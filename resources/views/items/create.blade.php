@extends('layouts.app')

@section('content')


<div class="container">
	<form enctype="multipart/form-data" action="{{route('items.store')}}" id="createItem" class="form-horizontal" method="POST" >
		{{csrf_field()}}

		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">Title</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ old('title') }}">
			</div>
		</div>

		<div class="form-group">
			<label for="type" class="col-sm-2 control-label">Type</label>
			<div class="col-sm-8">
				<select class="form-control" id="type" name="type">
					<option value="0" {{ (old('type') == 0 ? 'selected' : '') }}>Auction</option>
					<option value="1" {{ (old('type') == 1 ? 'selected' : '') }}>Regular Item</option>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label for="description" class="col-sm-2 control-label">Description</label>
			<div class="col-sm-8">
				<textarea class="form-control" rows="5" id="description" name="description" placeholder="Description">{{ old('description') }}</textarea>
			</div>
		</div>


		<div class="form-group">
			<label for="tags" class="col-sm-2 control-label">Tags</label>
			<div class="col-sm-8">
				<select multiple id="tags" name="tags[]" data-placeholder="Select tags ( Maximum is 3 )">
					@foreach($categories as $category)
                        <option selected></option>
						<optgroup label="{{$category->title}}">
							@foreach($subcategories as $subcategory)
								@if($subcategory->parent == $category->id)
									<option value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
								@endif
							@endforeach
						</optgroup>
					@endforeach
				</select>
			</div>
		</div>


        <div class="form-group">
            <label for="datetimepicker1" class="col-sm-2 control-label">Expiration date</label>
            <div class="col-sm-8">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" name="expirationDate"/>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
            </div>
        </div>


		<div class="form-group">
			<label for="quantity" class="col-sm-2 control-label">Quantity</label>
			<div class="col-sm-8">
				<input type="number" class="form-control" id="quantity" name="quantity">
			</div>
		</div>

		<div class="form-group">
			<label for="startingBid" class="col-sm-2 control-label">Starting Bid</label>
			<div class="col-sm-8">
				<input type="number" step="0.01" class="form-control" id="startingBid" name="startingBid">
			</div>
		</div>

		<div class="form-group">
			<label for="file" class="col-sm-2 control-label">Upload a picture</label>
			<div class="col-sm-8">
				<div class="fileinput fileinput-new" data-provides="fileinput">
					<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
						<img src="/items/default-thumbnail.jpg" alt="Image">
					</div>
					<div class="fileinput-preview fileinput-exists thumbnail"
						 style="max-width: 200px; max-height: 150px;"></div>
					<div>
					<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="picture"></span>
						<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-8">
				<button type="submit" class="btn btn-default">Submit</button>
			</div>
		</div>

	</form>
	@include('partials.errors')
	@include('partials.messages')
</div>

@endsection