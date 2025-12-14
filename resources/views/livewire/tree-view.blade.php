<div class="text-sm">
    @foreach($items as $item)
        @include('ld-tree-view::partials.tree-item', ['item' => $item, 'level' => 0])
    @endforeach
</div>
