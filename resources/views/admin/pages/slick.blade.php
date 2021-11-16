@extends('admin.layouts.sidebar')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/slick-carousel/slick-theme.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/slick-carousel/slick.min.js') }}"></script>

    <!-- Page JS Helpers (Slick Slider Plugin) -->
    <script>jQuery(function(){ One.helpers('slick'); });</script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Info -->
                <div class="block block-rounded">
                    <div class="block-header">
                        <h3 class="block-title">Plugin Example</h3>
                    </div>
                    <div class="block-content">
                        <p class="font-size-sm text-muted">
                            This page showcases how easily you can add a plugin’s JS/CSS assets and init it using a OneUI JS helper.
                        </p>
                    </div>
                </div>
                <!-- END Info -->

                <!-- Slider with dots -->
                <div class="block block-rounded">
                    <div class="block-header">
                        <h3 class="block-title">Dots</h3>
                    </div>
                    <div class="js-slider" data-dots="true">
                        <div>
                            <img class="img-fluid" src="{{ asset('media/photos/photo27@2x.jpg')}}" alt="photo">
                        </div>
                        <div>
                            <img class="img-fluid" src="{{ asset('media/photos/photo28@2x.jpg')}}" alt="photo">
                        </div>
                        <div>
                            <img class="img-fluid" src="{{ asset('media/photos/photo29@2x.jpg')}}" alt="photo">
                        </div>
                    </div>
                    <!-- END Slider with dots -->
                </div>
                <!-- END Dots -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
