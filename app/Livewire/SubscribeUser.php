<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SubscriptionUser;
use Illuminate\Support\Facades\Auth;

class SubscribeUser extends Component
{
    public bool $subscribed = false;
    public int $author;

    public function spawnConfetti(){
        if( $this->subscribed ){
            $this->js( <<<EOF
                let rect = $("[wire\\\\:click='subscribe']")[0].getBoundingClientRect();
                confetti({
                    spread: 90,
                    ticks: 50,
                    gravity: 0.3,
                    decay: 0.98,
                    startVelocity: 8,
                    shapes: ["star"],
                    colors: ["FFE400", "FFBD00", "E89400", "FFCA6C", "FDFFB8"],
                    origin: {
                        x: (rect.left + rect.width / 2) / window.innerWidth,
                        y: (rect.top + rect.height / 2) / window.innerHeight
                    }
                });
            EOF);
        }else{
            $this->js( <<<EOF
                let rect = $("[wire\\\\:click='subscribe']")[0].getBoundingClientRect();
                confetti({
                    spread: 90,
                    ticks: 50,
                    gravity: 0.2,
                    decay: 0.98,
                    startVelocity: 8,
                    scalar: 2,
                    shapes: ["emoji"],
                    shapeOptions: {
                    emoji: {
                        value: ["😭", "💧","😢"],
                    },
                    },
                    origin: {
                        x: (rect.left + rect.width / 2) / window.innerWidth,
                        y: (rect.top + rect.height / 2) / window.innerHeight
                    }
                });
            EOF);
        }
    }

    public function refreshSubscribers() {
        $user = Auth::user();
        if( $user )
            $subscribtion = SubscriptionUser::where("subscriber",Auth::user()->id)->where("author",$this->author)->first();


        $this->subscribed = !is_null($subscribtion);
    }

    public function render()
    {
        $this->refreshSubscribers();

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
        $this->spawnConfetti();

        $this->dispatch('profileSubscriptionsUpdate');
    }
}
