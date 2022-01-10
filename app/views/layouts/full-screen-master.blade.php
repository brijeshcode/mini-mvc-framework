@include('layouts.partials.header')

<div class="container bodydata">
  <div id="app">
    <notification message="foo bar"></notification>
    @yield('content')
  </div>
</div>



@include('layouts.partials.footer')
