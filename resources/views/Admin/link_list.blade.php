@extends('layouts.admin_dashboard')
@section('content')
<main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
  	@include('Admin.navbar')
  	<div class="main-content-container container-fluid px-4 pb-5">
	    <!-- Page Header -->
	    <div class="page-header row no-gutters py-4">
	      <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
	        <span class="text-uppercase page-subtitle">Link list</span>
	      </div>
	    </div>
	    <!-- End Page Header -->
	    <!-- Default Light Table -->
        <div class="row">
          <div class="col">
            <div class="card card-small mb-4">
              <div class="card-header border-bottom">
                <h6 class="m-0">Links</h6>
              </div>
              <div class="card-body p-0 pb-3 text-center table-responsive">
                <table class="table mb-0">
                  <thead class="bg-light">
                    <tr>
                      <th scope="col" class="border-0">#</th>
                      <th scope="col" class="border-0">Affilate link</th>
                      <th scope="col" class="border-0">Merchent link</th>
                      <th scope="col" class="border-0">Click Count</th>
                      <th scope="col" class="border-0">Unique Count</th>
                      <th scope="col" class="border-0">Redirect Link</th>
                      <th scope="col" class="border-0" style="min-width: 100px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@if(!empty($createlinks))
                        @php
                            $i = 1;
                            if(isset($_GET['page']) && $_GET['page']>1){
                                $i =  $_GET['page']*$limit - 2;
                            }
                        @endphp
	                  	@foreach($createlinks as $links)
		                    <tr>
		                      <td>{{$i}}</td>
		                      <td class="text-left">
                            <a target="_blank" href="{{$links->affilate_link}}">{{$links->affilate_link}}</a>
                          </td>
		                      <td class="text-left">
                            <a target="_blank" href="{{$links->affilate_link}}">{{$links->merchent_link}}</a>
                          </td>
                          <td>{{$links->click_count}}</td>
		                      <td>{{$links->uniqueCount}}</td>
		                      <td>
                            <a target="_blank" href="{{$links->domain}}/index.php/admin/go/{{$links->id}}">{{$links->domain}}/index.php/admin/go/{{$links->id}}</a>
                          </td>
		                      <td>
		                      	<a target="_blank" href="{{$links->domain}}/index.php/{{$links->id}}"><i class="material-icons notranslate">visibility</i></a>
		                      	<a href="{{url('/admin/editLink')}}/{{$links->id}}"><i class="material-icons notranslate">edit</i></a>
		                      	<a href="javascript:void(0)" data-id="{{$links->id}}" class="deleteLink"><i class="material-icons notranslate">delete</i></a>
		                      </td>
		                    </tr>
                        @php $i++; @endphp

	                    @endforeach
                    @else
                    <tr>
                    	<td colspan="6">
                    		<h4 class="mb-0 mt-2">There are no links.</h4>
                    	</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
                {{ $createlinks->links() }}
              </div>
            </div>
          </div>
        </div>
        <!-- End Default Light Table -->
	</div>
	@include('Admin.footer')
</main>
@endsection
