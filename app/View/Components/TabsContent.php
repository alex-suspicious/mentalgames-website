<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TabsContent extends Component
{
    public function render()
    {
        return view('components.tabs-content');
    }
}
