<script type="text/javascript">
    @if (session ('error'))
	    swal('Ops! Something went wrong.', '{{ session ('error') }}', 'warning');
    @endif
</script>