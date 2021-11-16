@extends('admin.layouts.sidebar')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/fullcalendar/main.css') }}">
@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/fullcalendar/main.js') }}"></script>
    <script src="{{ asset('js/plugins/fullcalendar/locales/ko.js') }}"></script>

    <script src="{{ asset('js/pages/calendar.js') }}"></script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Calendar -->
        <div class="block block-rounded">
            <div class="block-content">
                <div class="row items-push">
                    <div class="col-md-8 col-lg-7 col-xl-9">
                        <!-- Calendar Container -->
                        <div id="js-calendar"></div>
                    </div>
                    <div class="col-md-4 col-lg-5 col-xl-3">
                        <!-- Add Event Form -->
                        <form class="js-form-add-event push">
                            <div class="input-group">
                                <input type="text" class="js-add-event form-control" placeholder="Add Event..">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-fw fa-plus-circle"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <!-- END Add Event Form -->

                        <!-- Event List -->
                        <ul id="js-events" class="list list-events">
                            <li>
                                <div class="js-event p-2 text-white font-size-sm font-w500 bg-info">Codename X</div>
                            </li>
                            <li>
                                <div class="js-event p-2 text-white font-size-sm font-w500 bg-success">Weekend Adventure</div>
                            </li>
                            <li>
                                <div class="js-event p-2 text-white font-size-sm font-w500 bg-info">Project Mars</div>
                            </li>
                            <li>
                                <div class="js-event p-2 text-white font-size-sm font-w500 bg-warning">Meeting</div>
                            </li>
                            <li>
                                <div class="js-event p-2 text-white font-size-sm font-w500 bg-success">Walk the dog</div>
                            </li>
                        </ul>
                        <div class="text-center">
                            <p class="font-size-sm text-muted">
                                <i class="fa fa-arrows-alt"></i> Drag and drop events on the calendar
                            </p>
                        </div>
                        <!-- END Event List -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Calendar -->
    </div>
    <!-- END Page Content -->
@endsection
