<?php

Breadcrumbs::register('index.home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('index.home'));
});
