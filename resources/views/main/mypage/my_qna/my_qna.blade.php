@extends('main.layouts.layout')

@section('title', '1:1 문의')
@section('nav', 100004)

@section('top_back', '/my')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/my_qna.css">


@endsection

@section('js')
<script src="/js/DND-JS/my_qna.js"></script>
<script src="/js/DND-JS/faq.js"></script>


@endsection

@section('content')
    <ul class="tab_title">
        <li class="on">나의 질문 모아보기</li>
        <li>1:1 문의 하기</li>
    </ul>
    <div class="tab_cont">
        <div class="on tab-one">
            <section class="q-section">
                @if (count($data) == 0)
                <p style="text-align:center; background-color: #fff; position: absolute; left: 0; right: 0;"><img src="/image/no_list.png" alt="문의내역이 없습니다" style="width:270px;"></p>
                @endif
                @foreach ($data as $item)
                <a href="/myqna_answer?idx={{ $item->idx }}" class="q-box question ">
                    <div class="cont-box">
                        <h2>{{ $item->title }}</h2>
                        <!-- <div>{!! $item->content !!}</div> -->
                        <p class="counting">{{ substr($item->created_at, 0, 10) }}</p>
                    </div>
                    {{-- <div class="bg-layer"><p>답변완료  </p></div> --}}
                </a>
                <!-- <div class="answer">
                    @if (count($item->reply) == 0) <p>아직 답변이 없습니다.</p>@endif
                    @foreach ($item->reply as $reply)
                        <p> {{$reply->content}}</p>
                    @endforeach
                </div> -->
                @endforeach
            </section>
        </div>
        <div class="tab-two">
            <section class="inquiry-section">
                <div class="inquiry-box">
                    <form action="/myqna/insert" method="post">
                        @csrf
                        <fieldset class="info">
                            <input type="text" placeholder="제목" name="title" required> <br>
                            <textarea name="content" id=""  style="resize: none;" required placeholder="질문을 입력 해 주세요!"></textarea>
                        </fieldset>
                        <button class="save-btn" type="submit">
                        질문 등록
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
