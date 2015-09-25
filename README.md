# Dynatable
Very simple server-side Dynatable handler for Laravel 4. It handle the ajax calls from a jquery dynatable plugin in the front end.

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
    // Get fluent collection of what you want to show in dynatable
    $cars = Car::where('year', '=', 2007);
    $columns = ['id', 'name', 'price', 'stock'];
    
    // Build dynatable response
    return Dynatable::of($cars, $columns, $request->all())->make();
  }
}
```

