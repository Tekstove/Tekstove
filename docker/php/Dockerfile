FROM debian:8

RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y apt-transport-https lsb-release ca-certificates wget vim
RUN cd /root && wget https://www.dotdeb.org/dotdeb.gpg && apt-key add dotdeb.gpg

RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list

RUN echo "deb http://ftp.bg.debian.org/debian/ jessie main contrib non-free" >> /etc/apt/sources.list
RUN echo "deb-src http://ftp.bg.debian.org/debian/ jessie main contrib non-free" >> /etc/apt/sources.list
RUN apt-get update

RUN apt-get install -y php7.1-cgi php7.1-xml php7.1-mysql php7.1-mbstring \
                       git unzip curl \
                       apache2 libapache2-mod-fastcgi apache2-mpm-worker apache2-suexec libapache2-mod-fcgid
RUN a2enmod actions fastcgi rewrite

RUN wget "https://getcomposer.org/download/1.6.5/composer.phar" -q -O /bin/composer && chmod +x /bin/composer

RUN a2enmod ssl suexec
COPY tekstove-site-ssl.conf /etc/apache2/sites-available/tekstove-site-ssl.conf
COPY tekstove-site.conf /etc/apache2/sites-available/tekstove-site.conf
RUN  a2dissite 000-default && a2ensite tekstove-site && a2ensite tekstove-site-ssl
COPY cert/server.key /etc/ssl/private/apache-selfsigned.key
COPY cert/server.crt /etc/ssl/certs/apache-selfsigned.crt
RUN sed 's/.*cgi.fix_pathinfo=.*/cgi.fix_pathinfo=1/' /etc/php/7.1/cgi/php.ini > /etc/php/7.1/cgi/php.ini
RUN groupadd site_tekstove_www
RUN useradd -s /bin/false -d /home/web -m -g site_tekstove_www site_tekstove_www
RUN mkdir -p /home/site_tekstove_www
RUN chown -R site_tekstove_www:site_tekstove_www /home/site_tekstove_www
RUN mkdir -p /var/www/php-fcgi-scripts/tekstove_www
COPY fcgi-starter /var/www/php-fcgi-scripts/tekstove_www/php-fcgi-starter
RUN chown -R site_tekstove_www:site_tekstove_www /var/www/php-fcgi-scripts/tekstove_www
RUN chmod 755 /var/www/php-fcgi-scripts/tekstove_www/php-fcgi-starter

CMD if [ ! -d "/var/www/tekstove-site/var/cache" ] ; \
    then composer install -d /var/www/tekstove-site ; \
    fi ; \
    chmod 777 -R /var/www/tekstove-site/var/* && \
    /etc/init.d/apache2 restart && \
    tail -f /var/log/apache2/error.log
