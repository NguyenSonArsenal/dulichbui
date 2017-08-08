@extends('layouts.master')

@section('libs_css')


<!-- FormValidation CSS file -->
<link rel="stylesheet" href="{{asset('vendors/formvalidation/css/formValidation.min.css')}}">

<link rel="stylesheet" href="{{asset('vendors/cropper/cropper.css')}}">
<link rel="stylesheet" href="{{asset('vendors/croppie/croppie.css')}}">

@endsection

@section('style_css')
   <link rel="stylesheet" href="{{asset('css/crop-image/crop-image.css')}}">
@endsection

@section('content')
<div class="container"  id="crop-avatar">

    @php
        $avatar = $user->avatar;
    @endphp

    <input type="hidden" name="id" id="id" value="{{$user->id}}">

    <!-- Current avatar -->
    <div class="avatar-view" title="Change the avatar">
        <img src="{{asset($avatar)}}" height="98%" alt="Avatar">
    </div>

    <div class="row">
    
        <div class="col-md-2">
            <div class="left">
                Left
            </div>
        </div>

        <div class="col-md-8">
            <div class="main">
                Main                
            </div>
        </div>

        <div class="col-md-2">
            <div class="right">
                Right
            </div>
        </div>

    </div>


    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <form class="avatar-form" action="" enctype="multipart/form-data" method="post">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <div id="upload-demo" style="width:300px"></div>
                                </div>
                                <div class="col-md-4" style="padding-top:30px;    padding-left: 60px;">
                                    <strong>Select Image:</strong>
                                    <br/>
                                    <input type="file" id="upload" value="">
                                    <br/>
                                    <button class="btn btn-success upload-result">Upload Image</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div><!-- /.modal -->

    <h1>XXX</h1>
    <h1>XXX</h1>
    <h1>XXX</h1>
    <h1>XXX</h1>
    <h1>XXX</h1>
    <h1>XXX</h1>
    <h1>XXX</h1>
    <h1>XXX</h1>
    <h1>XXX</h1>
    <h1>XXX</h1>
    <h1>XXX</h1>
    <h1>XXX</h1>
    <h1>XXX</h1>
    <h1>XXX</h1>
    <h1>XXX</h1>
    <h1>XXX</h1>
    <h1>XXX</h1>
    <h1>XXX</h1>
    <h1>XXX</h1>

</div>

@endsection


@section('libs_js')

<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<script type="text/javascript" src="{{asset('vendors/formvalidation/js/formValidation.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/formvalidation/js/framework/bootstrap.min.js')}}"></script>

<script type="text/javascript" src="{{asset('vendors/croppie/croppie.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/cropper/cropper.js')}}"></script>

@endsection

@section('script_js')
    <script type="text/javascript" src="{{asset('js/auth/register.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/users/index.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/crop-image/crop-image.js')}}"></script>
@endsection


