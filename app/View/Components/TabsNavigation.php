<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TabsNavigation extends Component
{
    public array $tabs;
    public string $defaultTab;

    public function __construct(array $tabs, string $defaultTab)
    {
        $this->tabs = $tabs;
        $this->defaultTab = $defaultTab;
    }

    public function render()
    {
        return view('components.tabs-navigation');
    }
}
