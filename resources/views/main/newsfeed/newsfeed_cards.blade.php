@extends('main.layouts.layout')

@section('title', $title)
@section('nav', 100000)
@section('top_back', 'javascript:window.history.back()')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/cards.css">
<link rel="stylesheet" href="/js/DND-JS/animista.css">
<link rel="stylesheet" href="css/DND-STYLE/horizontal-scroll.css">
@endsection

@section('js')
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script>
// SDK를 초기화 합니다. 사용할 앱의 JavaScript 키를 설정해 주세요.
Kakao.init('11957eb969b57c54768c4fb033eaa8f8');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
<script src="/js/DND-JS/cards.js"></script>
<script src="/js/DND-JS/horizontal-scroll.js"></script>
<script>
function getFeedTag()
{
    $( ".card-div-tag" ).each(function( index ) {
        var tag =  $( this ).html();
        if(tag.indexOf('href') === -1){
            var textArr = tag.split(', ');
            var tag = '';
            for(var i=0; i < textArr.length; i++){
                tag += '<a href="/newsfeed?tag[]='+textArr[i]+'" class="hash-tag">'+textArr[i]+'</a> ';
            }
            $( this ).html(tag);
        }
    });
}
$('ul.pagination').hide();
    $(function() {
        $('.scrolling-pagination').jscroll({
            autoTrigger: true,
            padding: 0,
            loadingHtml: '<div style="text-align: center"><img class="center-block" src="/image/loading.gif" alt="Loading..." /></div>',
            nextSelector: '.pagination li.active + li a',
            contentSelector: '.scrolling-pagination ul',
            callback: function() {
                getFeedTag();
                $('ul.pagination').remove();
                var swiper = new Swiper('.swiper-container', {
                    autoHeight: true, //enable auto height
                    loop: $(this).find("swiper-slide").length > 1 ? true : false,
                    pagination: {
                        el: '.swiper-pagination',
                    },
                });
            }
        });
    });
    $(function () {
        getPageReload()
    });

</script>
@endsection

@section('search')
<form method="get">
        <li>
            <div class="search-wrapper">
                <div class="input-holder">
                    <input type="search" class="search-input" name="search"  placeholder="검색어를 입력하세요" />
                    <button class="search-icon search-toggle"><span></span></button>
                </div>
            </div>
        </li>
</form>
@endsection

@section('content')
<form method="get">
    @if($title == '마이피드')
    <input name="user_idx" type="hidden" value="{{$user->idx}}">
    @endif
    <div class="horizontal-scroll-menu">
        <div class="filter-fixed box">
            @if (Request::get('order') != 'like')
            <label class="box-radio-input sort time"><input type="checkbox" name="order" value="like"><span>최신순</span><div class="sort-icon"><img src="/image/sort.svg" alt=""></div></label>
            @else
            <label class="box-radio-input sort like"><input type="checkbox" name="order" value="date"><span>좋아요</span><div class="sort-icon"><img src="/image/sort.svg" alt=""></div></label>
            @endif
        </div>
        <div class="filter-scroll box">
            <label class="box-radio-input daily-m-btn"><input type="checkbox" name="tag[]"
                @if(Request::get('tag'))@foreach (Request::get('tag') as $item) @if ($item == '일상') checked @endif @endforeach @endif
                value="일상"><span>일상</span></label>
            <label class="box-radio-input "><input class="input-mission" type="checkbox" name="tag[]"
                @if(Request::get('tag'))@foreach (Request::get('tag') as $item) @if ($item == '미션') checked @endif @endforeach @endif
                value="미션"><span>미션</span></label>
            <label class="box-radio-input input-hide "><input type="checkbox" name="tag[]"
                @if(Request::get('tag'))@foreach (Request::get('tag') as $item) @if ($item == '놀이') checked @endif @endforeach @endif
                value="놀이"><span>놀이</span></label>
            <label class="box-radio-input input-hide "><input type="checkbox" name="tag[]"
                @if(Request::get('tag'))@foreach (Request::get('tag') as $item) @if ($item == '교육') checked @endif @endforeach @endif
                value="교육"><span>교육</span></label>
            <label class="box-radio-input input-hide "><input type="checkbox" name="tag[]"
                @if(Request::get('tag'))@foreach (Request::get('tag') as $item) @if ($item == '케어') checked @endif @endforeach @endif
                value="케어"><span>케어</span></label>
            <label class="box-radio-input input-hide "><input type="checkbox" name="tag[]"
                @if(Request::get('tag'))@foreach (Request::get('tag') as $item) @if ($item == '산책') checked @endif @endforeach @endif
                value="산책"><span>산책</span></label>
        </div>
    </div>
