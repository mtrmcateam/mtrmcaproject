<?php

class UtilityController extends BaseController {

	public function getSell()
	{	
		return View::make('utility.sell');	
	}

	// wishlist
	public function getWishlist()
	{	
		if (isset($_COOKIE['wishlist'])) {
			$products = Sell::whereIn('id',array_flatten($_COOKIE['wishlist']))->paginate(5);
		    return View::make('utility.wishlist')->with('products',$products);
		}
		else{
			return Redirect::back()->with('fail','You have not added anything to your wishlist.');
		}
	}

	public function postWishlist($id)
	{	
		if (isset($_COOKIE['wishlist'])) {
		    for ($i = 0; $i < count($_COOKIE['wishlist']); $i++) {
		        if($_COOKIE['wishlist'][$i]==$id)
		        	return Redirect::back()->with('fail','You have already added to your wishlist.');
		    }
		}


		$count;
		if (isset($_COOKIE['wishlist'])) {
	    	$count = count($_COOKIE['wishlist']);
	    //	if($count!=1)
	    //		$count++;
		}
		else{
			$count = 0;
		}
		
		setcookie('wishlist['.$count.']', $id, time()+3600 , '/' );

		return Redirect::back()->with('success','Added to wishlist successfully');
	}

	public function getDonateBooks()
	{	$category = Category::get();
		$user_id = Auth::user()->id;
		$active = Profile::where('user_id','=',$user_id)->pluck('active');
		$college_id = Profile::where('user_id','=',$user_id)->pluck('college_id');
		if($active == 1){
			return View::make('utility.donate.donateBooks')->with('category',$category)->with('college_id',$college_id);	
		}
		else{
			return Redirect::route('getManageProfile')->with('fail','Please update profile information to use our services.');
		}

	}

	public function postDonateBooks()
	{
		$validate = Validator::make(Input::all(), array(
			'book_name' => 'required',
			//'author_name' => 'required',
			//'book_edition' => 'required',
			//'print_year' => 'required',
			//'book_condition' => 'required',
			//'isbn' => 'required',
			//'publisher' => 'required',
			//'category' => 'required',
			//'mrp' => 'required',
			//'selling_price' => 'required',
			//'book_description' => 'required',

		));

		if($validate ->fails())
		{
			return Redirect::route('getDonateBooks')->withErrors($validate)->withInput();
		}
		else
		{	

			$book_name = Input::get('book_name');
			$author_name = Input::get('author_name');
			$publisher = Input::get('publisher');

			$sell = new DonateBooks();
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
				Mail::queue('emails.utility.postSell', array('ad_title' => $book_name, 'category_name' => 'Book Donation'), function($message)
				{
				    $message->to(Auth::user()->email, Auth::user()->username)->subject('Book Posted For Donation Succesfully!!!');
				});
				return Redirect::route('getDonateBooks')->with('success','You have posted your book for donation succesfully, we will contact you soon.')->with('modal','#shareModal');
			}
			else
			{
				return Redirect::route('createMember')->with('fail','An error ocurred.');
			}
		}

	}

	public function getFeedback(){

		return View::make('info.feedback');

	}

	public function postFeedback(){

		$validate = Validator::make(Input::all(), array(
			'email' => 'required|max:50|email|min:4',
			'full_name' => 'required|min:3|max:20',
			'message' => 'required|min:6',
		));

		if($validate ->fails())
		{
			return Redirect::route('getFeedback')->withErrors($validate)->withInput();
		}
		else
		{
			$email = Input::get('email');
			$full_name = Input::get('full_name');
			$fmessage = Input::get('message'); 
			
			Mail::send('emails.feedback', array('email' => $email, 'name' => $full_name, 'fmessage' => $fmessage), function($message) {
					$message->to("support@mycollegeadda.com", "Feedback")->subject('Feedback');
				});

			return Redirect::route('getFeedback')->with('success','Feedback submitted successfully.');
			
		}

	}

	public function postAlert(){

		$validate = Validator::make(Input::all(), array(
			'email' => 'required|max:50|email|min:4',
			'name' => 'required|min:3|max:20',
			'message' => 'required|min:6',
		));

		if($validate ->fails())
		{
			return Redirect::route('home')->withErrors($validate)->withInput();
		}
		else
		{
			$college_id = Input::get('college_id');
			$email = Input::get('email');
			$name = Input::get('name');
			$fmessage = Input::get('message'); 
			
			Mail::send('emails.feedback', array('email' => $email, 'name' => $name, 'fmessage' => $fmessage), function($message) {
					$message->to("support@mycollegeadda.com", "Alert")->subject('Alert');
				});

			return Redirect::route('getFeedback')->with('success','Feedback submitted successfully.');
			
		}

	}

	public function getCollege()
	{	
		$college = Input::get('college_name');
		$college_name = College::where('name','LIKE','%'.$college.'%')->pluck('name');
		if(count($college_name))
		return View::make('utility.college')->with('college_name',$college_name);
		else{
			$college_name="College Not Found!!";
			return View::make('utility.college')->with('college_name',$college_name);
		}
	}

	public function getDiscountCoupon()
	{	
		$count=0;
		$user_id = Auth::user()->id;
		$count += Sell::where('user_id','=',$user_id)->count();
		$count += SellNotes::where('user_id','=',$user_id)->count();
		$count += SellElectronics::where('user_id','=',$user_id)->count();
		$count += SellFlatmates::where('user_id','=',$user_id)->count();
		$count += SellCarPool::where('user_id','=',$user_id)->count();
		return View::make('discount-coupan')->with('count',$count);
	}
}