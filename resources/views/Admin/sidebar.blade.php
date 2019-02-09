<!-- Main Sidebar -->
<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
  <div class="main-navbar">
    <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
      <a class="navbar-brand w-100 mr-0 py-0" href="{{url('/admin/dashboard')}}" style="line-height: 25px;">
        <div class="d-table m-auto">
          <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 50px;" src="{{URL::asset('/public/images/Logo.png')}}" alt="Shards Dashboard">
        </div>
      </a>
      <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
        <i class="material-icons">&#xE5C4;</i>
      </a>
    </nav>
  </div>
  <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
    <div class="input-group input-group-seamless ml-3">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="fas fa-search"></i>
        </div>
      </div>
      <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
  </form>
  <div class="nav-wrapper">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link active" href="{{url('/admin/dashboard')}}">
          <i class="material-icons">edit</i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
	      <a class="nav-link dropdown-toggle text-nowrap" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">
	        <i class="material-icons notranslate" >vertical_split</i>
	        <span class="d-md-inline-block">Link</span>
	      </a>
	      <div class="dropdown-menu dropdown-menu-small">
	        <a class="dropdown-item" href="{{url('/admin/createLink')}}">
	          <i class="material-icons notranslate">note_add</i>  Create link </a>
	        <a class="dropdown-item " href="{{url('/admin/linkList')}}">
	          <i class="material-icons notranslate">vertical_split</i>  Link list </a>
	      </div>
	    </li>
	    <li class="nav-item dropdown">
	      <a class="nav-link dropdown-toggle text-nowrap" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">
	        <i class="material-icons notranslate" >vertical_split</i>
	        <span class="d-md-inline-block">Filter</span>
	      </a>
	      <div class="dropdown-menu dropdown-menu-small">
	        <a class="dropdown-item" href="{{url('/admin/addfilterCategory')}}">
	          <i class="material-icons notranslate">note_add</i>  Add filter category </a>
	        <a class="dropdown-item " href="{{url('/admin/filterList')}}">
	          <i class="material-icons notranslate">vertical_split</i>  Filter category list </a>
	      </div>
	    </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-nowrap" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="material-icons notranslate" >vertical_split</i>
          <span class="d-md-inline-block">Domain</span>
        </a>
        <div class="dropdown-menu dropdown-menu-small">
          <a class="dropdown-item" href="{{url('/admin/adddomain')}}">
            <i class="material-icons notranslate">note_add</i>  Add Domain </a>
          <a class="dropdown-item " href="{{url('/admin/domainList')}}">
            <i class="material-icons notranslate">vertical_split</i>  Domain list </a>
        </div>
      </li>
    </ul>
  </div>
</aside>
<!-- End Main Sidebar -->