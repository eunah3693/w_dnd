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
                    <h3 class="block-title">자주하는질문 {{ $title }}</h3>
                    <button type="submit" class="btn btn-dark" style="position:absolute; right:10px; top:5px;">{{ $title }}</button>
                </div>
                <div class="block-content">
                    <div class="form-group form-row border-bottom" style="padding-bottom:30px;">

                        <div class="col-1">
                            <label for="one-ecom-product-name">질문</label>
                        </div>
                        <div class="col-10">
                            <textarea type="text" name="title" style="width:100%; border: 1px solid #d5dce1;">{{ $data->title }}</textarea>
                        </div>
                    </div>
                    <div class="form-group form-row border-bottom" style="padding-bottom:20px;">
                        <div class="col-1">
                            <label for="one-ecom-product-name">답변</label>
                        </div>
                        <div class="col-10">
                        <textarea type="text" name="content" style="width:100%; border: 1px solid #d5dce1;">{{ $data->content }}</textarea>
                        </div>
                    </div>
                    <div class="form-group form-row border-bottom" style="padding-bottom:20px;">
                        <div class="col-1">
                            <label>출력순서</label>
                        </div>
                        <div class="col-3">
                        <input type="number" name="order" class="form-control"  value="{{ $data->order }}">
                        </div>
                        <div class="col-1">
                            
                        </div>
                        <div class="col-1">
                            <label>출력여부</label>
                        </div>
                        <div class="col-3">
                        <div class="custom-control custom-switch custom-control-light custom-control-lg">
                            <input type="checkbox" class="custom-control-input" id="hidden" name="hidden" value="Y" {{ $data->hidden == 'Y' ? 'checked="checked"' : '' }}>
                            <label class="custom-control-label" for="hidden"></label>
                        </div>
                        </div>
                    </div>
                    <div class="block-content">
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
    {{-- END Page Container --}}
    <script>
        if('{{session()->has('message')}}') {
            alert('{{session()->get('message')}}');
        }
    </script>
    <xmp>
    {{ json_encode(session()->all(), 384) }}
    </xmp>
    @endsection