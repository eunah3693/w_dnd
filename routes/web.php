<?php

use App\Http\Controllers\AdminControllers\BannerController;
use App\Http\Controllers\AdminControllers\AdminAuthController;
use App\Http\Controllers\AdminControllers\AdminEventController;
use App\Http\Controllers\AdminControllers\AdminFileController;
use App\Http\Controllers\AdminControllers\AdminManageController;
use App\Http\Controllers\AdminControllers\BoardController;
use App\Http\Controllers\AdminControllers\DashboardController;
use App\Http\Controllers\AdminControllers\LogController;
use App\Http\Controllers\AdminControllers\MarketingController;
use App\Http\Controllers\AdminControllers\UserViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommonControllers\FileController;
use App\Http\Controllers\ServiceControllers\UserAuthController;
use App\Http\Controllers\ServiceControllers\MainViewController;
use App\Http\Controllers\AdminControllers\MissionViewController;
use App\Http\Controllers\AdminControllers\PetController;
use App\Http\Controllers\AdminControllers\PopupController;
use App\Http\Controllers\AdminControllers\PostController as AdminControllersPostController;
use App\Http\Controllers\AdminControllers\UserOrderController;
use App\Http\Controllers\ServiceControllers\AlarmController;
use App\Http\Controllers\ServiceControllers\DeviceController;
use App\Http\Controllers\ServiceControllers\Eventcontroller;
use App\Http\Controllers\ServiceControllers\MissionContoller;
use App\Http\Controllers\ServiceControllers\NoticeController;
use App\Http\Controllers\ServiceControllers\PostController;
use App\Http\Controllers\ServiceControllers\UserMissionController;
use App\Http\Controllers\ServiceControllers\UserMyPageViewController;
use App\Models\EventJoin;
use App\Models\Breed;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
 * User Page
 *
 *
 */


// 홈
Route::get('/', [MainViewController::class, 'getMain']);
// 알림
Route::post('/notification/get_check', [AlarmController::class, 'getCheckUserAlarm']);

// 뉴스피드
Route::get('/newsfeed', [PostController::class, 'getNewsfeed']);
Route::get('/newsfeed_cards', [PostController::class, 'getNewsfeedCards']);
Route::get('/myfeed', [PostController::class, 'getMyfeed']);
Route::get('/myfeed_cards', [PostController::class, 'getMyfeedCards']);
Route::get('/post_detail', [PostController::class, 'getPostDetail']);

// 이벤트
Route::get('/event', [NoticeController::class, 'getEventList']);
Route::get('/event_detail', [NoticeController::class, 'getEventDetail']);

//이용안내
Route::get('/guide', [NoticeController::class, 'getGuideList']);
Route::get('/guide_detail', [NoticeController::class, 'getGuideDetail']);

// 공지사항
Route::get('/notice', [NoticeController::class, 'getNoticeList']);
Route::get('/notice_detail', [NoticeController::class, 'getNoticeDetail']);

// 개인정보처리방침
Route::get('/policy', [NoticeController::class, 'getPolicyList']);
//이용약관
Route::get('/term', [NoticeController::class, 'getTermList']);
Route::get('/faq', [NoticeController::class, 'getFaqList']);
Route::get('/faq_detail', [NoticeController::class, 'getFaqDetail']);



Route::view('/uikit', 'main.uikit');



