<?php

namespace App\Http\Controllers\User;

use App\Classes\Reply;
use App\Http\Controllers\Controller;
use App\Model\Event;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class EventController extends Controller {

    public function index() {

        $user  = User::find(Auth::guard('user')->id());
        $event = Event::where('user_id', Auth::guard('user')->id()) // select only the required data.
            ->get();
        //region Remove this
        $info = "";
        foreach($event as $data) {
            $info.= ",{id:".'\''.$data->id.'\''.",title:".'\''.$data->title.'\''.",start:".'\''.$data->start_date.'\''.",end:".'\''.date('Y-m-d', strtotime($data->end_date . ' +1 day')).'\''.",allDay:true}";
        }
        $knowledge = substr($info,1);
        //endregion
        return View::make('user.event',['information'=>$knowledge,'client'=>$user]);

    }

    public function create(Request $request) {

        $format_start = date('m/d/Y', strtotime($request->data)); // use carbon
        return View::make('user.create-event',['date'=>$format_start]);

    }

    public function store(Request $request) {

        if($request->formType == 'single') {

            $validate = Validator::make(Input::all(),Event::rules('add-single',null));
            //You don't have to pass null try to find yourself your mistake.

            if ($validate->fails()) {
                return Reply::formErrors($validate);
            }
            else {
                DB::beginTransaction();

                $event             = new Event();
                $event->user_id    = Auth::guard('user')->id();
                $event->title      = $request->get('title');
                $event->start_date = Carbon::parse($request->get('start_date'))->format('Y-m-d'); // Carbon::createFromFormat
                $event->end_date   = Carbon::parse($request->get('start_date'))->format('Y-m-d'); // Carbon::createFromFormat
                $event->save();

                DB::commit();

                $knowledge = ["id" => $event->id,"title"=>$event->title,"start"=>$event->start_date,"end"=>date('Y-m-d', strtotime($event->end_date . ' +1 day')),"allDay"=>true]; // FIX ME: Use Carbon.
                //Explain me the need to send the same object again back with response.
                return Reply::success('Event Stored',['info'=>$knowledge]);
            }
        }
        else {

            $validate = Validator::make(Input::all(),Event::rules('add-multiple',null));
            //$validate = Validator::make(Input::all(),Event::rules('add-multiple'));

            if ($validate->fails()) {
                return Reply::formErrors($validate);
            }
            else {
                DB::beginTransaction();

                $event             = new Event();
                $event->user_id    = Auth::guard('user')->id();
                $event->title      = $request->get('title');
                $event->start_date = Carbon::parse($request->get('start_date'))->format('Y-m-d'); //Carbon::createFromFormat
                $event->end_date   = Carbon::parse($request->get('end_date'))->format('Y-m-d');     //Carbon::createFromFormat
                $event->save();

                DB::commit();

                $knowledge = ["id" => $event->id,"title"=>$event->title,"start"=>$event->start_date,"end"=>date('Y-m-d', strtotime($event->end_date . ' +1 day')),"allDay"=>true]; //Use Carbon
                //Explain me the need to send the same object again back with response.
                return Reply::success('Event Stored',['info'=>$knowledge]);
            }
        }
    }

    public function edit($id) {

        $event = Event::find($id); // select only the required data.
        $format_start = date('m/d/Y', strtotime($event->start_date)); //Use Carbon
        $format_end = date('m/d/Y', strtotime($event->end_date)); //Use Carbon

        return View::make('user.edit-event', ['data'=>$event,'start'=>$format_start,'end'=>$format_end]);
    }

    public function update(Request $request, $id) {

        $validate = Validator::make(Input::all(), Event::rules('edit',$id));
        if ($validate->fails()) {
            return Reply::formErrors($validate);
        }
        else {
            DB::beginTransaction();

            $event              = Event::find($id);
            $event->title       = $request->get('title');
            $event->start_date  = Carbon::parse($request->get('start_date'))->format('Y-m-d'); //Carbon::createFromFormat
            $event->end_date    = Carbon::parse($request->get('end_date'))->format('Y-m-d'); //Carbon::createFromFormat
            $event->save();

            DB::commit();

            $knowledge = ["id" => $event->id,"title"=>$event->title,"start"=>$event->start_date,"end"=>date('Y-m-d', strtotime($event->end_date . ' +1 day')),"allDay"=>true];
            return Reply::success('Event Updated',['info'=>$knowledge,'type'=>'update']);
        }

    }

    public function destroy($id) {

        Event::destroy($id);
        return Reply::success('Event Deleted');

    }
}
