#!/usr/bin/env bash
CC="${@}"

CURRENT=$(dirname $(realpath $0) )

if ! docker images | grep -q frontend_tools ;
then
    docker build -t frontend_tools "${CURRENT}/../docker/frontend-tools/"
fi

docker run --rm -i -v $(pwd):"/www" frontend_tools /bin/bash -c ". /root/.bashrc && bash -c '${CC}'"
