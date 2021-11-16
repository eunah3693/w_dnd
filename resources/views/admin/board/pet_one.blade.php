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
                    <h3 class="block-title">펫시피 상세보기</h3>
                    <div class="block-options" onclick="location.href='/admin/board/pet_modify'">
                                <button type="submit" class="btn btn-dark" >수 정</button>  
                    </div>

                </div>
                <div class="block-content">
                    <div class="form-group form-row">

                        <div class="col-8">
                            <label >제목</label>
                            <input type="text" class="form-control focus_x" value="" readonly="readonly">

                        </div>
                        <div class="col-4 ">

                        </div>
                        <div class="col-2 " style="position:relative;">

                        </div>

                    </div>

                    <div class="form-group">
                        <label >상세내용</label>
                        <div style="width:100%; padding:10px; border-radius:5px; border:1px solid #d5dce1;"></div>
                    </div>
                    <div class="form-group">
                        <label >링크</label>
                        <input type="text" class="form-control focus_x" value="URL" readonly="readonly">
                    </div>
                    
                    
                    <div class="form-group form-row">


                        <div class="col-4 ">
                            <label >출력여부</label>
                            <input type="text" class="form-control focus_x" value="" readonly="readonly">
                        </div>
                        <div class="col-4 ">



                        </div>
                        <div class="col-4 ">

                        </div>

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

    @endsection
