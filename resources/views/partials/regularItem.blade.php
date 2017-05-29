<div class="container-fluid">

    @include('partials.messages')
    @include('partials.errors')

    <div class="row">
        <div class="col-md-11">
            <i class="fa fa-cubes fa-3x" aria-hidden="true"></i>
            <b style="font-size: 3em;">Regular Product</b>
            @if(Auth::user())
                @if(Auth::user()->isUsersProduct($item->id))
                    {{--Users item, so show nothing--}}
                @elseif(Auth::user()->isProductFavorite($item->id))
                    <div class="col-md-4 alert alert-info pull-right text-center">
                        <strong>Product is in your favorite list</strong>
                    </div>
                @else
                    <a onclick="addToFavorites({{ json_encode(route('items.addToFavorites', $item->id)) }})"
                       class="btn btn-success btn-lg pull-right" style="cursor: pointer"><i class="fa fa-star"
                                                                                            aria-hidden="true"></i> Add
                        To Favorites</a>
                @endif
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            {{--PICTURE--}}
            <img src="/{{ $item->picture }}" alt="" class="img-responsive"
                 style="margin-top: 25px; border-radius: 3px;">
        </div>
        <div class="col-sm-6">
            {{--INFORMATION--}}
            <div class="row">
                <div class="col-sm-12">
                    <h3>{{ $item->title }}</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <span>Categories:</span>
                    <span>
                        @foreach($item->categories as $category)
                            <span><a href="{{ route('search.category', $category) }}" class="label label-primary"
                                     data-value="{{ $category->id }}">{{ $category->title }}</a></span>
                        @endforeach
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 bottom-rule">
                    <h2 class="product-price">{{ $item->price }}€</h2>
                </div>
            </div><!-- end row -->

            <div class="row">
                <div class="col-sm-12">

                </div>
            </div><!-- end row -->

            <div class="row add-to-cart">
                <form enctype="multipart/form-data" action="{{ route('items.buyRegularItem', $item) }}" class="form-horizontal" method="POST" >
                    {{csrf_field()}}

                    <div class="col-sm-12 product-qty">
                        <span class="btn btn-default btn-sm">
                            <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                        </span>
                        <span>
                            <input type="number" min="1" max="{{ $item->quantity }}" class="btn btn-default btn-sm" value="1" name="quantityEntered"/>
                        </span>
                        <span class="btn btn-default btn-sm">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </span>

                        <span class="text-right">Quantity: </span>
                        <span class="text-right" style="color: red; font-size: 25px">{{ $item->quantity }}</span>
                    </div>

                    <div class="col-sm-12">
                        <button class="btn btn-success" type="submit">Buy</button>
                    </div>
                </form>
            </div><!-- end row -->

            <br>

        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <a href="#description" data-toggle="tab">Description</a>
                </li>
                <li>
                    <a href="#mailing" data-toggle="tab">Mailing Services</a>
                </li>
                <li>
                    <a href="#rating" data-toggle="tab">User Ratings</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="description">
                    <div>{{ $item->description }}</div>
                </div>
                <div class="tab-pane" id="mailing">
                    <ul>
                        @foreach($item->mailing_services as $mailing_service)
                            <li>{{ $mailing_service->title }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane" id="rating">
                    @if(count($item->user->ratings))
                        <div class="row">
                            <div class="col-md-8">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Rating</th>
                                        <th>Comment</th>
                                        <th>Made by</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($item->user->ratings as $rating)
                                        <tr>
                                            <td>{{ $rating->points }}</td>
                                            <td>{{ $rating->comment }}</td>
                                            <td>{{ $rating->getRatingMakerUsername() }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-8">
                                No ratings have been submitted!
                            </div>
                        </div>
                    @endif

                    @if(Auth::user())
                        <form enctype="multipart/form-data" action="{{ route('rating.submit', $item->user->id) }}" class="form-horizontal" method="POST" >
                            {{csrf_field()}}

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="year" class="control-label input-group">Select a rating</label>
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default">
                                            <input type="radio" name="rating" value="1">1
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="rating" value="2">2
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="rating" value="3">3
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="rating" value="4">4
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="rating" value="5">5
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="rating" value="6">6
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="rating" value="7">7
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="rating" value="8">8
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="rating" value="9">9
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="rating" value="10">10
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label for="comment">Leave a comment</label>
                                    <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="row">
                            <div class="col-md-8">
                                <div class="alert alert-danger">Can't leave a rating while not logged in!</div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            <div class="row">
                <div class="col-md-12" style="height: 200px;"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function addToFavorites(url) {
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: {!! json_encode(csrf_token()) !!}
            }
        }).always(function () {
            location.reload();
        }).success(function () {
            alert('success!');
        }).error(function () {
            alert(response);
        });
    }
</script>