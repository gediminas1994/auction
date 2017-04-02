@extends('layouts.app')

@section('content')

	{{--<script>
        $('#select-state').selectize({
            maxItems: 3
        });
	</script>--}}

<div class="container">
	<form class="form-horizontal">

		<div class="form-group">
			<label for="email" class="col-sm-2 control-label">Title</label>
			<div class="col-sm-10">
				<input type="email" class="form-control" id="email" placeholder="Title">
			</div>
		</div>

		<div class="form-group">
			<label for="description" class="col-sm-2 control-label">Description</label>
			<div class="col-sm-10">
				<textarea class="form-control" rows="3" id="description" placeholder="Description"></textarea>
			</div>
		</div>

		<div class="form-group">
			<label for="type" class="col-sm-2 control-label">Type</label>
			<div class="col-sm-10">
				<select class="form-control" id="type">
					@foreach($categories as $category)
						<optgroup label="{{$category->title}}">
							@foreach($subcategories as $subcategory)
								@if($subcategory->parent == $category->id)
									<option>{{ $subcategory->title }}</option>
								@endif
							@endforeach
						</optgroup>
					@endforeach
				</select>
			</div>
		</div>


















		{{--<div class="form-group">
			<select id="select-state">
				<option value="volvo">Volvo</option>
				<option value="saab">Saab</option>
				<option value="mercedes">Mercedes</option>
				<option value="audi">Audi</option>
			</select>
		</div>--}}

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">Submit</button>
			</div>
		</div>

	</form>
</div>
@endsection