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
            {{-- END All Orders --}}
            {{-- All Orders --}}
            @foreach ($data as $k => $v)
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">앱설정관리({{ $k }})</h3>
                    <div class="block-options"></div>
                </div>
                <div class="block-content">
                    {{-- All Orders Table --}}
                    <div class="table-responsive">
                            <table class="table table-borderless table-striped table-vcenter">
                                <thead>
                                    <tr>

                                        <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>설정내용</span></th>
                                        <th class="text-center" style="vertical-align:middle"><span>설정</span></th>
                                        <th class="text-center" style="vertical-align:middle"><span></span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($v as $item)
                                    @if($item->category == $k)
                                    <tr>
                                        <td class="d-none d-sm-table-cell text-center font-size-sm">{{ $item->name }}</td>
                                        <td class="text-center">
                                            <input type="text" class="form-control form-control-alt" value="{{ $item->value }}">
                                        </td>
                                        <td class="text-left">
                                            <button type="button" class="btn btn-dark btn_setting" onclick="updateAppSetting({{ $item->idx }}, this)"><i class="fa fa-cog" style="cursor:pointer;"></i></button>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                    {{-- END All Orders Table --}}
            </div>
        </div>
            @endforeach


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
        function updateAppSetting(idx, id)
        {
            var setting_val = $(id).parent().prev().find("input").val();
            console.log(setting_val);
            var data = {
                idx: idx,
                value : setting_val
            }
            if(confirm('변경하시겠습니까?'))
            {
                $.post('/api/admin/app/setting/update', data, function(res){
                if(res.status == 200)
                {
                    alert(res.msg);
                    location.reload();
                }
            })
            }

        }

    </script>

@endsection
