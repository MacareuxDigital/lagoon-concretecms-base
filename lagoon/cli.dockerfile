FROM uselagoon/php-8.3-cli:latest

RUN DOWNLOAD_PATH=$(curl -sL "https://api.github.com/repos/uselagoon/lagoon-sync/releases/latest" | grep "browser_download_url" | cut -d \" -f 4 | grep linux_amd64) \
    && wget -O /usr/local/bin/lagoon-sync $DOWNLOAD_PATH && chmod a+x /usr/local/bin/lagoon-sync

# Install composer dependencies
COPY composer.* /app/
RUN composer install --no-dev --prefer-dist

# Copy the application code to the image and make sure the required directories are created
COPY . /app
RUN mkdir -p -v -m775 /app/web/application/cache
RUN mkdir -p -v -m775 /app/web/application/files

# Define where the Concrete CMS webroot is located
ENV WEBROOT=web