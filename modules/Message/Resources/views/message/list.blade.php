@extends('app')

@section('title')
    @lang('message::message.title.list')
@stop

@section('styles')
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojify.js/0.9.5/emojify.min.css" />--}}
@stop

@section('content')
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-xs-3">--}}
                {{--{!! link_to_route('message.message.create', trans('message::message.new_message'), [], ['class' => 'btn btn-success']) !!}--}}
            {{--</div>--}}
            {{--<div class="col-xs-9">--}}
                {{--a--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">--}}
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <a data-target="#modal-send-message" class="send-message-btn" role="button" data-toggle="modal">
                    <i class="fa fa-plus"></i> @lang('message::message.new_message')
                </a>
            </div>
            <div class="col-lg-8">
                @if($curThread)
                    <div class="btn-group pull-right">
                        <ul class="nav">
                            <li class="dropdown active" id="userlist">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#userlist">
                                    {{ $curThread->participantString(80) }}
                                    <i class="fa fa-user"></i>
                                    {{ $curThread->participants->count() }}
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-large scrollable-menu">
                                    <li>
                                        <a data-target="#modal-add-participant" class="add-participant-btn" role="button" data-toggle="modal">
                                            &nbsp;<span class="fa fa-plus"></span>
                                            @lang('message::message.add_participant')
                                        </a>
                                    </li>
                                    <li role="presentation" class="divider"></li>
                                    @foreach ($curThread->participants as $participant)
                                        <li>{!! link_to_route('user.profile', $participant->user->name, $participant->user_id) !!}</li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">

            <div class="conversation-wrap col-lg-3">

                @if ($threads->count() > 0)
                    @foreach ($threads as $thread)
                        <div class="media conversation media-message-link {!! $thread->classStates($curThread) !!}">
                            <a href="{!! URL::route('message.message.show', $thread->id) !!}"></a>
                            <div class="pull-left">
                                <img class="media-object" alt="{{ $thread->lastmessage->user->name }}" style="width: 50px; height: 50px;" src="{!! $thread->avatar !!}">
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading"><strong>{!! $thread->participantString(40) !!}</strong></h5>
                                <small class="emojimessage">{{ $thread->shortbody }}</small>
                            </div>
{{--                            <small class="pull-right time" title="{{ $thread->lastmessage->created_at }}"><i class="fa fa-clock-o"></i> {{ $thread->lastmessage->created_at->diffForHumans() }}</small>--}}
                        </div>
                    @endforeach
                @else
                    <div class="media conversation">
                        <div class="media-body text-center">
                            <small>@lang('message::message.no_messages')</small>
                        </div>
                    </div>
                @endif

            </div>

            <div class="message-wrap col-lg-8">
                <div class="msg-wrap" id="msg-wrap">
                    @if ($curThread)
                        @foreach ($curThread->messages as $message)
                            {{-- Not happy with this :x --}}
                            @if (!isset($lastDate) || $lastDate->format('Y-m-d') != $message->created_at->format('Y-m-d'))
                                <div class="alert alert-info msg-date">
                                    @if ($message->created_at->format('Y-m-d') == Carbon\Carbon::now()->format('Y-m-d'))
                                        <strong>@lang('message::message.today')</strong>
                                    @else
                                        <strong>{{ $message->created_at->format('d.m.Y') }}</strong>
                                    @endif
                                </div>
                            @endif
                            <?php $lastDate = $message->created_at; ?>

                            <div class="media msg">
                                <a class="pull-left" href="#">
                                    <img class="media-object" alt="{{ $message->user->name }}" style="width: 32px; height: 32px;" src="{!! $message->user->avatar !!}">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right time" title="{{ $message->created_at }}"><i class="fa fa-clock-o"></i> {{ $message->created_at->diffForHumans() }}</small>
                                    <h5 class="media-heading">
                                        {!! link_to_route('user.profile', $message->user->name, $message->user->id) !!}
                                    </h5>

                                    <small class="emojimessage">{{ $message->body }}</small>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>

                @if($curThread)
                    {!! Form::open(['method' => 'PUT', 'route' => ['message.message.update', $curThread->id]]) !!}
                        <div class="send-wrap ">
                            <div class="row">
                                <div class="col-lg-11">
                                    <textarea name="message" class="form-control send-message" rows="2" placeholder="@lang('message::message.write_a_reply')"></textarea>
                                </div>
                                <div class="col-lg-1">
                                    <button class="btn btn-block btn-default text-center">
                                        <i class="fa fa-smile-o"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="btn-panel">
                            {{--<a href="" class=" col-lg-3 btn   send-message-btn " role="button"><i class="fa fa-plus"></i> @lang('message::message.add_participant')</a>--}}
                            {{--<a class=" col-lg-4 text-right btn   send-message-btn pull-right" role="button"></a>--}}
                            <button type="submit" class="col-lg-4 text-right btn pull-right" role="button">
                                <i class="fa fa-envelope"></i> @lang('message::message.send_message')
                            </button>
                        </div>
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>

    {{-- New message modal --}}
    <div class="modal fade" id="modal-send-message" tabindex="-1" role="dialog" aria-labelledby="sendMessageLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route' => 'message.message.store']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="sendMessageLabel">@lang('message::message.send_message')</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            {!! Form::label('subject', trans('message::message.subject')) !!}
                            {!! Form::text('subject', null, ['class' => 'form-control']) !!}
                            <br/>

                            {!! Form::label('participants', trans('message::message.participants')) !!}
                            {!! Form::text('participants', null, ['class' => 'form-control']) !!}
                            <br/>

                            {!! Form::label('message', trans('message::message.message')) !!}
                            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Absenden', ['class' => 'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    {{-- Add participant modal --}}
    <div class="modal fade" id="modal-add-participant" tabindex="-1" role="dialog" aria-labelledby="addParticipantLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route' => 'message.message.store']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addParticipantLabel">@lang('message::message.send_message')</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            {!! Form::label('subject', trans('message::message.subject')) !!}
                            {!! Form::text('subject', null, ['class' => 'form-control']) !!}
                            <br/>

                            {!! Form::label('participants', trans('message::message.participants')) !!}
                            {!! Form::text('participants', null, ['class' => 'form-control']) !!}
                            <br/>

                            {!! Form::label('message', trans('message::message.message')) !!}
                            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Absenden', ['class' => 'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript">

        // ToDo: move js to external file
        $(document).ready(function() {
            // set conversation scroll bar to bottom
            var d = $('#msg-wrap');
            if (d)
                d.scrollTop(d.prop("scrollHeight"));

            // Emojify
            emojify.setConfig({
                img_dir: '/static/images/emojify',
                emoticons_enabled: true,
                people_enabled: true,
                nature_enabled: true,
                objects_enabled: true,
                places_enabled: true,
                symbols_enabled: true
                //mode: 'sprite'
            });
            $('.emojimessage').each(function() { emojify.run($(this)[0]); });
        });

    </script>
@stop