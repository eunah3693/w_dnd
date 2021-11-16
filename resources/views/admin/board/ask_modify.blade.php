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
            <form action="{{ $type }}{{ $data->idx }}" method="post">
                @csrf
                <div class="block-header block-header-default" style="position:relative;">
                    <h3 class="block-title">이용문의 수정</h3>
                    <div class="block-options">
                        <button type="submit" class="btn btn-dark" id="btn_add" data-btn="ask">수정</button>
                    </div>

                </div>
                <div class="block-content">
                    <div class="form-group form-row border-bottom">
                        <div class="col-1">
                            <label>제목</label>
                        </div>
                        <div class="col-10" style="padding-bottom:20px;">
                            <input type="text" name="title" value="{{ $data->title }}" style="width:100%; border: 1px solid #d5dce1;">
                        </div>
                    </div>
                    <div class="form-group form-row border-bottom" style="padding-bottom:20px;">
                        <div class="col-1">
                            <label>내용</label>

                        </div>
                        <div class="col-10">
                            <textarea type="text" name="content" style="width:100%; border: 1px solid #d5dce1;">{{ $data->content }}</textarea>
                        </div>
                    </div>
                    <div class="form-group form-row border-bottom" style="padding-bottom:20px;">

                        <div class="col-md-2 col-lg-1">
                            <label>답변</label>
                        </div>

                        <div class="col-md-10 col-lg-10">
                            <textarea type="text" name="content2" style="width:100%; border: 1px solid #d5dce1;">{{ $data->content2 }}</textarea>
                        </div>
                    </div>
                    <div class="block-content">
                        {{-- Topics --}}
                        {{-- END Topics --}}
                        {{-- Pagination --}}
                        {{-- END Pagination --}}
                    </div>
                </div>
            </form>
            </div>
        </div>
        {{-- END Page Content --}}
    </main>
    {{-- END Main Container --}}

    {{-- Footer --}}
    @include('admin.layouts.footer')
    {{-- END Footer --}}


    </div>
    @endsection
