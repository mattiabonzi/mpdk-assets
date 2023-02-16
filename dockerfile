ARG PHP_VERSION
FROM moodlehq/moodle-php-apache:${PHP_VERSION}
ARG XDEBUG_VERSION
ARG MOODLE_LINK
ARG PYTHON_VERSION
#Set the shell to bash
SHELL ["/bin/bash", "-c"]
WORKDIR /var/www/
RUN apt update
RUN apt install -y wget unzip zip git
#On slow net python may fail with "libpython3.9-stdlib connection timed out"
RUN apt install -y ${PYTHON_VERSION} || apt install -y ${PYTHON_VERSION}
#Install composer
RUN cd /opt && wget -O composer-setup.php https://getcomposer.org/installer && php composer-setup.php && rm composer-setup.php
RUN mv /opt/composer.phar /usr/local/bin/composer
#Install moosh
RUN cd /opt && git clone --depth 1 https://github.com/tmuras/moosh.git
RUN cd /opt/moosh/ && composer update && composer install
RUN ln -s /opt/moosh/moosh.php /usr/local/bin/moosh
#Install xdebug
RUN pecl install ${XDEBUG_VERSION}
#Install Moodle
RUN wget --quiet -O moodle.zip ${MOODLE_LINK}
RUN unzip moodle.zip -d moodle && rm -fr moodle.zip html && mv moodle/*/ html && rm -fr moodle
WORKDIR /var/www/html
#Install NVM and   Node
RUN curl -o - https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.3/install.sh | bash
RUN source /root/.bashrc && nvm install && npm install
