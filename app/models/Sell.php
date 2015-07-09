<?php

class Sell extends Eloquent
{
	protected $table = 'sell_book';


	public function user()
    {
        return $this->belongsTo('User');
    }

    public function profile()
    {
        return $this->belongsTo('Profile','user_id');
    }
}