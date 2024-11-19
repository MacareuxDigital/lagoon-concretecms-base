ARG CLI_IMAGE
FROM ${CLI_IMAGE:-builder} AS builder

FROM uselagoon/nginx:latest

COPY lagoon/nginx/nginx.conf /etc/nginx/conf.d/app.conf
COPY lagoon/nginx/concrete /etc/nginx/conf.d/concrete/

COPY --from=builder /app /app

ENV WEBROOT=public