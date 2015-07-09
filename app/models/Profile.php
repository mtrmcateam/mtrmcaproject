<?php

class Profile extends Eloquent
{
	protected $fillable = array('user_id','college_id','contact','city','user_type','active');
	protected $table = 'profiles';


	public function user()
    {
        return $this->belongs_to('User');
    }

    public function sell()
    {
        return $this->has_many('Sell');
    }
}