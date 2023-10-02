FROM php:8.0-apache
WORKDIR /var/www/html
RUN apt-get update \
  && apt-get install -y libpq-dev \
  && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
  && docker-php-ext-install pdo pdo_pgsql pgsql
RUN a2enmod rewrite
RUN apt-get -y update && apt-get -y upgrade && apt-get install -y ffmpeg
EXPOSE 80