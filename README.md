# Dynatable
Very simple server-side Dynatable handler for Laravel 4. It handle the ajax calls from a jquery dynatable plugin in the front end.

Using this plugin you can use server-side (ajax) pagination, sorting, global search and specific search.

With a simple API you can customize all handlings such as search, sort, column display.

# Installation

## Laravel 4
    composer require white-frame/dynatable:1.*

**Laravel 5 : see v2 branch**

# Usage

## Sample usage

```php
<?php
class MyController {
  public function dynatable()
  {
    // Get a query builder of what you want to show in dynatable
    $cars = Car::where('year', '=', 2007); // or Car::query() for all cars
    $columns = ['id', 'name', 'price', 'stock'];
    
    // Build dynatable response
    return new Dynatable($cars, $columns, Input::all())->make();
  }
}
```

## Customize columns handling

API is quite similar to the dev-master branch. Please take a look at the new revision of this document.
