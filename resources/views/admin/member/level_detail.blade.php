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



                     {{-- 트릿상세내역 --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">경험치상세내역</h3>
                            <div class="block-options" onclick="location.href='/admin/member/level_modify?exp_idx={{ $exp->idx }}'">
                                <button type="submit" class="btn btn-dark" >수 정</button>
                            </div>
                        </div>
                        <div class="block-content">


                            {{-- All Orders Table --}}
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="vertical_center text-center" style="vertical-align:middle; width:200px;"><span>유저</span></th>
                                            <th class="vertical_center text-center" style="vertical-align:middle; width:200px;"><span>경험치</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>내용</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>날짜</span></th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="text-center font-size-sm">
                                                <span class="text-gray-darker font-w600">
                                                    <span>{{ $exp->user->id }}</span>
                                                </span>
                                            </td>
                                            <td class="d-none d-sm-table-cell text-center font-size-sm"><span>{{ $exp->exp }}</span></td>
                                            <td class="d-none d-sm-table-cell text-center font-size-sm" style="padding-left:20px"><span>{{ $exp->memo }}</span></td>
                                            <td class="d-none d-sm-table-cell text-center font-size-sm" >{{ $exp->created_at }}</td>


                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                            {{-- END All Orders Table --}}


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
