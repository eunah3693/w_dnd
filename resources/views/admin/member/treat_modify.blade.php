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


<form method="POST" action="{{ $url }}">
                     {{-- 트릿상세내역 --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">트릿 {{ $type }}</h3>
                            <div class="block-options">
                                <button type="submit" class="btn btn-dark" >{{ $type }}</button>
                            </div>
                        </div>
                        <div class="block-content">


                            {{-- All Orders Table --}}
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="vertical_center text-center" style="vertical-align:middle; width:200px;"><span>유저인덱스</span></th>
                                            <th class="vertical_center text-center" style="vertical-align:middle; width:200px;"><span>트릿</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>내용</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>날짜</span></th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="text-center font-size-sm">
                                                <span class="text-gray-darker font-w600">
                                                    <span><input name="user_idx" value="{{ $treat->user_idx }}"></span>
                                                    <input name="treat_idx" type="hidden" value="{{ $treat->idx }}">
                                                </span>
                                            </td>
                                            <td class="d-none d-sm-table-cell text-center font-size-sm"><span><input name="treat" type="number" value="{{ $treat->treat }}"></span></td>
                                            <td class="d-none d-sm-table-cell text-center font-size-sm" style="padding-left:20px"><span><input name="memo" type="text" value="{{ $treat->memo }}"></span></td>
                                            <td class="d-none d-sm-table-cell text-center font-size-sm" >{{ $treat->created_at }}</td>


                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                            {{-- END All Orders Table --}}
                        </form>

                        </div>
                    </div>
                    {{-- 트릿상세내역 --}}




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
