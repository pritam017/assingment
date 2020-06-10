<!DOCTYPE html>
<html lang="en">
  <head>
 @include('backend.include.header')
 @include('backend.include.css')

  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    @include('backend.include.menu')
    <!-- ########## END: LEFT PANEL ########## -->
    <!-- ########## START: HEAD PANEL ########## -->
    @include('backend.include.topbar')
    <!-- ########## END: HEAD PANEL ########## -->
    <!-- ########## START: RIGHT PANEL ########## -->
    @include('backend.include.message')
       <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="container">
        @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
           {{session()->get('success')}}
        </div>
        @endif
    </div>
    @yield('dashboard-content')
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
        <li class="list-group-item text-danger">{{$error}}</li>
            @endforeach

        </ul>
    </div>
    @endif
      @include('backend.include.footer')
    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
    @include('backend.include.script')

  </body>
</html>
