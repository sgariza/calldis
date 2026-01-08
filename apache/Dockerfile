ARG APACHE_VERSION=""
FROM httpd:${APACHE_VERSION:+${APACHE_VERSION}-}alpine

RUN apk update; \
    apk upgrade; \
    apk add openssl

# Copy apache vhost file to proxy php requests to php-fpm container
COPY calldis.apache.conf /usr/local/apache2/conf/calldis.apache.conf
RUN echo "Include /usr/local/apache2/conf/calldis.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf

# SSL 	
RUN mkdir -p /usr/local/apache2/ssl
RUN openssl req -new -newkey rsa:4096 -days 3650 -nodes -x509 -subj "/C=../ST=...../L=..../O=..../CN=..." -keyout /usr/local/apache2/ssl/ssl.key -out /usr/local/apache2/ssl/ssl.crt 
EXPOSE 443