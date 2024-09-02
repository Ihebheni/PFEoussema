<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SweetAlert extends Component
{
    public $type;
    public $title;
    public $text;
    public $footer;
    /**
     * Create a new component instance.
     */
     public function __construct($type = 'success', $title = 'Success!', $text = '', $footer = '')
     {
         $this->type = $type;
         $this->title = $title;
         $this->text = $text;
         $this->footer = $footer;
     }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sweet-alert');
    }
}
