<?php

class ElectronicsController extends BaseController {

	public function getSellElectronics()
	{	
		$category = DB::select('select category_name from electronics_category');
		$user_id = Auth::user()->id;
		$active = Profile::where('user_id','=',$user_id)->pluck('active');
		$college_id = Profile::where('user_id','=',$user_id)->pluck('college_id');
		if($active == 1){
			return View::make('utility.sell.electronics')->with('category',$category)->with('college_id',$college_id);	
		}
		else{
			return Redirect::route('getManageProfile')->with('fail','Please update profile information to use our services.');
		}

	}

	public function postSellElectronics()
	{
		$validate = Validator::make(Input::all(), array(
			'ad_title' => 'required',
			'selling_price' => 'required',
			'ad_description' => 'required',

		));

		if($validate ->fails())
		{
			return Redirect::route('getSellElectronics')->withErrors($validate)->withInput();
		}
		else
		{	

			$ad_title = Input::get('ad_title');
			$category_name = Input::get('category');

			$sell = new SellElectronics();
			$sell->user_id = Auth::user()->id;
			$sell->ad_title = Input::get('ad_title');
			$sell->brand_name = Input::get('brand_name');
			$sell->model_no = Input::get('model_no');
			$sell->item_condition = Input::get('item_condition');
			$sell->category = Input::get('category');
			$sell->selling_price = Input::get('selling_price');
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
				return Redirect::route('getSellElectronics')->with('success','You have posted your ad succesfully.')->with('coupons',$coupons)->with('modal','#shareModal');
			}
			else
			{
				return Redirect::back()->with('fail','An error ocurred.');
			}
		}

	}

	public function getElectronicsSearchResultAJAX()
	{
		$searchExplode[] = "";
		$searchQuery = Input::get('searchQuery');
		$searchExplode = explode(" ",rtrim($searchQuery," "));

		foreach($searchExplode as $value)
		  {
		  	$products = SellElectronics::where('ad_title','LIKE','%'.$value.'%')
							->orWhere('brand_name','LIKE','%'.$value.'%')
							->orWhere('model_no','LIKE','%'.$value.'%')
							->orWhere('category','LIKE','%'.$value.'%')
							->orderBy('id', 'DESC')
							->paginate(5);
		  }
		  	return View::make('utility.ajax.electronics')->with('products',$products)->render();

		

	}

	public function getElectronicsSearchQueryResult()
	{	$searchExplode[] = "";
		$searchQuery = Input::get('searchQuery');
		$searchExplode = explode(" ",rtrim($searchQuery," "));
		foreach($searchExplode as $value)
		  {
		  	$products = SellElectronics::where('ad_title','LIKE','%'.$value.'%')
							->orWhere('brand_name','LIKE','%'.$value.'%')
							->orWhere('model_no','LIKE','%'.$value.'%')
							->orWhere('category','LIKE','%'.$value.'%')
							->orderBy('id', 'DESC')
							->paginate(5);
		  }

		$category = DB::select('select category_name from electronics_category order By category_name');

		return View::make('utility.search.electronicsSearch')->with('products',$products)->with('category',$category);

	}

	public function getElectronicsKeywordSearchResult($key,$value)
	{


		$seller_profile = Profile::where($key,'=',$value)->pluck('user_id');
		$products = SellElectronics::where('user_id','=',$seller_profile)->paginate(5);
		
		$category = DB::select('select category_name from electronics_category order By category_name');		
		return View::make('utility.search.electronicsSearch')->with('products',$products)->with('category',$category);

	}

	public function ajaxPaginateElectronics(){

		$products = SellElectronics::orderBy('id', 'DESC')->paginate(5);
		return View::make('utility.ajax.electronics')->with('products',$products)->render();
	}

	public function getElectronicsDetails($pid)
	{	
		$id = explode('~',$pid);
		$product = SellElectronics::where('id','=',$id[1])->first();
		$user_id = SellElectronics::where('id','=',$id[1])->pluck('user_id');
		$seller = User::where('id','=',$user_id)->first();
		$seller_profile = Profile::where('id','=',$user_id)->first();

		$college_id = Profile::where('id','=',$user_id)->pluck('college_id');
		$other_seller_profile = Profile::where('college_id','=',$college_id)->pluck('user_id');
		$other_electronics = SellElectronics::where('user_id','=',$other_seller_profile)->orderBy('id', 'DESC')->take(4)->get();


		return View::make('utility.details.electronicDetails')->with('product',$product)->with('seller',$seller)->with('seller_profile',$seller_profile)->with('other_electronics',$other_electronics);

	}
}