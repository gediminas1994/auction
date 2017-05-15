<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'description',
        'expirationDate',
        'quantity',
        'price',
        'startingBid',
        'picture'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function mailing_services(){
        return $this->belongsToMany(Mailing_Service::class, 'product_mailings', 'product_id', 'mailing_service_id');
    }

    public function bids(){
        return $this->belongsToMany(User::class, 'bids', 'product_id', 'user_id')->withPivot('amount');
    }

    public function createAuction($user_id, $title, $type, $description, $expirationDate,$startingBid, $submittedMailingServices, $picturePath, $submittedCategories){
        $item = Product::fill([
            'user_id' => $user_id,
            'title' => $title,
            'type' => $type,
            'description' => $description,
            'expirationDate' => $expirationDate,
            'startingBid' => $startingBid,
            'picture' => $picturePath,
            'status' => 1
        ]);

        $item->save();

        foreach ($submittedMailingServices as $submittedMailingService){
            $service_id = intval($submittedMailingService);
            $item->mailing_services()->attach($service_id);
        }

        foreach ($submittedCategories as $submittedCategory){
            $category_id = intval($submittedCategory);
            $item->categories()->attach($category_id);
        }
    }

    public function createRegularItem($user_id, $title, $type, $description, $quantity, $price, $submittedMailingServices, $picturePath, $submittedCategories){
        $item = Product::fill([
            'user_id' => $user_id,
            'title' => $title,
            'type' => $type,
            'description' => $description,
            'quantity' => $quantity,
            'price' => $price,
            'picture' => $picturePath
        ]);

        $item->save();

        foreach ($submittedMailingServices as $submittedMailingService){
            $service_id = intval($submittedMailingService);
            $item->mailing_services()->attach($service_id);
        }

        foreach ($submittedCategories as $submittedCategory){
            $category_id = intval($submittedCategory);
            $item->categories()->attach($category_id);
        }
    }

    public function hasAuctionTimeEnded(){
        $hasEnded = Carbon::parse($this->expirationDate, 'Europe/Riga')->lte(Carbon::now('Europe/Riga'));
        return $hasEnded;
    }

    public function didSomeoneBid(){
        if($this->bids()->max('amount')){
            $this->saveWinner();
            return true;
        }else{
            return false;
        }
    }

    public function getWinnerInfo($id){
        $win = Auction_Winner::where('item_id', $id)->first();
        return $win;
    }

    public function hasAuctionBeenPayed($id){
        $win = Auction_Winner::where('item_id', $id)->first();
        if($win->hasPaid == 1){
            return true;
        }else{
            return false;
        }
    }

    private function saveWinner(){
        $highestAmount = $this->bids()->max('amount');
        $highestBidder = $this->bids()->where('amount', $this->bids()->max('amount'))->first();

        if($highestBidder){
            if(Auction_Winner::where('item_id', $this->id)->first()){
                $winner = Auction_Winner::where('item_id', $this->id)->first();
            }else{
                $winner = new Auction_Winner();
            }
            $winner->item_id = $this->id;
            $winner->user_id = $highestBidder->id;
            $winner->amount = $highestAmount;
            $winner->save();
        }else{
            return false;
        }
    }
}
