ARG MPDK_PHP_VERSION
FROM moodlehq/moodle-php-apache:${MPDK_PHP_VERSION}${MOODLE_VERSION}${MPDK}
ARG MOODLE_LINK
#Set the shell to bash
SHELL ["/bin/bash", "-c"]
WORKDIR /var/www/
RUN apt update
RUN apt install -y wget unzip zip git
#On slow net python may fail with "libpython3.9-stdlib connection timed out"
RUN apt install -y python3 || apt install -y python3
#Install NVM and latest LTS Node
RUN curl -o - https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.3/install.sh | bash
RUN source ~/.nvm/nvm.sh
#Install composer
RUN cd /opt && wget -O composer-setup.php https://getcomposer.org/installer && php composer-setup.php && rm composer-setup.php
RUN mv /opt/composer.phar /usr/local/bin/composer
#Install moosh
RUN cd /opt && git clone --depth 1 https://github.com/tmuras/moosh.git
RUN cd /opt/moosh/ && composer update && composer install
RUN ln -s /opt/moosh/moosh.php /usr/local/bin/moosh
#Install  (and not enable) xdebug
RUN pecl install xdebug
#Install Moodle
RUN wget --quiet -O moodle.zip $MOODLE_LINK
RUN unzip moodle.zip -d moodle && rm -fr moodle.zip html && mv moodle/*/ html && rm -fr moodle
WORKDIR /var/www/html
RUN npm install
RUN nvm install
#Download (and not install) utils plugins
RUN mkdir -p /opt/mpdk/assets /opt/mpdk/myplugins
RUN git clone --quiet --depth 1 https://github.com/moodlehq/moodle-local_codechecker.git "/opt/mpdk/assets/codechecker"
RUN git clone --quiet --depth 1 https://github.com/moodlehq/moodle-local_moodlecheck.git "/opt/mpdk/assets/moodlecheck"
RUN git clone --quiet --depth 1 https://github.com/mudrd8mz/moodle-tool_pluginskel.git "/opt/mpdk/assets/pluginskel"