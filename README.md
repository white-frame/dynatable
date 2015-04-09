# Dynatable
Very simple server-side Dynatable handler for Laravel 4

# Installation
    composer require ifnot/dynatable:dev-master

# Usage

```php
<?php
class MyController {
  public function dynatable()
  {
    // Get fluent collection of what you want to show in dynatable
    $cars = Car::all();
    $columns = ['id', 'name', 'price', 'stock'];
    
    // Build dynatable response
    return new Dynatable($cars, $columns, [])
      ->make();
  }
}
```
