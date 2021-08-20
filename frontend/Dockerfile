FROM nginx:1.21.1-alpine
ARG ENV_TYPE
ENV ENV_TYPE=$ENV_TYPE
#убираем дефолтную конфигурацию
RUN rm /etc/nginx/conf.d/default.conf
#копируем конфигурацию NGINX
COPY ./hosts /etc/nginx/conf.d
#копируем исходники
COPY ./app_js /var/www/fe
COPY ./app_js/app/config/settings.js-$ENV_TYPE /var/www/fe/app/config/settings.js
