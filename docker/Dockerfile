# Базовый образ с nginx и php
FROM richarvey/nginx-php-fpm


# Install required system packages
#RUN apt-get update && \
#    apt-get -y install \
#            git \
#            zlib1g-dev \
#            libssl-dev \
#        --no-install-recommends && \
#        apt-get clean && \
#        rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


#ENV COMPOSER_ALLOW_SUPERUSER=1
#RUN curl -sS https://getcomposer.org/installer | php -- \
#        --filename=composer \
#        --install-dir=/usr/local/bin
# Добавляем наше веб приложение
ADD app /var/www/app

# Удаляем конфиги сайтов которые там есть
RUN rm -Rf /etc/nginx/sites-enabled/*

# Добавляем наш конфиг
ADD docker/conf/nginx/site.conf /etc/nginx/sites-available/site.conf
# Включаем его
RUN ln -s /etc/nginx/sites-available/site.conf /etc/nginx/sites-enabled/site.conf