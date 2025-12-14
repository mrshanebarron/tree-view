<template>
  <ul :class="[isRoot && 'space-y-1']">
    <li v-for="node in nodes" :key="node.id || node.label">
      <div
        :class="['flex items-center gap-2 py-1 px-2 rounded-md hover:bg-gray-100 cursor-pointer', selectedId === node.id && 'bg-blue-50 text-blue-700']"
        :style="{ paddingLeft: (level * 20) + 8 + 'px' }"
        @click="handleClick(node)"
      >
        <button
          v-if="node.children?.length"
          @click.stop="toggle(node)"
          class="w-4 h-4 flex items-center justify-center text-gray-400"
        >
          <svg :class="['w-3 h-3 transition-transform', expanded[node.id] && 'rotate-90']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </button>
        <span v-else class="w-4"></span>

        <span v-if="node.icon" v-html="node.icon" class="w-4 h-4 text-gray-500"></span>

        <span class="text-sm">{{ node.label }}</span>
      </div>

      <TreeView
        v-if="node.children?.length && expanded[node.id]"
        :nodes="node.children"
        :level="level + 1"
        :selected-id="selectedId"
        :expanded="expanded"
        :is-root="false"
        @select="$emit('select', $event)"
        @toggle="$emit('toggle', $event)"
      />
    </li>
  </ul>
</template>

<script>
import { reactive } from 'vue';

export default {
  name: 'SbTreeView',
  props: {
    nodes: { type: Array, default: () => [] },
    level: { type: Number, default: 0 },
    selectedId: { type: [String, Number], default: null },
    expanded: { type: Object, default: () => ({}) },
    isRoot: { type: Boolean, default: true }
  },
  emits: ['select', 'toggle'],
  setup(props, { emit }) {
    const expanded = props.isRoot ? reactive({}) : props.expanded;

    const toggle = (node) => {
      if (props.isRoot) {
        expanded[node.id] = !expanded[node.id];
      }
      emit('toggle', node);
    };

    const handleClick = (node) => {
      emit('select', node);
    };

    return { expanded: props.isRoot ? expanded : props.expanded, toggle, handleClick };
  }
};
</script>
