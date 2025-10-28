<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Breadcrumbs extends Component
{
    public $segments;
    public $url;

    public function __construct()
    {
        $this->segments = request()->segments();
        $this->url = url('/');
    }

    public function render()
    {
        return view('components.breadcrumbs');
    }
}

