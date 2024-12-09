FROM uselagoon/php-8.3-cli-drupal:latest

COPY composer.* /app/
RUN composer install --no-dev --prefer-dist
COPY config/sync/*.php /app/web/application/config/
COPY . /app
RUN mkdir -p -v -m775 /app/web/application/files

# Define where the Concrete CMS webroot is located
ENV WEBROOT=web