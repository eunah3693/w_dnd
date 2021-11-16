@extends('admin.layouts.admin_layout')
@section('css')
@endsection
@section('js')
@endsection
@section('content')


 {{-- Main Container --}}
<main id="main-container">
    <div class="content content-boxed">
            {{-- Story --}}
                <div class="block block-rounded">
                    {{-- <img class="img-fluid" src="/image/admin_test.jpg" alt=""> --}}
                    {{-- 이미지슬라이드 --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">@if(!$post->parent_idx) 미션 @else 댓글 @endif 상세보기</h3>
                        </div>
                        {{-- 이미지슬라이드 --}}
                        <div class="js-slider"  >
                            @if(!$post->parent_idx)
                                @foreach ($post->files as $f)
                                <div><img class="img-fluid" src="/thum/{{ $f->idx }}" alt=""></div>
                                @endforeach
                            @endif

                        </div>
                        {{-- 이미지슬라이드 --}}
                        <div class="block-content">
                            <h4 class="mb-1">
                                @if($post->mission && !$post->parent_idx)
                                {{ $post->mission->missionPool->title }}
                                @elseif(!$post->parent_idx)
                                일상
                                @endif
                            </h4>
                            <p class="font-size-sm">
                                <span class="text-primary">{{ $post->created_at }}</span>
                                <em class="text-muted">tag: {{ $post->tag }}</em>
                            </p>
                            내용
                            <p class="font-size-sm">
                                {!! $post->content !!}
                            </p>
                            <p class="font-size-sm">댓글</p>
                            <table class="table table-striped table-borderless table-vcenter">
                                <tbody>
                                    @foreach ($post->reply as $r1)
                                    <tr>
                                        <td>
                                            <span class="font-w600">{{ $r1->user->nickname }} : {!! $r1->content !!}</span>
                                            @foreach ($r1->reply as $r2)
                                            <br>ㄴ<span class="font-w600">{{ $r2->user->nickname }} : {!! $r2->content !!}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            {{-- END Story --}}
            <div class="col-lg-12 push js-appear-enabled animated fadeIn" data-toggle="appear" data-offset="50" data-class="animated fadeIn">
                <div class="block block-rounded block-link-pop">
                <div class="block-header block-header-default">
                    <h3 class="block-title">신고내역</h3>
                    <div class="block-options">

                    </div>
                </div>
                <div class="block-content">
                    <table class="table table-striped table-borderless table-vcenter">
                        <thead class="border-bottom">
                            <tr>
                                <th class="d-none d-md-table-cell text-center">신고자 아이디</th>
                                <th class="d-none d-md-table-cell text-center">신고사유</th>
                                <th class="d-none d-md-table-cell text-center">신고날짜</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report as $item)
                            <tr>
                                <td class="d-none d-md-table-cell text-center">
                                    <span>{{ $item->user->id }}</span>
                                </td>
                                <td class="d-none d-md-table-cell text-center" style="width:500px;">
                                    <span>{{  $item->content }}</span>
                                </td>
                                <td class="d-none d-md-table-cell text-center">
                                    <span>{{  $item->created_at }}</span>
                                </td>

                            </tr>
                            @endforeach

                                                                </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
{{-- END Main Container --}}
{{-- Footer --}}
@include('admin.layouts.footer')
{{-- END Footer --}}


</div>
{{-- END Page Container --}}
<script>
    $(function(){
        $(".js-slider").slick({
            slide: 'div',
            slidesToShow : 3,		// 한 화면에 보여질 컨텐츠 개수
            slidesToScroll : 1,
        });
    })
</script>
@endsection
