@extends('layouts.master')

@section('title', 'Create trip')

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
			<div class="col-sm-6">
				<div class="trip">
					<table class="table hover table-bordered tbl_trip">
						<thead>
						    <tr>
						      	<th class="text-center">Address</th>
						      	<th class="text-center">Time</th>
						      	<th class="text-center">Vehicle</th>
						      	<th class="text-center">Activities</th>
						      	<th colspan="2" class="text-center">Note</th>
						    </tr>
						</thead>
						<tbody class="tbody">
							<tr>
							    <td class="text-center">A</th>
							    <td class="text-center">1 hour</td>
							    <td class="text-center">Oto</td>
							    <td class="text-center">Check in, eating</td>
							    <td class="text-center"><a href="javascript:;">Cancel</a></td>
							   {{--  <td class="text-center"><a href="javascript:;">Add</a></td> --}}
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			{{-- <div class="col-sm-2">
				<div class="search">
					<form>
						<input type="text" name="place_start" class="form-control">
					</form>
				</div>
			</div> --}}
			
			<div class="col-sm-6">
				<input id="pac-input" class="controls form-control" type="text" placeholder="Please enter your address">
				<div id="googleMap">
				</div>
			</div>
		</div>


	</div>
@endsection



@section('libs_js')
	

	{{-- Các thư viện cách nhau bằng dấu phẩy --}}
	<!-- Add Google API Key -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdEAmYzVK-OVPqWH_jgfff4wljNHu-14s&callback=initMap&libraries=places"></script>

   {{--  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=places"></script> --}}
    

@endsection


@section('script_js')
    <script type="text/javascript" src="{{asset('js/trips/create.js')}}"></script>
@endsection

