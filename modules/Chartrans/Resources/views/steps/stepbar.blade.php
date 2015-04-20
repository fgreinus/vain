<div class="row bs-wizard" style="border-bottom:0;">
    <div class="col-sm-1"></div>
    @foreach(['one', 'two', 'three', 'four', 'five'] as $index => $stepNum)
        @include('chartrans::steps.step')
    @endforeach
    <div class="col-sm-1"></div>
</div>