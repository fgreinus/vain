<div class="col-xs-2 bs-wizard-step
    @if($chartrans->state == $index + 1) active @elseif($chartrans->state > $index + 1) complete @else disabled @endif
    @if($stepNum == $step) current @endif
        ">
    <div class="text-center bs-wizard-stepnum">@lang('chartrans::chartrans.step.num.'.$stepNum)</div>
    <div class="progress"><div class="progress-bar"></div></div>
    <a class="bs-wizard-dot"></a>
    <div class="bs-wizard-info text-center">@lang('chartrans::chartrans.step.description.'.$stepNum)</div>
</div>