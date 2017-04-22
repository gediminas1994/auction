@extends('layouts.app')

@section('content')

    @if($item->type == 0)
        {{--AUCTION--}}
        <div class="container bg-info">

            <div class="row">
                <a href="{{ route('welcome') }}" class="btn btn-info">Back</a>

                @if(Auth::user()->isUsersProduct($item->id))
                    <div class="pull-right">TAI JUSU IKELTAS PRODUKTAS</div>
                @elseif(Auth::user()->isProductFavorite($item->id))
                    <div class="pull-right">SITAS PRODUKTAS ITRAUKTUS I JUSU FAVORITU SARASA</div>
                @else
                    <a onclick="addToFavorites({{ json_encode(route('items.addToFavorites', $item->id)) }})" class="col-lg-2 pull-right">
                        <div style="text-align: center; color: green">
                            <img src="/partials/3d-yellow-star.png" style="height: 30px; width: 30px">
                            Add To Favorites
                        </div>

                    </a>
                @endif
            </div>

            <div class="row">

                <div class="col-lg-6">
                    <h1>{{ $item->title }}</h1>
                    <img src="{{ $item->picture }}" style="max-height: 500px; max-width: 400px; border-radius: 3px">
                </div>

                <div class="col-lg-6">
                    <h3>Description</h3>
                    <div>{{ $item->description }}</div>

                    <h3>The auction ends in</h3>
                    <div>
                        {{ \Carbon\Carbon::parse($item->expirationDate)->diffForHumans() }}
                    </div>

                    <h3>Items left</h3>
                    <div>{{ $item->quantity }}</div>

                    <h3>Starting Bid</h3>
                    <div>{{ $item->startingBid }}</div>

                    <h3>Your Bid:</h3>
                    <div>
                        <input class="form-control" type="number" step="0.01" placeholder="0.00">
                    </div>
                    <div>
                        <button class="btn btn-primary col-lg-12">Place a bid</button>
                    </div>
                </div>

                <div class="col-lg-12">
                    <h1>Time left</h1>
                    <h1>{{ $item->expirationDate }}</h1>
                </div>

                <div class="col-lg-12">
                    <h1>Komentarai</h1>
                    <div>Nekazka</div>
                    <div><small>Posted by Pink Floyd at 2017-04-17 9:42:11</small></div>
                    <br>
                    <div>Uz Lietuva vyrai</div>
                    <div><small>Posted by NoScoper420 at 2017-04-17 9:42:11</small></div>
                    <br>
                    <div>Paimu uz 0.01</div>
                    <div><small>Posted by League Of Autism at 2017-04-17 9:42:11</small></div>
                    <br>
                    <button>1</button>
                    <button>2</button>
                    <button>3</button>
                    <button>4</button>
                    <button>5</button>
                    <button>6</button>

                    <h3>Rasykite komentara:</h3>
                    <input class="form-control" type="text">
                    <button class="btn btn-success">Komentuoti</button>
                </div>
            </div>

        </div>
    @else
        {{--REGULAR ITEM--}}
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    {{--PICTURE--}}
                    <img src="{{ $item->picture }}" alt="" class="img-responsive" style="margin-top: 25px; border-radius: 3px;">
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
                                    <span><a href="#" class="label label-primary">{{ $category->title }}</a></span>
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
                                <input type="number" min="1" class="btn btn-default btn-sm" value="1"/>
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
                            mailing services
                        </div>
                        <div role="tabpanel" class="tab-pane" id="user_rating">
                            @if(Auth::user()->rating)
                                <span>This Users Rating is: </span>
                                <span>{{ number_format(Auth::user()->rating->total_rating/Auth::user()->rating->times_rated, 2) }}</span>
                            @else
                                <div>This user has not been rated yet!</div>
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane" id="comments">
                            comments
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

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
@endsection