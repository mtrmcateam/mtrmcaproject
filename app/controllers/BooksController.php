<?php

class BooksController extends BaseController {

	public function getBooksSearchResultAJAX()
	{
		$searchExplode[] = "";
		$searchQuery = Input::get('searchQuery');
		$searchExplode = explode(" ",rtrim($searchQuery," "));

		foreach($searchExplode as $value)
		  {
		  	$products = Sell::where('book_name','LIKE','%'.$value.'%')
							->orWhere('author_name','LIKE','%'.$value.'%')
							->orWhere('isbn','LIKE','%'.$value.'%')
							->orWhere('publisher','LIKE','%'.$value.'%')
							->orWhere('category','LIKE','%'.$value.'%')
							->orderBy('id', 'DESC')->paginate(5);
		  }
		 
		  	return View::make('utility.ajax.books')->with('products',$products)->render();
		

	}

	public function getBooksSearchQueryResult()
	{	$searchExplode[] = "";
		$searchQuery = Input::get('searchQuery');
		$searchExplode = explode(" ",rtrim($searchQuery," "));
		foreach($searchExplode as $value)
		  {
		  	$products = Sell::where('book_name','LIKE','%'.$value.'%')
							->orWhere('author_name','LIKE','%'.$value.'%')
							->orWhere('isbn','LIKE','%'.$value.'%')
							->orWhere('publisher','LIKE','%'.$value.'%')
							->orWhere('category','LIKE','%'.$value.'%')
							->orderBy('id', 'DESC')
							->paginate(5);
		  }
		
		$category = DB::select('select category_name from books_category');
		return View::make('utility.search.booksSearch')->with('products',$products)->with('category',$category);

	}

	public function getBooksKeywordSearchResult($key,$value)
	{

		$arr[0]="user_id";
		$products="";
		$seller_profile = Profile::where($key,'=',$value)->get();
		foreach($seller_profile as $p)
		{
			$products .= Sell::where('user_id','=',$p->user_id)->get();
			//return $p->user_id;
		}
		//$products = Sell::where('user_id','=',$seller_profile[1])->paginate(5);
		$category = DB::select('select category_name from books_category');
		return View::make('utility.search.booksSearch')->with('products',$products)->with('category',$category);

	}

	public function ajaxPaginateBooks(){

		$products = Sell::orderBy('id', 'DESC')->paginate(5);
		return View::make('utility.ajax.books')->with('products',$products)->render();
	}

	public function getBooksDetails($pid)
	{	
		$id = explode('~',$pid);
		$product = Sell::where('id','=',$id[1])->first();
		$user_id = Sell::where('id','=',$id[1])->pluck('user_id');
		$seller = User::where('id','=',$user_id)->first();
		$seller_profile = Profile::where('id','=',$user_id)->first();

		$college_id = Profile::where('id','=',$user_id)->pluck('college_id');
		$other_seller_profile = Profile::where('college_id','=',$college_id)->pluck('user_id');
		$other_books = Sell::where('user_id','=',$other_seller_profile)->orderBy('id', 'DESC')->take(4)->get();


		return View::make('utility.details.bookDetails')->with('product',$product)->with('seller',$seller)->with('seller_profile',$seller_profile)->with('other_books',$other_books);

	}

	public function getSellBooks()
	{	$category = Category::get();
		$user_id = Auth::user()->id;
		$active = Profile::where('user_id','=',$user_id)->pluck('active');
		$college_id = Profile::where('user_id','=',$user_id)->pluck('college_id');
		if($active == 1){
			return View::make('utility.sell.books')->with('category',$category)->with('college_id',$college_id);	
		}
		else{
			return Redirect::route('getManageProfile')->with('fail','Please update profile information to use our services.');
		}

	}

	public function postSell()
	{
		$validate = Validator::make(Input::all(), array(
			'book_name' => 'required',
			//'author_name' => 'required',
			//'book_edition' => 'required',
			//'print_year' => 'required',
			'book_condition' => 'required',
			//'isbn' => 'required',
			//'publisher' => 'required',
			//'category' => 'required',
			'mrp' => 'required',
			'selling_price' => 'required',
			//'book_description' => 'required',

		));

		if($validate ->fails())
		{
			return Redirect::route('getSellBooks')->withErrors($validate)->withInput();
		}
		else
		{	

			$ad_title = Input::get('book_name');
			$category_name = Input::get('category');

			$sell = new Sell();
			$sell->user_id = Auth::user()->id;
			$sell->book_name = Input::get('book_name');
			$sell->author_name = Input::get('author_name');
			$sell->book_edition = Input::get('book_edition');
			$sell->print_year = Input::get('print_year');
			$sell->book_condition = Input::get('book_condition');
			$sell->isbn = Input::get('isbn');
			$sell->publisher = Input::get('publisher');
			$sell->category = Input::get('category');
			$sell->mrp = Input::get('mrp');
			$sell->selling_price = Input::get('selling_price');
			$sell->book_description = Input::get('book_description');


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
				return Redirect::route('getSellBooks')->with('success','You have posted your book for selling succesfully.')->with('coupons',$coupons)->with('modal','#shareModal');
			}
			else
			{
				return Redirect::route('createMember')->with('fail','An error ocurred.');
			}
		}

	}


	public function getSendMessage(){

		return Redirect::route('getSearch')->with('fail','An error ocurred.');
	}

	public function postSendMessage()
	{
		$validate = Validator::make(Input::all(), array(
			'seller_id' => 'required',
			'product_id' => 'required',
			'message' => 'required',

		));

		if($validate ->fails())
		{
			return Redirect::route('getSendMessage')->withErrors($validate)->withInput();
		}
		else
		{
			$buyer_username = Auth::user()->username;
			$buyer_email = Auth::user()->email;
			$seller_id = Input::get('seller_id');
			$product_id = Input::get('product_id');
			$BuyerMessage = Input::get('message');

			$seller = User::where('id','=',$seller_id)->first();
			$product = Sell::where('id','=',$product_id)->first();

			Mail::send('emails.utility.message', array('BuyerMessage' => $BuyerMessage, 'username' => $buyer_username, 'product' => $product), function($message) use ($seller) {
					$message->to($seller->email, $seller->username)->subject('Buyer Message Notification');
				});
			return Redirect::route('getBooksSearchResult')->with('success','We have sent your message via email to inform seller.');
		}		

	}

	public function getDeleteBook($id,$user_id)
	{	
		$delete = Sell::where('id','=',$id)->where('user_id','=',$user_id)->delete();
		if($delete)
			return Redirect::back()->with('success','Book deleted sucessfully.');
		else{
			return Redirect::back()->with('fail','Sorry!! Book not deleted');
		}

	}

}