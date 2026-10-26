ARG CLI_IMAGE
FROM ${CLI_IMAGE:-builder} AS builder

FROM uselagoon/php-8.3-fpm:latest

COPY --from=builder /app /app

#MAINT-2715 PHP (CVE-2026-109619 / CVE-2026-115560)
COPY lagoon/php-security.ini /usr/local/etc/php/conf.d/zz-security.ini