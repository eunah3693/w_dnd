<?php

use App\Http\Controllers\AdminControllers\AdminEventController;
use App\Http\Controllers\AdminControllers\AdminFileController;
use App\Http\Controllers\AdminControllers\AdminManageController;
use App\Http\Controllers\AdminControllers\AdminPostController;
use App\Http\Controllers\AdminControllers\BannerController;
use App\Http\Controllers\AdminControllers\MarketingController;
use App\Http\Controllers\AdminControllers\MissionViewController;
use App\Http\Controllers\AdminControllers\PetController;
use App\Http\Controllers\AdminControllers\PopupController;
use App\Http\Controllers\AdminControllers\UserOrderController;
use App\Http\Controllers\AdminControllers\UserViewController;
use App\Http\Controllers\ServiceControllers\AlarmController;
use App\Http\Controllers\CommonControllers\MentionController;
use App\Http\Controllers\ServiceControllers\PostController;
use App\Http\Controllers\ServiceControllers\UserAuthController;
use App\Http\Controllers\ServiceControllers\UserMyPageApiController;
use App\Http\Controllers\ServiceControllers\UserMyPageController;
use App\Http\Controllers\ServiceControllers\DeviceController;
use App\Http\Controllers\ServiceControllers\Eventcontroller;
use App\Http\Controllers\ServiceControllers\UserMissionController;
use App\Http\Controllers\ServiceControllers\UserMyPageViewController;
use App\Http\Controllers\ServiceControllers\PetsBreedApiController;
use App\Http\Controllers\ServiceControllers\AdminBoardController;
use App\Http\Controllers\ServiceControllers\NoticeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/join', [UserAuthController::class, 'join']);
Route::post('/join/social/{id}', [UserAuthController::class, 'joinApp']);
Route::post('/is_alarm', [AlarmController::class, 'getCheckUserAlarm']);
Route::post('/set_check_alarm', [AlarmController::class, 'setCheckUserAlarm']);
Route::post('/get_user_list', [MentionController::class, 'getUserList']);
Route::get('/post', [PostController::class, 'getPost']);
Route::post('/post/update', [UserMissionController::class, 'setUserMissionPost']);
Route::post('/post/user_update', [UserMyPageApiController::class, 'updatePost']);
Route::post('/post/dailylife', [UserMissionController::class, 'setUserDailyLifePost']);
Route::post('/post/set_report', [PostController::class, 'setReport']);
Route::post('/post/set_reply_like', [PostController::class, 'setReplyLike']);
Route::post('/post/set_like', [PostController::class, 'setLike']);
Route::post('/post/get_like', [PostController::class, 'getLike']);
Route::post('/post/set_reply', [PostController::class, 'setReply']);
Route::post('/post/file', [PostController::class, 'getMissionFileList']);
Route::post('/post/delete', [PostController::class, 'deleteReply']);
Route::post('/post/set_bookmark', [PostController::class, 'setBookmark']);
Route::post('/join/check/{id}', [UserAuthController::class, 'validCheck']);
Route::get('/join/session', [UserAuthController::class, 'authSessionCheck']);
Route::post('/my/update', [UserMyPageApiController::class, 'updateMyPage']);
Route::post('/my/update_auth', [UserAuthController::class, 'updateMyPassword']);
Route::post('/my/pet/insert', [UserMyPageApiController::class, 'insertMyPet']);
Route::post('/my/pet/update', [UserMyPageApiController::class, 'updateMyPet']);
Route::post('/notification', [AlarmController::class, 'setCheckUserAlarm']);
Route::post('/my/review/insert', [UserMyPageApiController::class, 'setMyReiview']);
Route::post('/my/pet/delete', [UserMyPageApiController::class, 'deleteMyPet']);
Route::post('/my/qna/insert', [UserMyPageApiController::class, 'insertMyQna']);
Route::post('/my/event/update', [UserMyPageApiController::class, 'updateMyEventdelivery']);
Route::post('/my/config/update', [UserMyPageApiController::class, 'updateMyConfig']);
Route::get('/my/pets/count', [UserMyPageApiController::class, 'getUserPetsCount']);
Route::post('/myconfig/update', [UserMyPageViewController::class, 'setMyConfig']);
Route::post('/mission/storytype/insert', [UserMissionController::class, 'setUserStoryType']);
Route::post('/event', [Eventcontroller::class, 'joinEvent']);
Route::post('/find_pw', [UserAuthController::class, 'findPasswordWithTel']);
Route::post('/pw/update', [UserAuthController::class, 'updatePassword']);
Route::get('/dogs/breed/list', [PetsBreedApiController::class, 'getList']);
Route::post('/secession', [UserMyPageApiController::class, 'deleteUser']);
Route::post('/device/set', [DeviceController::class, 'index']);
Route::post('/login/app', [UserAuthController::class, 'getAppLogin']);
Route::post('/term', [NoticeController::class, 'getTerm']);
Route::get('/mypost/delete/{id}', [UserMyPageApiController::class, 'deleteMyPost']);
Route::post('/user/addr', [Eventcontroller::class, 'getAddress']);
Route::get('/files/post/{id}',[PostController::class, 'getFilesList']);

