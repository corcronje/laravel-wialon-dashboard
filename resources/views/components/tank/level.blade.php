@props(['tank'])
{{-- <canvas class="tank-level-chart" data-id="{{ $tank->id }}" data-percentage="{{ $tank->currentLevelPercentage }}" style="height: 200px"></canvas> --}}
<div class="d-flex justify-content-center align-items-center">
    <h2 class="m-5">
        {{ $tank->currentLevelPercentage }} %
    </h2>
</div>
