FROM ubuntu:latest
RUN apt-get update
ENV TZ=Europe/Istanbul
RUN apt-get install -yq tzdata
RUN apt-get install -yq php
RUN apt-get install -yq php-mysql
RUN apt-get install -yq apache2
RUN apt-get install -yq php-pdo
RUN a2enmod rewrite
WORKDIR /var/www/html
CMD ["apache2ctl", "-D", "FOREGROUND"]