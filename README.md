# Dynatable
Very simple server-side Dynatable handler for Laravel 4. It handle the ajax calls from a jquery dynatable plugin in the front end.

Using this plugin you can use server-side (ajax) pagination, sorting, global search and specific search.

With a simple API you can customize all handlings such as search, sort, column display.

# Installation

## Laravel 5

Install the package using composer :

    composer require ifnot/dynatable:2.*

Register the service provider for the facade :

	Ifnot\Dynatable\DynatableServiceProvider::class

**Laravel 4 : see v1 branch**

# Usage

## Sample usage

```php
<?php
class MyController {
  public function dynatable()
  {
    // Get fluent collection of what you want to show in dynatable
    $cars = Car::all();
    $columns = ['id', 'name', 'price', 'stock'];
    
    // Build dynatable response
    return new Dynatable($cars, $columns, Input::all())->make();
  }
}
```