web: vendor/bin/heroku-php-apache2 public/ 
worker: php artisan queue:work --queue=high,default --tries=3 --memory=64 --sleep=3
