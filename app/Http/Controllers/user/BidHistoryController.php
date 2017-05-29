<?php

namespace App\Http\Controllers\user;

use App\Auction_Winner;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\Auth;

class BidHistoryController extends Controller
{
    public function showBidHistory(){
        $auctionsWithBidsSubmitted = Auth::user()->bids()->orderBy('created_at', 'desc')->get();
        $wonBids = Auction_Winner::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $wonAuctions = [];
        foreach ($auctionsWithBidsSubmitted as $key => $auctionWithBidsSubmitted){
            foreach ($wonBids as $wonBid){
                if($auctionWithBidsSubmitted->id == $wonBid->item_id){
                    unset($auctionsWithBidsSubmitted[$key]);
                }
            }
        }
        $auctionsWithBidsSubmitted = $auctionsWithBidsSubmitted->unique();

        foreach($wonBids as $wonBid){
            array_push($wonAuctions, Product::find($wonBid->item_id));
        }

        return view('user.bidHistory')
            ->with('activeAuctions', $auctionsWithBidsSubmitted)
            ->with('wonAuctions', $wonAuctions);
    }
}
