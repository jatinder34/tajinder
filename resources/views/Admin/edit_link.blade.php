@extends('layouts.admin_dashboard')
@section('content')
<main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
  	@include('Admin.navbar')
  	<div class="main-content-container container-fluid px-4 pb-5">
	    <!-- Page Header -->
	    <div class="page-header row no-gutters py-4">
	      <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
	        <span class="text-uppercase page-subtitle">Edit link</span>
	      </div>
	    </div>
	    <!-- End Page Header -->
	    @if($editdata)
	    <!-- Small Stats Blocks -->
	    <div class="row">
	    	<form style="width: 100%" action="{{url('/admin/editLink')}}" method="post" id="link_edit">
	    		@csrf
		    	<div class="col-lg-12 col-md-12">
		    	  <!-- Add New Post Form -->
		    	  <div class="card card-small mb-3">
		    	    <div class="card-body">
		    	        <input class="form-control form-control-lg mb-3" type="url" placeholder="Affilate Link" name="affilate_link" id="affilate_link" required="" value="{{$editdata->affilate_link}}">
		    	        <input class="form-control form-control-lg mb-3" type="url" placeholder="Merchent Link" name="merchent_link" id="merchent_link" required="" value="{{$editdata->merchent_link}}">

		    	        <div class="card-body">Filters</div>
		    	    	<div class="card-body">
		    	    		<label for="male">IP</label>
		    	    		<select class="form-control form-control-lg mb-3" id="ip" name="ip">
		    	    		  <?php if($linkfilterType1){ $sel1="selected";$sel=""; }else{ $sel="selected";$sel1="selected";} ?> 
							  <option {{$sel}} value="0">No</option>
							  <option {{$sel1}} value="1">Yes</option>
							</select>
		    	    	</div>
		    	    	<div class="card-body">
		    	    		<label for="male">ISP</label>
		    	    		<select class="form-control form-control-lg mb-3" id="isp" name="isp">
		    	    		<?php if($linkfilterType2){  ?>
								  <option <?php if($linkfilterType2->parameters=""){echo 'selected';} ?> value="">Select ISP</option>
								  <option <?php if($linkfilterType2->parameters="airtel"){echo 'selected';} ?> value="airtel">Airtel</option>
								  <option <?php if($linkfilterType2->parameters="vodafone"){echo 'selected';} ?> value="vodafone">Vodafone</option>
								  <option <?php if($linkfilterType2->parameters="idea"){echo 'selected';} ?> value="idea">Idea Cellular</option>
								  <option <?php if($linkfilterType2->parameters="reliance"){echo 'selected';} ?> value="reliance">Reliance Communications</option>
								  <option <?php if($linkfilterType2->parameters="bsnl"){echo 'selected';} ?> value="bsnl">BSNL</option>
								  <option <?php if($linkfilterType2->parameters="aircel"){echo 'selected';} ?> value="aircel">Aircel</option>
								  <option <?php if($linkfilterType2->parameters="tata"){echo 'selected';} ?> value="tata">Tata Teleservices</option>
								  <option <?php if($linkfilterType2->parameters="mtnl"){echo 'selected';} ?> value="mtnl">MTNL</option>
								  <option <?php if($linkfilterType2->parameters="videocon"){echo 'selected';} ?> value="videocon">Videocon</option>
								  <option <?php if($linkfilterType2->parameters="connect"){echo 'selected';} ?> value="connect">Connect</option>
							<?php }else{ ?>
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
							<?php } ?>
							</select>
		    	    	</div>
		    	    	<div class="card-body">
		    	    		<label for="male">Browser</label>
		    	    		<select class="form-control form-control-lg mb-3" id="browser" name="browser">
		    	    			<?php if($linkfilterType3){  ?>
			    	    		  	<option <?php if($linkfilterType3->parameters=""){echo 'selected';} ?> value="">Select Browser</option>
			    	    		  	<option <?php if($linkfilterType3->parameters="safari"){echo 'selected';} ?> value="safari">Safari</option>
								  	<option <?php if($linkfilterType3->parameters="chrome"){echo 'selected';} ?> value="chrome">chrome</option>
								  	<option <?php if($linkfilterType3->parameters="mozilla"){echo 'selected';} ?> value="mozilla">Mozilla</option>
								<?php }else{ ?>
									<option value="">Select Browser</option>
			    	    		  	<option value="safari">Safari</option>
								  	<option value="chrome">chrome</option>
								  	<option value="mozilla">Mozilla</option>
								<?php } ?>
							</select>
		    	    	</div>
		    	    	<div class="card-body">
		    	    		<label for="male">OS</label>
		    	    		<select class="form-control form-control-lg mb-3" id="os" name="os">
		    	    		    <?php if($linkfilterType4){  ?>
			    	    		  <option <?php if($linkfilterType4->parameters=""){echo 'selected';} ?> value="">Select OS</option>
								  <option <?php if($linkfilterType4->parameters="window"){echo 'selected';} ?> value="window">Window</option>
								  <option <?php if($linkfilterType4->parameters="mac"){echo 'selected';} ?> value="mac">Mac</option>
								  <option <?php if($linkfilterType4->parameters="ubuntu"){echo 'selected';} ?> value="ubuntu">Ubuntu</option>
								<?php }else{ ?>
								  <option value="">Select OS</option>
								  <option value="window">Window</option>
								  <option value="mac">Mac</option>
								  <option value="ubuntu">Ubuntu</option>
								<?php } ?>
							</select>
		    	    	</div>
		    	    	<div class="card-body">
		    	    		<label for="male">Device Type</label>
		    	    		<select class="form-control form-control-lg mb-3" id="devicetype" name="devicetype">
		    	    		<?php if($linkfilterType5){  ?>
		    	    		  <option <?php if($linkfilterType5->parameters=""){echo 'selected';} ?> value="">Select Device Type</option>
							  <option <?php if($linkfilterType5->parameters="iOS"){echo 'selected';} ?> value="iOS">iOS</option>
							  <option <?php if($linkfilterType5->parameters="Android"){echo 'selected';} ?> value="Android">Android</option>
							  <option <?php if($linkfilterType5->parameters="desktop"){echo 'selected';} ?> value="desktop">Desktop</option>
							</select>
							<?php }else{ ?>
							  <option value="">Select Device Type</option>
							  <option value="iOS">iOS</option>
							  <option value="Android">Android</option>
							  <option value="desktop">Desktop</option>
							<?php } ?>
		    	    	</div>
		    	    	<div class="card-body">
		    	    		<label for="male">Countries</label>
		    	    		<select class="form-control form-control-lg mb-3" id="country" name="country">
							    <?php if($linkfilterType6){  ?>
									<option <?php if($linkfilterType6->parameters=""){ echo 'selected';} ?> value="">Select Country</option>
								<?php }else{ ?>
									<option value="">Select Country</option>
								<?php } ?>
							    @foreach($countries as $country)
							    	<?php if($linkfilterType6){  ?>
		    	          				<option <?php if($linkfilterType6->parameters=$country->country_name){ echo 'selected';} ?> value="{{$country->country_name}}">{{$country->country_name}}</option>
		    	          			<?php }else{ ?>
		    	          				<option value="{{$country->country_name}}">{{$country->country_name}}</option>
		    	          			<?php } ?>
		    	          		@endforeach
							</select>
		    	    	</div>
		    	    	<select class="form-control form-control-lg mb-3" required id="domain" name="domain">
		    	    		<option value="">Select Domain</option>
							@foreach($domain as $dom)
		    	          		<option value="{{$dom->name}}">{{$dom->name}}</option>
		    	          	@endforeach
						</select>
		    	        <input class="form-control form-control-lg mb-3" type="url" placeholder="Your link will appear here.." id="generated_link" value="{{url('/admin/go')}}/{{$editdata->id}}">
                        <input type="hidden" name="id" value="{{$editdata->id}}">
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
    	@endif
    </div>
  	@include('Admin.footer')
</main>
@endsection