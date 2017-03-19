@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="standalone/selectize.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/selectize.default.css" />

<script>
	$('select').selectize(options);
</script>

<div class="container">
	<form class="form-horizontal">
		<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Title</label>
			<div class="col-sm-10">
				<input type="email" class="form-control" id="inputEmail3" placeholder="Title">
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Description</label>
			<div class="col-sm-10">
				<textarea class="form-control" rows="3" placeholder="Description"></textarea>
			</div>
		</div>

		

		

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">Submit</button>
			</div>
		</div>


	</form>
</div>
@endsection