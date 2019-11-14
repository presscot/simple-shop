#!/usr/bin/env bash

APP="php"

COMMAND="${APP} ${@}"

docker exec -i $(docker ps --filter="name=simple-shop_fpm" -q) cmd "${COMMAND}"
