@if (session('success'))
<script>
    $(document).ready(function($) {
        $.Toast("Wow!", "{{ session('success') }}", "success");
    });
</script>

@endif

@if (session('danger'))
<script>
    $(document).ready(function($) {
        $.Toast("Wow!", "{{ session('danger') }}", "error");
    });
</script>

@endif
