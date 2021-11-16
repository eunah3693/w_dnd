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
                   
                    {{-- 반려견 상세정보 --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">반려견 추가</h3>
                            <div class="block-options" >
                                <button type="submit" class="btn btn-dark" id="btn_add" data-btn="banner">추가</button>
                            </div>
                        </div>
                        <div class="block-content">
                            {{-- Topics --}}
                            <div class="block-content">
                                    <table class="table table-hover table-vcenter">
                                        <tbody>
                                            <tr>
                                                <th class="text-center ">이름</th>
                                                <td class="text-center ">
                                                <span ><input class="text-center" type="text"  ></span>
                                                </td>
                                                <th class="d-none d-sm-table-cell text-center">견종</th>
                                                <td class="text-center">
                                                <span ><input class="text-center" type="text"  ></span>
                                                </td>
                                            </tr>
                                        
                                        
                                            <tr>
                                                <th class="text-center" scope="row">크기</th>
                                                <td class=" text-center">
                                                    <span ><input class="text-center" type="text"  ></span>
                                                </td>
                                                <th class="d-none d-sm-table-cell text-center">
                                                    <span class="">생일</span>
                                                </th>
                                                <td class="text-center">
                                                    <span class=""><input class="text-center" type="text"  ></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">소개</th>
                                                <td class=" text-left" colspan="3"  style="padding-left:50px">
                                                <textarea style="width:100%; height:100px; "></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                        {{-- 반려견 상세정보 --}}
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