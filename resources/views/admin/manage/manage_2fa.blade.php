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
            <div class="panel-body" style="text-align: center;">
                <div>
                    {{ $key }}<br>
                    {!! $QR_Image !!}
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
@endsection
