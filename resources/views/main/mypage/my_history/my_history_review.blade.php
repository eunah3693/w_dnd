@extends('main.layouts.layout')

@section('title', '리뷰 작성')
@section('nav', 100004)

@section('top_back', '/myhistory')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/adress.css">
<link rel="stylesheet" href="css/DND-STYLE/my_history.css">


@endsection

@section('js')
<script src="/js/DND-JS/my_history_review.js"></script>
@endsection

@section('content')
    <section>
        <ul>
            <li class="history-lists">
                <div class="a-group">
                    @if ($data->status == '배송지미입력')
                    <a href="/adress?idx={{ $data->idx }}">
                        <div class="img-box">
                            <img src="/files/{{ $data->event->thum_file_idx }}" alt="">
                        </div>
                    </a>
                    @else
                    <a href="/myshipping?idx={{ $data->idx }}">
                        <div class="img-box">
                            <img src="/files/{{ $data->event->thum_file_idx }}" alt="">
                        </div>
                    </a>
                    @endif
                    <div class="cont-box">
                        <p class="date">{{  substr($data->created_at, 0, 10) }}</p>
                        @if ($data->status == '배송지미입력')
                        <p class="title"><a href="/adress?idx={{ $data->idx }}">{{ $data->event->title }}</a></p>
                        @else
                        <p class="title"><a href="/myshipping?idx={{ $data->idx }}">{{ $data->event->title }}</a></p>
                        @endif
                        @if ($data->status == '배송지미입력')
                        <p class="status-btn">{{ $data->status }}</p>
                        @else
                        <p class="status">{{ $data->status }}</p>
                        @endif
                    </div>
                </div>
            </li>
            <li>
                <div class="adress-box">
                    <div class="head clearboth">
                        <p>리뷰 작성하기</p>
                        <p id="star_grade">
                            @isset($review)
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($review->score > $i)
                                    <a href="" class="on" onclick="return false;">★</a>
                                    @else
                                    <a href="" onclick="return false;">★</a>
                                    @endif
                                @endfor
                            @else
                            <a class="on" onclick="return false;">★</a>
                            <a class="on" onclick="return false;">★</a>
                            <a class="on" onclick="return false;">★</a>
                            <a class="on" onclick="return false;">★</a>
                            <a class="on" onclick="return false;">★</a>
                            @endisset
                        </p>
                    </div>
                    <div class="adress-form clearboth">
                        <form action="/api/my/review/insert" method="post" class="info clearboth" enctype="multipart/form-data" >
                            <input type="file" id="profile-pic" style="display: none" name="file" accept="image/*">
                            <input type="hidden" name="score" id="score" value="@isset($review){{ $review->score }}@else 5 @endisset" placeholder="별점을 체크해주세요">
                            <input type="hidden" name="order_idx" value="{{ $data->idx }}" required>
                            <input type="hidden" name="event_idx" value="{{ $data->event_idx }}" required>
                            @isset($review)
                                <input type="hidden" name="review_idx" value="@isset($review){{ $review->idx }}@endisset" required>
                            @endisset
                            <label class="profile-pic-label" for="profile-pic" style="width:100%; float: left;font-size: 25px; line-height: 60px; box-sizing: border-box;
                            color: #7e7e7e;   margin: 10px;">
                            이미지 추가
                            @isset($review)
                                @if($review->file_idx)
                                <div class="review-cont  clearboth" style="margin-right:20px;">
                                    <img  id="img" width="80px" src="/thum/{{ $review->file_idx }}" alt="">
                                </div>

                                @else
                                <div class="review-cont  clearboth" style="margin-right:20px;">
                                    <img class="review-cont clearboth" id="img" width="80px" src="/image/app/no_user_profile.png" alt="" style="display: none">
                                </div>
                                @endif
                            @else
                            <div class="review-cont  clearboth" style="margin-right:20px;">
                                <img  id="img" width="80px" src="/image/app/no_user_profile.png" alt="" style="display: none">
                            </div>
                            @endisset
                            </label>
                            <p style="width:130px;">내용</p><textarea type="text" name="content" style="resize: none" class="review-cont clearboth" required>@isset($review){{ $review->content }}@endisset</textarea>
                            <button class="save-btn" type="submit">완료!</button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </section>
@endsection
