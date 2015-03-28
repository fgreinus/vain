@extends('site::admin.index')

@section('title')
    @lang('site::admin.title.edit')
@stop

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('site::admin.title.edit')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::model($page, [
            'class' => 'form-horizontal',
            'data-remote',
            'data-remote-success-message' => trans('site::admin.save.success'),
            'data-remote-error-message' => trans('site::admin.save.error'),
            'method' => 'PUT',
            'route' => ['site.admin.sites.update', $page->id]]) !!}

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include('site::admin.pages.form')

        {!! Form::close() !!}
    </section><!-- /.content -->
@endsection