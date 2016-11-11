<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 4.5.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>Event Manager | Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
{!! HTML::style('https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all') !!}
{!! HTML::style('assets/global/plugins/font-awesome/css/font-awesome.min.css') !!}
{!! HTML::style('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') !!}
{!! HTML::style('assets/global/plugins/bootstrap/css/bootstrap.min.css') !!}
{!! HTML::style('assets/global/plugins/uniform/css/uniform.default.css') !!}
{!! HTML::style('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}
<!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
{!! HTML::style('assets/global/css/components-md.min.css') !!}
{!! HTML::style('assets/global/css/plugins-md.min.css') !!}
<!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
{!! HTML::style('assets/pages/css/login.min.css') !!}
<!-- END PAGE LEVEL STYLES -->
</head>
<!-- END HEAD -->

<body class="login">
<div class="menu-toggler sidebar-toggler"></div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="index.html"></a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form method="post" id="loginCheck" class="form-horizontal login-form ajax_form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h3 class="form-title font-green">Sign In</h3>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="E-mail" name="email" id="email"/>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" id="password" />
        </div>
        <div class="form-actions">
            <button type="submit"  class="btn green uppercase">Login</button>
            <label class="rememberme check">
                <input type="checkbox" name="remember" value="true" id="remember"/>Remember Me</label>
            <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
        </div>
        <div class="login-options">
            <h4>Or login with</h4>
            <ul class="social-icons">
                <li>
                    <a class="social-icon-color facebook" data-original-title="facebook" href="{{ route('social.login',['facebook']) }}"></a>
                </li>
                <li>
                    <a class="social-icon-color twitter" data-original-title="Twitter" href="{{ route('social.login',['twitter']) }}"></a>
                </li>
                <li>
                    <a class="social-icon-color googleplus" data-original-title="Goole Plus" href="{{ route('social.login',['google']) }}"></a>
                </li>
                <li>
                    <a class="social-icon-color linkedin" data-original-title="Linkedin" href="{{ route('social.login',['linkedin']) }}"></a>
                </li>
            </ul>
        </div>
        <div class="create-account">
            <p>
                <a href="javascript:;" id="register-btn" class="uppercase">Create an account</a>
            </p>
        </div>
    </form>
    <!-- END LOGIN FORM -->

</div>
<div class="copyright"> 2016 © Event Manager </div>
<!--[if lt IE 9]>
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
<!-- END CORE PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
{!! HTML::script('assets/global/scripts/app.min.js') !!}
<!-- END THEME GLOBAL SCRIPTS -->
<script>

</script>
</body>

</html>