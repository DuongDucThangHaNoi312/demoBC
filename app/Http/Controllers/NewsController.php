<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use  App\Models\NewsCategory;
// use Validator;

class NewsController extends Controller
{
	public function __construct()
	{
		$this->middleware([
			'role:superadministrator|administrator',
		]);
	}

	public function showNews()
	{

		$news = News::with('newscategory')->paginate(5);
		$allNews = DB::table('news')->get();
		$allCategory = DB::table('news_categories')->get();
		$specialCategory = DB::table('news_categories')->where('id',8)->get();
		Carbon::setLocale('vi');
		$mytime = Carbon::now('Asia/Ho_Chi_Minh');
	    // $mytime->toDayDateTimeString();
		return view('news.show_news')->with('news', $news)->with('allNews',$allNews)->with('allCategory',$allCategory)->with('mytime',$mytime)->with('specialCategory',$specialCategory);
	}


	public function createNews()

	{
		$allCategory = NewsCategory::all();
        // $allCategory = NewsCategory::pluck('name', 'id','status');

        // var_dump ($allCategory);
        // die();
		$mytime = Carbon::now('Asia/Ho_Chi_Minh');
		
		return view('news.create_news')->with('mytime',$mytime)->with('allCategory',$allCategory)->with('messageAddNewsError','Thất bại ! ');

	}
	public function saveNews(Request $request)
	{
		$request->validate([
			'title' => 'required|min:6',
			'text' => 'required|min:10',
			'newscategory_id' =>'required',
			'avatar' =>'required',	
		],[

			"title.required" => " Title không được để trống",
			"title.min" => " Độ dài title ít nhất là 6",	
			"text.required" => " Text không được để trống",
			"text.min" => " Độ dài Text ít nhất là 6",
			"newscategory_id.required" => " Danh mục không được để trống",
			"newscategory_id.required" => " Ảnh không được để trống",



		]);
		if (isset($request->status1)) {
			$status = $request->status1;
		}
		else {

			$status = $request->status0;
		}

		if (request()->has('avatar')) {
			$avataruploaded = request()->file('avatar');
			$avatarname = time() . '.' . $avataruploaded->getClientOriginalExtension();
			$avatarpath = public_path('/images/');
			$avataruploaded->move($avatarpath, $avatarname);
		}

		$news = new News;
		$news ->title = $request->title;
		$news ->text = $request ->text;
		$news ->avatar ='/images/' . $avatarname;
		$news ->status = $status ;
		$news ->newscategory_id = $request->newscategory_id ;
		$news->save();
		return redirect()->route('showNews')->with('messageAddNews','Thêm thành công ! ');

		


	}

	public function editNews($idNews)

	{
		$allCategory = NewsCategory::all();
		$mytime = Carbon::now('Asia/Ho_Chi_Minh');
		$newsEdit =News::findOrFail($idNews);


		// var_dump ($newsEdit);
// die();
		return view('news.edit_news',['newsEdit' => $newsEdit])->with('mytime',$mytime)->with('allCategory',$allCategory);
	}

	public function updateNews(Request $request,$id)

	{
		$newsUpdate =News::findOrFail($id);
		$newsUpdate ->title = $request ->title;
		$newsUpdate ->text = $request ->text;

		// var_dump ($request ->avatarNew );
		// die();



		if (isset($request->statusOld)) {
			$status = $request->statusOld;

		}
		else {

			$status = $request->statusNew;
		}
		
		if (isset($request->newscategory_id_new)) {
			$newscategory_id = $request ->newscategory_id_new;

		}
		else {
			$newscategory_id = $request ->newscategory_id_old;
			
		}


		if (request()->has('avatarNew')  &&  $request ->avatarNew != "" ) {
			$avataruploaded = request()->file('avatarNew');
			$avatarname = time() . '.' . $avataruploaded->getClientOriginalExtension();
			$avatarpath = public_path('/images/');
			$avataruploaded->move($avatarpath, $avatarname);
		}



		$newsUpdate ->status = $status;
		$newsUpdate ->newscategory_id = $newscategory_id;
		
		if (request()->has('avatarNew')  &&  $request ->avatarNew != "" )  {
			
			$newsUpdate ->avatar ='/images/' . $avatarname;
		}

		else {
			$newsUpdate ->avatar = $request->avatarOld;
		}
		

		$newsUpdate->save();
		return redirect()->route('showNews')->with('messageUpdateNews', 'Cập nhật thành công ! ');
	}

	public function deleteNews($idNews)
	{ 
		$newsDeleted =News::findOrFail($idNews);
		$newsDeleted->delete();
		return redirect()->route('showNews')->with('messageDeleteNews', 'Xóa thành công ! ');

	}


