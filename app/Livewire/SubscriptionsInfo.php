<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\User;

class SubscriptionsInfo extends Component
{
    public $user;
    public int $subscribers = 0;
    public int $subscribed = 0;

    #[On('profileSubscriptionsUpdate')]
    public function updateSubscriptions(){
        $this->subscribers = $this->user->subscribersCount;
        $this->subscribed = $this->user->subscribedCount;
    }

    public function render()
    {
        $this->updateSubscriptions();

        return view('livewire.subscriptions-info');
    }
}
