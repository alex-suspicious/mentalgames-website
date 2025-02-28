<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\SubscriptionUser;

class ProfileController extends Controller
{
    public function view(Request $request, $url)
    {
        $user = User::where("url",$url)->first();
        if( !$user )
            abort(404);

        return view("guest.profile.view")->with(["user"=>$user]);
    }

    public function subscribers(Request $request, $url)
    {
        $user = User::where("url",$url)->first();
        if( !$user )
            abort(404);

        $subscriptions = SubscriptionUser::where("author", $user->id)->get();
        $subscribers_users = [];

        foreach( $subscriptions as $subscription ){
            $subscriber = User::where("id", $subscription->subscriber)->first();
            if( $subscriber )
                array_push($subscribers_users, $subscriber);
        }


        return view("guest.profile.subscribers")->with(["user"=>$user, "subscribers" => $subscribers_users]);
    }

    public function subscribed(Request $request, $url)
    {
        $user = User::where("url",$url)->first();
        if( !$user )
            abort(404);

        $subscriptions = SubscriptionUser::where("subscriber", $user->id)->get();
        $subscribers_users = [];

        foreach( $subscriptions as $subscription ){
            $subscriber = User::where("id", $subscription->author)->first();
            if( $subscriber )
                array_push($subscribers_users, $subscriber);
        }


        return view("guest.profile.subscribed")->with(["user"=>$user, "subscribers" => $subscribers_users]);
    }

}
