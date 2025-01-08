<script setup lang="ts"></script>
<template>
  <div class="space-y-10 py-8">
    <div class="space-y-8">
      <h3 class="text-2xl font-bold">
        Comparison of Terminal vs Graphical Interfaces
      </h3>
      <div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
          <div class="">
            <h3 class="mb-2 text-xl font-semibold">Terminal Interfaces</h3>
            <ul class="list-disc pl-6">
              <li>Text-based</li>
              <li>Powerful</li>
              <li>Flexible</li>
              <li>Learning Curve</li>
            </ul>
          </div>
          <div>
            <h3 class="mb-2 text-xl font-semibold">
              Graphical Interfaces (GUIs)
            </h3>
            <ul class="list-disc pl-6">
              <li>User-Friendly</li>
              <li>Point-and-Click</li>
              <li>Limited Control</li>
              <li>Resource Intensive</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="space-y-3">
      <h3 class="mb-2 mt-8 text-2xl font-semibold">Key Differences</h3>
      <ul class="list-disc space-y-2 pl-6">
        <li>
          <b>Interaction:</b> Terminal: Command-line input; GUI: Mouse input and
          visual elements.
        </li>
        <li>
          <b>Control:</b> Terminal: More direct and granular control; GUI: More
          user-friendly but potentially less powerful.
        </li>
        <li>
          <b>Learning Curve:</b> Terminal: Steeper initial learning curve; GUI:
          Generally more intuitive.
        </li>
        <li>
          <b>Efficiency:</b> Terminal: Can be highly efficient for experienced
          users; GUI: May be slower for complex tasks.
        </li>
        <li>
          <b>Resource Usage:</b> Terminal: Generally less resource-intensive;
          GUI: Can consume more system resources.
        </li>
      </ul>
    </div>
  </div>
</template>
