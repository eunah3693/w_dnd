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
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    {{-- <h3 class="block-title">전체 알람 리스트</h3>
                        <div class="block-options"  onclick="location.href='/admin/manage/alarm_modify'">
                        <button type="submit" class="btn btn-dark" id="btn_add" data-btn="banner">추 가</button>
                    </div> --}}
                </div>
                <div class="block-content">
                    {{-- All Orders Table --}}
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-vcenter" id="table_list" data-table="banner">
                            <thead>
                                <tr>
                                    <th class="vertical_center text-center" style="vertical-align:middle"><span>순번</span></th>
                                    <th class="text-center" style="vertical-align:middle"><span>제목</span></th>
                                    <th class="text-center" style="vertical-align:middle"><span>내용</span></th>
                                    <th class="text-center" style="vertical-align:middle"><span>메모</span></th>
                                    <th class="text-center" style="vertical-align:middle"><span>알람동의항목</span></th>
                                    <th class="text-center" style="vertical-align:middle"><span>수정</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $val)
                                <tr >
                                    <td class="text-center font-size-sm"><span id="table_idx">{{ $val->idx }}</span></td>
                                    <td class="text-center font-size-sm">
                                        <input class="form-control" value="{{ $val->title }}" id="title{{ $val->idx }}" style="width: 100%;display: inline-block;">
                                    </td>
                                    <td class="d-xl-table-cell text-center font-size-sm">
                                        <input class="form-control" value="{{ $val->body }}" id="body{{ $val->idx }}" style="width: 100%;display: inline-block;">
                                    </td>
                                    </td>
                                    <td class="d-xl-table-cell text-center font-size-sm">
                                        <input class="form-control" value="{{ $val->memo }}" id="memo{{ $val->idx }}" style="width: 70%;display: inline-block;">
                                    </td>
                                    <td class="d-xl-table-cell text-center font-size-sm">
                                        <select>
                                            <option {{ $val->push_column ==  'push_event' ? 'selected':''}} value="push_event">이벤트관련앱푸시</option>
                                            <option {{ $val->push_column ==  'push_like' ? 'selected':''}} value="push_like">좋아요관련앱푸시</option>
                                            <option {{ $val->push_column ==  'push_reply' ? 'selected':''}} value="push_reply">댓글관련앱푸시</option>
                                            <option {{ $val->push_column ==  'push_agree' ? 'selected':''}} value="push_agree">기본앱푸시</option>
                                        </select>
                                    </td>
                                    <td class="text-center"><button class="btn btn-dark" onclick="updateBreedName({{$val->idx}})" type="button">수정</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- END All Orders Table --}}

                </div>
            </div>
            {{-- END All Orders --}}
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
        function updateBreedName(idx)
        {
            if(confirm('해당 컬럼을 수정하시겠습니까?'))
            {
                var data = {
                    idx : idx,
                    title : $('#title'+idx).val(),
                    body : $('#body'+idx).val(),
                    push_column : $('#push_column'+idx).val(),
                    memo : $('#memo'+idx).val(),
                }
                $.post('/api/admin/alarm/update', data, function(res){
                    if(res.status == 200)
                    {
                        alert(res.msg);
                        location.reload();
                    }
                })
            }
        }

    </script>
    @endsection
