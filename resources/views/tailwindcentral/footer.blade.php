
        <!-- Lightbox2 css1 js1  -->
        <script src="{{ asset('assets/libs/fancybox/fancybox.umd.js') }}" type="text/javascript"></script>

        <script src="{{ asset('/js/jquery.min.js') }}"></script>

        <script type="text/javascript">
            Fancybox.bind("[data-fancybox]", {
            // Your custom options
            });
        </script>
        @yield('scripts')

    </body>
</html>
