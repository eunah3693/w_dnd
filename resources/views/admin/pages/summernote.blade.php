@extends('admin.layouts.sidebar')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/summernote/summernote.css') }}">
@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/summernote/summernote.js') }}"></script>

    <script src="{{ asset('js/pages/summernote.js') }}"></script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Full Editor</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option">
                        <i class="si si-settings"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <form action="/" method="POST" onsubmit="return false;">
                    <div class="form-group">
                        <div class="js-summernote">썸머노트</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
