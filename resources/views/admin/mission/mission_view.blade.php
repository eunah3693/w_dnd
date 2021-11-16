@extends('admin.layouts.sidebar')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/plugins/dropzone/dist/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/plugins/summernote/summernote.css') }}">

@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/summernote/summernote.js') }}"></script>
    <script src="{{ asset('/js/plugins/dropzone/dropzone.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('/js/global/flatpickr.js') }}"></script>
    <script src="{{ asset('/js/global/dropzone.js') }}"></script>
    <script src="{{ asset('/js/pages/summernote.js') }}"></script>
@endsection

@section('title', '미션관리')
@section('sub-title', '미션의 정보를 확인 및 수정 삭제 할 수 있습니다.')

@section('content')
<!-- Page Content -->
<div class="content">
    <!-- Info -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">미션정보</h3>
        </div>
        <div class="block-content">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <form action="be_pages_ecom_product_edit.html" method="POST" onsubmit="return false;">
                        <div class="form-group">
                            <label for="one-ecom-product-id">제목</label>
                            <input type="text" class="form-control" id="one-ecom-product-id" name="one-ecom-product-id" value="789" readonly>
                        </div>
                        <div class="form-group">
                            <label for="one-ecom-product-name">Name</label>
                            <input type="text" class="form-control" id="one-ecom-product-name" name="one-ecom-product-name" value="Dark Souls III">
                        </div>
                        <div class="form-group">
                            <!-- CKEditor (js-ckeditor-inline + js-ckeditor ids are initialized in Helpers.ckeditor()) -->
                            <!-- For more info and examples you can check out http://ckeditor.com -->
                            <label>Description</label>
                            <textarea class="js-summernote" name="one-ecom-product-description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="one-ecom-product-description-short">Short Description</label>
                            <textarea class="form-control" id="one-ecom-product-description-short" name="one-ecom-product-description-short" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <!-- Select2 (.js-select2 class is initialized in Helpers.select2()) -->
                            <!-- For more info and examples you can check out https://github.com/select2/select2 -->
                            <label for="one-ecom-product-category">Category</label>
                            <select class="js-select2 form-control" id="one-ecom-product-category" name="one-ecom-product-category" style="width: 100%;" data-placeholder="Choose one..">
                                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                <option value="1">Cables</option>
                                <option value="2" selected>Video Games</option>
                                <option value="3">Tablets</option>
                                <option value="4">Laptops</option>
                                <option value="5">PC</option>
                                <option value="6">Home Cinema</option>
                                <option value="7">Sound</option>
                                <option value="8">Office</option>
                                <option value="9">Adapters</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="one-ecom-product-price">Price in USD ($)</label>
                                <input type="text" class="form-control" id="one-ecom-product-price" name="one-ecom-product-price" value="59,00">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="one-ecom-product-stock">Stock</label>
                                <input type="text" class="form-control" id="one-ecom-product-stock" name="one-ecom-product-stock" value="29">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Condition</label>
                            <div class="custom-control custom-radio custom-control-inline mb-1">
                                <input type="radio" class="custom-control-input" id="one-ecom-product-condition-new" name="one-ecom-product-condition" checked>
                                <label class="custom-control-label" for="one-ecom-product-condition-new">New</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mb-1">
                                <input type="radio" class="custom-control-input" id="one-ecom-product-condition-old" name="one-ecom-product-condition">
                                <label class="custom-control-label" for="one-ecom-product-condition-old">Old</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Published?</label>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" class="custom-control-input" id="one-ecom-product-published" name="one-ecom-product-published" checked>
                                <label class="custom-control-label" for="one-ecom-product-published"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Info -->

    <!-- Meta Data -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Meta Data</h3>
        </div>
        <div class="block-content">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <form action="be_pages_ecom_product_edit.html" method="POST" onsubmit="return false;">
                        <div class="form-group">
                            <!-- Bootstrap Maxlength (.js-maxlength class is initialized in Helpers.maxlength()) -->
                            <!-- For more info and examples you can check out https://github.com/mimo84/bootstrap-maxlength -->
                            <label for="one-ecom-product-meta-title">Title</label>
                            <input type="text" class="js-maxlength form-control" id="one-ecom-product-meta-title" name="one-ecom-product-meta-title" value="Dark Souls III" maxlength="55" data-always-show="true" data-placement="top">
                            <small class="form-text text-muted">
                                55 Character Max
                            </small>
                        </div>
                        <div class="form-group">
                            <!-- Select2 (.js-select2 class is initialized in Helpers.select2()) -->
                            <!-- For more info and examples you can check out https://github.com/select2/select2 -->
                            <label for="one-ecom-product-meta-keywords">Keywords</label>
                            <select class="js-select2 form-control" id="one-ecom-product-meta-keywords" name="one-ecom-product-meta-keywords" style="width: 100%;" data-placeholder="Choose many.." multiple>
                                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                <option value="1" selected>Action</option>
                                <option value="2" selected>RPG</option>
                                <option value="3">Racing</option>
                                <option value="4">Strategy</option>
                                <option value="5">Adventure</option>
                                <option value="6">Strategy</option>
                                <option value="7">Puzzle</option>
                                <option value="8">Horror</option>
                                <option value="9">MMO</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <!-- Bootstrap Maxlength (.js-maxlength class is initialized in Helpers.maxlength()) -->
                            <!-- For more info and examples you can check out https://github.com/mimo84/bootstrap-maxlength -->
                            <label for="one-ecom-product-meta-description">Description</label>
                            <textarea class="js-maxlength form-control" id="one-ecom-product-meta-description" name="one-ecom-product-meta-description" rows="4" maxlength="115" data-always-show="true" data-placement="top">Dark Souls III is an action role-playing video game developed by FromSoftware.</textarea>
                            <small class="form-text text-muted">
                                115 Character Max
                            </small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Meta Data -->

    <!-- Media -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Media</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <!-- Dropzone (functionality is auto initialized by the plugin itself in js/plugins/dropzone/dropzone.min.js) -->
                    <!-- For more info and examples you can check out http://www.dropzonejs.com/#usage -->
                    <form class="dropzone" id="my-dropzone" method="post" enctype="multipart/form-data" action="/files">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Media -->
</div>
<!-- END Page Content -->
<!-- Page JS Helpers (Select2 + CKEditor plugins) -->
<script>
jQuery(function () {
    One.helpers(['select2', 'maxlength']);
});

</script>
@endsection
