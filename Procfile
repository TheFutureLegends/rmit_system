web: vendor/bin/heroku-php-apache2 public/
supervisor: supervisord -c supervisor.conf -n
worker: php artisan queue:restart && php artisan queue:work database --tries=3
