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
		    	    <!--div class="card-body">
		    	        <input class="form-control form-control-lg mb-3" type="url" placeholder="Affilate Link" name="affilate_link" id="affilate_link" required="">
		    	        <input class="form-control form-control-lg mb-3" type="url" placeholder="Merchent Link" name="merchent_link" id="merchent_link" required="">
		    	        <select id="filter_category" data-placeholder="Begin typing a name to filter..." name="filters" class="chosen-select form-control form-control-lg mb-3" multiple >
		    	          @if(!$filters->isEmpty())
		    	          	@foreach($filters as $filter)
		    	          		<option value="{{$filter->id}}">{{$filter->filter_name}}</option>
		    	          	@endforeach
		    	          @endif
		    	        </select>
		    	        <input class="form-control form-control-lg mb-3" type="url" placeholder="Your link will appear here.." id="generated_link">
                        
	    	      	</div-->
	    	      	<div class="form-group">
                            <label for="password" class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation" data-validation="length" data-validation-length="min6">
                            </div>
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