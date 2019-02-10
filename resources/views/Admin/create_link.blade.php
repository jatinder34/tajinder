@extends('layouts.admin_dashboard')
@section('content')
<main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
  	@include('Admin.navbar')
  	<div class="main-content-container container-fluid px-4 pb-5">
	    <!-- Page Header -->
	    <div class="page-header row no-gutters py-4">
	      <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
	        <span class="text-uppercase page-subtitle">Create link</span>
	      </div>
	    </div>
	    <!-- End Page Header -->
	    <!-- Small Stats Blocks -->
	    <div class="row">
	    	<form style="width: 100%" method="post" id="link_generater">
		    	<div class="col-lg-12 col-md-12">
		    	  <!-- Add New Post Form -->
		    	  <div class="card card-small mb-3">
		    	    <div class="card-body">
		    	    	<input class="form-control form-control-lg mb-3" type="text" placeholder="Name" name="name" id="namelink" required>
		    	        <input class="form-control form-control-lg mb-3" type="url" placeholder="Affilate Link" name="affilate_link" id="affilate_link" required="">
		    	        <input class="form-control form-control-lg mb-3" type="url" placeholder="Merchent Link" name="merchent_link" id="merchent_link" required="">
		    	        
		    	        <div class="card-body">Filters</div>
		    	    	<div class="card-body">
		    	    		<label for="male">IP</label>
		    	    		<select class="form-control form-control-lg mb-3" id="ip" name="ip">
							  <option selected value="0">No</option>
							  <option value="1">Yes</option>
							</select>
		    	    	</div>
		    	    	<div class="card-body">
		    	    		<label for="male">ISP</label>
		    	    		<select id="filter_category" data-placeholder="Begin typing a name to ISP..." name="isp" class="chosen-select form-control form-control-lg mb-3" >
			    	            @if(!$isp->isEmpty())
			    	          	    @foreach($isp as $ispp)
			    	          			<option value="{{$ispp->name}}">{{$ispp->name}}</option>
			    	          		@endforeach
			    	          	@endif
		    	        	</select>
		    	    	</div>
		    	    	<!--div class="card-body">
		    	    		<label for="male">ISP</label>
		    	    		<select class="form-control form-control-lg mb-3" id="isp" name="isp">
							  <option value="">Select ISP</option>
							  <option value="airtel">Airtel</option>
							  <option value="vodafone">Vodafone</option>
							  <option value="idea">Idea Cellular</option>
							  <option value="reliance">Reliance Communications</option>
							  <option value="bsnl">BSNL</option>
							  <option value="aircel">Aircel</option>
							  <option value="tata">Tata Teleservices</option>
							  <option value="mtnl">MTNL</option>
							  <option value="videocon">Videocon</option>
							  <option value="connect">Connect</option>
							</select>
		    	    	</div-->
		    	    	<div class="card-body">
		    	    		<label for="male">Browser</label>
		    	    		<select class="form-control form-control-lg mb-3" id="browser" name="browser">
		    	    		  <option value="">Select Browser</option>
		    	    		  <option value="safari">Safari</option>
							  <option value="chrome">chrome</option>
							  <option value="mozilla">Mozilla</option>
							</select>
		    	    	</div>
		    	    	<div class="card-body">
		    	    		<label for="male">OS</label>
		    	    		<select class="form-control form-control-lg mb-3" id="os" name="os">
		    	    		  <option value="">Select OS</option>
							  <option value="window">Window</option>
							  <option value="mac">Mac</option>
							  <option value="ubuntu">Ubuntu</option>
							</select>
		    	    	</div>
		    	    	<div class="card-body">
		    	    		<label for="male">Device Type</label>
		    	    		<select class="form-control form-control-lg mb-3" id="devicetype" name="devicetype">
		    	    		  <option value="">Select Device Type</option>
							  <option value="iphone">iphone</option>
							  <option value="android">android</option>
							  <option value="desktop">Web</option>
							</select>
		    	    	</div>
		    	    	<div class="card-body">
		    	    		<label for="male">Countries</label>
		    	    		<select class="form-control form-control-lg mb-3" id="country" name="country">
		    	    			<option value="">Select Country</option>
							    @foreach($countries as $country)
		    	          			<option value="{{$country->country_name}}">{{$country->country_name}}</option>
		    	          		@endforeach
							</select>
		    	    	</div>
		    	    	<select class="form-control form-control-lg mb-3" required id="domain" name="domain">
		    	    			<option value="">Select Domain</option>
							@foreach($domain as $dom)
		    	          		<option value="{{$dom->name}}">{{$dom->name}}</option>
		    	          	@endforeach
						</select>
		    	        <input class="form-control form-control-lg mb-3" disabled type="url" placeholder="Your link will appear here.." id="generated_link">
	    	      	</div>
	    	      	<div class="ml-3 mb-3">
		    			<button class="btn btn-accent" id="generate_link">
		    	            <i class="material-icons">file_copy</i> Create link
		    	            <span class="loader" style="display: none;" >
		    	            	<i class="fa fa-spinner fa-spin"></i>
		    	            </span>
		    	        </button>
	    	        </div>
		    	  </div>
		    	  <!-- / Add New Post Form -->
		    	</div>
		    </form>
    	</div>
    </div>
  	@include('Admin.footer')
</main>
@endsection
