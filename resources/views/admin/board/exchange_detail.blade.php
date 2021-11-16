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
                    <h3 class="block-title">교환소 상세보기</h3>
                    <div class="block-options" >
                        <a href="/admin/board_event/exchange_modify?idx={{ $data->idx }}" class="btn btn-dark" id="btn_add" data-btn="exchange">수정</a>
                    </div>

                </div>

                <div class="block-content">
                    <div class="form-group form-row">

                        <div class="col-6">
                            <label>상품명</label>
                            <input type="text" class="form-control" required name="title" value="{{ $data->title }}" readonly style="border: none">
                        </div>
                        <div class="col-6">
                            <label>요약</label>
                            <input type="text" class="form-control" required name="preview" value="{{ $data->preview }}" readonly style="border: none">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-4 ">
                            <label>계정당 응모횟수(없을시 사용안함)</label>
                            <input type="text" class="form-control" required name="participation_count" value="{{ $data->participation_count }}" readonly style="border: none">
                        </div>
                        <div class="col-4 ">
                            <label>소모트릿갯수</label>
                            <input type="text" class="form-control" required name="participation_point" value="{{ $data->participation_point }}" readonly style="border: none">
                        </div>
                        <div class="col-4 ">
                            <label>출력여부</label>
                            <select class="form-control" required name="is_public" disabled>
                                <option value="1">예</option>
                                <option value="0">아니오</option>
                            </select>
                        </div>
                        <div class="col-4 ">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-4 ">
                            <label>당첨확률</label>
                            <input type="text" class="form-control" required name="perc" value="{{ $data->perc }}" readonly style="border: none">
                        </div>
                        <div class="col-4 ">
                            <label>상품재고</label>
                            <input type="text" class="form-control" required name="stock"  value="{{ $data->stock }}" readonly style="border: none">
                        </div>
                        <div class="col-4 ">
                            <label>노출순서</label>
                            <input type="text" class="form-control" required name="order" value="{{ $data->order }}" readonly style="border: none">
                        </div>
                    </div>
                    <div class="form-group form-row">

                    <div class="col-4 ">
                        <label>시작시간</label>
                        <input class="js-flatpickr form-control bg-white js-flatpickr-enabled flatpickr-input flatpickr-mobile form_start" readonly  value="@isset($data){{ date('Y-m-d\TH:i', strtotime($data->startdate)) }}@endisset" tabindex="1" required name="startdate" type="datetime-local">
                    </div>
                    <div class="col-4 " style="position:relative;">
                        <label>종료시간</label>
                        <input class="js-flatpickr form-control bg-white js-flatpickr-enabled flatpickr-input flatpickr-mobile form_end" readonly  value="@isset($data){{ date('Y-m-d\TH:i', strtotime($data->enddate)) }}@endisset" tabindex="1" required name="enddate" type="datetime-local">
                    </div>
                    <input name="idx" type="hidden" value="@isset($data->idx){{ $data->idx }}@endisset">


                    </div>
                    <div class="form-group">
                        <label>상세내용</label>
                        <div>{!! $data->content !!}</div>
                    </div>
                    <div class="row" style="padding-bottom:20px;">
                        <div class="col-md-6 col-lg-6">
                            <label>썸네일 이미지 720*720</label><br>
                            <img id="img_thum_file" width="100%" @isset($data->thum_file_idx)src="/files/{{ $data->thum_file_idx }}"@endisset>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <label>대표 이미지 720*720</label><br>
                            <img id="img_main_file" width="100%"  @isset($data->main_file_idx)src="/files/{{ $data->main_file_idx }}"@endisset>
                        </div>
                    </div>
                </div>
                {{-- 교환소 당첨내역 --}}
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">교환소 당첨세부내역</h3>
                    </div>
                    <div class="block-content">
                        {{-- All Orders Table --}}
                        <div class="table-responsive">
                            <table class="table table-borderless table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center">순번</th>
                                        <th class="text-center">신청아이디</th>
                                        <th class="d-none d-xl-table-cell text-center">당첨여부</th>
                                        <th class="d-none d-xl-table-cell text-center">날짜</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($event_join as $j)
                                  <tr>
                                    <td class="text-center font-size-sm">
                                        <span class="">
                                            <span>{{ $j->idx }}</span>
                                        </span>
                                    </td>

                                    <td class="text-center font-size-sm">
                                        <span><a href="/admin/member/member_detail?user_idx={{ $j->idx }}">{{ $j->user->nickname }}</a></span>
                                    </td>
                                    <td class="d-none d-xl-table-cell font-size-sm text-center">
                                        @if($j->status == 1)
                                        <span>당첨</span>
                                        @else
                                        <span>탈락</span>
                                        @endif
                                    </td>
                                    <td class="text-center font-size-sm">
                                        <span class="">
                                            <span>{{ $j->created_at }}</span>
                                        </span>
                                    </td>
                                </tr>
                                  @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{ $event_join->appends(request()->input())->links() }}
                    </div>
                </div>
                {{-- 교환소 당첨내역 --}}
                {{-- 리뷰 --}}
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">교환소 리뷰내역</h3>
                    </div>
                    <div class="block-content">
                        {{-- All Orders Table --}}
                        <div class="table-responsive">
                            <table class="table table-borderless table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center">순번</th>
                                        <th class="text-center">닉네임</th>
                                        <th class="d-none d-xl-table-cell text-center">별점</th>
                                        <th class="d-none d-xl-table-cell text-center">내용</th>
                                        <th class="d-none d-xl-table-cell text-center">날짜</th>
                                        <th class="d-none d-xl-table-cell text-center">감추기</th>
                                        <th class="d-none d-xl-table-cell text-center">삭제</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($event_review as $j)
                                  @isset($j->user)
                                  <tr>
                                    <td class="text-center font-size-sm">
                                        <span class="">
                                            <span>{{ $j->idx }}</span>
                                        </span>
                                    </td>

                                    <td class="text-center font-size-sm">
                                        <span><a href="/admin/member/member_detail?user_idx={{ $j->idx }}">{{ $j->user->nickname }}</a></span>
                                    </td>
                                    <td class="d-none d-xl-table-cell font-size-sm text-center">
                                        {{ $j->score }}
                                    </td>
                                    <td class="d-none d-xl-table-cell font-size-sm text-center">
                                        {{ $j->content }}
                                    </td>
                                    <td class="text-center font-size-sm">
                                        <span class="">
                                            <span>{{ $j->created_at }}</span>
                                        </span>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center font-size-sm cursor">
                                        @if($j->is_public == 1)
                                        <i onclick="updateReview({{ $j->idx }}, 0)" class="fa fa-fw fa-eye"></i>
                                        @else
                                        <i onclick="updateReview({{ $j->idx }}, 1)" class="far fa-fw fa-eye-slash"></i>
                                        @endif
                                        </td>
                                    <td class="d-none d-sm-table-cell text-center font-size-sm cursor" onclick="deleteReview({{ $j->idx }})"><i class="fa fa-fw fa-times"></i>
                                    </td>
                                </tr>
                                    @endisset
                                  @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{ $event_review->appends(request()->input())->links() }}
                    </div>
                </div>
                {{-- 리뷰 --}}
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
            //추가버튼누르면 제출
            $("form").submit(function(){
                // 유효성 검증

                if(confirm("내용을 저장하시겠습니까?"))
                {

                }else{
                    return false;
                }
            })
        });
        function deleteReview(idx)
        {
            var data = {
                idx :idx
            }
            console.log(data)
            if(confirm('리뷰를 삭제하시겠습니까?'))
            {
                $.post('/api/admin/review/delete',data, function(res){
                    if(res.status == 200)
                    {
                        alert(res.msg);
                        location.reload();
                    }
                })
            }
        }
        function updateReview(idx,is_public)
        {
            var data = {
                idx :idx,
                is_public:is_public
            }
            if(confirm('리뷰를 감추시겠습니까?'))
            {
                $.post('/api/admin/review/update/is_public',data, function(res){
                    if(res.status == 200)
                    {
                        alert(res.msg);
                        location.reload();
                    }
                })
            }
        }
        function handleImgFileSelect(id) {
            var files = id.files;
            var filesArr = Array.prototype.slice.call(files);

            filesArr.forEach(function(f) {
                if(!f.type.match("image.*")) {
                    alert("이미지만 업로드 가능합니다.");
                    return;
                } else {
                    alert("이미지가 변경되었습니다.");
                }

                sel_file = f;

                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#img_"+id.id).attr("src", e.target.result);
                }
                reader.readAsDataURL(f);
            });
        }

    </script>

    @endsection