	public function searchNews(Request $request)	
	{ 
		Carbon::setLocale('vi');
		$mytime = Carbon::now('Asia/Ho_Chi_Minh');
		$allNews = DB::table('news')->get();
		$allCategory = DB::table('news_categories')->get();
		

		$keySearchNews = $request->keySearchNews;
		$keySearchCategory = $request->keySearchCategory;
		$searchByShow = $request->searchByShow;
		$searchByStatus = $request->searchByStatus;
		
		$searchByTime = $request->searchByTime;


		


		// var_dump ($keySearchNews);
		// die();

        // search by title
		if($keySearchNews!=""){
			$news = News::where(function ($query) use ($keySearchNews){
				$query->where('title', 'like', '%'.$keySearchNews.'%');
			})
			->paginate($searchByShow);
			$news->appends(['keySearchNews' => $keySearchNews,
				'searchByShow' => $searchByShow
			]);
		}
		


        // search by category
		if($keySearchCategory!=""){
			$news = News::where(function ($query) use ($keySearchCategory){
				$query->where('newscategory_id', 'like', '%'.$keySearchCategory.'%');
			})
			->paginate($searchByShow);
			$news->appends(['keySearchCategory' => $keySearchCategory,
				'searchByShow' => $searchByShow
			]);
		}  



		// search by status
		if($searchByStatus!=""){
			$news = News::where(function ($query) use ($searchByStatus){
				$query->where('status', 'like', '%'.$searchByStatus.'%');
			})
			->paginate($searchByShow);
			$news->appends(['searchByStatus' => $searchByStatus,
				'searchByShow' => $searchByShow
			]);
		}


		// search by title and category
		if($keySearchNews!="" && $keySearchCategory!=""){
			$news = News::where('title', 'like', '%'.$keySearchNews.'%')
			->where('newscategory_id', 'like', '%'.$keySearchCategory.'%')->paginate($searchByShow);
			$news->appends(['keySearchNews' => $keySearchNews,
				'keySearchCategory' => $keySearchCategory,
				'searchByShow' => $searchByShow
			]);
		}


        // search by title and status
		if($keySearchNews!="" && $searchByStatus!=""){
			$news = News::where('title', 'like', '%'.$keySearchNews.'%')
			->where('status', 'like', '%'.$searchByStatus.'%')->paginate($searchByShow);
			$news->appends(['keySearchNews' => $keySearchNews,
				'searchByStatus' => $searchByStatus,
				'searchByShow' => $searchByShow
			]);
		}

        // search by title and status and category
		if($keySearchNews!="" && $searchByStatus!="" && $keySearchCategory!=""){
			$news = News::where('title', 'like', '%'.$keySearchNews.'%')
			->where('status', 'like', '%'.$searchByStatus.'%')->where('newscategory_id', 'like', '%'.$keySearchCategory.'%')
			->paginate($searchByShow);
			$news->appends(['keySearchNews' => $keySearchNews,
				'searchByStatus' => $searchByStatus,
				'keySearchCategory' => $keySearchCategory,
				'searchByShow' => $searchByShow
			]);
		}


        // search by show
		if ($keySearchNews == "" && $keySearchCategory == "" &&  $searchByStatus ==""  && $searchByShow != "") {
			$news = News::paginate($searchByShow);
			$news->appends([
				'searchByShow' => $searchByShow
			]);
		}


        // search by empty
		if ($keySearchNews == "" && $keySearchCategory == "" &&  $searchByStatus ==""  && $searchByShow == "" && $searchByTime != "") {
			$news = News::paginate(5);
			// $news->appends([
			// 	'searchByShow' => $searchByShow
			// ]);
		}

		if($searchByTime!="" ){
			if(!is_array($searchByTime)){
				$searchByTimeNew = explode("-", $searchByTime);
			}
			$timeStart = strtotime($searchByTimeNew[0]);
			$timeStart = date('Y-m-d',$timeStart);
			var_dump ($timeStart);

			$timeEnd = strtotime($searchByTimeNew[1]);
			$timeEnd = date('Y-m-d',$timeEnd);
			var_dump ($timeEnd);
			$news = News::whereBetween('created_at', [$timeStart." 00:00:00", $timeEnd." 23:59:59"])->paginate(5);

			$news->appends([
				'searchByShow' => $searchByShow,
				'searchByTime' => $searchByTime,
			]);
		}


		return view('news.show_news',['news' => $news])->with('allNews',$allNews)->with('keySearchNews',$keySearchNews)
		->with('searchByStatus',$searchByStatus)->with('mytime',$mytime)->with('allCategory',$allCategory)->with('keySearchCategory',$keySearchCategory)->with('searchByShow',$searchByShow)->with('searchByTime',$searchByTime);
	}


	public function name()

	{
		$mytime = Carbon::now('Asia/Ho_Chi_Minh');
		return view('news.form_news')->with('mytime',$mytime);	
	}

	public function test()

	{
		$mytime = Carbon::now('Asia/Ho_Chi_Minh');
		return view('news.test_news')->with('mytime',$mytime);	
	}














	public function index1( Request $request ){
		$info = [];
		return view( 'datatables.list1', $info );
	}

	public function posts1( Request $request ){

		$info = [
			'draw' => $request->draw,
			'data' => [],
			'total' => 0,
		];

		$search = $request->input('search.value');

		$posts = News::orWhere( function($query) use ( $search ) {
			$query->where( "title", "LIKE", "%".$search."%" )->where( "text", "LIKE", "%".$search."%" );
		} )->dateFilter( $request->from_date, $request->to_date )->take( $request->length )->skip( $request->start )->get();

		$info['total'] = News::orWhere( function($query) use ( $search ) {
			$query->where( "title", "LIKE", "%".$search."%" )->where( "text", "LIKE", "%".$search."%" );
		} )->dateFilter( $request->from_date, $request->to_date )->count();

		$sl_no_counter = ( $request->start == 0 )? 1 : $request->start+1;

		foreach( $posts as $post ){
			$post->sl_no = $sl_no_counter;
			$sl_no_counter++;
		}

		$info['data'] = $posts;

		return $info;
	}


	public function testPostback(Request $request)
	{
		$title =  $request->title;
		return back()->with('title',$title );
	}




}
