@props(['tank'])
{{-- <canvas class="tank-level-chart" data-id="{{ $tank->id }}" data-percentage="{{ $tank->currentLevelPercentage }}" style="height: 200px"></canvas> --}}
<div class="d-flex justify-content-center align-items-center">
    <h2 class="m-5">
        {{ number_format($tank->currentLevelPercentage, 2) }} %
    </h2>
</div>
