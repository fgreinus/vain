@extends('app')

@section('title')
    @lang('chartrans::chartrans.title.index')
@stop

@section('content')

    <div class="container">

        @include('chartrans::steps.stepbar')

        {!! Form::open(['route' => 'chartrans.step.two.store']) !!}
        {!! Form::hidden('source_server_type', $chartrans->source_server_type, ['id' => 'source_server_type']) !!}
        <div class="chartrans-content-body">

            <h3 class="col-sm-12">@lang('chartrans::chartrans.step.two.caption')</h3>

            <br><br>
            <br><br>

            <div class="col-sm-12 text-center">
                <div class="btn-group">
                    <button class="btn btn-lg btn-default
                    @if($chartrans->source_server_type === false) active @endif
                    " type="button" data-server-type="private">
                        <i class="fa fa-code-fork"></i> @lang('chartrans::chartrans.step.two.type.private')
                    </button>
                    <button class="btn btn-lg btn-default
                    @if($chartrans->source_server_type === true) active @endif
                    " type="button" data-server-type="official">
                        @lang('chartrans::chartrans.step.two.type.official') <i class="fa fa-money"></i>
                    </button>
                </div>
            </div>

            <div class="clearfix"></div>
            <br><br>

            <div class="col-sm-12">

                <div class="col-sm-6">
                    <div class="panel panel-default" data-server-type="private">

                        @if($chartrans->source_server_type !== false)
                            <div class="chartrans-disable-overlay"></div>
                        @endif

                        <div class="panel-heading">
                            Private server information
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="source_server_website">URL of the server's website:</label>
                                <input type="text" class="form-control" name="source_server_website" id="source_server_website" value="{{ $chartrans->source_server_website }}">
                            </div>
                            <div class="form-group">
                                <label for="source_server_realm">Name of the source realm:</label>
                                <input type="text" class="form-control" name="source_server_realm" id="source_server_realm" value="{{ $chartrans->source_server_realm }}">
                            </div>
                            <div class="form-group">
                                <label for="source_character_name">Name of the account you want to transfer from:</label>
                                <input type="text" class="form-control" name="source_character_name" id="source_character_name" value="{{ $chartrans->source_character_name }}">
                            </div>
                            <div class="form-group">
                                <label for="source_character_name">Name of the character you want to transfer:</label>
                                <input type="text" class="form-control" name="source_character_name" id="source_character_name" value="{{ $chartrans->source_character_name }}">
                            </div>
                            <div class="form-group tagsinput-chartrans">
                                <label for="source_server_account_characters">All characters on that account (max. 10):</label>
                                <select name="source_server_account_characters[]" multiple data-tags data-tags-max="10" data-tags-class="label label-warning"></select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2"></div>

                <div class="col-sm-6">
                    <div class="panel panel-default" data-server-type="official">

                        @if($chartrans->source_server_type !== true)
                            <div class="chartrans-disable-overlay"></div>
                        @endif

                        <div class="panel-heading">
                            Retail server information
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="source_server_realm">Name of the blizzard realm you want to transfer from:</label>
                                <input type="text" class="form-control" name="source_server_realm" id="source_server_realm" value="{{ $chartrans->source_server_realm }}">
                            </div>
                            <div class="form-group">
                                <label for="source_server_account">Email of the battle.net-Account you want to transfer from:</label>
                                <input type="text" class="form-control" name="source_server_account" id="source_server_account" value="{{ $chartrans->source_server_account }}">
                            </div>
                            <div class="form-group">
                                <label for="source_server_character">Name of the character you want to transfer:</label>
                                <input type="text" class="form-control" name="source_server_character" id="source_server_character" value="{{ $chartrans->source_server_character }}">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <a href="{{ route('chartrans.step.one.show') }}" class="btn btn-default pull-left">@lang('chartrans::chartrans.step.button.backwards')</a>
            {!! Form::submit(trans('chartrans::chartrans.step.button.forward'), ['class' => 'btn btn-success pull-right']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@stop