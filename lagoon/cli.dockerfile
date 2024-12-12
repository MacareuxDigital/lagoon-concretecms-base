FROM uselagoon/php-8.3-cli:latest

COPY composer.* /app/
RUN composer install --no-dev --prefer-dist
COPY . /app
RUN mkdir -p -v -m775 /app/web/application/files
RUN mkdir -p -v -m775 /app/cache

# Define where the Concrete CMS webroot is located
ENV WEBROOT=web