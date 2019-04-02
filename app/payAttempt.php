<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payAttempt extends Model
{

	protected $fillable = [
        'mount', 'description', 'request_id','process_url','status','reason','user_id','franchise','bank'
    ];

  public function user()
  {
  	return $this->belongsTo('App\User');
  }
}
