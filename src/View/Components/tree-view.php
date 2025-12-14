<?php

namespace MrShaneBarron\tree-view\View\Components;

use Illuminate\View\Component;

class tree-view extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('sb-tree-view::components.tree-view');
    }
}
