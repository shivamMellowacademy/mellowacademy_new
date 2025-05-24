<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class CheckUnpaidAdvancePayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:unpaid-advances';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for unpaid employee advance payments and send reminders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('developer_details_tb')
        ->join('developer_order_tb', 'developer_order_tb.dev_id', '=', 'developer_details_tb.dev_id')
        ->join('employee_details', 'employee_details.id', '=', 'developer_order_tb.u_id')
        ->get();
    }
}
