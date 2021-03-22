ARG version
ARG type

FROM php:${version}-${type}

RUN apt update && apt upgrade -y && \
    apt install -y libxml2-dev wget

# Copy over our script to check if the extension is already installed
COPY ./Partials/PHP/extension-installer.sh /opt/php-ext-install.sh

RUN apt-get install -y \
    libzip-dev \
    zip

# Check and/or Install core modules
RUN /opt/php-ext-install.sh bcmath ctype fileinfo json mbstring openssl tokenizer xml zip curl

# Install PHP Database Extensions
RUN /opt/php-ext-install.sh mysql mysqli pdo_mysql pdo

# Install Composer
RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/e3e43bde99447de1c13da5d1027545be81736b27/web/installer -O - -q | php -- --quiet
RUN mv composer.phar /usr/local/bin/composer

RUN useradd -ms /bin/bash user
USER user

WORKDIR /var/www/html
