<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Add Event</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#singleDay" data-toggle="tab"> Single Day </a>
            </li>
            <li>
                <a href="#multipleDay" data-toggle="tab"> Multiple Day </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="singleDay">
                {!!  Form::open(['url' => '','class'=>'form-horizontal' ,'autocomplete'=>'off','id'=>'add-form-single']) 	 !!}
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control"  placeholder="Title" value="">
                            <input type="hidden" name="formType" value="single">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Date</label>
                        <div class="col-sm-10">
                            <input class="form-control date-picker" name="start_date" size="16" type="text" placeholder="mm/dd/yyyy" value="{{$date}}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn green" onclick="addEditUser('add-form-single');return false">Submit</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="tab-pane fade" id="multipleDay">
                {!!  Form::open(['url' => '','class'=>'form-horizontal' ,'autocomplete'=>'off','id'=>'add-form-multiple']) 	 !!}
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control"  placeholder="Title" value="">
                            <input type="hidden" name="formType" value="multiple">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Start Date</label>
                        <div class="col-sm-10">
                            <input class="form-control date-picker" id="yo" name="start_date" size="16" type="text" placeholder="mm/dd/yyyy" value="{{$date}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">End Date</label>
                        <div class="col-sm-10">
                            <input class="form-control date-picker" name="end_date" size="16" type="text" placeholder="mm/dd/yyyy" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn green" onclick="addEditUser('add-form-multiple');return false">Submit</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script>

    $(".date-picker").datepicker({

        dateFormat: 'mm/dd/yyyy'

    });


</script>