Route::group(['middleware' => ['admin.auth.insert']], function () {
    Route::post('/admin/pet/insert', [UserViewController::class, 'setPetInsert']);
    Route::post('/admin/order/insert', [UserOrderController::class, 'setOrderInsert']);
    Route::post('/admin/treat/insert', [UserViewController::class, 'setTreatInsert']);
    Route::post('/admin/exp/insert', [UserViewController::class, 'setLogExpInsert']);
    Route::post('/admin/manage/banner/insert', [BannerController::class, 'insertBanner']);
    Route::post('/admin/manage/popup/insert', [PopupController::class, 'insertPopup']);
    Route::post('/admin/manage/insert', [AdminManageController::class, 'insertAdmin']);
    Route::post('/admin/terms/insert', [AdminManageController::class, 'insertTerms']);
    Route::post('/admin/exchange/insert', [AdminEventController::class, 'setExchangeShopInsert']);
    Route::post('/admin/breed/insert', [PetController::class, 'insertBreed']);

});
Route::group(['middleware' => ['admin.auth.update']], function () {
    Route::get('/admin/board/visible/{id}', [AdminBoardController::class, 'toggleVisible']);
    Route::post('/admin/post/visible', [AdminPostController::class, 'setPostPublic']);
    Route::post('/admin/user/passupdate', [UserViewController::class, 'setUserPassword']);
    Route::get('/admin/user/update/{key}', [UserViewController::class, 'setUserUpdate']);
    Route::post('/admin/order/update', [UserOrderController::class, 'setOrderInsert']);
    Route::post('/admin/treat/update', [UserViewController::class, 'setTreatInsert']);
    Route::post('/admin/exp/update', [UserViewController::class, 'setLogExpInsert']);
    Route::post('/admin/manage/banner/update', [BannerController::class, 'updateBanner']);
    Route::post('/admin/report/update', [MissionViewController::class, 'updatePostReport']);
    Route::post('/admin/popup/visible', [PopupController::class, 'updateIsPublic']);
    Route::post('/admin/manage/popup/update', [PopupController::class, 'updatePopup']);
    Route::post('/admin/manage/update/{key}', [AdminManageController::class, 'updateAdmin']);
    Route::post('/admin/terms/update', [AdminManageController::class, 'updateTerms']);
    Route::post('/admin/exchange/update', [AdminEventController::class, 'setExchangeShopUpdate']);
    Route::post('/admin/review/update/{id}', [AdminEventController::class, 'updateReivew']);
    Route::post('/admin/app/setting/update', [AdminManageController::class, 'updateAppSetting']);
    Route::get('/admin/user/export', [UserViewController::class, 'userExport']);
    Route::post('/admin/user/import', [UserViewController::class, 'userImport']);
    Route::post('/admin/app_push', [MarketingController::class, 'appPush']);
    Route::post('/admin/pet/update', [UserViewController::class, 'setPetInsert']);

    Route::post('/admin/mission/update/{id}', [MissionViewController::class, 'updateMissionDate']);
    Route::post('/admin/mission/insert/{id}', [MissionViewController::class, 'insertMissionDate']);

    Route::post('/admin/mission_manage/story/update', [MissionViewController::class, 'updateStroyMissionTemp']);

    Route::post('/admin/user/pw', [UserViewController::class, 'setUserPasswordWithAdmin']);

    Route::post('/admin/breed/update', [PetController::class, 'updateBreed']);
    Route::post('/admin/breed/update/{id}', [PetController::class, 'updateBreed']);
    Route::post('/admin/alarm/update', [AdminManageController::class, 'updateAlarmText']);
    Route::post('/admin/member/address/{id}', [UserOrderController::class, 'updateAddress']);
});

Route::group(['middleware' => ['admin.auth.delete']], function () {
    Route::post('/admin/exchange/delete', [AdminEventController::class, 'setExchangeShopDelete']);
    Route::post('/admin/review/delete', [AdminEventController::class, 'deleteReivew']);
    Route::post('/admin/file/delete', [AdminFileController::class, 'deleteFile']);
    Route::post('/admin/terms/delete', [AdminManageController::class, 'deleteTerms']);
    Route::post('/admin/manage/delete', [AdminManageController::class, 'deleteAdmin']);
    Route::post('/admin/manage/popup/delete', [PopupController::class, 'deletePopup']);
    Route::post('/admin/manage/banner/delete', [BannerController::class, 'deleteBanner']);
    Route::post('/admin/report/delete', [MissionViewController::class, 'deletePostReport']);
    Route::post('/admin/exp/delete', [UserViewController::class, 'setLogExpDelete']);
    Route::post('/admin/treat/delete', [UserViewController::class, 'setTreatDelete']);
    Route::post('/admin/order/delete', [UserOrderController::class, 'setOrderDelete']);
    Route::post('/admin/pet/delete', [UserViewController::class, 'setPetDelete']);
    Route::post('/admin/post/delete', [AdminPostController::class, 'deletePost']);
    Route::post('/admin/breed/delete', [PetController::class, 'deleteBreed']);
    Route::post('/admin/member/address/delete/{id}', [UserOrderController::class, 'deleteAddress']);

});
