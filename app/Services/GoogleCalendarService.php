<?php

namespace App\Services;

use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use App\Models\GoogleToken;

class GoogleCalendarService
{
    protected $client;

    public function __construct()
    {
        $this->client = new \Google_Client();
        $this->client->setAuthConfig(storage_path('app/google-calendar-credentials.json'));
        $this->client->addScope(\Google_Service_Calendar::CALENDAR);
        $this->client->setAccessType('offline');

        if (Session::has('google_calendar_token')) {
            $this->client->setAccessToken(Session::get('google_calendar_token'));

            if ($this->client->isAccessTokenExpired()) {
                if ($this->client->getRefreshToken()) {
                    $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                    Session::put('google_calendar_token', $this->client->getAccessToken());
                } else {
                    // token expired and no refresh token, force re-login
                    $this->client = null;
                    return;
                }
            }

            $this->service = new \Google_Service_Calendar($this->client);
        } else {
            // No token in session
            $this->client = null;
            $this->service = null;
        }
    }

    /**
     * Save the access token to the database
     * 
     * @param array $token
     */
    public function saveAccessToken($token)
    {
        GoogleToken::updateOrCreate([], [
            'access_token' => $token['access_token'],
            'refresh_token' => $token['refresh_token'],
            'expires_in' => $token['expires_in'],
        ]);
    }

    /**
     * Create an interview event in Google Calendar
     * 
     * @param string $name
     * @param string $email
     * @param string $date
     * @return string $meetLink
     */
    public function createInterviewEvent($name, $email, $date)
    {
        $service = new Google_Service_Calendar($this->client);

// If $date already includes time (e.g., '2025-05-04T06:30'), use Carbon directly
$startDateTime = Carbon::parse($date)->toRfc3339String(); // Example: '2025-05-04T10:00:00'
$endDateTime = Carbon::parse($date)->addMinutes(30)->toRfc3339String(); // Add 30 minutes for end time


        // Create the event details
        $event = new Google_Service_Calendar_Event([
            'summary' => 'Interview with ' . $name,
            'description' => 'Scheduled interview with ' . $name,
            'start' => [
                'dateTime' => $startDateTime,
                'timeZone' => 'Asia/Kolkata',
            ],
            'end' => [
                'dateTime' => $endDateTime,
                'timeZone' => 'Asia/Kolkata',
            ],
            'attendees' => [
                ['email' => $email],
            ],
            'conferenceData' => [
                'createRequest' => [
                    'requestId' => uniqid(),
                    'conferenceSolutionKey' => ['type' => 'hangoutsMeet'],
                ],
            ],
        ]);

        // Insert the event into the calendar and create the Google Meet link
        $createdEvent = $service->events->insert('primary', $event, ['conferenceDataVersion' => 1]);

        return $createdEvent->getHangoutLink(); // Return the Google Meet link
    }
}