Route::group(['middleware' => ['web']], function () {
    // your routes here
    //Route::get('/', [MainViewController::class, 'getMain']);
    Route::view('/join', 'main.join');
    Route::get('/join/social/{id}', function($id){
        return view('main.kakao_join', ['id'=>$id]);
    });
    Route::get('/login', [UserAuthController::class, 'login'])->name('login');
    Route::post('/device/uuid', [DeviceController::class, 'getUUID']);
    Route::post('/checklogin', [UserAuthController::class, 'authenticate']);
    Route::get('/find_pw', [UserAuthController::class, 'getFindPassword']);
    Route::get('/logout', [UserAuthController::class, 'logout']);
    Route::get('/login/kakao', [UserAuthController::class, 'kakaoLogin']);
    Route::get('/login/kakao/callback', [UserAuthController::class, 'kakaoLoginCallback']);
    Route::view('/feed', 'main.feed');
        // 교환소
    Route::get('/shop', [Eventcontroller::class, 'getEventList']);
    Route::get('/shop_detail', [Eventcontroller::class, 'getEventDetail']);
});
// 로그인만 접속 가능한 페이지
Route::group(['middleware' => ['auth','web','user']], function () {
    // 미션
    Route::get('/mission', [UserMissionController::class, 'getUserMissionList']);
    Route::get('/mission_detail', [MissionContoller::class, 'getMissionDetailWithIdx']);
    Route::post('/mission/bookmark', [UserMissionController::class, 'setMissionBookMark']);
    Route::get('/mission_post', [UserMissionController::class, 'getUserMissionPostPage']);
    Route::get('/story_first',   [UserMissionController::class, 'storyFirst']);
    // 마이페이지
    Route::get('/my', [UserMyPageViewController::class, 'getUser']);
    Route::get('/nav', [UserMyPageViewController::class, 'getUser']);
    Route::get('/mypost', [UserMissionController::class, 'getUserDailyLifePost']);
    Route::get('/mypost_update', [UserMissionController::class, 'updatePost']);
    Route::get('/myhistory', [UserMyPageViewController::class, 'getMyHistory']);
    Route::get('/myreview',  [UserMyPageViewController::class, 'getMyReview']);
    Route::get('/myshipping', [UserMyPageViewController::class, 'getMyShipping']);
    Route::get('/mylists', [PostController::class, 'getBookmark']);
    Route::get('/mylists_cards', [PostController::class, 'getBookmarkCards']);
    Route::get('/mytreat', [UserMyPageViewController::class, 'getMytreatList']);
    Route::get('/mypet', [UserMyPageViewController::class, 'getMyPet']);
    Route::get('/myqna', [UserMyPageViewController::class, 'getMyQna']);
    Route::get('/myqna_answer',[UserMyPageViewController::class, 'getMyQnaDetail']);
    Route::post('/myqna/insert', [UserMyPageViewController::class, 'setMyQna']);
    Route::get('/setting_account', [UserMyPageViewController::class, 'updateMyPageUserView']);
    Route::view('/setting_pw', 'main.mypage.user_account.setting_pw');
    Route::get('/setting_notification', [UserMyPageViewController::class, 'getMyConfig']);
    Route::get('/notification', [AlarmController::class, 'getUserAlarmList']);
    Route::get('/adress', [Eventcontroller::class, 'getOrderWithEvent']);
    Route::post('/adress/insert', [Eventcontroller::class, 'setOrderWithEvent']);
    Route::get('/secession', [UserMyPageViewController::class, 'deleteUser']);
});


/*
 * Admin Page
 *
 *
 */

Route::get('/admin', [AdminAuthController::class, 'register']);
Route::post('/admin/login', [AdminAuthController::class, 'authenticate']);
Route::get('/admin/logout', [AdminAuthController::class, 'logout']);

