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

    public function __construct($title, $image = null, $date)
    {
        $this->title = $title;
        $this->image = $image ?? config('app.urlDefaultImage');
        $this->date = $date;
    }

    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
