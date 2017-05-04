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
                    <h3 id="currentBid">Current bid: <span style="color: green">{{--<small> by John Doe</small>--}}</span></h3>
                </div>
                <div class="col-md-8">
                    <input class="form-control" type="number" id="bid_amount" name="bid_amount" placeholder="Enter Bid" required />
                    <br>
                    <button id="submitButton" class="btn btn-success btn-sm">Place your bid</button>
                </div>
            </div><!-- end row -->

            <br>


        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="text-center" id="clockdiv" style="font-size: 35px;">Expires at: {{ $item->expirationDate }}</div>
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
            alert('success!');
        }).error(function () {
            alert(response);
        });
    }

    @if($item->type == 0)
        let end_date = '{{ $item->expirationDate }}';

        function getTimeRemaining(endtime){
            let t = Date.parse(endtime) - Date.parse(new Date());
            let seconds = Math.floor( (t/1000) % 60 );
            let minutes = Math.floor( (t/1000/60) % 60 );
            let hours = Math.floor( (t/(1000*60*60)) % 24 );
            let days = Math.floor( t/(1000*60*60*24) );
            return {
                'total': t,
                'days': days,
                'hours': hours,
                'minutes': minutes,
                'seconds': seconds
            };
        }

        function initializeClock(id, endtime){
            let clock = document.getElementById(id);
            let timeinterval = setInterval(function(){
                let t = getTimeRemaining(endtime);
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

<script>
    function notifyInit() {
        // set up form submission handling
        $('#submitButton').click(notifySubmit);
    }

    // Handle the form submission
    function notifySubmit() {
        let bidAmount = $('#bid_amount').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Build POST data and make AJAX request
        let variables = {
            bid_amount: bidAmount
        };
//        $.post('/bids/submitBid', data).success(notifySuccess);
        $.ajax({
            type: "POST",
            url: "/bids/submitBid",
            data: variables,
            success: function () {
                notifySuccess();
            }
        });

        // Ensure the normal browser event doesn't take place
        return false;
    }

    // Handle the success callback
    function notifySuccess() {
        console.log('notification submitted');
    }

    $(notifyInit); // Existing functionality

    // Use toastr to show the notification
    function showNotification(data) {

        // TODO: get the text from the event data

        // TODO: use the text in the notification
        toastr.success(text, null, {"positionClass": "toast-bottom-left"});
    }

    let pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
        cluster: "eu"
    });

    pusher.connection.bind('connected', function() {
        console.log('Realtime is go!');
    });

    let channel = pusher.subscribe('auction');
    channel.bind('bid', function(data) {
        //toastr.info(data.amount);
        $('#currentBid').append('<li><strong>New bid incoming ' + data.amount + '</strong></li>');
        // do something with the event data.amount
    });
</script>