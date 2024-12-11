FROM uselagoon/php-8.3-cli:latest

COPY composer.* /app/
RUN <<EOF
composer install --no-dev --prefer-dist
if [[ $(/app/vendor/bin/concrete c5:is-installed) == "Concrete is installed" ]]; then
    /app/vendor/bin/concrete c5:entities:refresh
fi
EOF
COPY . /app
RUN mkdir -p -v -m775 /app/web/application/files

# Define where the Concrete CMS webroot is located
ENV WEBROOT=web