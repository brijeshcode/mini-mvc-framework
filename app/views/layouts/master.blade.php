@include('partials.head')
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @include('partials.error')
                    <div class="module">
                        <div class="module-head">
                                @yield('module-head')
                        </div>
                        <div class="module-body">
                             @if ($_SESSION['user']['type'] != 'Partner')
                                @yield('header-buttons')
                             @endif
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('partials.footer')
