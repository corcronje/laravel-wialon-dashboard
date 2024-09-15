@props(['tank'])
<canvas class="tank-level-chart" data-id="{{ $tank->id }}" data-percentage="{{ $tank->currentLevelPercentage }}" style="height: 200px"></canvas>
