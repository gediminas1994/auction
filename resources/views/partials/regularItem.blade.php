<div class="container-fluid">
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
                    <a onclick="addToFavorites({{ json_encode(route('items.addToFavorites', $item->id)) }})" class="btn btn-success btn-lg pull-right" style="cursor: pointer"><i class="fa fa-star" aria-hidden="true"></i> Add To Favorites</a>
                @endif
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            {{--PICTURE--}}
            <img src="/{{ $item->picture }}" alt="" class="img-responsive" style="margin-top: 25px; border-radius: 3px;">
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
                            <span><a href="{{ route('search.category', $category) }}" class="label label-primary" data-value="{{ $category->id }}">{{ $category->title }}</a></span>
                        @endforeach
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 bottom-rule">
                    <h2 class="product-price">$129.00</h2>
                </div>
            </div><!-- end row -->

            <div class="row">
                <div class="col-sm-12">

                </div>
            </div><!-- end row -->

            <div class="row add-to-cart">
                <div class="col-sm-12 product-qty">
                            <span class="btn btn-default btn-sm">
                                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                            </span>
                    <span>
                                <input type="number" min="1" max="{{ $item->quantity }}" class="btn btn-default btn-sm" value="1"/>
                            </span>
                    <span class="btn btn-default btn-sm">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </span>

                    <span class="text-right">Quantity: </span>
                    <span class="text-right" style="color: red; font-size: 25px">{{ $item->quantity }}</span>
                </div>
            </div><!-- end row -->

            <br>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <a href="#description"
                       aria-controls="description"
                       role="tab"
                       data-toggle="tab"
                    >Description</a>
                </li>
                <li>
                    <a href="#mailing_services"
                       aria-controls="mailing_services"
                       role="tab"
                       data-toggle="tab"
                    >Mailing Services</a>
                </li>
                <li>
                    <a href="#user_rating"
                       aria-controls="user_rating"
                       role="tab"
                       data-toggle="tab"
                    >User Rating</a>
                </li>
                <li>
                    <a href="#comments"
                       aria-controls="comments"
                       role="tab"
                       data-toggle="tab"
                    >Comments</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="description">
                    {{ $item->description }}
                </div>
                <div role="tabpanel" class="tab-pane top-10" id="mailing_services">
                    @if($item->mailingService_id == 1)
                        Lietuvos paštas
                    @elseif($item->mailingService_id == 2)
                        Omniva
                    @elseif($item->mailingService_id == 3)
                        LP Express
                    @elseif($item->mailingService_id == 4)
                        DPD Kurjeris
                    @else
                        Autobusų stotis
                    @endif
                </div>
                <div role="tabpanel" class="tab-pane" id="user_rating">
                    @if($item->user->rating)
                        <span>This Users Rating is: </span>
                        <span>{{ number_format($item->user->rating->total_rating/$item->user->rating->times_rated, 2) }}<b>/5</b></span>
                    @else
                        <div>This user has not been rated yet!</div>
                    @endif

                    <br>
                    <div>Give this user a rating!</div>

                    <form enctype="multipart/form-data" action="{{ route('rating.submit', $item->user->id) }}" id="createItem" class="form-horizontal" method="POST" >
                        {{csrf_field()}}

                        <div class="row">
                            <div class="col-md-4">
                                <select class="form-control" name="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>


                    </form>

                </div>
                <div role="tabpanel" class="tab-pane" id="comments">
                    comments
                </div>
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