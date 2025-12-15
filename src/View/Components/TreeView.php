<?php

namespace MrShaneBarron\TreeView\View\Components;

use Illuminate\View\Component;

class TreeView extends Component
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