//관리자페이지
Route::post('/2fa', function () {
    return redirect('/admin/index');
})->name('2fa')->middleware('2fa');
Route::group(['middleware' => ['admin.auth','2fa']], function () {
    Route::get('/admin/alarm', [DashboardController::class, 'getAdminAlarm']);
    Route::get('/admin/mission_detail', [MissionContoller::class, 'getAdminMissionDetailWithIdx']);
    /** 회원 관리 ***************************************************************************************** */
    Route::get('/admin/index', [DashboardController::class, 'getTodayJoinCount']);
    Route::get('/admin/member/member', [UserViewController::class, 'getUserList']);
    Route::get('/admin/member/member_detail', [UserViewController::class, 'getUser']);
    Route::view('/admin/member/member_modify', 'admin.member.member_modify');
    Route::view('/admin/member/member_add', 'admin.member.member_add');
    Route::get('/admin/member/animal', [UserViewController::class, 'getPets']);
    Route::get('/admin/member/animal_detail', [UserViewController::class, 'getPetDetail']);
    Route::get('/admin/member/animal_modify', [UserViewController::class, 'getPetsModify']);
    Route::get('/admin/member/animal_add', [UserViewController::class, 'getPetsModify']);

    Route::get('/admin/member/delivery', [UserOrderController::class, 'getOrder']);
    Route::get('/admin/member/delivery_modify', [UserOrderController::class, 'getOrderModify']);
    Route::get('/admin/member/delivery_detail', [UserOrderController::class, 'getOrderDetail']);

    Route::get('/admin/member/treat', [UserViewController::class, 'getTreat']);
    Route::get('/admin/member/treat_detail', [UserViewController::class, 'getTreatDetail']);
    Route::get('/admin/member/treat_modify', [UserViewController::class, 'getTreatModify']);

    Route::get('/admin/member/level', [UserViewController::class, 'getLogExp']);
    Route::get('/admin/member/level_detail', [UserViewController::class, 'getLogExpDetail']);
    Route::view('/admin/member/level_add', 'admin.member.level_add');
    Route::get('/admin/member/level_modify', [UserViewController::class, 'getLogExpModify']);

    Route::view('/admin/member/treat_add', 'admin.member.treat_add');

    Route::get('/admin/member/address', [UserOrderController::class, 'getAddress']);
    Route::get('/admin/member/address_modify/{id}', [UserOrderController::class, 'getAddressModify']);
    Route::get('/admin/member/address_detail/{id}', [UserOrderController::class, 'getAddressDetail']);
    /** 회원 관리 ***************************************************************************************** */

    /** 사이트 관리  *******************************************************************************************/
    Route::get('/admin/manage/banner', [BannerController::class, 'getBannerList']);
    Route::get('/admin/manage/banner_detail', [BannerController::class, 'getBanner']);
    Route::get('/admin/manage/banner_modify', [BannerController::class, 'getBannerModify']);

    Route::get('/admin/manage/popup_detail', [PopupController::class, 'getPopup']);
    Route::get('/admin/manage/popup', [PopupController::class, 'getPopuplist']);
    Route::get('/admin/manage/popup_modify', [PopupController::class, 'getPopupModify']);

    Route::view('/admin/manage/banner_one', 'admin.manage.banner_one');
    Route::view('/admin/manage/popup_one', 'admin.manage.popup_one');

    Route::get('/admin/manage/manage', [AdminManageController::class, 'getAdminList']);
    Route::get('/admin/manage/manage/2fa/{id}', [AdminManageController::class, 'getQRCode']);
    Route::get('/admin/manage/manage_detail', [AdminManageController::class, 'getAdmin']);
    Route::get('/admin/manage/manage_modify', [AdminManageController::class, 'getAdminModify']);

    Route::get('/admin/manage/app_setting',  [AdminManageController::class, 'appSetting']);

    Route::get('/admin/manage/file', [AdminFileController::class, 'getFileList']);

    Route::get('/admin/manage/terms', [AdminManageController::class,'getTermsList']);
    Route::get('/admin/manage/terms_detail', [AdminManageController::class,'getTermsDetail']);
    Route::get('/admin/manage/terms_modify', [AdminManageController::class,'getTermsModify']);

    Route::get('/admin/manage/breed', [PetController::class,'getBreedList']);
    Route::get('/admin/manage/breed_detail', [PetController::class,'getBreedDetail']);
    Route::get('/admin/manage/breed_modify', [PetController::class,'getBreedModify']);

    Route::get('/admin/manage/alarm', [AdminManageController::class,'getAlarmTextList']);
    Route::get('/admin/manage/alarm_modify', [AdminManageController::class,'setAlarmTextModify']);
    /** 사이트 관리  *******************************************************************************************/

    /** 미션관리 ***********************************************************************************************/
    Route::get('/admin/mission_manage/story', [MissionViewController::class, 'getStoryMissionList']);
    Route::get('/admin/mission_manage/story_detail', [MissionViewController::class, 'getStoryMissionDetail']);
    Route::get('/admin/mission_manage/story_modify', [MissionViewController::class, 'getStoryMissionModify']);
    Route::post('/admin/mission_manage/story/insert', [MissionViewController::class, 'insertStroyMission']);
    Route::post('/admin/mission_manage/story/update', [MissionViewController::class, 'updateStroyMission']);
    Route::get('/admin/mission_manage/story/delete', [MissionViewController::class, 'deleteStroyMission']);

    Route::get('/admin/mission_manage/mission', [MissionViewController::class, 'getMissionPoolList']);
    Route::get('/admin/mission_manage/mission_modify', [MissionViewController::class, 'getMissionPoolModify']);
    Route::get('/admin/mission_manage/mission_detail', [MissionViewController::class, 'getMissionPoolDetail']);
    Route::post('/admin/mission_manage/mission/insert', [MissionViewController::class, 'insertPoolMission']);
    Route::post('/admin/mission_manage/mission/update', [MissionViewController::class, 'updatePoolMission']);
    Route::post('/admin/mission_manage/mission/delete', [MissionViewController::class, 'deletePoolMission']);

    Route::get('/admin/mission_manage/accepted_mission', [MissionViewController::class, 'getMissionList']);
    Route::post('/admin/mission_manage/accepted_mission/update', [MissionViewController::class, 'updateMission']);
    Route::post('/admin/mission_manage/accepted_mission/delete', [MissionViewController::class, 'deleteMission']);

    Route::get('/admin/mission_manage/member_mission_list', [AdminControllersPostController::class, 'getPost']);
    Route::get('/admin/mission_manage/member_mission_detail', [AdminControllersPostController::class, 'getPostDetail']);

    Route::get('/admin/mission_manage/report', [MissionViewController::class, 'getPostReportList']);
    Route::get('/admin/mission_manage/report_detail', [MissionViewController::class, 'getPostReport']);


    Route::get('/admin/mission_manage/reply', [MissionViewController::class, 'getPostReplyList']);
    Route::post('/admin/mission_manage/reply/update', [MissionViewController::class, 'updatePostReply']);
    Route::post('/admin/mission_manage/reply/delete', [MissionViewController::class, 'deletePostReply']);

    // Route::view('/admin/mission_manage/story_modify', 'admin.mission_manage.story_modify');
    // Route::view('/admin/mission_manage/mission_modify', 'admin.mission_manage.mission_modify');
    // Route::view('/admin/mission_manage/member_mission_modify', 'admin.mission_manage.member_mission_modify');
    // Route::view('/admin/mission_manage/report_modify', 'admin.mission_manage.report_modify');
    /** 미션관리 ***********************************************************************************************/

    /** 게시판관리 ***********************************************************************************************/
    Route::get('/admin/board/{id}', [BoardController::class, 'getBoardList']);
    Route::get('/admin/board/one/{id}', [BoardController::class, 'getBoard']);
    Route::get('/admin/board/modify/{id}/{idx}', [BoardController::class, 'getBoardModify']);
    Route::get('/admin/board/modify/{id}', [BoardController::class, 'getBoardModify']);
    Route::get('/admin/board/detail/{id}', [BoardController::class, 'getBoardDetail']);
    Route::post('/admin/board/insert/{id}', [BoardController::class, 'insertBoard']);
    Route::post('/admin/board/update/{id}', [BoardController::class, 'updateBoard']);
    Route::get('/admin/board/delete/{id}', [BoardController::class, 'deleteBoard']);
    Route::view('/admin/board/list/event', 'admin.board.event_list');

    Route::get('/admin/board_event/exchange', [AdminEventController::class , 'getExchangeShopList']);
    Route::view('/admin/board_event/exchange_one', 'admin.board.exchange_one');
    Route::get('/admin/board_event/exchange_detail',  [AdminEventController::class , 'getExchangeShopDetail']);
    Route::get('/admin/board_event/exchange_modify',  [AdminEventController::class , 'getExchangeShopModify']);
    Route::get('/admin/board_event/review', [AdminEventController::class,'getReviewList']);
    /** 게시판관리 ***********************************************************************************************/


    Route::get('/admin/marketing/marketing_list', [MarketingController::class, 'getMarketingList']);
    Route::get('/admin/marketing/marketing_detail', [MarketingController::class, 'getMarketingDetail']);
    Route::view('/admin/marketing/alarm_talk', 'admin.marketing.alarm_talk');
    Route::view('/admin/marketing/alarm_talk_add', 'admin.marketing.alarm_talk_add');
    Route::view('/admin/marketing/app_push', 'admin.marketing.app_push');
    Route::view('/admin/marketing/app_push_add', 'admin.marketing.app_push_add');
    Route::view('/admin/marketing/mail', 'admin.marketing.mail');
    Route::view('/admin/marketing/mail_add', 'admin.marketing.mail_add');
    Route::view('/admin/marketing/mess', 'admin.marketing.mess');
    Route::view('/admin/marketing/mess_add', 'admin.marketing.mess_add');
    Route::view('/admin/user/pw', 'admin.user.password');

    /** 로그기록 ***********************************************************************************************/
    Route::get('/admin/log', [LogController::class, 'getLog']);
});


/*
 * Resources API
 *
 *
 */
Route::resources(['/files' => FileController::class,]);
Route::get('/thum/{id}', [FileController::class, 'thumbnailShow']);

