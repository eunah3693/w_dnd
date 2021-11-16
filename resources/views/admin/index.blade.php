@extends('admin.layouts.admin_layout')
@section('css')
<link rel="stylesheet" href="/js/plugins/chart.js/Chart.min.css">
@endsection
@section('js')
<script src="/js/plugins/chart.js/Chart.min.js"></script>
@endsection
@section('content')

    {{-- Main Container --}}
    <main id="main-container">
        {{-- Page Content --}}
        <div class="content" style="max-width:1600px">
            {{-- Overview --}}
            <div class="row row-deck">
                <div class="col-sm-6 col-xl-3">
                    {{-- Pending Orders --}}
                    <div class="block block-rounded d-flex flex-column">
                        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="font-size-h2 font-w700">{{ $today_join }}</dt>
                                <dd class="text-muted mb-0"></dd>
                            </dl>
                            <div class="item item-rounded bg-body">
                                <i class="fa fa-2x fa-plus"></i>

                            </div>
                        </div>
                        <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                            <span class="font-w500 d-flex align-items-center font-w700" >
                                금일 가입자수
                            </span>
                        </div>
                    </div>
                    {{-- END Pending Orders --}}
                </div>
                <div class="col-sm-6 col-xl-3">
                    {{-- New Customers --}}
                    <div class="block block-rounded d-flex flex-column">
                        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="font-size-h2 font-w700">{{ $total_users }}</dt>
                                <dd class="text-muted mb-0"></dd>
                            </dl>
                            <div class="item item-rounded bg-body">
                                <i class="fa fa-2x fa-user-plus"></i>
                            </div>
                        </div>
                        <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                            <span class="font-w500 d-flex align-items-center font-w700"
                            >
                                총 가입자수
                            </span>
                        </div>
                    </div>
                    {{-- END New Customers --}}
                </div>
                <div class="col-sm-6 col-xl-3">
                    {{-- Messages --}}
                    <div class="block block-rounded d-flex flex-column">
                        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="font-size-h2 font-w700">{{ $post }}</dt>
                                <dd class="text-muted mb-0"></dd>
                            </dl>
                            <div class="item item-rounded bg-body">
                                <i class="fa fa-2x fa-newspaper"></i>
                            </div>
                        </div>
                        <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                            <span class="font-w500 d-flex align-items-center font-w700" >
                                새 피드수
                            </span>
                        </div>
                    </div>
                    {{-- END Messages --}}
                </div>
                <div class="col-sm-6 col-xl-3">
                    {{-- Conversion Rate --}}
                    <div class="block block-rounded d-flex flex-column">
                        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="font-size-h2 font-w700">{{ $today_login }}</dt>
                                <dd class="text-muted mb-0"></dd>
                            </dl>
                            <div class="item item-rounded bg-body">
                                <i class="fab fa-2x fa-internet-explorer"></i>
                            </div>
                        </div>
                        <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                            <span class="font-w500 d-flex align-items-center font-w700" >
                                금일 접속자수
                            </span>
                        </div>
                    </div>
                    {{-- END Conversion Rate--}}
                </div>
            </div>
            {{-- END Overview --}}


            {{-- Overview --}}
            <div class="row row-deck">
                <div class="col-sm-12 col-xl-4">
                            <div class="block block-rounded d-flex flex-column">
                                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between">
                                    <dl class="mb-0">
                                        <dt class="font-size-h2 font-w700"></dt>
                                        <dd class="text-muted mb-0">일별 포스트 수</dd>
                                    </dl>
                                </div>
                                <div class="block-content p-1 text-center overflow-hidden">
                                    {{-- Sparkline Line: Orders --}}
                                    <canvas id="postChart" width="400" height="400"></canvas>
                                    <span class="js-sparkline" data-type="line" id="post_chart" data-labels="@foreach ($post_list as $item){{ $item->date }}@if(!$loop->last),@endif @endforeach" data-points="[@foreach ($post_list as $item){{ $item->count }}@if(!$loop->last),@endif @endforeach]" ></span>
                                </div>
                                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                                    <span class="font-w500 d-flex align-items-center font-w700" >
                                        포스트 수
                                    </span>
                                </div>
                            </div>

                </div>
                <div class="col-sm-12 col-xl-4">
                            <div class="block block-rounded d-flex flex-column">
                                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between">
                                    <dl class="mb-0">
                                        <dt class="font-size-h2 font-w700"></dt>
                                        <dd class="text-muted mb-0">일별 가입자 수</dd>
                                    </dl>
                                    <div>
                                    </div>
                                </div>
                                <div class="block-content p-1 text-center overflow-hidden">
                                    <canvas id="joinChart" width="400" height="400"></canvas>
                                    <span class="js-sparkline" data-type="line" id="join_chart" data-labels="@foreach ($join_list as $item){{ $item->date }}@if(!$loop->last),@endif @endforeach" data-points="[@foreach ($join_list as $item){{ $item->count }}@if(!$loop->last),@endif @endforeach]" ></span>
                                </div>
                                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                                    <span class="font-w500 d-flex align-items-center font-w700" >
                                        일별가입자수
                                    </span>
                                </div>
                            </div>
                </div>

            </div>
            {{-- END Overview --}}




        </div>
        {{-- END Page Content --}}
    </main>
    {{-- END Main Container --}}
    @include('admin.layouts.footer')
    </div>
    {{-- END Page Container --}}


    {{-- Page JS Helpers (jQuery Sparkline Plugins) --}}
    <script>
        var ctx = document.getElementById('joinChart').getContext('2d');
        var labels = $('#join_chart').data('labels');
        var data =  $('#join_chart').data('points');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
            labels: labels.split(','),
            datasets: [{
                label: '가입자수',
                data: data,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
            },
        });

        var ctx = document.getElementById('postChart').getContext('2d');
        var labels = $('#post_chart').data('labels');
        var data =  $('#post_chart').data('points');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
            labels: labels.split(','),
            datasets: [{
                label: '포스트수',
                data: data,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
            },
        });
        </script>

@endsection
