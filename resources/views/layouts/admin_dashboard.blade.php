<!doctype html>
<html class="no-js h-100" lang="en">
  <head>
    <meta charset="utf-8">
    <!--===================================================================================-->  
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!--===================================================================================-->  
    <title>Dashboard</title>
    <!--===================================================================================-->  
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--===================================================================================-->  
    <meta name="description" content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
    <!--===================================================================================-->  
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--===================================================================================-->  
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!--===================================================================================-->  
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--===================================================================================-->  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--===================================================================================-->  
    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="{{URL::asset('/public/css/admin/shards-dashboards.1.1.0.min.css')}}">
    <!--===================================================================================-->  
    <link rel="stylesheet" href="{{URL::asset('/public/css/admin/extras.1.1.0.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/public/css/admin/dashboard.css')}}">
    <!--===================================================================================-->  
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!--===================================================================================-->  
    <link rel=”stylesheet” href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css'>
    <!--===================================================================================-->  
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
    <!--===================================================================================-->  

  </head>
  <body class="h-100">
    <div class="container-fluid">
      <div class="row">
        @include('Admin.sidebar')
        @yield('content')
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!--===================================================================================-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!--===================================================================================-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!--===================================================================================-->  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <!--===================================================================================-->
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
    <!--===================================================================================-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <!--===================================================================================-->
    <script src="{{URL::asset('/public/js/admin/extras.1.1.0.min.js')}}"></script>
    <!--===================================================================================-->
    <script src="{{URL::asset('/public/js/admin/shards-dashboards.1.1.0.min.js')}}"></script>
    <!--===================================================================================-->
    <script src="{{URL::asset('/public/js/admin/app-blog-overview.1.1.0.js')}}"></script>
    <!--===================================================================================-->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!--===================================================================================-->
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <!--===================================================================================-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--===================================================================================-->
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>

    <script type="text/javascript"> 
        $(document).ready(function(){
            $('#link_generater').on('submit',function(e){
                e.preventDefault();
                $('.loader').show();
                var affilate_link = $('#affilate_link').val();
                var merchent_link = $('#merchent_link').val();
                var filter_category = $('#filter_category').val();

                var ip = $('#ip').val();
                var isp = $('#isp').val();
                var browser = $('#browser').val();
                var os = $('#os').val();
                var devicetype = $('#devicetype').val();
                var country = $('#country').val();
                var domain = $('#domain').val();
                var name = $('#namelink').val();
                var iprange = $('#iprange').val();
                $.ajax({
                    type: "POST",
                    url: "{{url('/admin/createLink')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType:'json',
                    data: {
                        'affilate_link':affilate_link,
                        'merchent_link':merchent_link,
                        'ip':ip,
                        'isp':isp,
                        'browser':browser,
                        'os':os,
                        'devicetype':devicetype,
                        'country':country,
                        'domain':domain,
                        'name':name,
                        'iprange':iprange
                    },
                    success: function(result){
                        $('.loader').hide();
                        if(result.success){
                            $('#generated_link').val(result.url);
                            toastr.success(result.message, 'Create link', {timeOut: 5000});
                        }else{
                            toastr.error(result.message, 'Create link', {timeOut: 5000});
                        }
                    }
                });
            });

            $(document).on('click','.deleteLink',function(){
                var linkid = $(this).attr('data-id');
                var btn = $(this);
                swal({
                    buttons: {
                        cancel: true,
                        confirm: true,
                    },
                    title: "Delete Link",
                    text: "Are you want to delete this link?",
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "POST",
                            url: "{{url('/admin/deleteLink')}}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType:'json',
                            data: {
                                'id':linkid,
                            },
                            success: function(result){
                                if(result.success){
                                    toastr.success(result.message, 'Delete link', {timeOut: 5000});
                                    $(btn).closest('tr').remove();
                                }else{
                                    toastr.error(result.message, 'Delete link', {timeOut: 5000});
                                }
                            }
                        });
                    }
                });
            });
            $(document).on('click','.deleteFilter',function(){
                var filterid = $(this).attr('data-id');
                var btn = $(this);
                swal({
                    buttons: {
                        cancel: true,
                        confirm: true,
                    },
                    title: "Delete Filter",
                    text: "Are you want to delete this Filter category?",
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "POST",
                            url: "{{url('/admin/deleteFilter')}}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType:'json',
                            data: {
                                'id':filterid,
                            },
                            success: function(result){
                                if(result.success){
                                    toastr.success(result.message, 'Delete Filter', {timeOut: 5000});
                                    $(btn).closest('tr').remove();
                                }else{
                                    toastr.error(result.message, 'Delete Filter', {timeOut: 5000});
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click','.deleteDomain',function(){
                var domainid = $(this).attr('data-id');
                var btn = $(this);
                swal({
                    buttons: {
                        cancel: true,
                        confirm: true,
                    },
                    title: "Delete Domain",
                    text: "Are you want to delete this Domain?",
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "POST",
                            url: "{{url('/admin/deleteDomain')}}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType:'json',
                            data: {
                                'id':domainid,
                            },
                            success: function(result){
                                if(result.success){
                                    toastr.success(result.message, 'Delete Domain', {timeOut: 5000});
                                    $(btn).closest('tr').remove();
                                }else{
                                    toastr.error(result.message, 'Delete Domain', {timeOut: 5000});
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click','.deleteIsp',function(){
                var ispid = $(this).attr('data-id');
                var btn = $(this);
                swal({
                    buttons: {
                        cancel: true,
                        confirm: true,
                    },
                    title: "Delete ISP",
                    text: "Are you want to delete this ISP?",
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "POST",
                            url: "{{url('/admin/deleteIsp')}}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType:'json',
                            data: {
                                'id':ispid,
                            },
                            success: function(result){
                                if(result.success){
                                    toastr.success(result.message, 'Delete Domain', {timeOut: 5000});
                                    $(btn).closest('tr').remove();
                                }else{
                                    toastr.error(result.message, 'Delete Domain', {timeOut: 5000});
                                }
                            }
                        });
                    }
                });
            });

            $(".chosen-select").chosen({
              no_results_text: "Oops, nothing found!"
            })
        });
    </script>
    {!! Toastr::message() !!}
  </body>
</html>