</form>
<section class="cards-section">
<!-- <span class="anchor" id="section1"></span> -->

    <div class="cards-div scrolling-pagination">
        <ul>
            @if (count($post) == 0)

            <li style="text-align:center; position:absolute; width:100%; height:100%; background-color:#fff; "><img style="width:270px;" src="/image/icon/no_text.jpg"></li>
            @endif
            @foreach($post as $p)
            <li class="card-ind"  id="cards_{{$p->idx}}" data-idx="{{$p->idx}}">
                <div class="card-lists">
                <span class="anchor" id="section1"></span>

                    <div class="title clearboth">
                        <a href="/myfeed?user_idx={{$p->user->idx}}">
                            @if ($p->user->file_idx)
                            <img src="/files/{{ $p->user->file_idx }}" alt="">
                            @else
                            <img src="image/mp_top_profile_icon.svg" alt="">
                            @endif
                        </a>
                        <p>{{ $p->user->nickname }}</p>
                            <a href="javascript:void(0)" id="share_post{{$p->idx}}" data-url="/post_detail?post_idx={{ $p->idx }}&page={{ $post->currentPage() }}" onclick="sharePage(this)"  class="button">공유</a>
                            <a href="javascript:void(0)" data-postidx="{{ $p->idx }}" onclick="setReport({{$p->idx}})" class="button btn_report">신고</a>
                    </div>
                    <div class="pics">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @if(count($p->files)!=0)
                                    @foreach ($p->files as $file)
                                    <div class="swiper-slide">
                                        <div class="swiper-slide-img-box">
                                            <a onclick="openAppGallery({{ $p->idx }}, {{ $loop->index }})">
                                                @if (strpos($file->mime_type, 'video') !== false)
                                                <video src="/files/{{ $file->idx }}" poster="/thum/{{ $file->idx }}" loop playsinline autoplay="autoplay" muted="muted" ></video>
                                                @else
                                                <img src="/files/{{ $file->idx }}" alt="">
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                <div class="swiper-slide"><div class="swiper-slide-img-box"><a><img src="/files/1" alt=""></a></div></div>
                                @endif
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    <div class="cont">
                        <div class="cont-box">
                            {!! $p->content !!}<br>
                            <!-- 추가 -->
                            @isset($p->mission->missionPool->tag)
                            <div class="card-div-tag">{{ $p->mission->missionPool->tag }}</div>
                            @else
                            <div class="card-div-tag">일상</div>
                            @endisset
                        </div>
                        <div class="number-group">
                            <div class="like">
                            @if ($p->user_like != 1)
                                <img class="likes-off" data-like = 'false' onclick="setLike({{$p->idx}}, this)" src="/image/n-heart.svg" alt="">
                                @else
                                <img class="likes-on" data-like = 'true' onclick="setLike({{$p->idx}}, this)" src="/image/n-heart-p.svg" alt="">
                                @endif
                                <span  class="like_number">{{ $p->like_count }}</span>
                            </div>
                            <div class="comment">
                                <img src="/image/n-comment.svg" onclick="javascript:location.href='/post_detail?post_idx={{$p->idx}}&comment=true';" alt="">
                                <span class="comment-number">{{ count($p->reply) + $p->sub_reply_count  }}</span>
                            </div>
                        </div>

                        @if ($p->user_bookmark != 1)
                        <div class="bookmark " >
                            @if (session('idx') == $p->user_idx)
                                @if (!$p->mission_idx)
                                <a href="javascript:if(confirm('게시물을 삭제하시겠습니까?')){location.href='/api/mypost/delete/{{ $p->idx }}'};" style="padding-left:20px;float: left;"><img src="/image/n-delete.svg" alt=""></a>
                                @endif
                                <a href="/mypost_update?idx={{ $p->idx }}" style="padding-left:20px;float: left;padding-right:20px;"><img src="/image/n-edit.svg" alt=""></a>
                            @endif
                            <img onclick="setBookMark({{$p->idx}}, this)" class="xi-bookmark-o deactive" src="/image/n-bookmark.svg" alt="">
                        </div>
                        @else
                        <div class="bookmark " >
                            @if (session('idx') == $p->user_idx)
                                @if (!$p->mission_idx)
                                <a href="javascript:if(confirm('게시물을 삭제하시겠습니까?')){location.href='/api/mypost/delete/{{ $p->idx }}'};" style="padding-left:20px;float: left;"><img src="/image/n-delete.svg" alt=""></a>
                                @endif
                                <a href="/mypost_update?idx={{ $p->idx }}" style="padding-left:20px;float: left;padding-right:20px;"><img src="/image/n-edit.svg" alt=""></a>
                            @endif
                            <img onclick="setBookMark({{$p->idx}}, this)" class="xi-bookmark active" src="/image/n-bookmark-p.svg" alt="">
                        </div>
                        @endif
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        {!! $post->render() !!}
        <div class="page-navigator-bg">
            <a class="mission-button" href="/mission">미션</a>
            <a class="daily-button mission_pet_check" href="/mypost">일상</a>
        </div>
        <div class="page-navigator-wrapper">
            <button class="page-navigator-button"></button>
        </div>
    </div>
</section>
@endsection


