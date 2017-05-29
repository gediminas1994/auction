<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function Sodium\increment;

class RatingController extends Controller
{
    public function submitRating(Request $request, $user_id){
        //$user_id = tas useris, kuriam dudoa reitinga
        $this->validate($request, [
            'rating' => 'required',
            'comment' => 'required'
        ]);

        $rating = new Rating();
        $rating->user_id = $user_id;
        $rating->rated_by_user_id = Auth::user()->id;
        $rating->points = $request->get('rating');
        $rating->comment = $request->get('comment');
        $rating->save();

        Session::flash('message', 'Succesfully rated!');
        return back();
    }
}
