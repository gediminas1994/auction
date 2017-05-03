<?php

namespace App\Services;

use App\Product;
use App\User;
use Carbon\Carbon;
use Vinkla\Pusher\PusherManager;

class BiddingService
{
    protected $pusher;
    protected $user;

    public function __construct(User $user, PusherManager $pusher)
    {
        $this->pusher = $pusher;
        $this->user = $user;
    }

    public function bid(Product $product, $amount)
    {
        // $this->user->bid()->attach($auction, ['amount' => $amount]);

        $response = $this->pusher->trigger('auction', 'bid', ['amount' => $amount]);

        return $response;
    }

    public function retract()
    {
        $this->user->bids()->detach();
    }

    public function close(Product $product)
    {
        $product->expires_at = Carbon::now();
        $product->save();
    }

    public function expire(Product $product)
    {
        $product->delete();
    }
}