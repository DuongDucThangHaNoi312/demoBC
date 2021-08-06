<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsCategory;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
class NewsCategoryController extends Controller
{
	public function __construct()
	{
		$this->middleware([
			'role:superadministrator|administrator',
			
		]);
	}

	
	public function showCategory()
	{

		$allCategories =  DB::table('news_categories')->get();

		$categories = DB::table('news_categories')->orderBy('created_at','desc')->paginate(5);
		Carbon::setLocale('vi');
		$mytime = Carbon::now('Asia/Ho_Chi_Minh');
		return view('category.show_category')->with('allCategories',$allCategories)->with('categories', $categories)->with('mytime',$mytime);
	}


	public function createCategory()
	{
		$mytime = Carbon::now('Asia/Ho_Chi_Minh');
		return view('category.create_category')->with('mytime',$mytime);

	}

	public function saveCategory(Request $request)
	{
		
		$request->validate([
			'name' => 'required|min:6',
		],[

			"name.required" => " Title không được để trống",
			"name.min" => " Độ dài title ít nhất là 6",	
		]);
		if (isset($request->status1)) {
			$status = $request->status1;
		}
		else {

			$status = $request->status0;
		}
		$category = new NewsCategory;
		$category ->name = $request->name;
		$category ->status = $status ;
		$category->save();
		return redirect()->route('showCategory')->with('messageAddCategory','Thêm thành công ! ');

		


	}

	public function editCategory($idCategory)

	{
		
		$mytime = Carbon::now('Asia/Ho_Chi_Minh');
		$categoryEdit =NewsCategory::findOrFail($idCategory);
		return view('category.edit_category',['categoryEdit' => $categoryEdit])->with('mytime',$mytime);
	}

	public function updateCategory(Request $request,$id)

	{
		$categoryUpdate =NewsCategory::findOrFail($id);
		$categoryUpdate ->name = $request ->name;

		if (isset($request->statusOld)) {
			$status = $request->statusOld;

		}
		else {

			$status = $request->statusNew;
		}

		$categoryUpdate ->status = $status;
		$categoryUpdate->save();
		return redirect()->route('showCategory')->with('messageUpdateCategory', 'Cập nhật thành công ! ');
	}

	public function deleteCategory($idCategory)
	{ 
		$categoryDeleted =NewsCategory::findOrFail($idCategory);
		DB::table('news')->where('newscategory_id',$idCategory)->update(array('newscategory_id' => 1));
		$categoryDeleted->delete();

		return redirect()->route('showCategory')->with('messageDeleteCategory', 'Xóa thành công ! ');

	}


	public function searchCategory(Request $request)	
	{ 
		Carbon::setLocale('vi');
		$mytime = Carbon::now('Asia/Ho_Chi_Minh');
		$allCategories = DB::table('news_categories')->get();
		$keySearchCategory = $request->keySearchCategory;
		$searchByShow = $request->searchByShow;
		$searchByStatus = $request->searchByStatus;
		

		$searchByTime = $request->searchByTime;

		// var_dump ($searchByTime);
		// die();


		if($searchByTime!="" ){
			if(!is_array($searchByTime)){
				$searchByTime1 = explode("-", $searchByTime);
			}
			$timeStart = strtotime($searchByTime1[0]);
			$timeStart = date('Y-m-d',$timeStart);
			var_dump ($timeStart);

			$timeEnd = strtotime($searchByTime1[1]);
			$timeEnd = date('Y-m-d',$timeEnd);
			var_dump ($timeEnd);
			$categories = NewsCategory::whereBetween('created_at', [$timeStart." 00:00:00", $timeEnd." 23:59:59"])->paginate(5);

			$categories->appends([
				'searchByShow' => $searchByShow,
				'searchByTime' => $searchByTime,
			]);
		}


		if($keySearchCategory!=""){
			$categories = NewsCategory::where(function ($query) use ($keySearchCategory){
				$query->where('name', 'like', '%'.$keySearchCategory.'%');
			})
			->paginate($searchByShow);
			$categories->appends(['keySearchCategory' => $keySearchCategory,
				'searchByShow' => $searchByShow
			]);
		}
		
		// search by status
		if($searchByStatus!=""){
			$categories = NewsCategory::where(function ($query) use ($searchByStatus){
				$query->where('status', 'like', '%'.$searchByStatus.'%');
			})
			->paginate($searchByShow);
			$categories->appends(['searchByStatus' => $searchByStatus,
				'searchByShow' => $searchByShow
			]);
		}

			// search by title and status
		if($keySearchCategory!="" && $searchByStatus!=""){
			$categories = NewsCategory::where('name', 'like', '%'.$keySearchCategory.'%')
			->where('status', 'like', '%'.$searchByStatus.'%')->paginate($searchByShow);
			$categories->appends(['keySearchCategory' => $keySearchCategory,
				'searchByStatus' => $searchByStatus,
				'searchByShow' => $searchByShow
			]);
		}

       // search by show
		if ($keySearchCategory == "" &&  $searchByStatus ==""  && $searchByShow != "") {
			$categories = NewsCategory::paginate($searchByShow);
			$categories->appends([
				'searchByShow' => $searchByShow
			]);
		}


        // search by empty
		if ( $keySearchCategory == "" &&  $searchByStatus ==""  && $searchByShow == ""  && $searchByTime == "") {
			$categories = NewsCategory::paginate(5);
		}
		// var_dump ($searchByTime);
		// die();

		return view('category.show_category',['categories' => $categories])->with('allCategories',$allCategories)->with('keySearchCategory',$keySearchCategory)->with('mytime',$mytime)->with('searchByShow', $searchByShow)->with('searchByStatus',$searchByStatus)->with('searchByTime',$searchByTime);
	}



}
