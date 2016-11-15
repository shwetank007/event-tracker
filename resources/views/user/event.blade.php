<!DOCTYPE html>
<html>
<head>
    <title>Calendar</title>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
{!! HTML::style('https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all') !!}
{!! HTML::style('assets/global/plugins/font-awesome/css/font-awesome.min.css') !!}
{!! HTML::style('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') !!}
{!! HTML::style('assets/global/plugins/bootstrap/css/bootstrap.min.css') !!}
{!! HTML::style('assets/global/plugins/uniform/css/uniform.default.css') !!}
{!! HTML::style('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}
{!! HTML::style('assets/plugins/froiden-helper/helper.css') !!}
<!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
{!! HTML::style('assets/global/css/components-md.min.css') !!}
{!! HTML::style('assets/global/css/plugins-md.min.css') !!}
<!-- END THEME GLOBAL STYLES -->
    <!--BEGIN CUSTOM STYLES-->
{!! HTML::style('assets/global/plugins/fullcalendar/fullcalendar.css') !!}
{!! HTML::style('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') !!}
{!! HTML::style('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
{!! HTML::style('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') !!}
{!! HTML::style('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') !!}
<!--END CUSTOM STYLES-->
    <!--BEGIN USER CSS-->
{!! HTML::style('css/style.css') !!}
    <!--END USER CSS-->
</head>
<body>
<!--Begin Navigation Bar-->
<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><h4>Event Manager</h4></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="{{$client->profile_picture}}" class="image"><span class="distance">{{$client->name}}</span><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><img src="{{$client->profile_picture}}" class="large-image"></a></li>
                        <li><h4 class="show-text">{{$client->name}}</h4></li>
                        <li><h5>{{$client->email}}</h5></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('user.logout') }}">Sign Out</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!--End Navigation Bar-->
<!--Begin Content-->
<div id="calendar"></div>
<!--End Content-->

<!--Begin Add Modals-->
<div id="addModal" class="modal fade modal-scroll" tabindex="-1" data-replace="true">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>
<!--End Add Modals-->

<!--Begin Edit Modals-->
<div id="editModal" class="modal fade modal-scroll" tabindex="-1" data-replace="true">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>
<!--End Edit Modals-->

<!--[if lt IE 9]-->
{!! HTML::script('assets/global/plugins/respond.min.js') !!}
{!! HTML::script('assets/global/plugins/excanvas.min.js') !!}
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
{!! HTML::script('assets/global/plugins/jquery.min.js') !!}
{!! HTML::script('assets/global/plugins/bootstrap/js/bootstrap.min.js') !!}
{!! HTML::script('assets/global/plugins/js.cookie.min.js') !!}
{!! HTML::script('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') !!}
{!! HTML::script('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}
{!! HTML::script('assets/global/plugins/jquery.blockui.min.js') !!}
{!! HTML::script('assets/global/plugins/uniform/jquery.uniform.min.js') !!}
{!! HTML::script('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
{!! HTML::script('assets/plugins/froiden-helper/helper.js') !!}
<!-- END CORE PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
{!! HTML::script('assets/global/scripts/app.min.js') !!}
<!-- END THEME GLOBAL SCRIPTS -->
<!--BEGIN PAGE PLUGIN-->
{!! HTML::script('assets/global/plugins/jquery-ui/jquery-ui.min.js') !!}
{!! HTML::script('assets/global/plugins/moment.min.js') !!}
{!! HTML::script('assets/global/plugins/fullcalendar/fullcalendar.js') !!}
{!! HTML::script('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') !!}
{!! HTML::script('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
{!! HTML::script('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') !!}
{!! HTML::script('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') !!}
<!--END PAGE PLUGIN-->
<script type="text/javascript">

    $(document).ready(function() {

        var calendar = $('#calendar').fullCalendar({
            header:
            {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultView: 'month',
            selectable: true,
            selectHelper: true,

            eventClick: function(event)
            {
                editModal(event.id);
            },

            dayClick: function(date)
            {

                var moment = $.fullCalendar.moment();
                moment.stripTime();
                if(date.format() >= moment.format()) {
                    addModal(date.format());
                }
            },

            events:{!! $information !!}

        });
    });

    function addModal(date) {

        var url = "{{route('user.event.create', 'data=value')}}";
        url = url.replace('value', date);
        $.ajaxModal('#addModal', url);

    }

    function editModal(id) {

        var url = "{{route('user.event.edit',':id')}}";
        url =  url.replace(':id',id);
        $.ajaxModal('#editModal',url);

    }

    function addEditUser(id) {

        var method = '';
        var container = '';
        if(!isNaN(id)) {

            var url = "{{route('user.event.update',':id')}}";
            url = url.replace(':id',id);
             method = 'PUT';
             container = "#edit-form";

        }
        else {

            url = "{{ route('user.event.store') }}";
             method     = 'POST';
             container  = "#"+id;

        }

        $.easyAjax({
            type: method,
            url: url,
            data: $(container).serialize(),
            container: container,
            success: function(response) {
                if (response.status == "success") {

                    $('#addModal').modal('hide');
                    $('#editModal').modal('hide');

                    if(response.type == "update") {
                        $('#calendar').fullCalendar("removeEvents",id);
                    }

                    $('#calendar').fullCalendar("renderEvent",response.info);
                }
            }
        });
    }

    function deleteUser(id) {

        var url = "{{route('user.event.destroy',':id')}}";
        url = url.replace(':id',id);
        var token = "{{ csrf_token() }}";
        $.easyAjax({
            type: 'DELETE',
            url: url,
            data: {'_token': token},
            success: function(response) {
                if (response.status == "success") {
                    $('#editModal').modal('hide');
                    $('#calendar').fullCalendar("removeEvents",id);
                }
            }
        });
    }
</script>
</body>
</html>