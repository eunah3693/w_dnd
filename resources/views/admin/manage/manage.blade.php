@extends('admin.layouts.admin_layout')
@section('css')
@endsection
@section('js')
@endsection
@section('content')

    {{-- Main Container --}}
    <main id="main-container">

        {{-- Page Content --}}
        <div class="content" style="max-width:1400px;">


            {{-- All Orders --}}
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">관리자권한설정</h3>
                    <div class="block-options"  onclick="location.href='/admin/manage/manage_modify'">
                        <button type="submit" class="btn btn-dark" id="btn_add" data-btn="banner">추 가</button>
                         </div>
                </div>
                <div class="block-content">
                    {{-- All Orders Table --}}
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-vcenter">
                            <thead>
                                <tr>
                                    <th class="text-center">순번</th>
                                    <th class="d-none d-sm-table-cell text-center">아이디</th>
                                    <th class="text-center">이름</th>
                                    <th class="d-none d-xl-table-cell text-center">읽기권한</th>
                                    <th class="d-none d-xl-table-cell text-center">수정권한</th>
                                    <th class="d-none d-sm-table-cell text-center">추가권한</th>
                                    <th class="d-none d-sm-table-cell text-center">삭제권한</th>
                                    <th class="d-none d-sm-table-cell text-center">수정</th>
                                    <th class="d-none d-sm-table-cell text-center">삭제</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ( $data as $v )
                            <tr>
                                <td class="text-center font-size-sm">
                                    <span>
                                        <span>{{ $v->idx }}</span>
                                    </span>
                                </td>
                                <td class="d-none d-sm-table-cell text-center font-size-sm">{{ $v->id }}</td>
                                <td class="text-center">
                                    <span class="">{{ $v->name }}</span>
                                </td>
                                <td class="d-none d-xl-table-cell font-size-sm text-center">
                                    <div class="custom-control custom-switch custom-control-light custom-control-lg mb-2">
                                        <input type="checkbox" class="custom-control-input" id="read_{{ $v->idx }}"  @if (strpos($v->access_db,'read') !== false ) checked @endif onclick="updateAcccess({{ $v->idx }}, this)">
                                        <label class="custom-control-label" for="read_{{ $v->idx }}"></label>
                                    </div>
                                </td>
                                <td class="d-none d-xl-table-cell text-center font-size-sm">
                                    <div class="custom-control custom-switch custom-control-light custom-control-lg mb-2">
                                        <input type="checkbox" class="custom-control-input" id="update_{{ $v->idx }}" @if (strpos($v->access_db,'update') !== false ) checked @endif onclick="updateAcccess({{ $v->idx }}, this)">
                                        <label class="custom-control-label" for="update_{{ $v->idx }}"></label>
                                    </div>
                                </td>
                                <td class="d-none d-sm-table-cell text-center font-size-sm ">
                                    <div class="custom-control custom-switch custom-control-light custom-control-lg mb-2">
                                        <input type="checkbox" class="custom-control-input" id="insert_{{ $v->idx }}" @if (strpos($v->access_db,'insert') !== false ) checked @endif onclick="updateAcccess({{ $v->idx }}, this)">
                                        <label class="custom-control-label" for="insert_{{ $v->idx }}"></label>
                                    </div>
                                </td>
                                <td class="d-none d-sm-table-cell text-center font-size-sm " style="width:100px;">
                                    <div class="custom-control custom-switch custom-control-light custom-control-lg mb-2">
                                        <input type="checkbox" class="custom-control-input" id="delete_{{ $v->idx }}" @if (strpos($v->access_db, 'delete') !== false ) checked @endif onclick="updateAcccess({{ $v->idx }}, this)">
                                        <label class="custom-control-label" for="delete_{{ $v->idx }}"></label>
                                    </div>
                                </td>
                                <td class="d-xl-table-cell text-center font-size-sm  cursor" onclick="location.href='/admin/manage/manage_detail?idx={{ $v->idx }}'"><i class="si si-pencil fa-fw"></i></td>
                                <td class="d-xl-table-cell text-center font-size-sm cursor"  onclick="deleteData({{ $v->idx }})"><i class="fa fa-fw fa-times"></i></td>
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
        function updateAcccess(idx,id)
        {
            var access = [];
            if($('#read_'+idx).is(":checked")) access.push('read');
            if($('#insert_'+idx).is(":checked")) access.push('insert');
            if($('#update_'+idx).is(":checked")) access.push('update');
            if($('#delete_'+idx).is(":checked")) access.push('delete');
            var data = {
                user_idx : idx,
                access : access
            }
            $.post('/api/admin/manage/update/access', data, function(res){
                if(res.status)
                {
                    alert(res.msg);
                }
            });
        }
        function deleteData(idx)
        {
            var data = {
                user_idx : idx
            }
            if(confirm('삭제하시겠습니까?'))
            {
                $.post('/api/admin/manage/delete', data, function(res){
                    if(res.status)
                    {
                        alert(res.msg);
                        location.reload();
                    }
                });
            }
        }
        $(function() {

            $(".filter_option").click(function(){
                    var option_num=$(this).index();
                    console.log(option_num);
                    if(option_num=="0"){
                        $(".filter_name").text("아이디");
                    }else if(option_num=="1"){
                        $(".filter_name").text("이름");
                    }else if(option_num=="2"){
                        $(".filter_name").text("이메일");
                    }else if(option_num=="2"){
                        $(".filter_name").text("핸드폰");
                    }

                })

        });

    </script>
@endsection
