<?php

// Normal site
// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > About
Breadcrumbs::for('features', function ($trail) {
    $trail->parent('home');
    $trail->push('Features', route('features'));
});

// App (account)
Breadcrumbs::for('app', function ($trail) {
    $trail->push('Account', route('dashboard'));
});
// App > Articles
Breadcrumbs::for('articles.index', function ($trail) {
    $trail->parent('app');
    $trail->push('Acticles', route('articles.index'));
});
Breadcrumbs::for('articles.show', function ($trail, $item) {
    $trail->parent('articles.index');
    $trail->push($item->name, route('articles.show', $item->id));
});
Breadcrumbs::for('articles.form', function ($trail, $item) {
    if ($item->exists) {
        $trail->parent('articles.show', $item);
        $trail->push(__('Edit'), route('articles.edit', $item->id));
    }
    else {
        $trail->parent('articles.index');
        $trail->push(__('Create'), route('articles.create'));
    }
});

// App > Characters
Breadcrumbs::for('characters.index', function ($trail) {
    $trail->parent('app');
    $trail->push('Characters', route('characters.index'));
});
Breadcrumbs::for('characters.show', function ($trail, $item) {
    $trail->parent('characters.index');
    $trail->push($item->name, route('characters.show', $item->id));
});
Breadcrumbs::for('characters.form', function ($trail, $item) {
    if ($item->exists) {
        $trail->parent('characters.show', $item);
        $trail->push(__('Edit'), route('characters.edit', $item->id));
    }
    else {
        $trail->parent('characters.index');
        $trail->push(__('Create'), route('characters.create'));
    }
});
Breadcrumbs::for('characters.relations', function ($trail) {
    $trail->parent('characters.index');
    $trail->push(__('Relations'), route('characters.relations'));
});

// App > Organisations
Breadcrumbs::for('organisations.index', function ($trail) {
    $trail->parent('app');
    $trail->push('Organisations', route('organisations.index'));
});
Breadcrumbs::for('organisations.show', function ($trail, $item) {
    $trail->parent('organisations.index');
    $trail->push($item->name, route('organisations.show', $item->id));
});
Breadcrumbs::for('organisations.form', function ($trail, $item) {
    if ($item->exists) {
        $trail->parent('organisations.show', $item);
        $trail->push(__('Edit'), route('organisations.edit', $item->id));
    }
    else {
        $trail->parent('characters.index');
        $trail->push(__('Create'), route('organisations.create'));
    }
});

// App > Locations
Breadcrumbs::for('locations.index', function ($trail) {
    $trail->parent('app');
    $trail->push('Locations', route('locations.index'));
});
Breadcrumbs::for('locations.show', function ($trail, $item) {
    $trail->parent('locations.index');
    foreach ($item->ancestors()->get() as $ancestor) {
        $trail->push($ancestor->name, route('locations.show', $ancestor->id));
    }
    $trail->push($item->name, route('locations.show', $item->id));
});
Breadcrumbs::for('locations.form', function ($trail, $item) {
    if ($item->exists) {
        $trail->parent('locations.show', $item);
        $trail->push(__('Edit'), route('locations.edit', $item->id));
    }
    else {
        $trail->parent('locations.index');
        $trail->push(__('Create'), route('locations.create'));
    }
});