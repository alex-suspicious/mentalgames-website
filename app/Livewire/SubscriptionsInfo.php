<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class SubscriptionsInfo extends Component
{
    public $user;
    public int $subscribers = 0;
    public int $subscribed = 0;
    public bool $loaded = false;

    #[On('profileSubscriptionsUpdate')]
    public function updateSubscriptions(){
        $new_subscribers = $this->user->subscribersCount;

        if( Auth::check() && $this->user->id == Auth::user()->id && $this->loaded ){
            if( $new_subscribers > $this->subscribers ){
                $this->js( <<<EOF
                    let rect = $("#subscribers-count-render")[0].getBoundingClientRect();
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
            }elseif( $new_subscribers < $this->subscribers ){
                $this->js( <<<EOF
                    let rect = $("#subscribers-count-render")[0].getBoundingClientRect();
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

        $this->loaded = true;
        $this->subscribers = $new_subscribers;
        $this->subscribed = $this->user->subscribedCount;
    }

    public function render()
    {
        $this->updateSubscriptions();

        return view('livewire.subscriptions-info');
    }
}
