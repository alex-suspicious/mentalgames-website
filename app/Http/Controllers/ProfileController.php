<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class ProfileController extends Controller
{

    public function view(Request $request, $url)
    {
        $user = User::where("url",$url)->first();
        if( !$user )
            abort(404);

        return view("guest.profile.view")->with(["user"=>$user]);
    }

}
