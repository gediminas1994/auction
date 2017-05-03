<div class="just-padding">

    <div class="list-group list-group-root well">

        @foreach($categories as $category)
            <div class="list-group">
                <a href="{{ route('search.category', $category) }}" data-value="{{ $category->id }}" class="list-group-item">{{ $category->title }}</a>
                <div class="list-group">
                    @foreach($subcategories->where('parent_id', $category->id) as $subcategory)
                        <a href="{{ route('search.category', $subcategory) }}" data-value="{{ $subcategory->id }}" class="list-group-item">{{ $subcategory->title }}</a>
                    @endforeach()
                </div>
            </div>
        @endforeach

    </div>

</div>