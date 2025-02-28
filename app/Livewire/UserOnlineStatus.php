<?php

namespace App\Livewire;

use Livewire\Component;

class UserOnlineStatus extends Component
{
    public $user;
    public $status = 0;

    public function updateStatus()
    {
        $this->status = $this->user->online;
    }

    public function render()
    {
        $this->updateStatus();
        return view('livewire.user-online-status');
    }
}
