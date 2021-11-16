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
                   {{-- 회원상세정보--}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">회원정보 추가</h3>
                            <div class="block-options" >
                                <button type="submit" class="btn btn-dark" id="btn_add" data-btn="banner">추 가</button>
                            </div>
                        </div>
                        <div class="block-content">
                            {{-- Topics --}}
                            <div class="block-content">
                                    <table class="table table-hover table-vcenter">
                                        <tbody>
                                            <tr>
                                                <th class="text-center " >순번</th>
                                                <td class="text-center " id="member_table_idx">
                                                    <input class="text-center" type="text"  >
                                                </td>
                                                <th class="d-none d-sm-table-cell text-center">아이디</th>
                                                <td class="text-center">
                                                    <input class="text-center" type="text"  >
                                                </td>
                                            </tr>
                                        
                                        
                                            <tr>
                                                <th class="text-center" scope="row">이름</th>
                                                <td class=" text-center" >
                                                    <input class="text-center" type="text"  >
                                                </td>
                                                <th class="d-none d-sm-table-cell text-center">
                                                    <span class="">이메일</span>
                                                </th>
                                                <td class="text-center">
                                                    <input class="text-center" type="text"  >
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">핸드폰</th>
                                                <td class="text-center">
                                                    <input class="text-center" type="text"  >
                                                </td>
                                                <th class="d-none d-sm-table-cell text-center">
                                                    <span class="">알림수신여부</span>
                                                </th>
                                                <td class="text-center">
                                                    <input class="text-center" type="text"  >
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">가입일</th>
                                                <td class=" text-center">
                                                    <input class="text-center" type="text"  >
                                                </td>
                                                <th class="d-none d-sm-table-cell text-center">
                                                    마지막로그인
                                                </th>
                                                <td class="text-center">
                                                    <input class="text-center" type="text"  >
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">관리자</th>
                                                <td class="  text-center">
                                                    <input class="text-center" type="text"  >
                                                </td>
                                                <th class="d-none d-sm-table-cell text-center">
                                                    
                                                </th>
                                                <td class="text-center">
                                                
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">자기소개</th>
                                                <td class=" text-left" colspan="3" style="padding-left:50px">
                                                    <textarea style="width:100%; height:100px; ">

                                                    </textarea>
                                                </td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>  
                    </div>

                    {{-- 회원상세정보--}}
                    
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

        @endsection