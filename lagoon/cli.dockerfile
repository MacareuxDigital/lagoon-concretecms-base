FROM uselagoon/php-8.3-cli:latest

COPY composer.* /app/
RUN composer install --no-dev --prefer-dist
COPY . /app
RUN mkdir -p -v -m775 /app/web/application/files
WORKDIR /app

RUN if [ "$(./vendor/bin/concrete c5:is-installed)" = "Concrete is installed" ]; then \
        ./vendor/bin/concrete orm:generate-proxies; \
    fi

# Define where the Concrete CMS webroot is located
ENV WEBROOT=web