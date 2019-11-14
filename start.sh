#!/usr/bin/env bash

echo '{}' > composer.lock
chmod 777 ./composer.lock
mkdir -m 777 vendor
chmod 0777 ./var -R

./bin/docker-compose.sh up -d
./bin/composer.sh install -n --optimize-autoloader
./bin/frontend.sh npm install
./bin/frontend.sh encore dev
./bin/php.sh ./bin/console doctrine:database:create
./bin/php.sh ./bin/console doctrine:migrations:migrate --no-interaction
./bin/php.sh bin/console server:run *:80
