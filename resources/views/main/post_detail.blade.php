@extends('main.layouts.layout')

@section('title', '상세보기')
@section('nav', 100000)

@section('top_back', 'javascript:window.history.back()')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/cards.css">
<link rel="stylesheet" href="/js/DND-JS/animista.css">
<link rel="stylesheet" href="/css/DND-STYLE/post_detail.css">
<link rel="stylesheet" href="js/plugins/mentiony/css/jquery.mentiony.css">
@endsection

@section('js')
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script>
// SDK를 초기화 합니다. 사용할 앱의 JavaScript 키를 설정해 주세요.
Kakao.init('11957eb969b57c54768c4fb033eaa8f8');
</script>
<script src="js/plugins/mentiony/js/jquery.mentiony.js"></script>
<script src="/js/DND-JS/cards.js"></script>
<script src="/js/DND-JS/post_detail.js"></script>
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
window.onload = function() {
    getFeedTag();
    if(getParameterByName('comment') == 'true')
    {
        var offset = $("#comment_list").offset();
        $('html, body').animate({scrollTop : offset.top - 99}, 400);
    }
};
</script>
@endsection

@section('content')
<section>
    <div class="cards-div">
        <ul>
            <li>
                <div class="card-lists">
                    <div class="title clearboth">
                        <a href="/myfeed?user_idx={{$post[0]->user_idx}}">
                            @if ($post[0]->user->file_idx)
                            <img src="/files/{{ $post[0]->user->file_idx }}" alt="">
                            @else
                            <img src="/image/mp_top_profile_icon.svg" alt="">
                            @endif
                        </a>
                        <p>{{ $post[0]->user->nickname }}</p>
                        <a href="javascript:void(0)" id="share_post{{$post[0]->idx}}" data-url="/post_detail?post_idx={{ $post[0]->idx }}" onclick="sharePage(this)"  class="button">공유</a>
                            <a href="javascript:void(0)" onclick="setReport({{$post[0]->idx}})" class="button btn_report">신고</a>
                    </div>
                    <div class="pics">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @if(count($post[0]->files)!=0)
                                    @foreach ($post[0]->files as $file)
                                    <div class="swiper-slide">
                                        <div class="swiper-slide-img-box">
                                            <a onclick="openAppGallery({{ $post[0]->idx }}, {{ $loop->index }})">
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
                    <div id="comment_list"></div>
                    <div class="cont">
                        <div class="cont-box">
                            {!! $post[0]->content !!}<br>
                            @isset($post[0]->mission->missionPool->tag)
                            <div class="card-div-tag">{{ $post[0]->mission->missionPool->tag }}</div>
                            @else
                            <div class="card-div-tag">일상</div>
                            @endisset
                            <!-- 추가 -->
                            <!-- 추가 -->
                            {{--@if (session('idx') == $post[0]->user_idx)
                            @if (!$post[0]->mission_idx)
                            <a href="javascript:if(confirm('게시물을 삭제하시겠습니까?')){location.href='/api/mypost/delete/{{ $post[0]->idx }}'};" style="padding-left:20px;float: right;"><i class="xi-trash-o"></i></a>
                            @endif
                            <a href="/mypost_update?idx={{ $post[0]->idx }}" style="padding-left:20px;float: right;"><i class="xi-pen"></i></a>
                            @endif--}}
                        </div>
                        <div class="number-group">
                            <div class="like">
                            @if ($post[0]->user_like != 1)
                                <img class="likes-off" data-like='false' onclick="setLike({{$post[0]->idx}}, this)" src="/image/n-heart.svg" alt="">
                            @else
                                <img class="likes-on" data-like='true' onclick="setLike({{$post[0]->idx}}, this)" src="/image/n-heart-p.svg" alt="">
                            @endif
                                <span  class="like_number">{{ $post[0]->like_count }}</span>
                            </div>
                            <div class="comment">
                                <img src="/image/n-comment.svg" alt="">
                                <span class="comment-number">{{ count($post[0]->reply) + $post[0]->sub_reply_count  }}</span>
                            </div>
                        </div>
                        @if ($post[0]->user_bookmark != 1)
                        <div class="bookmark">
                            @if (session('idx') == $post[0]->user_idx)
                                @if (!$post[0]->mission_idx)
                                <a href="javascript:if(confirm('게시물을 삭제하시겠습니까?')){location.href='/api/mypost/delete/{{ $post[0]->idx }}'};" style="padding-left:20px;float: left;"><img src="/image/n-delete.svg" alt=""></a>
                                @endif
                                <a href="/mypost_update?idx={{ $post[0]->idx }}" style="padding-left:20px;float: left;padding-right:20px;"><img src="/image/n-edit.svg" alt=""></a>
                            @endif
                            <img onclick="setBookMark({{$post[0]->idx}}, this)" class="xi-bookmark-o deactive" src="/image/n-bookmark.svg" alt="">
                        </div>
                        @else
                        <div class="bookmark">
                            @if (session('idx') == $post[0]->user_idx)
                                @if (!$post[0]->mission_idx)
                                <a href="javascript:if(confirm('게시물을 삭제하시겠습니까?')){location.href='/api/mypost/delete/{{ $post[0]->idx }}'};" style="padding-left:20px;float: left;"><img src="/image/n-delete.svg" alt=""></a>
                                @endif
                                <a href="/mypost_update?idx={{ $post[0]->idx }}" style="padding-left:20px;float: left;padding-right:20px;"><img src="/image/n-edit.svg" alt=""></a>
                            @endif
                            <img onclick="setBookMark({{$post[0]->idx}}, this)" class="xi-bookmark active" src="/image/n-bookmark-p.svg" alt="">
                        </div>
                        @endif
                    </div>
                </div>
                <div class="comment-list">
                    <ul id="comment_list_ul">
                        @if (count($post[0]->reply) != 0)
                            @foreach ($post[0]->reply as $reply)
                            <li>

                                <div>

                                    <div class="comment-title">
                                        <div class="image-box">
                                            <a href="/myfeed?user_idx={{$reply->user->idx}}">
                                                @if ($reply->user->file_idx)
                                                <img src="/files/{{ $reply->user->file_idx }}" alt="">
                                                @else
                                                <img src="/image/mp_top_profile_icon.svg" alt="">
                                                @endif
                                            </a>
                                        </div>

                                        <div class="comment-likes @foreach ($reply->like as $like)@if ($like->user_idx == session('idx')) active-l @break @endif @endforeach " onclick="setReplyLike({{$reply->idx}}, this,{{$post[0]->idx}})"><i class="xi-heart xi-2x"></i></div>
                                        <div class="content-box">
                                            <p class="nickname">{{ $reply->user->nickname }}</p>
                                            <p class="content">{!! $reply->content !!}</p>
                                            <p class="bottom"><span class="comment-date">{{ substr($reply->created_at, 0, 10) }}</span> <a data-commentidx="{{$reply->idx}}" onclick="setComment({{$reply->idx}},'{{$reply->user->nickname}}')" class="comment">답글달기</a>
                                                <button class="comment-report" onclick="setReport({{$reply->idx}})">신고</button>
                                                @if (session('idx') == $reply->user->idx)
                                                <button class="comment-delete" onclick="deleteComment({{$reply->idx}})">삭제</button>
                                                @endif
                                            </p>
                                        </div>
                                        {{-- 대댓글 --}}
                                        <ul id="comment_list_ul{{ $reply->idx }}">
                                            <li></li>
                                            @foreach ($reply->reply as $reply2)
                                            <li>
                                                <div>
                                                    <div class="comment-title sub-comment">
                                                        <div class="image-box">
                                                            <a href="/myfeed?user_idx={{$reply2->user->idx}}">
                                                                @if ($reply2->user->file_idx)
                                                                <img src="/files/{{ $reply2->user->file_idx }}" alt="">
                                                                @else
                                                                <img src="/image/mp_top_profile_icon.svg" alt="">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="comment-likes @foreach ($reply2->like as $like)@if ($like->user_idx == session('idx')) active-l @break @endif @endforeach " onclick="setReplyLike({{$reply2->idx}}, this,{{$post[0]->idx}})"><i class="xi-heart xi-2x"></i></div>
                                                    <div class="content-box">
                                                        <p class="nickname">{{ $reply2->user->nickname }}</p>
                                                        <p class="content">{!! $reply2->content !!}</p>
                                                        <p class="bottom"><span class="comment-date">{{ substr($reply2->created_at, 0, 10) }}</span>
                                                            <button class="comment-report" onclick="setReport({{$reply2->idx}})">신고</button>
                                                            @if (session('idx') == $reply2->user->idx)
                                                            <button class="comment-delete" onclick="deleteComment({{$reply2->idx}})">삭제</button>
                                                            @endif
                                                        </p>
                                                    </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        @else
                            <img class="comment-img" src="/image/icon/nocomment-icon.svg" alt="">
                        @endif
                    </ul>
                    {{-- 글작성 폼 --}}
                    @if(session('idx'))
                    <div class="post-comment-info" style="display:none;">
                        <p><span id="user_name">fff</span>님께 답글 남기는 중</p>
                        <i class="xi-close xi-1x" onclick="setCommentClose({{$post[0]->idx}})"></i>
                    </div>
                    <div class="comment-form clearboth" >
                        <div class="image-box">
                            @if ($user->file_idx)
                            <img src="/files/{{ $user->file_idx }}" alt="">
                            @else
                            <img src="/image/mp_top_profile_icon.svg" alt="">
                            @endif
                        </div>
                        <form method="POST" action="/api/post/set_reply" id="comment_form" class="cm-form">
                            <input name="main_post_idx" id="main_post_idx" type="hidden" value="{{$post[0]->idx}}">
                            <input name="post_idx" id="post_idx" type="hidden" value="{{$post[0]->idx}}">
                            <input name="content"  id="textarea" class="content_1" placeholder="댓글을 입력하세요." style="display: none">
                            <button type="button" class="comment-submit" onclick="setCommentForm()">게시</button>
                        </form>
                    </div>
                    @endif
                </div>
            </li>
        </ul>
    </div>
</section>

@endsection


