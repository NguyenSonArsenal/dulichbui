@extends('layouts.master')

@section('title','trip')

@section('libs_css')


<link rel="stylesheet" href="{{asset('vendors/cropper/cropper.css')}}">
<link rel="stylesheet" href="{{asset('vendors/croppie/croppie.css')}}">

@endsection

@section('style_css')
   <link rel="stylesheet" href="{{asset('css/crop-image/crop-image.css')}}">
   <link rel="stylesheet" href="{{asset('css/trips/index.css')}}">
@endsection

@section('content')
<div class="container"  id="crop-avatar">

    <div class="row">
    
        <div class="col-md-2"></div>

        <div class="col-md-8">
            <div class="main">

                <!-- Current cover img -->
                <div class="avatar-view" title="Change the cover image">
                    <img src="" height="98%" alt="Cover image ">
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


            </div>
        </div>

        <div class="col-md-2"></div>

    </div>

</div>

@endsection


@section('libs_js')

<script type="text/javascript" src="{{asset('vendors/croppie/croppie.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/cropper/cropper.js')}}"></script>

@endsection



@section('script_js')
    <script type="text/javascript" src="{{asset('js/trips/index.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/crop-image/crop-image.js')}}"></script>
@endsection


