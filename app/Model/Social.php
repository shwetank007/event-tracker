<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Social extends Model {

    protected $fillable = [
        'user_id','social_id','social_service'
    ];

}
