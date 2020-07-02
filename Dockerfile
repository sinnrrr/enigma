FROM ubuntu

LABEL maintainer="Dmytro Soltusyuk <dimasoltusyuk@gmail.com>"

RUN apt update -y
RUN apt install nginx -y
RUN ufw allow 'Nginx HTTP'

RUN echo "\ndaemon off;" >> /etc/nginx/nginx.conf
RUN chown -R www-data:www-data /var/lib/nginx

VOLUME ["/etc/nginx/sites-enabled", "/etc/nginx/certs", "/var/log/nginx"]

EXPOSE 80 443

ADD nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /etc/nginx

CMD ["nginx"]