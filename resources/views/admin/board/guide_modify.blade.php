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
            <div class="block-header block-header-default" style="position: relative;">
                <h3 class="block-title">이용안내 {{ $title }}</h3>
                <div class="block-options">
                    <button type="submit" class="btn btn-dark" id="btn_add" data-btn="notice">{{ $title }}</button>
                </div>
            </div>
            <div class="block-content">
                <div class="form-group form-row">
                    <div class="col-8">
                        <label>이용안내 제목</label> <input type="text" name="title" class="form-control" value="@isset($data->title){{$data->title}}@endisset">
                    </div>
                    <div class="col-4 "></div>
                    <div class="col-2 " style="position: relative;"></div>
                </div>
                <div class="form-group">
                    <label>내용</label>
                    <textarea class="js-summernote" name="content">{{ $data->content  }}</textarea>
                </div>
                <div class="form-group form-row">
                    <div class="col-8 ">
                        <div class="custom-control custom-switch custom-control-light custom-control-lg">
                            <label>비공개</label>
                            <input type="checkbox" class="custom-control-input" id="top_fixed" name="hidden" value="N" {{ $data->hidden == 'N' ? 'checked="checked"' : 'Y' }}>
                                <label class="custom-control-label" for="top_fixed"></label>
                        </div>
                    </div>
                    <div class="col-4 "></div>
                </div>
                <div class="block-content"></div>
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
@endsection
