<?php

class SellNotes extends Eloquent
{
	protected $table = 'sell_notes';


	public function user()
    {
        return $this->belongsTo('User');
    }

    public function profile()
    {
        return $this->belongsTo('Profile','user_id');
    }
}