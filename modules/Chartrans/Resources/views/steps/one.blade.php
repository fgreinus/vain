@extends('app')

@section('title')
    @lang('chartrans::chartrans.title.index')
@stop

@section('content')

    <div class="container">

        @include('chartrans::steps.stepbar')

        {!! Form::open(['route' => 'chartrans.step.one.store']) !!}
        {!! Form::hidden('destination_realm', $chartrans->destination_realm, ['id' => 'destination_realm']) !!}
        <div class="chartrans-content-body">
            <h3 class="col-sm-12">@lang('chartrans::chartrans.step.one.caption')</h3>

            <br><br><br><br><br>

            @foreach ($accounts as $realmId => $realmAccounts)
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <img src="{{ URL::asset('static/images/chartrans/'.$realms[$realmId]['expansion'].'.gif') }}">
                            {{ $realms[$realmId]['name'] }} <span class="text-muted pull-right">Patch {{ $realms[$realmId]['patch'] }}</span>
                        </div>
                        <ul class="list-group">
                            @foreach($realmAccounts as $accountId => $accountData)
                                <li class="list-group-item">
                                    <div class="radio">
                                        @if($accountData['qualified'])
                                            <span class="text-success pull-right"><i class="fa fa-check"></i> @lang('chartrans::chartrans.step.one.account.valid')</span>
                                        @else
                                            <span class="text-warning pull-right"><i class="fa fa-exclamation"></i> @lang('chartrans::chartrans.step.one.account.invalid')</span>
                                        @endif
                                        <label>
                                            <input type="radio" name="destination_account_id" data-destination-account
                                                data-realmid="{{ $realmId }}"
                                                @if($chartrans->destination_account_id == $accountId && $chartrans->destination_realm == $realmId) checked @endif
                                                value="{{ $accountId }}" @if(!$accountData['qualified']) disabled @endif >
                                            <span class="text @if(!$accountData['qualified']) text-muted @endif ">{{ $accountData['name'] }}</span>
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach

            <div class="clearfix"></div>
        </div>

        <div class="col-sm-12">
            {!! Form::submit(trans('chartrans::chartrans.step.button.forward'), ['class' => 'btn btn-success pull-right']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@stop