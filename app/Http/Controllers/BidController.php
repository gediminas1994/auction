<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Services\BiddingService;
use Illuminate\Support\Facades\Auth;

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

        $success = $this->BiddingService->bid($bid_amount, $item_id, $user_id);

        return response()->json($success);
    }
}
