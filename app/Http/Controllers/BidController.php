<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Services\BiddingService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BidController extends Controller
{
    protected $BiddingService;

    public function __construct(BiddingService $BiddingService)
    {
        $this->BiddingService = $BiddingService;
    }

    public function submit(Request $request){
        $this->validate($request, [
            'bid_amount' => 'required|numeric'
        ]);

        $bid_amount = $request->bid_amount;
        $item_id = $request->item_id;
        $user_id = $request->user_id;

        $item = Product::find($item_id);
        $currentMaxBid = $item->bids()->max('amount');
        //If there are no bids, currentMaxBid is given the default startingBid
        if(!$currentMaxBid){
            $currentMaxBid = $item->startingBid;
        }

        $valueRange = collect([
            ['lowest' => 0.01, 'highest' => 0.99, 'minimumDifference' => 0.05],
            ['lowest' => 1.00, 'highest' => 4.99, 'minimumDifference' => 0.25],
            ['lowest' => 5.00, 'highest' => 24.99, 'minimumDifference' => 0.50],
            ['lowest' => 25.00, 'highest' => 99.99, 'minimumDifference' => 1.00],
            ['lowest' => 100.00, 'highest' => 249.99, 'minimumDifference' => 2.50],
            ['lowest' => 250.00, 'highest' => 999999.00, 'minimumDifference' => 5.00],
        ]);

        $fittingValues = $valueRange->filter(function ($value) use ($currentMaxBid) {
            return $currentMaxBid >= $value['lowest'] && $currentMaxBid <= $value['highest'];
        })->collapse();

        //How much you have to bid, for it to be valid
        $minBidNeeded = $currentMaxBid + $fittingValues['minimumDifference'];

        if ($bid_amount < $minBidNeeded) {
            $error = "Can't bid lower than $minBidNeeded";
            return response()->json($error);
        }else{
            $success = $this->BiddingService->bid($bid_amount, $item_id, $user_id);
            return response()->json($success);
        }
    }
}
