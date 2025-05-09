
@extends('front.layout')
@section('content')

<section class="contact">
    <div>
        
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="contact-block">
                    <div class="contact-info">
                        <div class="row">
                            <?php $i=1;
                            foreach($cont as $con) { ?>
                            <div class="col-sm-4">
                                <figure class="text-center">
                                    <span class="icon icon-map-marker"></span>
                                    <figcaption>
                                        <strong class="text-dark">Address</strong>
                                        <span class="text-dark"><?php echo $con->address; ?></span>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="col-sm-4">
                                <figure class="text-center">
                                    <span class="icon icon-phone"></span>
                                    <figcaption>
                                        <strong class="text-dark">Call us</strong>
                                        <span class="text-dark">
                                            <?php echo $con->phone; ?>
                                                                                        
                                        </span>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="col-sm-4">
                                <figure class="text-center">
                                    <span class="icon icon-envelope"></span>
                                    <figcaption>
                                        <strong class="text-dark">Email</strong>
                                        <span class="text-dark">
                                            <?php echo $con->email; ?>
                                           
                                        </span>
                                    </figcaption>
                                </figure>
                            </div>
                            <?php if ($i++ == 1) break;
                        } ?>
                        </div>
                    </div>

                    <div class="contact-info">
                        <h2 class="title" style="font-size: 19px;">Send an email</h2>
                            <div class="row">
                                <div class="col-lg-8 ml-auto mr-auto">
                                    @if(Session::has('errmsg'))                 
                                        <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                               <strong>{{Session::get('errmsg')}}</strong>
                                        </div>
                                        {{Session::forget('message')}}
                                        {{Session::forget('errmsg')}}
                                    @endif
                                </div>
                            </div>
                            <div class="contact-form-wrapper">
                                <div class="contact-form clearfix">
                                    <form method="post" action="{{route('submit_query')}}" >
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-control" placeholder="Your name" required="required">
                                                    @if ($errors->has('name'))
                                                        <strong class="text-danger">{{ $errors->first('name') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-control" placeholder="Your email" required="required">
                                                    @if ($errors->has('email'))
                                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="tel" name="phone" class="form-control" maxlength="10" placeholder="Phone" required="required">
                                                    @if ($errors->has('phone'))
                                                        <strong class="text-danger">{{ $errors->first('phone') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="subject" class="form-control" placeholder="Subject" required="required">
                                                    @if ($errors->has('subject'))
                                                        <strong class="text-danger">{{ $errors->first('subject') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="mesage" placeholder="Your message" rows="10"></textarea>
                                                    @if ($errors->has('mesage'))
                                                        <strong class="text-danger">{{ $errors->first('mesage') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-center">
                                                <input type="submit" class="btn btn-primary" value="Send message" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                    
                </div> 
            </div>
        </div> 
    </div>
</section>
    <script>
        function initMap() {
            var contentString =
                '<div class="map-info-window">' +
                '<p><img src="assets/images/divano-logo.png" alt="" width="150"></p>' +
                '<p><strong>Divano - Furniture Template</strong></p>' +
                '<p><i class="fa fa-map-marker"></i> 200 12th Ave, New York, NY 10001, USA</p>' +
                '<p><i class="fa fa-phone"></i> +12 33 444 555</p>' +
                '<p><i class="fa fa-clock-o"></i> 10am - 6pm</p>' +
                '</div>';

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
            //set default pposition
            var myLatLng = { lat: 40.7459772, lng: -74.0545504 };
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: myLatLng,
                styles: [{ "featureType": "administrative", "elementType": "all", "stylers": [{ "visibility": "on" }, { "saturation": -100 }, { "lightness": 20 }] }, { "featureType": "road", "elementType": "all", "stylers": [{ "visibility": "on" }, { "saturation": -100 }, { "lightness": 40 }] }, { "featureType": "water", "elementType": "all", "stylers": [{ "visibility": "on" }, { "saturation": -10 }, { "lightness": 30 }] }, { "featureType": "landscape.man_made", "elementType": "all", "stylers": [{ "visibility": "simplified" }, { "saturation": -60 }, { "lightness": 10 }] }, { "featureType": "landscape.natural", "elementType": "all", "stylers": [{ "visibility": "simplified" }, { "saturation": -60 }, { "lightness": 60 }] }, { "featureType": "poi", "elementType": "all", "stylers": [{ "visibility": "off" }, { "saturation": -100 }, { "lightness": 60 }] }, { "featureType": "transit", "elementType": "all", "stylers": [{ "visibility": "off" }, { "saturation": -100 }, { "lightness": 60 }] }]
            });
            //set marker
            var image = 'assets/images/map-icon.png';
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: "Hello World!",
                icon: image
            });
            marker.addListener('click', function () {
                infowindow.open(map, marker);
            });
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}"></script>


@endsection