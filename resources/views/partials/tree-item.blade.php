@php
    $hasChildren = isset($item['children']) && count($item['children']) > 0;
    $isExpanded = in_array($item['id'], $expanded);
    $isSelected = $selected === $item['id'];
@endphp

<div style="padding-left: {{ $level * 16 }}px">
    <div @class([
        'flex items-center gap-2 py-1.5 px-2 rounded-lg cursor-pointer transition-colors',
        'bg-blue-50 text-blue-700' => $isSelected,
        'hover:bg-gray-100' => !$isSelected,
    ])>
        @if($hasChildren)
            <button wire:click="toggle('{{ $item['id'] }}')" class="p-0.5 hover:bg-gray-200 rounded">
                <svg class="w-4 h-4 text-gray-500 transition-transform {{ $isExpanded ? 'rotate-90' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        @else
            <span class="w-5"></span>
        @endif

        @if($showIcons)
            @if($hasChildren)
                <svg class="w-4 h-4 {{ $isExpanded ? 'text-yellow-500' : 'text-yellow-600' }}" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                </svg>
            @else
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            @endif
        @endif

        <span wire:click="select('{{ $item['id'] }}')" class="flex-1">{{ $item['label'] }}</span>

        @if(isset($item['badge']))
            <span class="px-2 py-0.5 text-xs bg-gray-200 rounded-full">{{ $item['badge'] }}</span>
        @endif
    </div>

    @if($hasChildren && $isExpanded)
        @foreach($item['children'] as $child)
            @include('sb-tree-view::partials.tree-item', ['item' => $child, 'level' => $level + 1])
        @endforeach
    @endif
</div>
