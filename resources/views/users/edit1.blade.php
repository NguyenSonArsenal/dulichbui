@extends('layouts.master')

@section('libs_css')




<!-- FormValidation CSS file -->
<link rel="stylesheet" href="{{asset('vendors/formvalidation/css/formValidation.min.css')}}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.css">

@endsection

@section('style_css')
@endsection

@section('content')
<div class="container">

    {{-- {{dd($user)}} --}}

    @php
        $avatar = $user->avatar;
    @endphp




{{--     {!! Form::model($user, [ 'method'   =>  'PATCH' ,
                             'id'       =>  'registrationForm my-awesome-dropzone' , 
                             'class'    => 'form-horizontal dropzone' ,
                             'action'   =>  ['UserController@update', $user->id ] ,
                             'files'     => true
                            ]) !!}

        <div class="form-group">
            <div class="row">
                <label class="col-xs-3 control-label">Avatar</label>

                <div class="col-xs-3">
                    <img src="{{asset($avatar)}}" height="150px">
                     {!! Form::file('file', null, ['class'=>'form-control']) !!}
                </div> 
            </div>
        </div>

        <div>
            <span class="preview"><img data-dz-thumbnail /></span>
        </div>

        <div class="form-group">
            <div class="row">
                <label class="col-xs-3 control-label">Username</label>
               
                <div class="col-xs-5">
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <label class="col-xs-3 control-label">Email address</label>
               
                <div class="col-xs-5">
                    {!! Form::email('email', null, ['class'=>'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <label class="col-xs-3 control-label">Phone</label>
               
                <div class="col-xs-5">
                    {!! Form::text('phone', null, ['class'=>'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Gender</label>
            <div class="col-xs-5">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="gender" value="1" {{$user->gender == 1 ? 'checked' : '' }} /> Male 
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="gender" value="2" {{$user->gender == 2 ? 'checked' : '' }}/> Female
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="gender" value="3" {{$user->gender == 3 ? 'checked' : '' }}/> Other
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <label class="col-xs-3 control-label">Date of birthday</label>
               
                <div class="col-xs-5">
                    {!! Form::date('birthday', null, ['class'=>'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-9 col-xs-offset-3">
                {!! Form::submit('Update' , ['class' => 'btn btn-primary']) !!}
            </div>
        </div>

    {!! Form::close() !!} --}}
    
</div>

@endsection


@section('libs_js')

<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<script src="{{asset('vendors/formvalidation/js/formValidation.min.js')}}"></script>
<script src="{{asset('vendors/formvalidation/js/framework/bootstrap.min.js')}}"></script>

{{-- <script src="{{asset('js/dropzone/dropzone.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"></script>


{{-- <script src="{{asset('vendors/formvalidation/js/language/languagecode_COUNTRYCODE.js')}}"></script>
 --}}
@endsection



@section('script_js')
    <script type="text/javascript" src="{{asset('js/auth/register.js')}}"></script>
@endsection


