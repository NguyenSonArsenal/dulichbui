@extends('layouts.master')

@section('title','trip')

@section('libs_css')


<link rel="stylesheet" href="{{asset('vendors/cropper/cropper.css')}}">
<link rel="stylesheet" href="{{asset('vendors/croppie/croppie.css')}}">

@endsection

@section('style_css')
   <link rel="stylesheet" href="{{asset('css/crop-image/crop-image.css')}}">
   <link rel="stylesheet" href="{{asset('css/trips/index.css')}}">
   <link rel="stylesheet" href="{{asset('css/comment.css')}}">
@endsection

@section('content')


@if(Auth::user()) 
    @php
        $user = Auth::user();
        $user_id = $user->id;
        $avatar = $user->avatar;
        //dd($avatar);
    @endphp
@else
    @php
    @endphp
@endif

{{-- {{dd($parent_comments)}} --}}

{{-- {{dd($trip->id)}} --}}

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
                
                {{-- Row control  --}}
                <div class="row">
                    {{var_dump($permission)}}

                    <div class="attend-group">
                       {{--  {{$users_request_waitting[0]->avatar}} --}}
                        @if($permission == 'owner')

                            <a href="javascript:;" class="style-btn">Manager member</a>
    
                            <a role="presentation" class="">
                                <a href="javascript:;" class="style-btn dropdown info-number" data-toggle="dropdown">Request(<span class="">{{$count_status_waitting}}</span>)</a>
                                
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                    @for ($i = 0; $i < $count_status_waitting; $i++)
                                        <li class="li-request-cancel-accept">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <img class="img" width="50%" src="{{asset($users_request_waitting[$i]->avatar)}}" alt="Profile Image" data-user="{{$users_request_waitting[$i]->id}}"/>
                                                </div>
                                                <div class="col-md-2">
                                                    <div><a href="javascript:;">{{$users_request_waitting[$i]->name}}</a></div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="btn-accept-cancel">
                                                        <button class="btn btn-success btn-xs btn-accept" title="click to ACCEPT user join for trip">Accept</button>
                                                        <button class="btn btn-danger btn-xs btn-cancel" title="click to CANCEL  user join for trip">Cancel</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <span class="time">3 mins ago</span>
                                                </div>
                                            </div>
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
                            <p style="margin-bottom: 15px;">You joined this trip</p>
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
                        Admin : <a href="{{route('users.show', $trip->user->id)}}" class="">{{$user_name_owner}}</a>
                    </div>
                </div>
                {{-- end row control --}}
                
                {{-- row detail plan for trip --}}
                <div class="row"></div>
                {{-- end row detail plan for trip --}}

                {{-- row map for trip --}}
                <div class="row"></div>
                {{-- end row map plan for trip --}}

                {{-- row comment for trip --}}
                <div class="row">
                    <div class="area-comment">

                        <div class="action" style="margin-bottom: 15px">
                            <a class="link-show-comment" title="click to comments">Comments (<span>{{$parent_comments->count()}}</span>)</a>
                        </div>

                        <div class="detail-comment">
                            <tag class='comment_area' data-trip = {{$trip->id}}>
                                
                                @foreach($parent_comments as $parent_comment)
                                    <div class="content-cmt">

                                        <div class="avatar-owner">
                                            <img src="{{asset($parent_comment->user->avatar)}}" height="34px">
                                        </div>

                                        {{-- Don't delete this line. It make us find comment_id to reply --}}
                                        <input type="hidden" name="comment_id" value="{{$parent_comment->id}}">

                                        <div class="input-group form_{{$parent_comment->id}}" id="{{$parent_comment->id}}">

                                            <span class="username-cmt">{{$parent_comment->user->name}}</span>

                                            <span>{{$parent_comment->content}}</span>

                                            <div class="action action-reply">
                                                <a href="javascript:;" class="link-like">Like</a>
                                                <a href="javascript:;" class="link-show-form-sub-comment">Reply</a>
                                                @if(isset($user) && $user->id == $parent_comment->user_id)
                                                    <a href="javascript:;" class="link_delete_comment">Delete</a>
                                                @endif
                                            </div>
                                        </div>

                                        <tag class='sub_comment_area_{{$parent_comment->id}}'>
                                            @foreach($sub_comments[$parent_comment->id] as $sub_comment)
                                                <div class="content-sub-comment sub_comment_id_{{$sub_comment->id}}">
                                                    <div class="avatar-owner">
                                                        <img src="{{asset($sub_comment->user->avatar)}}" height="34px">
                                                    </div>

                                                    <div class="input-group sub-comment form_{{$parent_comment->id}}">
                                                        <span class="username-cmt">{{$sub_comment->user->name}}</span>
                                                        <span>{{$sub_comment->content}}</span>
                                                        <div class="action action-reply">
                                                            <a href="javascript:;" class="link-like">Like</a>
                                                            <a href="javascript:;" class="link-show-form-sub-comment">Reply</a>
                                                            @if(isset($user) && $user->id == $sub_comment->user_id)
                                                                <a href="javascript:;" class="link_delete_sub_comment sub_comment_id_{{$sub_comment->id}}">Delete</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tag>
                                        
                                    </div>
                                @endforeach
                                
                            </tag>

                            {{-- form input parent comment --}}
                            @if($permission == 'joined' || $permission == 'owner')
                                <form class="form-comment" id="form_{{$trip->id}}" data-form = "{{$trip->id}}">
                                    <div class="avatar-owner">
                                        <img src="{{asset($avatar)}}" height="34px">
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="form-control text_comment" placeholder="Comment here" name="content">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button">
                                                <i class="fa fa-picture-o" aria-hidden="true"></i>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
                {{-- end comment plan for trip --}}

            </div>
        </div>

        <div class="col-md-2"></div>

    </div>
    {{-- end row --}}

</div>

@endsection


@section('libs_js')

<script type="text/javascript" src="{{asset('vendors/croppie/croppie.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/cropper/cropper.js')}}"></script>

@endsection



@section('script_js')
    <script type="text/javascript" src="{{asset('js/trips/index.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/comment.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/crop-image/crop-image.js')}}"></script>
@endsection


