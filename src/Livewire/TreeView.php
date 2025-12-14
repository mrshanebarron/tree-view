<?php

namespace MrShaneBarron\TreeView\Livewire;

use Livewire\Component;

class TreeView extends Component
{
    public array $items = [];
    public array $expanded = [];
    public bool $selectable = false;
    public ?string $selected = null;
    public bool $showIcons = true;

    public function mount(
        array $items = [],
        array $expanded = [],
        bool $selectable = false,
        bool $showIcons = true
    ): void {
        $this->items = $items;
        $this->expanded = $expanded;
        $this->selectable = $selectable;
        $this->showIcons = $showIcons;
    }

    public function toggle(string $id): void
    {
        if (in_array($id, $this->expanded)) {
            $this->expanded = array_diff($this->expanded, [$id]);
        } else {
            $this->expanded[] = $id;
        }
    }

    public function select(string $id): void
    {
        if ($this->selectable) {
            $this->selected = $id;
            $this->dispatch('tree-item-selected', id: $id);
        }
    }

    public function render()
    {
        return view('ld-tree-view::livewire.tree-view');
    }
}
