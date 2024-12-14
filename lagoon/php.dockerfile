ARG CLI_IMAGE
FROM ${CLI_IMAGE:-builder} AS builder

FROM uselagoon/php-8.3-fpm:latest

# Copy the php.ini file to customize the PHP configuration
COPY lagoon/php/php.ini /usr/local/etc/php/conf.d/10-concretecms-base.ini

COPY --from=builder /app /app