<?php

class DonateBooks extends Eloquent
{
	protected $table = 'donate_book';


	public function user()
    {
        return $this->belongsTo('User');
    }

    public function profile()
    {
        return $this->belongsTo('Profile','user_id');
    }
}