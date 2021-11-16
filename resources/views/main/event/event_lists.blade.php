@extends('main.layouts.layout')

@section('title', '이벤트')
@section('nav', 100002)


@section('css')
<link rel="stylesheet" href="css/DND-STYLE/event_lists.css">


@endsection

@section('js')
<script src="/js/DND-JS/event_lists.js"></script>

@endsection

@section('search')

@endsection

@section('content')
    <ul class="tab_title clearboth">
        <li class="on"><a href="/event">진행 중 이벤트</a></li>
        <li><a href="/event?type=1">종료된 이벤트</a></li>
    </ul>
    <div class="tab_cont">
        <div class="on tab-one">
            <section class="event-section">
                @if (count($data) == 0)
                    <p style="padding-top: 100px; text-align:center;">진행중인 이벤트가 없습니다.</p>
                @endif
                @foreach ($data as $item)
                <div class="event-box">
                    <a href="@isset($item->link_url) {{ $item->link_url }} @else/event_detail?idx={{ $item->idx }}@endisset">
                        @if ($item->thum_file_idx)<img src="/files/{{ $item->thum_file_idx }}" alt="">@endif
                        <div class="cont-box">
                            <p class="counting">{{ substr($item->startdate, 0, 10) }} ~ {{ substr($item->enddate, 0, 10) }}</p>
                        </div>
                    </a>
                    @if ($item->startdate > date('Y-m-d H:i'))
                    <div class="bg-layer"><p> 진행 예정  </p></div>
                    @endif
                </div>
                @endforeach
            </section>
        </div>
        <div class="tab-two">
            <section class="event-section">
                @if (count($data) == 0)
                    <p style="padding-top: 100px; text-align:center;">종료된 이벤트가 없습니다.</p>
                @endif
                @foreach ($data as $item)
                <div class="event-box">
                    <a href="/event">
                        @if ($item->thum_file_idx)<img src="/files/{{ $item->thum_file_idx }}" alt="">@endif
                        <div class="cont-box">

                            <!-- <p class="counting">{{ substr($item->startdate, 0, 10) }} - {{ substr($item->enddate, 0, 10) }}</p> -->
                        </div>
                    </a>
                    <div class="bg-layer"><p>종료</p></div>
                </div>
                @endforeach
            </section>
        </div>
    </div>
@endsection
