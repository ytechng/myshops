@extends('layouts.frontLayout.front_design')
@section('title', 'Loging or Register')

@section('styles')
<link rel="stylesheet" href="/css/backend_css/multicheck.css">
<link href="/css/backend_css/dataTables.bootstrap4.css" rel="stylesheet">
@endsection

@section('content')

<div id="mainBody">
    <div class="container">
        <div class="row">
            <div class="span9">
                <ul class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
                    <li class="active">Login or Register</li>
                </ul>

                @if (Session::has('error_msg'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ session('error_msg') }}</strong>
                </div>
                @endif

                @if (Session::has('success_msg'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ session('success_msg') }}</strong>
                </div>
                @endif

                <h3> Login</h3>
                <hr class="soft" />

                <div class="row">
                    <div class="span4">
                        <div class="well">
                            <h5>ALREADY REGISTERED ?</h5>
                            <form>
                                <div class="control-group">
                                    <label class="control-label" for="inputEmail1">Email</label>
                                    <div class="controls">
                                        <input class="span3" type="text" id="inputEmail1" placeholder="Email">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputPassword1">Password</label>
                                    <div class="controls">
                                        <input type="password" class="span3" id="inputPassword1" placeholder="Password">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" class="btn">Sign in</button> <a
                                            href="forgetpass.html">Forget password?</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="span1"> &nbsp;</div>
                    <div class="span4">
                        <div class="well">
                            <h5>CREATE YOUR ACCOUNT</h5><br />
                            Enter your e-mail address to create an account.<br /><br /><br />
                            <form action="{{ url('/users/login-register') }}" method="post" id="frmRegister">
                                @csrf
                                <div class="control-group">
                                    <label class="control-label" for="r_email">E-mail address</label>
                                    <div class="controls">
                                        <input class="span3" type="text" id="r_email" name="r_email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="controls">
                                    <button type="submit" id="btnRegister" class="btn block">Create Your Account</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Sidebar ================================================== -->
            @include('layouts.frontLayout.front_sidebar')
            <!-- Sidebar end=============================================== -->

        </div>
    </div>
</div>
@endsection

@section('page_script')
<!-- Form Validation -->
<script src="/js/frontend_js/jquery.validate.min.js"></script>
<script src="/js/backend_js/additional-methods.js"></script>

<script>
    $(document).ready(function () {
        
        $('#frmRegister').validate({

            rules: {
                r_email: {
                    required: true,
                    remote: '/users/check-email',
                    minlength: 5,
                },
            },

            messages: {
                r_email: {
                    required: 'Please enter your email.',
                    minlength: 'Email must be 5 characters or more.',
                    remote: 'Email already exist',
                },
            },

            errorClass: "text-danger",
            errorElement: "label",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('text-danger');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('text-danger');
                $(element).parents('.control-group').addCss('color:red');
            }
        });
    });

</script>
@endsection