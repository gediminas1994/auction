@extends('layouts.app')

@section('content')

    @include('partials.errors')
    @include('partials.messages')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-info" href="{{ url('/home') }}">Back</a>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#categoryModal"> + Add new category</button>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            @foreach($categories as $category)
                                <li style="font-size: 25px">
                                    <a href="{{ route('search.category', $category) }}" data-value="{{ $category->id }}">{{ $category->title }}</a>
                                    <a onclick="destroyCategory({{ json_encode(route('admin.categories.destroy', $category)) }})" class="btn btn-danger btn-xs"> Delete</a>
                                    <button id="addSubcategory" class="btn btn-success btn-xs" data-toggle="modal" data-target="#subcategoryModal" onclick="getValue(this.value)" value="{{ $category->id }}"> + Add new subcategory</button>
                                </li>
                                @foreach($subcategories->where('parent_id', $category->id) as $subcategory)
                                    <li style="margin-left: 35px; font-size: 18px">
                                        <a href="{{ route('search.category', $subcategory) }}" data-value="{{ $subcategory->id }}">{{ $subcategory->title }}</a>                                          <a onclick="destroyCategory({{ json_encode(route('admin.categories.destroy', $subcategory)) }})" class="btn btn-danger btn-xs"> Delete</a>
                                    </li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form enctype="multipart/form-data" action="{{ route('admin.categories.store') }}" method="POST" >
                    {{csrf_field()}}
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLongTitle">Category creation</h2>
                    </div>
                    <div class="modal-body">
                        <div class="form-group text-center">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                            <input hidden value="category" name="type">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Subcategory Modal -->
    <div class="modal fade" id="subcategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form enctype="multipart/form-data" action="{{ route('admin.categories.store') }}" method="POST" >
                    {{csrf_field()}}
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLongTitle">Subcategory creation</h2>
                    </div>
                    <div class="modal-body">
                        <div class="form-group text-center">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                            <input hidden value="subcategory" name="type">
                            <input id="parent_id" hidden value="" name="parent_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function getValue(category_id) {
            let element = document.getElementById("parent_id");
            element.value = category_id;
        }

        function destroyCategory(url) {
            $.ajax({
                url: url,
                method: 'DELETE',
                data: {
                    _token: {!! json_encode(csrf_token()) !!}
                }
            }).always(function () {
                location.reload();
            });
        }
    </script>

@endsection