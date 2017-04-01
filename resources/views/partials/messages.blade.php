@if(\Illuminate\Support\Facades\Session::has('message'))
    <p id="selector" class="alert alert-success">{{ \Illuminate\Support\Facades\Session::get('message') }}</p>
@endif

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
    $('#selector').slideDown(function() {
        setTimeout(function() {
            $('#selector').slideUp();
        }, 3000);
    });
</script>