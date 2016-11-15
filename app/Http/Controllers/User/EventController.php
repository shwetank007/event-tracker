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
        $event = Event::select('id','title','start_date as start','end_date as end','allDay')
            ->where('user_id', Auth::guard('user')->id())
            ->get();
        $knowledge = json_encode($event);
        return View::make('user.event',['information'=>$knowledge,'client'=>$user]);

    }

    public function create(Request $request) {

        $format_start = Carbon::createFromFormat('Y-m-d', $request->data)
                            ->format('m/d/Y');

        return View::make('user.create-event',['date'=>$format_start]);

    }

    public function store(Request $request) {

        if($request->formType == 'single') {

            $validate = Validator::make(Input::all(),Event::rules('add-single'));

            if ($validate->fails()) {
                return Reply::formErrors($validate);
            }
            else {
                DB::beginTransaction();

                $event             = new Event();
                $event->user_id    = Auth::guard('user')->id();
                $event->title      = $request->get('title');
                $event->start_date = Carbon::createFromFormat('m/d/Y',$request->get('start_date'))
                                        ->toDateString();
                $event->end_date   = Carbon::createFromFormat('m/d/Y',$request->get('start_date'))
                                        ->toDateString();
                $event->save();

                DB::commit();

                $knowledge = ["id" => $event->id,"title"=>$event->title,"start"=>$event->start_date,"end"=>Carbon::createFromFormat('Y-m-d',$event->end_date)->addDay(),"allDay"=>$event->allDay];
                return Reply::success('Event Stored',['info'=>$knowledge]);
            }
        }
        else {

            $validate = Validator::make(Input::all(),Event::rules('add-multiple'));

            if ($validate->fails()) {
                return Reply::formErrors($validate);
            }
            else {
                DB::beginTransaction();

                $event             = new Event();
                $event->user_id    = Auth::guard('user')->id();
                $event->title      = $request->get('title');
                $event->start_date = Carbon::createFromFormat('m/d/Y',$request->get('start_date'))
                                        ->toDateString();
                $event->end_date   = Carbon::createFromFormat('m/d/Y',$request->get('end_date'))
                                        ->toDateString();
                $event->save();

                DB::commit();

                $knowledge = ["id" => $event->id,"title"=>$event->title,"start"=>$event->start_date,"end"=>Carbon::createFromFormat('Y-m-d',$event->end_date)->addDay(),"allDay"=>$event->allDay];
                //Explain me the need to send the same object again back with response.
                return Reply::success('Event Stored',['info'=>$knowledge]);
            }
        }
    }

    public function edit($id) {

        $event        = Event::select('id','title','start_date','end_date')
                            ->find($id);
        $format_start = Carbon::createFromFormat('Y-m-d',$event->start_date)
                            ->format('m/d/Y');
        $format_end   = Carbon::createFromFormat('Y-m-d',$event->end_date)
                            ->format('m/d/Y');
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
            $event->start_date  = Carbon::createFromFormat('m/d/Y',$request->get('start_date'))
                                    ->toDateString();
            $event->end_date    = Carbon::createFromFormat('m/d/Y',$request->get('end_date'))
                                    ->toDateString();
            $event->save();

            DB::commit();

            $knowledge = ["id" => $event->id,"title"=>$event->title,"start"=>$event->start_date,"end"=>Carbon::createFromFormat('Y-m-d',$event->end_date)->addDay(),"allDay"=>$event->allDay];
            return Reply::success('Event Updated',['info'=>$knowledge,'type'=>'update']);
        }

    }

    public function destroy($id) {

        Event::destroy($id);
        return Reply::success('Event Deleted');

    }
}
