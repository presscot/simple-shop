#!/bin/bash

echo ";" >> /etc/php-fpm.conf
#echo "env[APP_SERVER_NAME] = ${APP_SERVER_NAME}" >> /etc/php-fpm.conf
#echo "env[REDIS_PORT] = ${REDIS_PORT_6379_TCP_PORT}" >> /etc/php-fpm.conf
#echo "env[REDIS_ADDRESS] = ${REDIS_PORT_6379_TCP_ADDR}" >> /etc/php-fpm.conf

##sed -i '/^memory_limit =/c\memory_limit = 1024M' /usr/local/etc/php/php.ini

exec php-fpm #--nodaemonize --allow-to-run-as-root