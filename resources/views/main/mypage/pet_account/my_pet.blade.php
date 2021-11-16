@extends('main.layouts.layout')

@section('title', '반려견 프로필 설정')
@section('nav', 100004)

@section('top_back', '/my')

@section('css')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="css/DND-STYLE/setting.css">
@endsection

@section('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/DND-JS/setting_account.js"></script>
<script src="/js/DND-JS/my_pet.js"></script>

@endsection

@section('content')
<form action="{{ $action }}" method="post"  enctype="multipart/form-data">
@csrf
    <section class="profile-pic-section">
        <div class="pfofile_img_wrap">
            <input type="file" id="profile-pic" name="file" accept="image/*">
            <label class="profile-pic-label" for="profile-pic">
                <img id="img" src="{{ $data->file_idx ? '/files/'.$data->file_idx:'/image/icon/pet_profile.svg' }}" alt="">
                <div class="btn_wrap">
                    <img @if($data->file_idx) src="/image/icon/user_icon_setting.svg" @else src="/image/icon/user_icon_plus.svg" @endif alt="설정" class="pet_icon_setting">
                </div>
            </label>
        </div>
    </section>
    <section class="user-info-section">
            <fieldset>
                <div class="label">이름</div>
                <input type="text" name="name" class="name_input" value="{{ $data->name }}" required>
                <div class="label">견종</div>
                <div class="select_wrap">
                <select name="kind2" id="kind2" class="selectbox" >
                    @if(!$data->breed)<option value="">선택없음</option>@else<option value="other">기타</option>@endif
                    @foreach ($breeds as $breed)
                        <option @if($data->breed == $breed->breed ) selected @endif value="{{ $breed->breed }}">{{ $breed->breed }}</option>
                    @endforeach
                    <option value="other">기타</option>
                </select>
                <img src="/image/icon/arrow_down.svg" alt="아래" class="arrow_down">
                </div>
                <div id="kind2_etc" style="display: none">
                    <input name="breed" id="breed" type="text" placeholder="견종을 작성하세요" value="{{ $data->breed }}">
                </div>
                <div class="label">성별</div>
                <div class="pet_gender">
                    <label class="box-radio-input"><input type="radio" name="sex" @if($data->sex == "M" ) checked @endif value="M"><span>남자아이</span></label>
                    <label class="box-radio-input"><input type="radio" name="sex" @if($data->sex == "F" ) checked @endif value="F"><span>여자아이</span></label>
                </div>
                <input type="hidden" name="pet_idx" value="{{ $data->idx }}">
                <div class="label">생일</div>
                <div class="birth_wrap">
                <input type="text" id="datepicker" readonly name="birth" value="{{ $data->birth }}" class="date_input">
                <img src="/image/icon/calendar_icon.svg" class="calendar_icon">
                </div>
                <textarea class="intro" style="resize: none;" placeholder="인사말을 적어보세요:)" name="memo">{{ $data->memo }}</textarea>


            </fieldset>
            <button class="save-btn" type="submit">
            저장하기
            </button>
    </section>
</form>


@endsection
