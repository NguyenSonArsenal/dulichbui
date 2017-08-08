@if(Auth::user()) 
    @php
        $user = Auth::user();
        $avatar = $user->avatar;
    @endphp
    
    <input type="hidden" name="user_id"  id="user_id"  value="{{$user->id}}">
    <input type="hidden" name="avatar"   id="avatar"   value="{{$user->avatar}}">
    <input type="hidden" name="username" id="username" value="{{$user->name}}"> 
@else
    @php
        $avatar = 'images/avatar/default-avatar.png';
    @endphp
@endif