@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div style="font-size: 30px">{{ Auth::user()->username }}'s bid history</div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#activeAuctions" role="tab">Active auctions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#wonAuctions" role="tab">Won auctions</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="activeAuctions" role="tabpanel">
                    @if(isset($activeAuctions))
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Picture</th>
                                <th>Your Bid</th>
                                <th>Show</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($activeAuctions as $activeAuction)
                                    <tr>
                                        <td>{{ $activeAuction->title }}</td>
                                        <td><img style="max-width: 100px; max-height: 80px" src="/{{ $activeAuction->picture }}"></td>
                                        <td>{{ $activeAuction->pivot->amount }}</td>
                                        <td><a href="{{ route('items.show', $activeAuction->id) }}" class="btn btn-primary">Show</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="tab-pane" id="wonAuctions" role="tabpanel">
                    @if(isset($wonAuctions))
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Picture</th>
                                <th>Your Bid</th>
                                <th>Show</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($wonAuctions as $wonAuction)
                                <tr class="bg-success">
                                    <td>{{ $wonAuction->title }}</td>
                                    <td><img style="max-width: 100px; max-height: 80px" src="/{{ $wonAuction->picture }}"></td>
                                    <td>{{ $wonAuction->getWinnerInfo($wonAuction->id)->amount }}</td>
                                    <td><a href="{{ route('items.show', $activeAuction->id) }}" class="btn btn-primary">Show</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection