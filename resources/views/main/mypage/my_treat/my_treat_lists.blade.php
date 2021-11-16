@extends('main.layouts.layout')

@section('title', '트릿 관리')
@section('nav', 100004)

@section('top_back', '/my')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/my_treat_lists.css">

@endsection

@section('js')

@endsection

@section('content')
    <section>
        <p class="treat-title">총 {{ number_format($total_treat) }} 트릿</p>
        <ul>
            @if (count($data) == 0)
            <li style="text-align: center;font-size: 25px;">
                보유 트릿이 없습니다.
            </li>
            @endif
            @foreach ($data as $v)
                @if (strpos( $v->treat,"-") !== false)
                <li class="redeem treat-lists">
                    <div class="icon-box">
                        <div class="tr-img-wrapper">
                            <img src="image/minus_icon.svg" alt="">
                        </div>
                        <p>{{ $v->treat }}트릿</p>
                    </div>
                    <div class="cont-box">
                        <p>{{$v->memo}}</p>
                        <p>{{ substr($v->created_at, 0, 20) }}</p>

                    </div>
                </li>
                @else
                <li class="earn treat-lists">

                    <div class="icon-box">
                        <div class="tr-img-wrapper">
                            <img src="image/plus_icon.svg" alt="">
                        </div>
                        <p>{{ $v->treat }}트릿</p>
                    </div>
                    <div class="cont-box">
                        <p>{{$v->memo}}</p>
                        <p>{{ substr($v->created_at, 0, 20) }}</p>

                    </div>
                </li>
                @endif
            @endforeach

        </ul>
    </section>
@endsection
