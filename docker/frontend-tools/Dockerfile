FROM node:8-alpine

RUN set -x \
	&& addgroup -g 82 -S www-data \
	&& adduser -u 82 -D -S -G www-data www-data

RUN apk --no-cache update && apk --no-cache upgrade

RUN apk add --no-cache --update  \
    sudo \
    bash \
    yarn \
    git \
    bc \
    openssh
#    openssh \
#    imagemagick

RUN apk add --no-cache --update  \
    perl \
    perl-dev \
    build-base \
    libltdl \
    libtool \
    openjpeg \
    openjpeg-dev \
    libpng \
    libpng-dev \
    libwebp \
    libwebp-dev \
    tiff \
    tiff-dev



RUN cd /opt && \
    git clone https://github.com/4creators/jxrlib.git && \
    cd jxrlib && \
    make && \
    ln -s /opt/jxrlib/build/JxrEncApp /bin/JxrEncApp && \
    ln -s /opt/jxrlib/build/JxrDecApp /bin/JxrDecApp

RUN cd /tmp && \
    wget https://imagemagick.org/download/ImageMagick.tar.gz && \
    tar xvzf ImageMagick*.tar.gz && \
    cd ImageMagick-* && \
    ./configure --prefix=/usr --with-modules --with-perl=/usr/bin/perl --with-jp2 --enable-shared --disable-static --without-magick-plus-pus && \
    make && \
    make install

WORKDIR /www

ADD init.sh /init.sh
RUN chmod +x /init.sh

CMD ["/init.sh"]

RUN echo '{ "allow_root": true }' > /root/.bowerrc

RUN echo 'export NODE_PATH="'$(npm root -g)':/www/node_modules"' >> /root/.bashrc && \
    echo 'export PATH="/www/node_modules/.bin:$PATH"' >> /root/.bashrc && \
    echo 'export PATH="/www/scripts/in_containers/basic/bin:$PATH"' >> /root/.bashrc && \
    echo 'export PATH="/www/scripts/in_container/frontend_tools/bin:$PATH"' >> /root/.bashrc && \
    . /root/.bashrc

RUN mkdir /includes
RUN ln -s $(npm root -g)'/lesshat/lesshat.less' /includes/lesshat.less

EXPOSE 4200
