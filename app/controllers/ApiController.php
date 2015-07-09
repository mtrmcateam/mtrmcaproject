<?php

class ApiController extends BaseController {

	public function getCollegeList()
	{
		$category = College::get();
		return Response::json($category);
	}
}
?>