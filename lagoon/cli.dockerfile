FROM uselagoon/php-8.3-cli:latest

# Copy the php.ini file to customize the PHP configuration
COPY lagoon/php/php.ini /usr/local/etc/php/conf.d/10-concretecms-base.ini

# Install composer dependencies
COPY composer.* /app/
RUN composer install --no-dev --prefer-dist

# Copy the application code to the image and make sure the required directories are created
COPY . /app
RUN mkdir -p -v -m775 /app/web/application/files
RUN mkdir -p -v -m775 /app/cache

# Define where the Concrete CMS webroot is located
ENV WEBROOT=web