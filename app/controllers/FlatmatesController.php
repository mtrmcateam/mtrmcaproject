<?php

class FlatmatesController extends BaseController {
public function getSellFlatmates()
	{	
		$category = DB::select('select category_name from flatmates_category');
		$user_id = Auth::user()->id;
		$active = Profile::where('user_id','=',$user_id)->pluck('active');
		$college_id = Profile::where('user_id','=',$user_id)->pluck('college_id');
		if($active == 1){
			return View::make('utility.sell.flatmates')->with('category',$category)->with('college_id',$college_id);	
		}
		else{
			return Redirect::route('getManageProfile')->with('fail','Please update profile information to use our services.');
		}

	}

	public function postSellFlatmates()
	{
		$validate = Validator::make(Input::all(), array(
			'ad_title' => 'required',
			'location' => 'required',
			'ad_description' => 'required',

		));

		if($validate ->fails())
		{
			return Redirect::route('getSellFlatmates')->withErrors($validate)->withInput();
		}
		else
		{	

			$ad_title = Input::get('ad_title');
			$category_name = Input::get('category');

			$sell = new SellFlatmates();
			$sell->user_id = Auth::user()->id;
			$sell->ad_title = Input::get('ad_title');
			$sell->location = Input::get('location');
			$sell->facilities_available = Input::get('facilities_available');
			$sell->category = Input::get('category');
			$sell->monthly_rent = Input::get('monthly_rent');
			$sell->ad_description = Input::get('ad_description');


			if (Input::hasFile('photo'))
			{
				$files = Input::file('photo');
				$photo="";
				foreach($files as $file) {
				    $rules = array(
				       'file' => 'mimes:png,gif,jpeg|max:20000'
				    );
				    $validator = Validator::make(array('file'=> $file), $rules);
				    if($validator->passes()){

				        $id = Str::random(6);

				        $destinationPath = 'uploads/' . Auth::user()->id;
				        $fname = "MCA_".$id;
				        $mime_type = $file->getMimeType();
				        $extension = $file->getClientOriginalExtension();
				        $filename = $fname.".".$extension;
				        $upload_success = $file->move($destinationPath, $filename);
				        $sell->photo.= $filename.",";
				    } else {
				        return Redirect::back()->with('error', 'I only accept images.');
				    }
				}
			}

			if($sell->save())
			{	
				Mail::queue('emails.utility.postSell', array('ad_title' => $ad_title, 'category_name' => $category_name), function($message)
				{
				    $message->to(Auth::user()->email, Auth::user()->username)->subject('Ad Posted Succesfully!!!');
				});
				$coupons = DB::select('select * from coupons where 
				campaign="Shopclues - CPS new" OR 
				campaign="Kfc - CPS" OR
				campaign="Mc Donald - CPS" OR
				campaign="Paytm CPS"
				GROUP BY campaign
				ORDER BY RAND() limit 4');
				return Redirect::route('getSellFlatmates')->with('success','You have posted your ad succesfully.')->with('coupons',$coupons)->with('modal','#shareModal');
			}
			else
			{
				return Redirect::back()->with('fail','An error ocurred.');
			}
		}

	}

	public function getFlatmatesSearchResultAJAX()
	{
		$searchExplode[] = "";
		$searchQuery = Input::get('searchQuery');
		$searchExplode = explode(" ",rtrim($searchQuery," "));

		foreach($searchExplode as $value)
		  {
		  	$products = SellFlatmates::where('ad_title','LIKE','%'.$value.'%')
							->orWhere('location','LIKE','%'.$value.'%')
							->orWhere('category','LIKE','%'.$value.'%')
							->orderBy('id', 'DESC')
							->paginate(5);
		  }
		  	return View::make('utility.ajax.flatmates')->with('products',$products)->render();

	}

	public function getFlatmatesSearchQueryResult()
	{	$searchExplode[] = "";
		$searchQuery = Input::get('searchQuery');
		$searchExplode = explode(" ",rtrim($searchQuery," "));
		foreach($searchExplode as $value)
		  {
		  	$products = SellFlatmates::where('ad_title','LIKE','%'.$value.'%')
							->orWhere('location','LIKE','%'.$value.'%')
							->orWhere('category','LIKE','%'.$value.'%')
							->orderBy('id', 'DESC')
							->paginate(5);
		  }

		$category = DB::select('select category_name from flatmates_category order By category_name');
		return View::make('utility.search.flatmatesSearch')->with('products',$products)->with('category',$category);

	}

	public function getFlatmatesKeywordSearchResult($key,$value)
	{


		$seller_profile = Profile::where($key,'=',$value)->pluck('user_id');
		$products = SellFlatmates::where('user_id','=',$seller_profile)->paginate(5);
		
		$category = DB::select('select category_name from flatmates_category order By category_name');
		return View::make('utility.search.flatmatesSearch')->with('products',$products)->with('category',$category);

	}

	public function ajaxPaginateFlatmates(){

		$products = SellFlatmates::orderBy('id', 'DESC')->paginate(5);
		return View::make('utility.ajax.flatmates')->with('products',$products)->render();
	}

	public function getFlatmatesDetails($pid)
	{	
		$id = explode('~',$pid);
		$product = SellFlatmates::where('id','=',$id[1])->first();
		$user_id = SellFlatmates::where('id','=',$id[1])->pluck('user_id');
		$seller = User::where('id','=',$user_id)->first();
		$seller_profile = Profile::where('id','=',$user_id)->first();

		$college_id = Profile::where('id','=',$user_id)->pluck('college_id');
		$other_seller_profile = Profile::where('college_id','=',$college_id)->pluck('user_id');
		$other_flatmates = SellFlatmates::where('user_id','=',$other_seller_profile)->orderBy('id', 'DESC')->take(4)->get();


		return View::make('utility.details.flatmateDetails')->with('product',$product)->with('seller',$seller)->with('seller_profile',$seller_profile)->with('other_flatmates',$other_flatmates);

	}
}