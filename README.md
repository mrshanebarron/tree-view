# Tree View

Hierarchical tree structure component for Laravel applications. Supports nested items, expand/collapse, selection, and custom icons. Works with Livewire and Vue 3.

## Installation

```bash
composer require mrshanebarron/tree-view
```

## Livewire Usage

### Basic Usage

```blade
@php
$items = [
    [
        'id' => 'src',
        'label' => 'src',
        'icon' => 'folder',
        'children' => [
            ['id' => 'app', 'label' => 'App.vue', 'icon' => 'file'],
            ['id' => 'main', 'label' => 'main.js', 'icon' => 'file'],
        ]
    ],
    ['id' => 'readme', 'label' => 'README.md', 'icon' => 'file'],
];
@endphp

<livewire:sb-tree-view :items="$items" />
```

### With Default Expanded

```blade
<livewire:sb-tree-view :items="$items" :expanded="['src', 'components']" />
```

### Selectable Items

```blade
<livewire:sb-tree-view :items="$items" :selectable="true" />
```

### With Icons

```blade
<livewire:sb-tree-view :items="$items" :show-icons="true" />
```

### Livewire Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `items` | array | `[]` | Tree structure array |
| `expanded` | array | `[]` | IDs of initially expanded nodes |
| `selectable` | boolean | `false` | Enable item selection |
| `showIcons` | boolean | `true` | Show folder/file icons |

### Item Structure

```php
$items = [
    [
        'id' => 'unique-id',       // Required: unique identifier
        'label' => 'Display Name', // Required: visible text
        'icon' => 'folder',        // Optional: 'folder' or 'file'
        'children' => [            // Optional: nested items
            ['id' => 'child-1', 'label' => 'Child Item', 'icon' => 'file'],
        ],
    ],
];
```

### Events

```blade
<livewire:sb-tree-view
    :items="$items"
    :selectable="true"
    @tree-item-selected="handleSelect"
/>
```

## Vue 3 Usage

### Setup

```javascript
import { SbTreeView } from './vendor/sb-tree-view';
app.component('SbTreeView', SbTreeView);
```

### Basic Usage

```vue
<template>
  <SbTreeView :items="items" />
</template>

<script setup>
const items = [
  {
    id: 'docs',
    label: 'Documents',
    icon: 'folder',
    children: [
      { id: 'resume', label: 'Resume.pdf', icon: 'file' },
    ]
  }
];
</script>
```

### With Selection

```vue
<template>
  <SbTreeView
    :items="items"
    :selectable="true"
    :expanded="['docs']"
    @selected="handleSelect"
  />
</template>

<script setup>
function handleSelect(id) {
  console.log('Selected:', id);
}
</script>
```

### Vue Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `items` | Array | `[]` | Tree items |
| `expanded` | Array | `[]` | Expanded node IDs |
| `selectable` | Boolean | `false` | Enable selection |
| `showIcons` | Boolean | `true` | Show icons |

### Events

| Event | Payload | Description |
|-------|---------|-------------|
| `selected` | string | Emitted when item is selected |
| `expanded` | string | Emitted when node is expanded |
| `collapsed` | string | Emitted when node is collapsed |

## Use Cases

### File Explorer

```php
$items = $this->buildFileTree(base_path());

private function buildFileTree(string $path): array
{
    $items = [];
    foreach (scandir($path) as $file) {
        if ($file === '.' || $file === '..') continue;

        $fullPath = $path . '/' . $file;
        $item = [
            'id' => $fullPath,
            'label' => $file,
            'icon' => is_dir($fullPath) ? 'folder' : 'file',
        ];

        if (is_dir($fullPath)) {
            $item['children'] = $this->buildFileTree($fullPath);
        }

        $items[] = $item;
    }
    return $items;
}
```

### Category Browser

```php
$items = Category::with('children')
    ->whereNull('parent_id')
    ->get()
    ->map(fn($cat) => $this->categoryToTreeItem($cat))
    ->toArray();

private function categoryToTreeItem($category): array
{
    return [
        'id' => (string) $category->id,
        'label' => $category->name,
        'icon' => $category->children->count() ? 'folder' : 'file',
        'children' => $category->children->map(
            fn($c) => $this->categoryToTreeItem($c)
        )->toArray(),
    ];
}
```

### Organization Chart

```php
$items = [
    [
        'id' => 'ceo',
        'label' => 'CEO',
        'icon' => 'folder',
        'children' => [
            [
                'id' => 'cto',
                'label' => 'CTO',
                'icon' => 'folder',
                'children' => [
                    ['id' => 'dev1', 'label' => 'Developer 1', 'icon' => 'file'],
                    ['id' => 'dev2', 'label' => 'Developer 2', 'icon' => 'file'],
                ]
            ],
            ['id' => 'cfo', 'label' => 'CFO', 'icon' => 'file'],
        ]
    ]
];
```

## Styling

The tree view includes:
- Indented nested levels
- Expand/collapse chevron icons
- Folder and file icons
- Selection highlight
- Hover effects

## Requirements

- PHP 8.1+
- Laravel 10, 11, or 12
- Tailwind CSS 3.x
- Alpine.js

## License

MIT License
