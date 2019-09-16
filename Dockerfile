FROM richarvey/nginx-php-fpm:latest

WORKDIR /var/www/html
ADD nginx.conf /etc/nginx/sites-enabled/default.conf
ADD app /var/www/html/app

EXPOSE 80 9000
