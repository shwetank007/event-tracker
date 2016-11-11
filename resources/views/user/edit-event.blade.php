<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Edit Event</h4>
</div>
{!!  Form::open(['url' => '','class'=>'form-horizontal' ,'autocomplete'=>'off','id'=>'edit-form']) 	 !!}
<div class="modal-body">
<div class="form-body">
    <div class="form-group">
        <label class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            <input type="text" name="title" class="form-control"  placeholder="Title" value="{{$data->title}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Start Date</label>
        <div class="col-sm-10">
            <input class="form-control date-picker" id="yo" name="start_date" size="16" type="text" placeholder="mm/dd/yyyy" value="{{$start}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">End Date</label>
        <div class="col-sm-10">
            <input class="form-control date-picker" name="end_date" size="16" type="text" placeholder="mm/dd/yyyy" value="{{$end}}">
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn red" onclick="deleteUser({{$data->id}});return false">Delete</button>
    <button type="button" class="btn green" onclick="addEditUser({{$data->id}});return false">Update</button>
    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
</div>
{!! Form::close() !!}

<script>

    $(".date-picker").datepicker({

        dateFormat: 'mm/dd/yyyy'

    });


</script>