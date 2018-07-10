web: vendor/bin/heroku-php-apache2 public/ 
worker: php artisan queue:listen --sleep=60 --delay=60 --timeout=70
supervisor: supervisord -c supervisor.conf -n # update config path relative to Procfile
