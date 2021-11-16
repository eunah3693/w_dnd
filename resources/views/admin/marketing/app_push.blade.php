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
                <form method="POST" action="/api/admin/app_push" enctype="multipart/form-data">
                    <div class="block-header block-header-default" style="position:relative;">
                        <h3 class="block-title">앱 푸쉬관리</h3>
                        <button type="submit" class="btn btn-dark" style="position:absolute; right:10px; top:5px;">발 송</button>
                    </div>
                    <div class="block-content">
                        <div class="form-group form-row">
                            <div class="col-4">
                                <label>제목</label>
                                <input type="text" name="title" class="form-control focus_x" value="">
                            </div>

                        </div>
                        <div class="form-group form-row">

                            <div class="col-4 ">
                                <label>내용</label>
                                <textarea name="content" style="display:block; border-radius: 0.25rem;   border: 1px solid #d5dce1;"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>이미지</label>
                            <input type="file" name="file" onchange="handleImgFileSelect(this)">
                            <img id="img_file" width="150px">
                        </div>
                        <input value="" type="hidden" name="user_list" id="user_list">
                    </div>
                </form>
                <div class="block-content">

                    <div class="block-content" >
                    <form id="upload">
                        <input type="file" name="file" id="file" required="" onchange="uploadFile()" style="padding-bottom:1rem;">
                    </form>
                        {{-- 테이블 --}}
                        <p>* 엑셀파일만 업로드 해주세요. A = 회원인덱스 B = 회원 아이디 필수 입니다. </p>
                        <table class="table table-striped table-border table-vcenter">
                                <thead class="border-bottom">
                                    <tr>
                                        <th class=" text-center">인덱스</th>
                                        <th class="d-none d-md-table-cell text-center" >아이디</th>
                                        <th class="d-none d-md-table-cell text-center" >발송상태</th>
                                        <th class="d-none d-md-table-cell text-center" >응답</th>
                                    </tr>
                                </thead>
                                <tbody class="border-bottom" id="list_body">

                                </tbody>
                            </table>

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
        function uploadFile(){
                var form = $('#upload')[0];
                var formData = new FormData(form);
                formData.append("file", $("#file")[0].files[0]);

                $.ajax({
                    url:'/api/admin/user/import',
                        processData: false,
                        contentType: false,
                        data: formData,
                        type: 'POST',
                        success: function(res){
                            if(res.status == 200)
                            {
                                var data = res.data;
                                var id_list = [];
                                console.log(data)
                                var list;
                                for (var row of data) {
                                    id_list.push(row.id);
                                    list = '<tr>' +
                                    '<td class="text-center" >'+row.idx+'</td>' +
                                    '<td class="text-center">'+row.id+'</td>' +
                                    '<td class="d-none d-md-table-cell text-center">미전송</td>' +
                                    '<td class="d-none d-md-table-cell text-center">미응답</td>' +
                                    '</tr>';
                                $('#list_body').append(list);
                                }
                                $('#user_list').val(id_list);
                            }
                        }
                    });
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
                    $("#img_file").attr("src", e.target.result);
                }
                reader.readAsDataURL(f);
            });
        }
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
