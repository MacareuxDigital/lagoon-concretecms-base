ARG CLI_IMAGE
FROM ${CLI_IMAGE:-builder} AS builder

FROM uselagoon/php-8.3-fpm:latest

COPY lagoon/php /usr/local/etc/php/conf.d/

COPY --from=builder /app /app

WORKDIR /app
RUN if [ "$(./vendor/bin/concrete c5:is-installed)" = "Concrete is installed" ]; then \
        ./vendor/bin/concrete orm:generate-proxies; \
    fi