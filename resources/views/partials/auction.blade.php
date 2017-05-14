<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-11">
            <i class="fa fa-gavel fa-3x" aria-hidden="true"></i>
            <b style="font-size: 3em;">Auction</b>
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
                    <h1>{{ $item->title }}</h1>
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
                    <h3>Starting bid: <span style="color:red">{{ $item->startingBid }}</span></h3>
                </div>
            </div><!-- end row -->

            <div class="bidding">
                @if($item->hasAuctionTimeEnded())
                    @if(Auth::user()->id == $item->getWinnerInfo($item->id)->user_id)
                        <div class="row">
                            <div class="col-sm-12" style="font-size: 25px">
                                <div>
                                    <div><strong style="color: #66CDAA; font-size: 40px">You have won this auction!</strong></div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12" style="font-size: 25px">
                                <div>
                                    <div><strong>Click the button bellow to pay for your item!</strong></div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12" style="font-size: 25px">
                                <div>
                                    <div><button class="btn btn-success">GET IT</button></div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-sm-12" style="font-size: 25px">
                                <div>
                                    <div><strong>This auction has been won!</strong></div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12" style="font-size: 25px">
                                <div>
                                    <div><strong>Winner</strong></div>
                                    <div style="color: green">{{ \App\User::find($item->getWinnerInfo($item->id)->user_id)->username }}</div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12" style="font-size: 25px">
                                <div>
                                    <div><strong>With a bid of</strong></div>
                                    <div style="color: green">{{ $item->getWinnerInfo($item->id)->amount }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="col-sm-12 product-qty">
                        <h3>Current highest bid:
                            <span id="currentBid" style="color: green">
                                @if(count($item->bids))
                                    {{ $item->bids()->max('amount') . ' submitted by ' . $item->bids()->where('amount', $item->bids()->max('amount'))->first()->username }}
                                @else
                                    No bids have been made yet
                                @endif
                            </span>
                        </h3>
                    </div>
                    @if(Auth::user())
                        @if(Auth::user()->isUsersProduct($item->id))
                            <div class="col-md-8">
                                <div class="alert alert-info">You can't bid on your own item!</div>
                            </div>
                        @else
                            <div class="col-md-8">
                                <input class="form-control" type="number" id="bid_amount" name="bid_amount" placeholder="Enter Bid" required />
                                <br>
                                <button id="submitButton" class="btn btn-success btn-sm">Place your bid</button>
                            </div>
                        @endif
                    @else
                        <div class="col-md-8">
                            <div class="alert alert-danger">You have to be logged in to bid!</div>
                        </div>
                    @endif
                @endif
            </div><!-- end row -->

            <br>


        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="text-center" id="clockdiv" style="font-size: 35px;">
                <div class="bg-info">
                    @if(!$item->hasAuctionTimeEnded())
                        <span>Auction closes in: </span>
                        <span class="days" style="color: #4815EF"></span><span> Days</span>
                        <span class="hours" style="color: #4815EF"></span><span> Hours</span>
                        <span class="minutes" style="color: #4815EF"></span><span> Minutes</span>
                        <span class="seconds" style="color: #4815EF"></span><span> Seconds</span>
                    @else
                        <span>Auction has ended</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
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

            <div class="row">
                <div class="col-md-12" style="height: 200px;"></div>
            </div>
        </div>
    </div>

</div>

<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="//js.pusher.com/3.0/pusher.min.js"></script>

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
            alert(response);
        }).error(function () {
            alert(response);
        });
    }
</script>

<script>
    window.onload = function() {
        let end_date = '{{ $item->expirationDate }}';

        function getTimeRemaining(endtime) {
            let t = Date.parse(endtime) - Date.parse(new Date());
            let seconds = Math.floor((t / 1000) % 60);
            let minutes = Math.floor((t / 1000 / 60) % 60);
            let hours = Math.floor((t / (1000 * 60 * 60)) % 24);
            let days = Math.floor(t / (1000 * 60 * 60 * 24));
            return {
                'total': t,
                'days': days,
                'hours': hours,
                'minutes': minutes,
                'seconds': seconds
            };
        }

        function initializeClock(id, endtime) {
            console.log('initialized');
            let clock = document.getElementById(id);
            let daysSpan = clock.querySelector('.days');
            let hoursSpan = clock.querySelector('.hours');
            let minutesSpan = clock.querySelector('.minutes');
            let secondsSpan = clock.querySelector('.seconds');

            function updateClock() {
                let t = getTimeRemaining(endtime);

                daysSpan.innerHTML = t.days;
                hoursSpan.innerHTML = t.hours;
                minutesSpan.innerHTML = t.minutes;
                secondsSpan.innerHTML = t.seconds;

                @if(!$item->hasAuctionTimeEnded())
                    if (t.total <= 0) {
                        window.location.reload();
                    }
                @endif
            }

            updateClock(); // run function once at first to avoid delay
            let timeinterval = setInterval(updateClock, 1000);
        }

        initializeClock('clockdiv', end_date);
    }
</script>

<script>
    function notifyInit() {
        // set up form submission handling
        $('#submitButton').click(notifySubmit);
    }

    @if(Auth::user())
    // Handle the form submission
    function notifySubmit() {
        let bidAmount = $('#bid_amount').val();
        let itemID = '{{ $item->id }}';
        let userID = '{{ Auth::user()->id }}';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Build POST data and make AJAX request
        let letiables = {
            bid_amount: bidAmount,
            item_id: itemID,
            user_id: userID
        };
//        $.post('/bids/submitBid', data).success(notifySuccess);
        $.ajax({
            type: "POST",
            url: "/bids/submitBid",
            data: letiables,
            success: function (response) {
//                notifySuccess();
                if( response == true ){
                    toastr.success('Succesfully submitted the bid!');
                }else{
                    toastr.error(response);
                }
            }
        });

        // Ensure the normal browser event doesn't take place
        return false;
    }
    @endif
    /*// Handle the success callback
    function notifySuccess() {
        console.log('notification submitted');
    }*/

    $(notifyInit); // Existing functionality

    let pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
        cluster: "eu"
    });

    pusher.connection.bind('connected', function() {
        console.log('Realtime is go!');
    });

    let channel = pusher.subscribe('auction');
    channel.bind('bid', function(data) {
        $('#currentBid').text(data.amount + ' submitted by ' + data.username);
    });

    @include('partials.errors')
</script>