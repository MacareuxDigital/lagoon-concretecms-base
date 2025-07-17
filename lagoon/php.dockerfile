ARG CLI_IMAGE
FROM ${CLI_IMAGE:-builder} AS builder

FROM uselagoon/php-8.3-fpm:latest

# Install Redis extension
RUN apk add --no-cache php8-pecl-redis

COPY --from=builder /app /app