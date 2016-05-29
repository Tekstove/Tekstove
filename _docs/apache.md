2enmod proxy
a2enmod proxy_http

example config:


<VirtualHost *:80>
        ServerName tekstove.fb
        ServerAdmin webmaster@localhost

        DocumentRoot /var/www/tekstoveSymfony/web

        Options -MultiViews

        SuexecUserGroup potaka potaka

        <Directory /var/www/tekstoveSymfony>
                Options +ExecCGI
                AddHandler fcgid-script .php
                FCGIWrapper /var/www/php-fcgi-scripts/tekstoveSymfony/php-fcgi-starter .php
        </Directory>

    ProxyPass /proxy/api/ http://api.tekstove.fb/
    ProxyPassReverse /proxy/api/ http://api.tekstove.fb:80/

    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_URI} !^/proxy/
    RewriteCond %{REQUEST_URI} !\.(css|js|gif|png|jpg|ico)$
    RewriteRule ^ /app_dev.php [QSA,L]

        <filesmatch "\.(ico|css|gif|jpg|png)$">
                Header set Cache-Control "max-age=34560000, public"
        </filesmatch>

        ErrorLog ${APACHE_LOG_DIR}/error.log

        # Possible values include: debug, info, notice, warn, error, crit,
        # alert, emerg.
        LogLevel warn

        CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
