<?php

class SellFlatmates extends Eloquent
{
	protected $table = 'sell_flatmates';


	public function user()
    {
        return $this->belongsTo('User');
    }

    public function profile()
    {
        return $this->belongsTo('Profile','user_id');
    }
}