## Migration & Seeding

> php artisan migrate\
> php artisan db:seed\
> php artisan migrate:fresh --seed

## Tests

> php artisan test

## Test for Logic

> App\Console\Commands\TestForLogicCommand.php

```
php artisan test:logic 3 5 6 0 7 0 1
php artisan test:logic 5 0 0 6 0 8
php artisan test:logic 1 2 3 0 0 0 0
php artisan test:logic 1 2 3
```

## Test for Refactor Code

> App\Console\Commands\TestForRefactorCommand.php

```
php artisan test:refactor --distance=350
```

## Test User Credential After Seed Data

> Email - test@gmail.com\
> Password - password
