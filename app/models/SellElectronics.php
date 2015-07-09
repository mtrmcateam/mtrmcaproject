<?php

class SellElectronics extends Eloquent
{
	protected $table = 'sell_electronics';


	public function user()
    {
        return $this->belongsTo('User');
    }

    public function profile()
    {
        return $this->belongsTo('Profile','user_id');
    }
}