FROM debian:10

RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install -y apt-transport-https lsb-release ca-certificates wget vim \
                            apache2 git unzip curl

RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list

ENV PHP_V="7.4"

RUN apt-get update && \
    apt-get install -y \
                php${PHP_V} \
                php${PHP_V}-xml \
                php${PHP_V}-mysql \
                php${PHP_V}-mbstring \
                php${PHP_V}-zip \
                php${PHP_V}-curl

RUN update-alternatives --set php /usr/bin/php${PHP_V}

RUN a2enmod actions rewrite ssl

RUN wget "https://getcomposer.org/download/1.6.5/composer.phar" -q -O /bin/composer && chmod +x /bin/composer

COPY tekstove-site-ssl.conf /etc/apache2/sites-available/tekstove-site-ssl.conf
COPY tekstove-site.conf /etc/apache2/sites-available/tekstove-site.conf
RUN  a2dissite 000-default && a2ensite tekstove-site && a2ensite tekstove-site-ssl
COPY cert/server.key /etc/ssl/private/apache-selfsigned.key
COPY cert/server.crt /etc/ssl/certs/apache-selfsigned.crt

WORKDIR /var/www/tekstove-site


ADD start.sh /start.sh

CMD bash /start.sh
