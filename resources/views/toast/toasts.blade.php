@if(Session::has('success'))
<script>
toastr.success('{{Session::get("success")}}');
</script>
@endif
@if(Session::has('error'))
<script>
toastr.error('{{Session::get("error")}}');
</script>
@endif
@if(Session::has('warning'))
<script>
toastr.warning('{{Session::get("warning")}}');
</script>
@endif
@if(Session::has('info'))
<script>
toastr.info('{{Session::get("info")}}');
</script>
@endif

<!--Contenedor toast-->


@if(Session::has('warning_fijo'))
<script>
  var array=HtmltoJson('{{Session::get("warning_fijo")}}');
  $(document).ready(function(){
    $(document).Toasts('create', {
      class: 'bg-warning',
      title: array.title,
      subtitle: array.subtitle,
      body: array.body
    });
  });
</script>
@endif



