@extends('front.layout')
@section('content')

    <section class="about pt-4 pt-lg-5">

        <div class="container">
            <div class="row">
                <div class="col-md-12" style="color: #000 !important;">
                    <?php
                    foreach($license as $clic) { ?>
                    <h4 style="color: #000;"><?php echo $clic->heading; ?></h4>
                    <p style="color: #000;"><?php echo $clic->description; ?></p>
                    
                    <?php
                    } ?> 
                </div>
            </div>
        </div>
    </section>
    
@endsection