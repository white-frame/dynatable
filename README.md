# Dynatable
Very simple server-side [Dynatable](http://www.dynatable.com/) handler for Laravel. It handle the ajax calls from the [dynatable jquery plugin](http://www.dynatable.com/) in the front end.

Using this plugin you can use server-side (ajax) pagination, sorting, global search and specific search.

With a simple API you can customize all handlings such as search, sort, column display.

# Installation

## Laravel 5

Install the package using composer :

    composer require ifnot/dynatable:2.*

**Laravel 4 : see v1 branch**

# Usage

## Sample usage

This is a light working example :

```php
<?php
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Ifnot\Dynatable\Dynatable;

class UserController extends Controller
  public function dynatable(Request $request)
  {
    // Get a query builder of what you want to show in dynatable
    $cars = Car::where('year', '=', 2007);
    $columns = ['id', 'name', 'price', 'stock'];
    
    // Build dynatable response with your query builder, columns and all input from dynatable font end javascript
    $dynatable = Dynatable::of($cars, $columns, $request->all()));
    
    // ... Here you can do what you want here on $dynatable (see example below)
    
    // Build the response and return to the table
    return $dynatable->make();
  }
}
```

Change the content of a column :

```php
$dynatable->column('price', function($car) {
    return number_format($car->price) . ' $';
});
```

Add a new column for each row :
```php
$dynatable->column('actions', function($car) {
    return '<a href="/car/' . $car->id . '">View</a>';
});
```

Customize column sorting :
```php
$dynatable->sort('id', function($query, $mode) {
    return $query->orderBy('id', $mode == 'asc');
});
```

Customize global searching :
```php
$dynatable->search(function($query, $term) {
    return $query->where('name', 'LIKE', '%' . $term . '%');
});
```

Customize specific column searching :
```php
$dynatable->search('year', function($query, $term) {
    return $query->whereBetween('year', array($term - 5, $term + 5));
});
```
