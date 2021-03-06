@extends('layouts.admin_dashboard')
@section('content')
<main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
    @include('Admin.navbar')
    <div class="main-content-container container-fluid px-4 pb-5">
      <!-- Page Header -->
      <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
          <span class="text-uppercase page-subtitle">Filter list</span>
        </div>
      </div>
      <!-- End Page Header -->
      <!-- Default Light Table -->
        <div class="row">
          <div class="col">
            <div class="card card-small mb-4">
              <div class="card-header border-bottom">
                <h6 class="m-0">Filters List</h6>
              </div>
              <div class="card-body p-0 pb-3 text-center table-responsive">
                <table class="table mb-0">
                  <thead class="bg-light">
                    <tr>
                      <th scope="col" class="border-0">#</th>
                      <th scope="col" class="border-0">Filter name</th>
                      <th scope="col" class="border-0">Action</th>
                    </tr>
                  </thead>
                  <tbody> 
                    @if(!$filters->isEmpty())
                        @php
                            $i = 0;
                            if(isset($_GET['page']) && $_GET['page']>1){
                                $i =  ($_GET['page']-1)*$limit;
                            }
                        @endphp
                      @foreach($filters as $filter)  
                        <tr>
                          @php $i=$i+1; @endphp
                          <td>{{$i}}</td>
                          <td>{{$filter->filter_name}}</td>
                          <td>
                            <a href="{{url('/admin/editfilterCategory')}}/{{$filter->id}}"><i class="material-icons notranslate">edit</i></a>
                            <a href="javascript:void(0)" data-id="{{$filter->id}}" class="deleteFilter"><i class="material-icons notranslate">delete</i></a>
                          </td>
                        </tr>
                      @endforeach
                    @else
                        <tr>
                          <td colspan="3">
                            <h4 class="mb-0 mt-2">There are no filter categories.</h4>
                          </td>
                        </tr>
                    @endif
                  </tbody>
                </table>
              </div>
              {{$filters->links()}}
            </div>
          </div>
        </div>
        <!-- End Default Light Table -->
  </div>
  @include('Admin.footer')
</main>
@endsection
