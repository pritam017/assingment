@include('frontend.includes.header')
        <!-- quickview-modal -->
        <div id="quickview-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl"><div class="modal-content"></div></div>
        </div>
        <!-- quickview-modal / end --><!-- mobilemenu -->
        @include('frontend.includes.mobilemenu')
        <!-- mobilemenu / end --><!-- site -->
        <div class="site">
            <!-- mobile site__header -->
            @include('frontend.includes.mobilesiteheader')
            <!-- mobile site__header / end --><!-- desktop site__header -->
            @include('frontend.includes.desktopsiteheader')
            <!-- desktop site__header / end --><!-- site__body -->
          @yield('content')
            <!-- site__body / end --><!-- site__footer -->
@include('frontend.includes.footer')

