@extends('layouts.admin_dashboard')
@section('content')
<main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
  	@include('Admin.navbar')
  	<div class="main-content-container container-fluid px-4 pb-5">
	    <!-- Page Header -->
	    <div class="page-header row no-gutters py-4">
	      <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
	        <span class="text-uppercase page-subtitle">Edit Filter Category</span>
	      </div>
	    </div>
	    <!-- End Page Header -->
	    @if($filter)
		    <!-- Small Stats Blocks -->
		    <div class="row">
		    	<form style="width: 100%" method="post" id="edit_isp" action="{{url('/admin/editisp')}}">
		    		@csrf
			    	<div class="col-lg-12 col-md-12">
			    	  <!-- Add New Post Form -->
			    	  <div class="card card-small mb-3">
			    	    <div class="card-body">
			    	        <input class="form-control form-control-lg mb-3" type="text" placeholder="ISP Name" name="name" id="filter_category" required="" value="{{$isp->name}}">
		    	      	</div>
		    	      	<div class="ml-3 mb-3">
		    	      		<input type="hidden" id="isp_id" name="id" value="{{$isp->id}}"/>
			    			<button class="btn btn-accent" id="filteredit">
			    	            <i class="material-icons">file_copy</i>Save
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