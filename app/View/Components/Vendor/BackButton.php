<?php

namespace App\View\Components\Vendor;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BackButton extends Component
{
    public $route;
    /**
     * Create a new component instance.
     */
    public function __construct($route = '#')
    {
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.vendor.back-button');
    }
}
