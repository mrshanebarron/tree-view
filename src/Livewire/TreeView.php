<?php

namespace MrShaneBarron\TreeView\Livewire;

use Livewire\Component;

class TreeView extends Component
{
    public array $items = [];
    public array $expanded = [];
    public ?string $selected = null;
    public bool $showIcons = true;

    public function mount(
        array $items = [],
        array $expanded = [],
        ?string $selected = null,
        bool $showIcons = true
    ): void {
        $this->items = $items;
        $this->expanded = $expanded;
        $this->selected = $selected;
        $this->showIcons = $showIcons;
    }

    public function toggle(string $id): void
    {
        if (in_array($id, $this->expanded)) {
            $this->expanded = array_values(array_diff($this->expanded, [$id]));
        } else {
            $this->expanded[] = $id;
        }
    }

    public function select(string $id): void
    {
        $this->selected = $id;
        $this->dispatch('item-selected', id: $id);
    }

    public function render()
    {
        return view('sb-tree-view::livewire.tree-view');
    }
}
