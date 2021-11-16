<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Http\Controllers\CommonControllers\AppPushControllers;
use App\Http\Controllers\CommonControllers\UserTreatController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookMark;
use App\Models\Config;
use App\Models\Files;
use App\Models\Like;
use App\Models\Mission;
use App\Models\Post;
use App\Models\Report;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    // 뉴스피드 바둑형
    function getNewsfeed(Request $request)
    {
        $post = $this->getPost($request);
        return view('main.newsfeed.newsfeed_tiles')->with(compact('post'))->with('title','뉴스피드');
    }
    // 뉴스피드 카드영
    function getNewsfeedCards(Request $request)
    {
        $post = $this->getPost($request);
        return view('main.newsfeed.newsfeed_cards')->with(compact('post'))->with('title','뉴스피드');
    }
    // 마이피드 바둑
    function getMyfeed(Request $request)
    {
        $idx = Auth::id();
        if(!$request->user_idx)
        {
            $request->user_idx = $idx;
        }
        $post = $this->getPost($request);
        $user = User::where('idx',$request->user_idx)->with('pets')->first();
        if($user)
        {
            return view('main.newsfeed.newsfeed_tiles')->with(compact('post'))->with('title','마이피드')->with('user',$user);
        }else{
            return redirect()->back();
        }
    }
    // 마이피드 카드
    function getMyfeedCards(Request $request)
    {
        $idx = Auth::id();
        if(!$request->user_idx)
        {
            $request->user_idx = $idx;
        }
        $post = $this->getPost($request);
        $user = User::where('idx',$request->user_idx)->with('pets')->first();
        return view('main.newsfeed.newsfeed_cards')->with(compact('post'))->with('title','마이피드')->with('user',$user);
    }

    // 찜목록 바둑
    function getBookmark(Request $request)
    {
        $request->bookmark_user = 1;
        $post = $this->getPost($request);
        return view('main.newsfeed.newsfeed_tiles')->with(compact('post'))->with('title','저장피드');
    }

    // 찜목록 디테일
    function getBookmarkCards(Request $request)
    {
        $request->bookmark_user = 1;
        $post = $this->getPost($request);
        return view('main.newsfeed.newsfeed_cards')->with(compact('post'))->with('title','저장피드');
    }

    // 포스트 디테일
    function getPostDetail(Request $request)
    {
        $post = $this->getPost($request);
        if(count($post) == 0){
            die('<script>alert("삭제되었거나 숨김처리된 글입니다."); location.href="/newsfeed_cards"; </script>');
        }
        $user_idx = Auth::id();
        $user = User::find($user_idx);
        return view('main.post_detail')->with(compact('post'))->with('user',$user);
    }

    function getMissionFileList(Request $request)
    {
        if($request->post_idx){
            $files = Files::where([
                ['table_idx', $request->post_idx],
                ['table_name', 'post_tbl'],
                ['is_public', 1],
            ])->get();
            return response()->json([
                'data' => $files,
                'count' => count($files),
                'status' => 200,
            ], 200);
        }
    }

    /**
     * 피드 요청
     * get
     * url '/pos'
     * @param request->tag          선택
     * @param request->order        선택
     * @param request->mission_idx  선택
     * @param request->mission_pool_idx 선택
     * @param request->user_idx     선택
     * @param request->pet_idx      선택
     * @param request->page         선택
     *
     */
    function getPost($request)
    {
        print_r(DB::enableQueryLog());
        $post = Post::
                select('post_tbl.*')
                ->addSelect(DB::raw('group_concat(tag) as tag'))
                ->addSelect(DB::raw('(SELECT COUNT(idx) FROM like_tbl WHERE post_idx = post_tbl.idx AND deleted_at IS NULL) as like_count'))
                ->whereNull('parent_idx')
                ->where('is_public','1')->where('status','2')
                ->leftJoin('tag_tbl', 'post_tbl.idx', '=', 'tag_tbl.post_idx')
                ->groupBy('post_tbl.idx')
                ->with('like:idx,user_idx')
                ->with('files')
                ->with('mission')
                ->with('user:idx,nickname,file_idx')
                ->with('reply');
        // 검색
        $tag = $request->tag ? $request->tag : [];
        $order = $request->order ? $request->order : 'date';
        $mission_idx = $request->mission_idx ? $request->mission_idx : '';
        $mission_pool_idx = $request->mission_pool_idx ? $request->mission_pool_idx : '';
        $user_idx = $request->user_idx ? $request->user_idx : '';
        $pet_idx = $request->pet_idx ? $request->pet_idx : [];
        $page = $request->page ? $request->page : '0';
        $search = $request->search ? $request->search:'';
        $post_idx = $request->post_idx ? $request->post_idx:'';
        $session_user_idx = Auth::id();
        $bookmark_user = $request->bookmark_user ? $request->bookmark_user:'';

        // 세션 유저의 좋아요, 찜 여부 확인
        if($session_user_idx){
            $post
            ->addSelect(DB::raw('(SELECT COUNT(idx) FROM like_tbl WHERE post_idx = post_tbl.idx AND user_idx = '.$session_user_idx.' AND deleted_at IS NULL) as user_like'))
            ->addSelect(DB::raw('(SELECT COUNT(idx) FROM bookmark_tbl WHERE post_idx = post_tbl.idx AND user_idx = '.$session_user_idx.' AND deleted_at IS NULL) as user_bookmark'));
        }
        if($bookmark_user)
        {
            $post->join('bookmark_tbl', 'post_tbl.idx', '=', 'bookmark_tbl.post_idx')->where('bookmark_tbl.user_idx',$session_user_idx )->whereNull('bookmark_tbl.deleted_at');
        }

        //포스트 인덱스
        if($post_idx)
        {
            $post->where('post_tbl.idx', $post_idx);
        }
        // 태그 검색 배열
        if($tag){
            if(count($tag) > 1)
            {
                $key = array_search( '미션', $tag );
                array_splice($tag, $key, 1 );
            }
            $post->whereIn('tag_tbl.tag', $tag);
        }
        // 정렬 기본 : 날짜순
        if($order == 'like'){
            $post->orderBy('like_count', 'desc')->latest();
        }else{
            $post->latest();
        }

        // 발급미션 인덱스
        if($mission_idx){
            $post->where('post_tbl.idx', $mission_idx);
        }

        // 미션 인덱스
        if($mission_pool_idx){
            $idx = Mission::select(DB::raw('group_concat(idx) as data'))->where('mission_pool_idx', $mission_pool_idx)->first();
            $idx = explode(',',$idx->data);
            $post->whereIn('post_tbl.mission_idx', $idx);
        }

        // 유저 인덱스 검색
        if($user_idx){
            $post->where('post_tbl.user_idx', $user_idx);
        }

        // 펫 인덱스 검색
        if($pet_idx){
            $str_pet = implode( '|', $pet_idx);
            $post->where('post_tbl.pet_idx', 'REGEXP', $str_pet);
        }

        // 검색
        if($search)
        {
            $user = User::where('nickname',$search)->first();
            $post->where(function ($query) use ($search, $user) {
                $query->where('post_tbl.content', 'like' ,'%'.$search.'%')
                    ->orWhere('tag_tbl.tag', $search);
                    if($user)$query->orWhere('post_tbl.user_idx', $user->idx);
            });
        }

        // 페이징 10개씩
        $post =  $post->paginate(18);
        $post->setPath('');

        foreach($post as $key => $val)
        {
            $c_reply = 0;
            foreach($val->reply as $key2){ $c_reply += $key2->reply2_count; }
            $post[$key]->sub_reply_count = $c_reply;
        }
        // 페이지 링크에 현재 쿼리 스트링 추가
        $post->withQueryString()->links();

        return $post;
    }
    /**
     * 신고 요청
     * post
     * url '/post/set_report'
     * @param request->post_idx //필수
     */
    public function setReport(Request $request)
    {
        $idx = Auth::id();
        if($request->post_idx && $idx)
        {
            $report = Report::insertOrIgnore(
                [
                    'user_idx' => $idx,
                    'post_idx' => $request->post_idx,
                    'content' => $request->msg
                ]
            );
            if($report != 0)
            {
                Post::where('idx', $request->post_idx)->increment('report', '1');

                // 설정 파일에서 신고 카운터 한도가 넘었을땐 자동적으로 포스트 블락 처리
                $config_count = Config::where('key','report_count')->first();
                $config_count = $config_count->value;
                $report_count = Report::where('post_idx', $request->post_idx)->count();
                if($config_count <= $report_count) {

                    Post::where('idx', $request->post_idx)->update(['is_public' => 0]); // 포스트 블라인드 처리

                    // 신고 회원에게 알람 메시지
                    $post = Post::where('idx', $request->post_idx)->first();

                    $alarm = collect();
                    $alarm->user_idx = $post->user_idx;
                    $alarm->sender_idx = 0;
                    $alarm->url = '';
                    $alarm->text = '';
                    $appPushControllers = new AppPushControllers;
                    $appPushControllers->sendSingleAppPush($alarm, 'report');
                    // 세번이상일때는 페이지가 사라짐으로 뉴스피드로 이동
                    return response()->json([
                        'status' => 200,
                        'msg' => '신고하였습니다',
                        'redirect' => '/newsfeed_cards',
                    ], 200);
                }
                return response()->json([
                    'status' => 200,
                    'msg' => '신고하였습니다',
                ], 200);
                return redirect()->back()->with('alert','신고하였습니다');
            }
            else
            {
                return response()->json([
                    'status' => 200,
                    'msg' => '이미 신고한 게시물입니다.',
                ], 200);
            }
        }
        return response()->json([
            'status' => 200,
            'msg' => '로그인 해주세요',
        ], 200);
    }

    /**
     * 좋아요 요청
     * post
     * url '/post/set_like'
     * @param request->post_idx 필수
     */
    public function setLike(Request $request)
    {
        $user_idx = Auth::id();
        if($request->post_idx && $user_idx)
        {
            $post = Post::find($request->post_idx);
            $is_check = Like::where(['user_idx' => $user_idx, 'post_idx' => $request->post_idx])->withTrashed()->count();
            if($is_check)
            {
                DB::update('UPDATE `like_tbl` SET `deleted_at` = IF( deleted_at IS NULL, NOW(), NULL) where (`user_idx` = ? AND `post_idx` = ?) limit 1', [$user_idx, $request->post_idx]);
            }else{

                DB::insert('INSERT INTO `like_tbl` (`user_idx`, `post_idx`) VALUES (?, ?)', [$user_idx, $request->post_idx]);

                // 좋아요 트릿 신규 추가시에만 업데이트
                $userTreatController = new UserTreatController;
                $userTreatController->updateUserTreatOfLike($user_idx, $request->post_idx);

                $alarm = collect();
                $alarm->user_idx = $post->user_idx;
                $alarm->sender_idx = $user_idx;
                $alarm->url = '/post_detail?post_idx='.$post->idx;
                $alarm->text = '';
                $appPushControllers = new AppPushControllers;
                $appPushControllers->sendSingleAppPush($alarm, 'post_like');
            }

            return response()->json([
                'status' => 200,
            ], 200);

        }else{
            return response()->json([
                'status' => 200,
            ], 200);
        }
    }

    /**
     * 좋아요 요청
     * post
     * url '/post/get_like'
     * @param request->idx_list 필수
     */
    public function getLike(Request $request)
    {
        $ret = '';
    	if($request->idx_list)
        {
            $user_idx = Auth::id();
        	$idx_list = implode(", ", json_decode($request->idx_list, true));
            if($idx_list)
            {
                // 좋아요 리스트
                $like = DB::select("SELECT p.idx as post_idx ,(SELECT COUNT(*) FROM like_tbl WHERE deleted_at IS NULL AND post_idx = p.idx) as cnt, (SELECT IF(user_idx=$user_idx, 1, 0) FROM like_tbl WHERE deleted_at IS NULL AND post_idx = p.idx AND user_idx=$user_idx) as user, (SELECT IF(user_idx=$user_idx, 1, 0) FROM bookmark_tbl WHERE deleted_at IS NULL AND post_idx = p.idx AND user_idx=$user_idx) as book FROM post_tbl as p WHERE idx in ($idx_list)");

                $ret = json_encode($like);
                return response()->json([
                    'status' => 200,
                    'data'   => $ret,
                ], 200);
            }
        }
        return response()->json([
            'status' => 201,
            'data'   => $ret,
        ], 200);
    }

    public function setReplyLike(Request $request)
    {
        $user_idx = Auth::id();
        $main_post_idx = $request->main_post_idx;
        if($request->post_idx && $user_idx)
        {
            $post = Post::find($request->post_idx);
            $is_check = Like::where(['user_idx' => $user_idx, 'post_idx' => $request->post_idx])->withTrashed()->count();
            if($is_check)
            {
                DB::update('UPDATE `like_tbl` SET `deleted_at` = IF( deleted_at IS NULL, NOW(), NULL) where (`user_idx` = ? AND `post_idx` = ?) limit 1', [$user_idx, $request->post_idx]);
            }else{
                // 좋아요 트릿 신규 추가시에만 업데이트
                DB::insert('INSERT INTO `like_tbl` (`user_idx`, `post_idx`) VALUES (?, ?)', [$user_idx, $request->post_idx]);

                $alarm = collect();
                $alarm->user_idx = $post->user_idx;
                $alarm->sender_idx = $user_idx;
                $alarm->url = '/post_detail?post_idx='.$main_post_idx.'&comment=true';
                $alarm->text = '';
                $appPushControllers = new AppPushControllers;
                $appPushControllers->sendSingleAppPush($alarm, 'reply_like');
            }

            return response()->json([
                'status' => 200,
            ], 200);

        }else{
            return response()->json([
                'res' => '요청 값 에러',
                'status' => 200,
            ], 200);
        }
    }
    // 북마크 요청
    public function setBookmark(Request $request)
    {
        $user_idx = Auth::id();
        if($request->post_idx && $user_idx)
        {

            $is_check = BookMark::where(['user_idx' => $user_idx, 'post_idx' => $request->post_idx])->withTrashed()->count();
            if($is_check)
            {
                DB::update('UPDATE `bookmark_tbl` SET `deleted_at` = IF( deleted_at IS NULL, NOW(), NULL) where (`user_idx` = ? AND `post_idx` = ?) limit 1', [$user_idx, $request->post_idx]);
            }else{
                DB::insert('INSERT INTO `bookmark_tbl` (`user_idx`, `post_idx`) VALUES (?, ?)', [$user_idx, $request->post_idx]);
            }

            return response()->json([
                'status' => 200,
            ], 200);

        }else{
            return response()->json([
                'res' => '요청 값 에러',
                'status' => 200,
            ], 200);
        }
    }

    // 댓글 작성 요청
    public function setReply(Request $request)
    {
        $main_post_idx = $request->main_post_idx;
        $post_idx = $request->post_idx;
        $content = $request->content;
        $user_idx = Auth::id();

        // 태그 변환
        $content = $this->getTagChange($content);

        $post = new Post;
        $post->user_idx = $user_idx;
        $post->content = $content;
        $post->parent_idx = $post_idx;
        $post->status = 2;
        $post->save();

        // 회원이 단 태그
        $tags = $this->getUserPostTag($request->content);
        foreach($tags as $val){ Tag::insertOrIgnore([['tag' => $val, 'post_idx' => $post_idx ]]); }

        // 맨션 알림 처리
        $this->userMention($content, $user_idx, $post->idx);

        $appPushControllers = new AppPushControllers;
        // 본문 작성자 알람
        $alarm = collect();
        $parent_post = Post::find($main_post_idx);
        $alarm->user_idx = $parent_post->user_idx;
        $alarm->sender_idx = $user_idx;
        $alarm->url = '/post_detail?post_idx='.$main_post_idx.'&comment=true';
        $alarm->text = '';
        $appPushControllers->sendSingleAppPush($alarm, 'post_reply');
        // 본문포스트와 parent 포스트가 다를경우 대댓이므로 댓글작성자에게도 알람 전송
        if($post_idx != $main_post_idx)
        {
            $parent_post = Post::find($post_idx);
            // 본문작성자와 댓글작성자가 다를경우에만 보냄..
            if($alarm->user_idx != $parent_post->user_idx)
            {
                $alarm->user_idx = $parent_post->user_idx;
                $appPushControllers->sendSingleAppPush($alarm, 'post_reply');
            }
        }
        return response()->json([
            'msg' => '댓글을 작성하였습니다.1',
            'data' => array(
                'idx' => $post->idx,
                'main_post_idx' => $main_post_idx,
                'parent_idx' => $post_idx,
                'content' => $content,
                'date' => substr($post->created_at, 0, 10),
                'user' => User::select('idx','nickname','file_idx')->find($user_idx),
            ),
            'status' => 200,
        ], 200);
    }
    // 게시글 삭제 요청
    public function deleteReply(Request $request){
        $post_idx = $request->post_idx;
        $user_idx = Auth::id();
        $post = Post::find($post_idx);
        if($post->user_idx == $user_idx)
        {
            $post->delete();
            return redirect()->back()->with('alert','삭제하였습니다.');
        }else{
            return redirect()->back()->with('alert','본인 글만 삭제 가능합니다.');
        }
    }

    function getUserPostTag($text)
    {
        preg_match_all('/((?<=#)[\d|A-Z|a-z|ㄱ-ㅎ|ㅏ-ㅣ|가-힣|\_]+)/', $text ,$matches);
        return $matches[0];
    }

    function getTagChange($text)
    {
        $result = preg_replace('/#([\d|A-Z|a-z|ㄱ-ㅎ|ㅏ-ㅣ|가-힣|\_]+)/' , '<a href="/newsfeed?tag[]=${1}" class="hash-tag">${1}</a>', $text);
        return $result;
    }

    function userMention($text, $sender_idx, $post_idx)
    {
        preg_match_all('/(?<=data-item-id=")[0-9]*/', $text , $matches);
        if(count($matches[0]))
        {
            foreach($matches[0] as $val)
            {
                $alarm = collect();
                $alarm->user_idx = $val;
                $alarm->sender_idx = $sender_idx;
                $alarm->url = '/post_detail?post_idx='.$post_idx;
                $alarm->text = '';
                $appPushControllers = new AppPushControllers;
                $appPushControllers->sendSingleAppPush($alarm, 'mention');
            }
        }
    }

    function getFilesList(Request $request, $id)
    {
        $urls = array();
        $files = Files::where('table_name','post_tbl')->where('table_idx',$id)->orderBy('created_at','asc')->get();
        foreach($files as $f){
            array_push($urls, 'https://dndlifecare.com/files/'.$f->idx);
        }
        return response()->json([
            'urls' => $urls,
            'status' => 200,
        ], 200);

    }
}
