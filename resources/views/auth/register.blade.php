@extends('layouts.master')

@section('libs_css')




<!-- FormValidation CSS file -->
<link rel="stylesheet" href="{{asset('vendors/formvalidation/css/formValidation.min.css')}}">

@endsection

@section('style_css')
@endsection

@section('content')
<div class="container">
    
    <form id="registrationForm" class="form-horizontal" action="{{route('post.register')}}" method="POST">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label class="col-xs-3 control-label">Username</label>
            <div class="col-xs-5">
                <input type="text" class="form-control" name="name" placeholder="nguyenvanson" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Email address</label>
            <div class="col-xs-5">
                <input type="email" class="form-control" name="email" placeholder="vanson297.nguyen@gmail.com" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Password</label>
            <div class="col-xs-5">
                <input type="password" class="form-control" name="password" placeholder="son123456" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Phone</label>
            <div class="col-xs-5">
                <input type="text" class="form-control" name="phone" placeholder="0964047xxx" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Gender</label>
            <div class="col-xs-5">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="gender" value="1" /> Male 
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="gender" value="2" /> Female
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="gender" value="3" /> Other
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Date of birth</label>
            <div class="col-xs-5">
                <input type="date" class="form-control" name="birthday" placeholder="YYYY/MM/DD" />
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-9 col-xs-offset-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>


</div>
@endsection


@section('libs_js')

<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<script src="{{asset('vendors/formvalidation/js/formValidation.min.js')}}"></script>
<script src="{{asset('vendors/formvalidation/js/framework/bootstrap.min.js')}}"></script>

{{-- <script src="{{asset('vendors/formvalidation/js/language/languagecode_COUNTRYCODE.js')}}"></script>
 --}}
@endsection



@section('script_js')
    <script type="text/javascript" src="{{asset('js/auth/register.js')}}"></script>
@endsection


