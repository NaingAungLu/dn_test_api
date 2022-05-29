php artisan db:seed
php artisan migrate:fresh --seed

./vendor/bin/phpunit
php artisan test

php artisan logic:test 3 5 6 0 7 0 1
php artisan logic:test 5 0 0 6 0 8
php artisan logic:test 1 2 3 0 0 0 0
php artisan logic:test 1 2 3
