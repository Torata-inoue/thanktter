FROM php:8.2-fpm-bullseye AS base

WORKDIR /home

# timezone environment
ENV TZ=UTC \
  # locale
  LANG=en_US.UTF-8 \
  LANGUAGE=en_US:en \
  LC_ALL=en_US.UTF-8 \
  # composer environment
  COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

COPY --from=composer:2.4 /usr/bin/composer /usr/bin/composer

RUN apt-get update \
  && apt-get -y install --no-install-recommends \
    locales \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    bash \
    coreutils \
    vim \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* \
  && locale-gen en_US.UTF-8 \
  && localedef -f UTF-8 -i en_US en_US.UTF-8 \
  && docker-php-ext-install \
    intl \
    pdo_mysql \
    zip \
    bcmath \
  && composer config -g process-timeout 3600 \
  && composer config -g repos.packagist composer https://packagist.org

RUN apt-get -y update
RUN apt-get install -y \
    curl \
    gnupg
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs
RUN npm install npm@9 -g
RUN npm install yarn -g

RUN echo "alias ll='ls --color=auto -l'" >> /root/.bashrc \
  && echo "alias ls='ls --color=auto'" >> /root/.bashrc \
  && echo "alias la='ls --color=auto -lA'" >> /root/.bashrc

FROM base AS development

COPY ./.docker/php/php.development.ini /usr/local/etc/php/php.ini
