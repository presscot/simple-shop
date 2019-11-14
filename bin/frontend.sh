#!/usr/bin/env bash

APP="node_modules/${1}/bin/${1}"

CC="${@}"

COMMAND="${APP} ${@:2}"

COMMANDJS="${APP}.js ${@:2}"

#if hash ${APP} 2>/dev/null; then
#    ${COMMAND}
#else
    CURRENT=$(dirname $(realpath $0) )

    if ! docker images | grep -q frontend_tools ;
    then
        docker build -t frontend_tools "${CURRENT}/../docker/frontend-tools/"
    fi

    if [ -z ${DOCKER_VERSION} ];
    then
        VOLUMES=$(realpath "${CURRENT}/../")
    else
        VOLUMES="/var/app/current"
    fi

    docker run --rm -i -v "${VOLUMES}":"/www" frontend_tools \
     /bin/bash -c ". /root/.bashrc && cmd '${CC}'"


#    docker run --rm -i -v "${VOLUMES}":"/www" frontend_tools \
#     /bin/bash -c ". /root/.bashrc && ( ( hash ${1} 2>/dev/null && ${CC} ) || ( (ls ${APP} >> /dev/null 2>&1 && ${COMMAND}) || ${COMMANDJS} ) )"
#fi