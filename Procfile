web: composer warmup && $(composer config bin-dir)/heroku-php-apache2 public/
supervisor: supervisord -c supervisor.conf -n # update config path relative to Procfile
worker: php artisan queue:work --queue=high,default --tries=3 --memory=64 --sleep=3
