<div class="form-group">
    <div class="col-md-12">
        {!! Form::label('name_'. $locale, trans('gallery::admin.category.field.name')) !!}
        {!! Form::text('name_'. $locale, isset($category) && ($content = $category->content($locale, false)) ? $content->name : '', ['class' => 'form-control']) !!}
    </div>
</div>