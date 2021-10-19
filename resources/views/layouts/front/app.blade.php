@include('layouts.front.header')
    @livewireStyles
    @yield('style')
@yield('content')   @livewireScripts
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
@include('layouts.front.footer')
