<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    public static function rules($action ,$id=null) {

        $rules = [
            'add-single' => [
                'title'      => 'required|unique:events|alpha',
                'start_date' => 'required|date|after:yesterday'
            ],
            'add-multiple' => [
                'title'      => 'required|unique:events|alpha',
                'start_date' => 'required|date|after:yesterday',
                'end_date'   => 'required|date|after:start_date'
            ],
            'edit' => [
                'title'      => 'required|alpha|unique:events,title,'.$id,
                'start_date' => 'required|date|after:yesterday',
                'end_date'   => 'required|date|after:today'
            ]
        ];

       return $rules[$action];

    }

}
