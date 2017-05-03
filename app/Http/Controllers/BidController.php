<?php

namespace App\Http\Controllers;

use App\Product;
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

    public function submit(Request $request, Product $product){
        $this->validate($request, [
            'bid_amount' => 'required|numeric'
        ]);

        $user = Auth::user();

        $success = $this->BiddingService->bid($product, $request->input('bid_amount'));

        return response()->json($success);
    }
}
