@extends('layouts.app')

@section('content')

    @if($item->type == 0)
        {{--AUCTION--}}
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <i class="fa fa-gavel fa-3x" aria-hidden="true"></i>
                    <b style="font-size: 3em;">Auction</b>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    {{--PICTURE--}}
                    <img src="/{{ $item->picture }}" alt="" class="img-responsive" style="margin-top: 25px; border-radius: 3px;">

                    <div class="row">
                        <div class="col-md-12">
                            <div id="clockdiv"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    {{--INFORMATION--}}
                    <div class="row">
                        <div class="col-sm-12">
                            <h1>{{ $item->title }}</h1>
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
                            <h3>Starting bid: <span style="color:red">{{ $item->startingBid }}</span></h3>
                        </div>
                    </div><!-- end row -->

                    <div class="row add-to-cart">
                        <div class="col-sm-12 product-qty">
                            <h3>Current bid: <span style="color: green">98.51<small> by John Doe</small></span></h3>
                        </div>
                        <div class="col-md-8">
                            <input class="form-control" type="number" step="0.01" min="98.51" placeholder="98.51">
                            <button class="btn btn-success btn-sm">Place your bid</button>
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
    @else
        {{--REGULAR ITEM--}}
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <i class="fa fa-cubes fa-3x" aria-hidden="true"></i>
                    <b style="font-size: 3em;">Regular Product</b>
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

        @if($item->type == 0)
            var end_date = '{{ $item->expirationDate }}';

            function getTimeRemaining(endtime){
                var t = Date.parse(endtime) - Date.parse(new Date());
                var seconds = Math.floor( (t/1000) % 60 );
                var minutes = Math.floor( (t/1000/60) % 60 );
                var hours = Math.floor( (t/(1000*60*60)) % 24 );
                var days = Math.floor( t/(1000*60*60*24) );
                return {
                    'total': t,
                    'days': days,
                    'hours': hours,
                    'minutes': minutes,
                    'seconds': seconds
                };
            }

            function initializeClock(id, endtime){
                var clock = document.getElementById(id);
                var timeinterval = setInterval(function(){
                    var t = getTimeRemaining(endtime);
                    clock.innerHTML = 'days: ' + t.days + '<br>' +
                        'hours: '+ t.hours + '<br>' +
                        'minutes: ' + t.minutes + '<br>' +
                        'seconds: ' + t.seconds;
                    if(t.total<=0){
                        clearInterval(timeinterval);
                    }
                },1000);
            }

            initializeClock('clockdiv', end_date);
        @endif

    </script>
@endsection