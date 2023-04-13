<iframe src="{{url('/').$preview_url }}"
        frameborder="0"
        marginheight="0"
        marginwidth="0"
        width="100%"
        height="100%"
        scrolling="auto"
        id="Iframe">
</iframe>

{{-- @push('scripts') --}}
    {{-- <script>

    $(document).ready(function() {

        $('#team').Activities();

        $('#team').on('change', function (e) {

            var data = $('#team').Activities("val");

            @this.set('team', data);

        });

    });

</script> --}}
{{-- @endpush --}}
