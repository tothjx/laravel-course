<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $image;
    public $date;

    /**
     * Create a new component instance.
     */
    public function __construct($title, $image = null, $date)
    {
        $this->title = $title;
        $this->image = $image ?? 'https://picsum.photos/400/250?random=default';
        $this->date = $date;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
