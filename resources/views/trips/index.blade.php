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


@if(Auth::user()) 
    @php
        $user = Auth::user();
        $user_id = $user->id;
    @endphp
@else
    @php
    @endphp
@endif

{{dd($trip->joins())}}



<div class="container">
    
    <input type="hidden" name="trip_id" id="trip_id" value="{{$trip->id}}">

    <div class="row">
    
        <div class="col-md-2"></div>

        <div class="col-md-8">
            <div class="main">
                
                <div class="row">
                    <div id="crop-avatar">
                         <!-- Current cover img -->
                        @if($permission == 'owner')
                            <div class="avatar-view" title="Change the cover image">
                                <img src="{{asset(isset($trip->cover) ? $trip->cover : '')}}" height="98%" alt="Cover image ">
                            </div>
                            @include('includes.image-crop')

                        @else
                            <div class="avatar-view">
                                <img src="{{asset(isset($trip->cover) ? $trip->cover : '')}}" height="98%" alt="Cover image ">
                            </div>
                        @endif 
                        
                    </div>
                    {{-- end div crop cover image --}}
                </div>
                {{-- end row cover image --}}

                <div class="row">
                    {{var_dump($permission)}}

                    <div class="attend-group">
                       {{--  {{$users_request_waitting[0]->avatar}} --}}
                        @if($permission == 'owner')

                            <a href="javascript:;" class="style-btn">Manager member</a>
    
                            <a role="presentation" class="">
                                    <a href="javascript:;" class="style-btn dropdown-toggle info-number" data-toggle="dropdown">Request(<span class="">{{$count_status_waitting}}</span>)</a>
                                    
                                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                        @for ($i = 0; $i < $count_status_waitting; $i++)
                                            <li>
                                                <a>
                                                    <span class="image">
                                                        <img src="{{asset($users_request_waitting[$i]->avatar)}}" alt="Profile Image"/>
                                                    </span>
                                                    <span>
                                                        <span>{{$users_request_waitting[$i]->name}}</span>
                                                        <span class="time">3 mins ago</span>
                                                    </span>
                                                    <span class="message">
                                                      <button class="btn btn-success btn-xs">Accept</button>
                                                      <button class="btn btn-danger btn-xs">Cancel</button>
                                                    </span>
                                                </a>
                                            </li>
                                        @endfor
                                       
                                        <li>
                                            <div class="text-center">
                                                <a>
                                                  <strong>See All Alerts</strong>
                                                  <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </a>

                        @elseif($permission == 'joined')

                            <a href="javascript:;" class="style-btn exit-trip" title="click to exit trip">Exit trip</a>

                            <a href="javascript:;" class="style-btn" title="click to unfollow trip">Follow</a>

                        @elseif($permission == 'waitting')

                            <a href="javascript:;" class="style-btn cancel-watting-join-trip" title="click to cancel waitting join trip">Waiting Join</a>

                        @elseif($permission == 'user')

                            <a href="javascript:;" class="style-btn join-trip" title="click to join trip">Join trip</a>

                        @endif


                        <a href="javascript:;" class="style-btn">Member(<span>{{$count_join_trip}}</span>)</a>

                       {{--  <a href="javascript:;" class=""></a> --}}

                        
                        
                        Trip : <a href="javascript:;" class="" style="margin-right: 20px;">{{$trip->name}}</a>
                        Admin : <a href="javascript:;" class="">{{$user_name_owner}}</a>


                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2"></div>

    </div>

    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>
    <h1>xxx</h1>

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


