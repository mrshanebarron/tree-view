@php
    $hasChildren = isset($item['children']) && count($item['children']) > 0;
    $isExpanded = in_array($item['id'], $this->expanded);
    $isSelected = $this->selected === $item['id'];
@endphp

<div style="padding-left: {{ $level * 16 }}px;">
    <div style="display: flex; align-items: center; gap: 8px; padding: 6px 8px; border-radius: 8px; cursor: pointer; transition: background-color 0.15s; {{ $isSelected ? 'background: #eff6ff; color: #1d4ed8;' : '' }}"
        onmouseover="if(!{{ $isSelected ? 'true' : 'false' }}) this.style.background='#f3f4f6'"
        onmouseout="if(!{{ $isSelected ? 'true' : 'false' }}) this.style.background='transparent'"
    >
        @if($hasChildren)
            <button wire:click="toggle('{{ $item['id'] }}')" style="padding: 2px; background: transparent; border: none; border-radius: 4px; cursor: pointer;">
                <svg style="width: 16px; height: 16px; color: #6b7280; transition: transform 0.15s; {{ $isExpanded ? 'transform: rotate(90deg);' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        @else
            <span style="width: 20px;"></span>
        @endif

        @if($this->showIcons)
            @if($hasChildren)
                <svg style="width: 16px; height: 16px; color: {{ $isExpanded ? '#eab308' : '#ca8a04' }};" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                </svg>
            @else
                <svg style="width: 16px; height: 16px; color: #9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            @endif
        @endif

        <span wire:click="select('{{ $item['id'] }}')" style="flex: 1;">{{ $item['label'] }}</span>

        @if(isset($item['badge']))
            <span style="padding: 2px 8px; font-size: 12px; background: #e5e7eb; border-radius: 9999px;">{{ $item['badge'] }}</span>
        @endif
    </div>

    @if($hasChildren && $isExpanded)
        @foreach($item['children'] as $child)
            @include('sb-tree-view::partials.tree-item', ['item' => $child, 'level' => $level + 1])
        @endforeach
    @endif
</div>
