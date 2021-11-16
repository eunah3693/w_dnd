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
                            <h3 class="block-title">레벨상세내역</h3>
                            <div class="block-options" >
                                <button type="submit" class="btn btn-dark" id="btn_add" data-btn="banner">추 가</button>
                            </div>
                        </div>
                        <div class="block-content">
                            

                            {{-- All Orders Table --}}
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="vertical_center text-center" style="vertical-align:middle; width:200px;"><span>추가/차감</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>내용</span></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <tr>
                                            <td class="text-center ">
                                                <input class="text-center" type="text"  style=" background-color:transparent; width:100%; border:0; border-bottom:1px solid #d5dce1"> 
                                            </td>
                                            <td class="d-none d-sm-table-cell text-center " >
                                                <input class="text-center" type="text"  style=" background-color:transparent;  width:100%; border:0; border-bottom:1px solid #d5dce1"> 
                                            </td>
                                            
                                            
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