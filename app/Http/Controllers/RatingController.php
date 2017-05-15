<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;
use function Sodium\increment;

class RatingController extends Controller
{
    public function submitRating(Request $request, $user_id){
        //$user_id = tas useris, kuriam dudoa reitinga
        dd($request->all(), $user_id);
        $rating = Rating::where('user_id', $user_id)->first();
        if(!$rating){
            //pirma karta ratinamas
            $rating = new Rating();
            $rating->user_id = $user_id;
            $rating->times_rated = 1;
            $rating->total_rating = $request->get('rating');
        }else{
            $rating->user_id = $user_id;
            $rating->times_rated = $rating->times_rated + 1;
            $rating->total_rating = $rating->total_rating + $request->get('rating');
        }

        $rating->save();

        return back();
    }
}
