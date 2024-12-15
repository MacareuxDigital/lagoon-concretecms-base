FROM uselagoon/php-8.3-cli:latest

# Install composer dependencies
COPY composer.* /app/
RUN composer install --no-dev --prefer-dist

# Copy the application code to the image and make sure the required directories are created
COPY . /app
RUN mkdir -p -v -m775 /app/web/application/files
RUN mkdir -p -v -m775 /app/cache

# Define where the Concrete CMS webroot is located
ENV WEBROOT=web