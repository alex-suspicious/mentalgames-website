<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SubscriptionUser;
use Illuminate\Support\Facades\Auth;

class SubscribeUser extends Component
{
    public bool $subscribed = false;
    public int $author;

    public function render()
    {
        $user = Auth::user();
        if( $user )
            $subscribtion = SubscriptionUser::where("subscriber",Auth::user()->id)->where("author",$this->author)->first();

        if( !is_null($subscribtion) )
            $this->subscribed = true;

        return view('livewire.subscribe-user');
    }

    public function subscribe(){
        if( Auth::user()->id == $this->author )
            return;

        if( $this->subscribed )
            SubscriptionUser::where("subscriber",Auth::user()->id)->where("author",$this->author)->delete();
        else
            SubscriptionUser::create([
                "subscriber" => Auth::user()->id,
                "author" => $this->author
            ]);

        $this->subscribed = !$this->subscribed;
    }
}
