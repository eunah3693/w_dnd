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
                    <h3 class="block-title">펫시피 수정</h3>
                    <button type="submit" class="btn btn-dark" id="btn_add" data-btn="banner">수정</button>

                </div>
                <div class="block-content">
                    <div class="form-group form-row">

                        <div class="col-8">
                            <label >제목</label>
                            <input type="text" class="form-control" value="">

                        </div>
                        <div class="col-4 ">

                        </div>
                        <div class="col-2 " style="position:relative;">

                        </div>

                    </div>

                    <div class="form-group">
                        <label >상세내용</label>
                        <div class="js-summernote"></div>
                    </div>
                    <div class="form-group">
                        <label >링크</label>
                        <input type="text" class="form-control" value="URL">
                    </div>
                    <div class="form-group form-row">


                        <div class="col-4 ">
                            <label >출력여부</label>
                            <input type="text" class="form-control" value="">
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
