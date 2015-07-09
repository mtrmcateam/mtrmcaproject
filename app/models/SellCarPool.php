<?php

class SellCarPool extends Eloquent
{
	protected $table = 'sell_carpool';


	public function user()
    {
        return $this->belongsTo('User');
    }

    public function profile()
    {
        return $this->belongsTo('Profile','user_id');
    }
}