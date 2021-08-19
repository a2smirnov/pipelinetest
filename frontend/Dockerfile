FROM nginx:1.21.1-alpine
ENV ENV_TYPE=${{ env.ENV_TYPE }}
#убираем дефолтную конфигурацию
RUN rm /etc/nginx/conf.d/default.conf
#копируем конфигурацию NGINX
COPY ./hosts /etc/nginx/conf.d
COPY ./app_js /var/www/fe