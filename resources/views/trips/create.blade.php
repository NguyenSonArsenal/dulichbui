@extends('layouts.master')

@section('title', 'Create trip')


@section('libs_css')
	<link href="{{asset('vendors/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
	<link href="{{asset('vendors/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker-standalone.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('vendors/formvalidation/css/formValidation.min.css')}}">

@endsection


@section('style_css')
    <link href="{{asset('css/trips/create.css')}}" rel="stylesheet">
@endsection

@section('content')
	<div class="container_create_trip">

		<h1 class="text-center">This is page create trip</h1>
		
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="cover">
					<span>this is area to update cover for trip</span>
				</div>	
			</div>
		</div>

    
		<div class="row">
			<div class="col-md-8 col-md-offset-2  text-center">
				<div class="trip">
					<table class="table hover table-bordered tbl_trip">
						<thead>
						    <tr>
						      	<th class="text-center" >Id</th>
						      	<th class="text-center">Address</th>
						      	<th class="text-center">Time</th>
						      	<th class="text-center">Vehicle</th>
						      	<th class="text-center">Activities</th>
						      	<th colspan="2" class="text-center" >Note</th>
						    </tr>
						</thead>
						<tbody class="tbody"></tbody>
					</table>
				</div> 

				
			</div>
			
		</div>
		{{-- end row --}}

		<form id="registrationTripForm" class="form-horizontal" action="" method="POST">

        	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	        <div class="form-group">
	            <label class="col-xs-3 control-label">Trip: </label>
	            <div class="col-xs-5">
	                <input type="text" class="form-control" name="name" placeholder="du lich bui" />
	            </div>
	            <div class="show_error text-danger error_trip" style="margin-left: 188px;"></div>  
	        </div>

	        <div class="form-group">
				<label class="col-md-3 control-label ">Time-start-trip: </label>
	            <div class="col-md-5" >
	                <input type='text' class="form-control"  maxlength="16" id='datetimepicker-time-start-trip' name="time_start" placeholder="dd/mm/yyyy HH:mm" value="" />
	            </div>
	            <div class="show_error text-danger error_time_start" style="margin-left: 188px;"></div>  
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label ">Time-end-trip: </label>
	            <div class="col-md-5" >
	                <input type='text' class="form-control"  maxlength="16" id='datetimepicker-time-end-trip' name="time_end" placeholder="dd/mm/yyyy HH:mm" value="" />
	            </div>
	            <div class="show_error text-danger error_time_end" style="margin-left: 188px;"></div>               
			</div>

	        <div class="form-group">
	            <div class="col-md-5 col-md-offset-3">
	                <a type="" class="btn btn-success text-center btn-create-trip" style="float: right">Create trip</a>
	            </div>
	        </div>

	    </form>

	    @if(count($errors) > 0)
		    <div class="alert alert-danger">
		        <ul>
		            @ foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @ endforeach
		        </ul>
		    </div>
		@endif

		<div class="row" style="margin-top:20px;">
			<div class="col-md-8 col-md-offset-2">
				<input id="pac-input" class="controls form-control" type="text" placeholder="Please enter your address">
				<div id="googleMap"></div>
			</div>
		</div>
		{{-- end row --}}


	</div>
@endsection



@section('libs_js')
	

	{{-- Các thư viện cách nhau bằng dấu phẩy --}}
	<!-- Add Google API Key -->
  {{--   <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxENPta6TWWjNc7IJsuWGp9L1faK_Dm_8&callback=initMap&libraries=places"></script> --}}

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0xN7pJms2uXrJo13YLfgh7ReFTmXTwcU&callback=initMap&libraries=places"></script>

   {{--  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=places"></script> --}}
    
    <script type="text/javascript" src="{{asset('vendors/bootstrap-datetimepicker-master/js/moment.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('vendors/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js')}}"></script>

	<!-- FormValidation plugin and the class supports validating Bootstrap form -->
	<script src="{{asset('vendors/formvalidation/js/formValidation.min.js')}}"></script>
	<script src="{{asset('vendors/formvalidation/js/framework/bootstrap.min.js')}}"></script>

@endsection


@section('script_js')
    <script type="text/javascript" src="{{asset('js/trips/create.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/auth/register.js')}}"></script>
@endsection

<script type="text/javascript">

</script>

