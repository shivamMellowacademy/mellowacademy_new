@extends('front.layout')
@section('content')

<br>

<section class="about">
  <header>
    <div class="container">
      <?php
          foreach($about as $a) { ?>  
      <h2 class="title"><?php echo $a->heading; ?></h2>
      <?php } ?>
      <div class="text-dark">
        <?php
          foreach($about as $a) { ?>
            <p><?php echo $a->description; ?></p>
        <?php } ?>
      </div>
    </div>
  </header>
  <div class="container-fluid">
    <div class="image">
      <?php
          foreach($about as $aa) { ?>
          <img src="<?php echo URL::asset('public/upload/about/'.$aa->image.'') ?>" alt="Alternate Text" />
      <?php } ?>
    </div>
  </div>
</section>


<section id="blog">
  <center>
        <header class="blog_header">
            <div class="container">
                <h2 class="h2 title text-dark">MEET THE TEAM</h2>
                <div class="text">
                    <p class="text-dark">Hire High-Performance Individual/Team, On Your Terms</p>
                </div>
            </div>
        </header>
  </center>
  <br>
  <div class="blog-box">
    <div class="blog-image">
      <img src="{{ URL::asset('public/upload/team/nikhil.jpeg') }}" alt="Blog">
    </div>
    <div class="blog-details">
      <h4 class="text-dark">MEET THE CEO</h4>
      <p class="text-dark">THROW HIM A CURVE BALL AND SEE HIS IDEAS
            THRIVE IN ACTION. NIKHIL IS UNRELENTING IN
            BREAKING DOWN COMPLEX ISSUES TO THEIR LAST
            THREAD. HE BRINGS AN INTERDISCIPLINARY
            APPROACH WITH AN EXPERIENCE OF OVER 12
            YEARS. HIS EXPERTISE LIES IN MARKETING, SALES,
            EVENT MANAGEMENT AND CRISIS MANAGEMENT.
            FROM IPL INAUGURAL CEREMONIES TO ISL
            INAUGURAL CEREMONIES, CONCERTS TO SOCIAL
            EVENTS, NIKHIL HAS SPEARHEADED ALL OF THEM.
            HE IS AN AVID OBSERVER, SPORTS ENTHUSIAST
            AND AN NCC CADET WHO BELIEVES THAT
            TECHNOLOGY HAS THE POWER TO TRANSFORM
            LIVES. OVER TIME HE HAS PLAYED THE ROLE OF AN
            ADVISOR AND MENTOR TO MANY NEW STARTUPS.
            TRULY A LEADER AND AN EMPATHETIC TEAM
            PLAYER</p>
      <a href="#">Nikhil Kothari</a>
    </div>
    
  </div>
  <div class="blog-box text-dark">
    <div class="blog-details text-dark">
      <h4 class="text-dark">MEET THE CTO</h4>
      <p class="text-dark">VIKASH KNOWS THE TACTIC TO FIX ALL. HE IS
        A DOER AND HAS RICH EXPERIENCE OF
        WORKING WITH ONE OF THE TECH GIANTS IN
        THE COUNTRY. HE HAS DELIVERED 100+
        INTERNATIONAL PROJECTS. HIS
        ENTREPRENEURIAL SPIRIT LED HIM TO BEGIN
        HIS TWO ENTERPRISES: 1. GATEPASS
        ONEYOUR'S NEW IDENTITY (IN PUNE) AND OF
        COURSE THE SEMINATOR INFOSYSTEM. HIS
        INTEREST LIES IN R&D ON NEW IDEA
        IMPLEMENTATION AND REAL-TIME CASE
        SOLVING. DON’T MISJUDGE HIM TO BE A TECHGEEK AS HE HAS ALSO ORGANISED LARGE
        SCALE HAPPENING EVENTS IN THE PAST AS
        WELL.</p>
      <a href="#" class="text-dark">Vikash Kumar Pandit</a>
    </div>
    <div class="blog-image">
      <img src="{{ URL::asset('public/upload/team/vixcy.jpg') }}" alt="Blog">
    </div>
    
  </div>
  <div class="blog-box">
    <div class="blog-image">
      <img src="{{ URL::asset('public/upload/team/Sumit Photo 1.jpg') }}" alt="Blog">
    </div>
    <div class="blog-details text-dark">
      <h4 class="text-dark">MEET THE CFO</h4>
      <p class="text-dark"> SUMIT TRULY KNOWS HOW TO LEAD FROM THE
            FRONT WITH HIS 18+ YEARS OF LEADERSHIP
            EXPERIENCE WITH CORPORATE GIANTS SUCH AS
            TRANSUNION CIBIL, HSBC, JP MORGAN, NOMURA,
            LEHMAN BROTHERS & CCIL. HE IS AN ADVISOR TO
            MULTIPLE CONSULTING COMPANIES IN INDIA AND
            ABROAD. HE HAS COMBINED HIS PASSION FOR
            SPORTS AND ADVISORY BY PROVIDING
            CONSULTATIONS TO CCUSA (CRICKET COUNCIL
            USA), SMRI, SPORTSCASTER MANAGEMENT ETC.
            HE IS ALSO THE CHAPTER PRESIDENT FOR MUMBAI
            REGION FOR GOVERNMENT BLOCKCHAIN
            ASSOCIATION (GBA), VIRGINIA, USA. AS A
            BLOCKCHAIN EVANGELIST, BPM EXPERT AND
            DESIGN THINKING PRACTITIONER, SUMIT AIMS TO
            REVOLUTIONIZE THE BLOCKCHAIN AND CRYPTO
            SPACE WITH HIS DYNAMIC LEADERSHIP
            EXPERIENCE, POWERING INNOVATION.</p>
      <a href="#" >Sumit Kumar Gugari</a>
    </div>
  </div>
  <div class="blog-box">
    <div class="blog-details text-dark">
      <h4 class="text-dark">MEET THE CMO</h4>
      <p class="text-dark">ASHISH IS A DIGITAL MARKETING AND
            CRYPTOCURRENCY EXPERT. HIS MARKET
            KNOWLEDGE OF ABOUT 13 YEARS IN DIGITAL
            MARKETING AND OVER 5 YEARS IN DEALING
            WITH CRYPTO SPACE HAS GIVEN HIM A
            PROFOUND EXPERTISE. HE HAS A STRONG
            HOLD ON SEO, SEM, SMO, PPC ADVERT AND
            OTHER AREAS OF EXPERTISE IN DIGITAL
            MARKETING. HE ALSO HAS A THOROUGH
            UNDERSTANDING OF ADVISORS, INVESTORS,
            COMMUNITY MANAGEMENT, DIGITAL
            SUPPORT, PROJECT PLANNING, BASICALLY
            THE ENTIRE ECOSYSTEM TO SUPPORT TOKEN/
            COIN IN CRYPTO REALM. IN SHORT OUR
            DIGITAL MARKETING GENIUS.</p>
      <a href="#" class="text-dark">Ashish Kumar Jain</a>
    </div>
    <div class="blog-image">
      <img src="{{ URL::asset('public/upload/team/ashis.jpg') }}" alt="Blog">
    </div>
  </div>
  <div class="blog-box">
    <div class="blog-image">
      <img src="{{ URL::asset('public/upload/team/sanjay.jpg') }}" alt="Blog">
    </div>
    <div class="blog-details" class="text-dark">
      <h4 class="text-dark">MEET THE CLO</h4>
      <p class="text-dark"> A SEASONED PRACTITIONER SANJAY HAS
            MULTIDIMENSIONAL KNOWLEDGE OF
            CORPORATE SECTOR AND IS WELL SKILLED
            IN DRAFTING AND PLEADING ALL KINDS OF
            LITIGATIONS AND PROCEEDING IN ALL
            LEVELS OF COURT RANGING FROM HIGH
            COURT OF CALCUTTA TO APEX COURT. HE
            HAS A CHARISMATIC PERSONALITY WITH A
            POSITIVE ATTITUDE. HE HAS BEEN
            ASSOCIATED WITH A NUMBER OF REPUTED
            LAW FIRMS AND CORPORATE HOUSES AS
            THEIR LEGAL ADVISOR FOR THE LAST FEW
            YEARS. CURRENTLY SERVING AS AN
            ARBITRATOR AT VARIOUS PRIVATE AND
            PUBLIC ARBITRATION PROCEEDINGS. WALL
            OF OUR COMPANY WE CALL HIM MR.
            DEPENDABLE</p>
      <a href="#" class="text-dark">Sanjay Sonkar</a>
    </div>
  </div>
</section>
          
@endsection


