{{-- @extends('layouts.app') --}}

@extends('layouts.master')

@section('style_css')
    <link href="{{asset('css/index.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="container">

        @if(Auth::user()) 
            @php
                $user       = Auth::user();
                $user_id    = $user->id;
                $avatar     = $user->avatar;
            @endphp
            <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
            <input type="hidden" name="avatar" id="avatar" value="{{$user->avatar}}">
            <input type="hidden" name="username" id="username" value="{{$user->name}}">
        @else
            @php
                $avatar = 'images/avatar/default-avatar.png';
            @endphp
        @endif

    @if(isset($user_id))
        <div class="row">
            <div class="col-md-offset-2">
                <a href="{{route('trips.create')}}">
                    <button class="btn-create-trip btn btn-success col-md-9">Create new trip</button>
                </a>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-2">
            <div class="left">
                
            </div>
        </div>
        <div class="col-md-8">
            <div class="main">
                @foreach($listTrip as $trip)
                    
                    <div class="trip" id="trip_{{$trip->id}}">
                        <div class="title">
                            <div class="avatar-owner">
                                <img src="{{$trip->user->avatar}}" height="50px">
                            </div>
                            <div class="infor-trip">
                                <a href="{{route('users.show', $trip->user->id)}}" class="name-trip">{{$trip->user->name}}</a>
                                <span>-></span>
                                <a href="{{route('trips.show',$trip->id)}}" class="name-trip">{{$trip->name}}</a>
                                <p>10 minutes ago</p>
                            </div>
                        </div>
                        
                        <div class="content">
                            <span>{{$trip->content}}</span>
                        </div>
                        
                        <div class="cover">
                            <img src="{{$trip->cover}}" width="100%" title="name_image">
                        </div>
                        
                        @if(isset($user))
                            <div class="action" style="margin-bottom: 15px">
                                <a href="javascript:;" class="link-like">Like</a>
                                <a class="link-show-comment" title="click to comments">Comments</a>
                            </div>
                        @endif

                        <div class="comments_{{$trip->id}} comments" style="display: none;">

                            <tag class='comment_area_{{$trip->id}}'>

                                @foreach($trip->comments as $comment)

                                    <div class="content-cmt comment_id_{{$comment->id}}">
                                        
                                        @if($comment->parent_cmt_id == 0)
                                            <div class="avatar-owner">
                                                <img src="{{$comment->user->avatar}}" height="34px">
                                            </div>

                                            {{-- Don't delete this line. It make us find comment_id to reply --}}
                                            <input type="hidden" name="comment_id" value="{{$comment->id}}">

                                            <div class="input-group form_{{$comment->id}}" id="{{$comment->id}}">
                                                <span class="username-cmt">{{$comment->user->name}}</span>
                                                <span>{{$comment->content}}</span>
                                                <div class="action action-reply">
                                                    <a href="javascript:;" class="link-like">Like</a>
                                                    <a href="javascript:;" class="link-show-form-sub-comment">Reply</a>
                                                    @if(isset($user) && $user->id == $comment->user_id)
                                                        <a href="javascript:;" class="link_delete_comment">Delete</a>
                                                    @endif
                                                </div>
                                            </div>

                                            <tag class='sub_comment_area_{{$comment->id}}'>

                                                @foreach($sub_comments[$comment->id] as $sub_comment)
                                                    <div class="content-sub-comment sub_comment_id_{{$sub_comment->id}}">
                                                        <div class="avatar-owner">
                                                            <img src="{{$sub_comment->user->avatar}}" height="34px">
                                                        </div>

                                                        <div class="input-group sub-comment form_{{$comment->id}}">
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

                                        @endif

                                        {{-- form input sub comment --}}
                                        <form class="form-comment-reply form-comment-reply-{{$comment->id}} comment_reply_{{$comment->id}}" id="id_form_comment_reply_{{$trip->id}}" >
                                            <div class="avatar-owner">
                                                <img src="{{$avatar}}" height="34px">
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control text_sub_comment" placeholder="Comment here" name="content">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button">
                                                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </form>
                                        

                                    </div>
                                @endforeach
                            </tag>

                            
                            {{-- form input parent comment --}}
                            <form class="form-comment form_{{$trip->id}}" id="form_{{$trip->id}}">
                                <div class="avatar-owner">
                                    <img src="{{$avatar}}" height="34px">
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

                        </div>
                        {{-- end comment_area_ --}}

                    </div>
                    {{-- end a trip --}}
                @endforeach
            
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>

</div>
@endsection

@section('script_js')
        <script type="text/javascript" src="{{asset('js/index.js')}}"></script>
@endsection



