# Для начала указываем исходный образ, он будет использован как основа
FROM php:7.4-fpm-alpine

# RUN выполняет идущую за ней команду в контексте нашего образа.
# В данном случае мы установим некоторые зависимости и модули PHP.
# Для установки модулей используем команду docker-php-ext-install.
RUN apk add \
        curl \
	libzip-dev \
	libmcrypt-dev \
        && docker-php-ext-install -j$(nproc) iconv mysqli pdo_mysql zip

# Куда же без composer'а.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ARG ENV_TYPE
ENV ENV_TYPE=${ENV_TYPE}

# Добавим свой php.ini, можем в нем определять свои значения конфига
ADD php.ini.${ENV_TYPE} /usr/local/etc/php/conf.d/40-custom.ini

# Копируем исходники в контейнер
COPY ./api /var/www/api

ARG DB_HOST
ARG DB_USERNAME
ARG DB_PASSWORD
ARG DB_NAME
ENV DB_HOST=${DB_HOST}
ENV DB_USERNAME=${DB_USERNAME}
ENV DB_PASSWORD=${DB_PASSWORD}
ENV DB_NAME=${DB_NAME}

# Указываем рабочую директорию для PHP
WORKDIR /var/www

# Запускаем контейнер
CMD ["php-fpm"]
