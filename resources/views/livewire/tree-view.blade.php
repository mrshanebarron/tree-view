<div style="font-size: 14px;">
    @foreach($this->items as $item)
        @include('sb-tree-view::partials.tree-item', ['item' => $item, 'level' => 0])
    @endforeach
</div>
