ARG CLI_IMAGE
FROM ${CLI_IMAGE:-builder} AS builder

FROM uselagoon/nginx:latest

COPY lagoon/nginx/nginx.conf /etc/nginx/conf.d/app.conf
COPY lagoon/nginx/concrete /etc/nginx/conf.d/concrete/

COPY --from=builder /app /app

WORKDIR /app
RUN if [ "$(./vendor/bin/concrete c5:is-installed)" = "Concrete is installed" ]; then \
        ./vendor/bin/concrete orm:generate-proxies; \
    fi

ENV WEBROOT=web