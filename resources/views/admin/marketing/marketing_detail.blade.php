@extends('admin.layouts.admin_layout')
@section('css')
@endsection
@section('js')
@endsection
@section('content')

    {{-- Main Container --}}
    <main id="main-container">

        {{-- Page Content --}}
        <div class="content" style="max-width:1400px">

            {{-- All Orders --}}
            <div class="block block-rounded">
                <div class="block-header block-header-default" style="position:relative;">
                    <h3 class="block-title">마케팅작업내역 자세히보기</h3>


                </div>
                <div class="block-content">
                    <div class="form-group">
                        <label >제목</label>
                        <input type="text" class="form-control"  value="{{ $data->title }}">
                    </div>
                    <div class="form-group">
                        <label for="one-ecom-product-description-short">내용</label>
                        <div style="width:100%; padding:20px; border: 1px solid #d5dce1; border-radius:0.25rem">{{ $data->content }}</div>
                    </div>
                    <div class="form-group">
                        <label >이미지</label>
                        @if ($data->file)
                        @foreach ($data->file as $f)
                        <img src="/files/{{  $f->idx }}" width="80px">
                        @endforeach
                        @endif
                    </div>
                    <div class="form-group">
                        <label>요청수</label>
                        <input type="text" class="form-control"  value="{{ $data->count }}">
                    </div>
                    <div class="form-group">
                        <label>발송가능한 회원수</label>
                        <input type="text" class="form-control"  value="{{ count($data->appPush) }}">
                    </div>

                    <div class="block-content" style="padding-bottom:1rem;">
                        {{-- 테이블 --}}
                        <table class="table table-striped table-border table-vcenter">
                                <thead class="border-bottom">
                                    <tr>
                                        <th class=" text-center">순번</th>
                                        <th class="d-none d-md-table-cell text-center" >아이디</th>
                                        <th class="d-none d-md-table-cell text-center" >요청</th>
                                        <th class="d-none d-md-table-cell text-center" >응답</th>
                                        <th class="d-none d-md-table-cell text-center" >상태</th>
                                    </tr>
                                </thead>
                                <tbody class="border-bottom">
                                    @foreach ($data->appPush as $p)
                                    <tr>
                                        <td class="text-center">
                                            {{ $p->idx }}
                                        </td>
                                        <td class="d-none d-md-table-cell text-center">
                                            {{ $p->user->id }}
                                        </td>
                                        <td class="d-none d-md-table-cell text-center" >
                                        <span style="display:inline-block; width:350px; overflow-x:auto;">
                                            {{ $p->request }}
                                        </span> 
                                        </td>
                                        <td class="d-none d-md-table-cell text-center">
                                        <span style="display:inline-block; width:350px; overflow-x:auto;">
                                            {{ $p->response }}
                                        </span>
                                        </td>
                                        <td class="d-none d-md-table-cell text-center">
                                            @if ($p->success)
                                                성공
                                            @else
                                                실패
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                         </div>
                        {{-- 테이블 --}}
                    </div>

                </div>
            </div>
        </div>
        {{-- END Page Content --}}
    </main>
    {{-- END Main Container --}}

    {{-- Footer --}}

@include('admin.layouts.footer')
    {{-- END Footer --}}


    </div>
    {{-- END Page Container --}}
    <script>
        $(function(){
            $(".filter_option").click(function(){
                    var option_num=$(this).index();
                    console.log(option_num);
                    if(option_num=="0"){
                        $(".filter_name").text("아이디");
                    }else if(option_num=="1"){
                        $(".filter_name").text("이메일");
                    }else if(option_num=="2"){
                        $(".filter_name").text("핸드폰");
                    }else if(option_num=="3"){
                        $(".filter_name").text("관리자");

                    }else if(option_num=="4"){
                        $(".filter_name").text("비회원");
                    }

                })
        })
    </script>
    @endsection
