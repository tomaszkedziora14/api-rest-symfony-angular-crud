FROM nginx

ADD docker/nginx/conf/vhost.conf /etc/nginx/conf.d/default.conf
COPY ./public /var/www/symfony-docker/public

WORKDIR /var/www/symfony-docker
