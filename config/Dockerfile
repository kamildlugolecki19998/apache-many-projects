# Użycie oficjalnego obrazu PHP z Apache
FROM php:8.2-apache

# Instalacja niezbędnych zależności i rozszerzeń PHP dla WordPress i Symfony
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \ 
    sudo \
    nano \
     # Dodajemy libicu-dev, który jest potrzebny do intl
    libicu-dev \ 
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd zip intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/

# Instalacja Composera
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Włączenie modułów Apache niezbędnych dla Symfony i WordPress (mod_rewrite, mod_headers)
RUN a2enmod rewrite headers vhost_alias proxy proxy_http

# Skopiowanie konfiguracji VirtualHost
# COPY ./apache/vhosts.conf /etc/apache2/sites-available/000-default.conf

# COPY ./config/apache/symfony.conf /etc/apache2/sites-available/symfony.conf
# COPY ./config/apache/wordpress.conf /etc/apache2/sites-available/wordpress.conf

COPY ./config/apache/dynamic_hosts.conf /etc/apache2/sites-available/dynamic_hosts.conf
COPY ./config/apache/hosts /etc/hosts

# RUN a2ensite symfony.conf
# RUN a2ensite wordpress.conf
# Włączenie odpowiedniego configu dla apache
RUN a2ensite dynamic_hosts.conf

# Wyłączenie domyślengo configu dla apache
RUN a2dissite 000-default.conf

RUN groupadd -r apache && \
    useradd -r -g apache apache -p ""

RUN usermod -u 1000 apache && groupmod -g 1000 apache

# Dodanie komendy aby po wpisaniu run wykonuwać wszystko jako user apache 
RUN echo '#!/bin/bash\n su apache -c "$@"' > /usr/local/bin/run
RUN chmod +x /usr/local/bin/run

# Tworzenie katalogów na aplikacje Symfony i WordPress
# dla odzizlnych v host z publiuc 
# RUN mkdir -p /var/www/symfony/public_html
# RUN mkdir -p /var/www/wordpress/public_html

# RUN mkdir -p /var/www/moja_domena/symfony
# RUN mkdir -p /var/www/moja_domena/wordpress
# RUN mkdir -p /var/www/moja_domena/symfonyeasyadmin
RUN mkdir -p /var/www/moja_domena


COPY ./projects/ /var/www/moja_domena/

# change privileges for regular user
# RUN chown -R apache:apache /var/www/moja_domena/symfony
# RUN chown -R apache:apache /var/www/moja_domena/wordpress
# RUN chown -R apache:apache /var/www/moja_domena/symfonyeasyadmin
RUN chown -R apache:apache /var/www/moja_domena
# RUN chown -R www-data:www-data /var/www/moja_domena/symfonyeasyadmin

#install compser dependencies
# RUN run "composer update --working-dir=/var/www/moja_domena/symfonyeasyadmin"
RUN run "composer install --working-dir=/var/www/moja_domena/symfonyeasyadmin"
RUN run "composer install --working-dir=/var/www/moja_domena/apiplatform3p1"

RUN chmod -R 755 /var/www   

RUN ln -s /var/www/moja_domena/symfonyeasyadmin /var/www/html/symfonyeasyadmin
RUN ln -s /var/www/moja_domena/apiplatform3p1 /var/www/html/apiplatform3p1

# Ustawienie domyślnego użytkownika i grupy Apache oraz folderów z logami
ENV APACHE_RUN_USER apache
ENV APACHE_RUN_GROUP apache
ENV APACHE_LOG_DIR /var/log/apache2

WORKDIR /var/www/moja_domena

# Eksponowanie portu 80 dla serwera Apache
EXPOSE 80

# Restart Apache w przypadku zmian
CMD ["apache2-foreground"]