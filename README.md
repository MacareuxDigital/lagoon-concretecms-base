# Concrete CMS Base for Lagoon

A template to make Concrete CMS run on Lagoon.

* [Lagoon - the developer-focused application delivery platform for Kubernetes](https://docs.lagoon.sh/)
* [Concrete CMS](https://www.concretecms.org/)

This template includes everything you need to get started with Concrete CMS to run on Lagoon.

## Included Services

This template includes the following services:

* Concrete CMS 9.3
* PHP 8.3 (FPM)
* Nginx
* MariaDB 10.11

## Initial Setup

You can change the following values to fit your project:

* `COMPOSE_PROJECT_NAME` in `.env` file. This value is used for container names
* `project` value in `.lagoon.yml` file
* `&lagoon-project` value in `docker-compose.yml`
* Language code to install translations in `.lagoon.yml` file. Default is `ja_JP`.

## Local environment setup using pygmy

[pygmy](https://pygmy.readthedocs.io/en/mkdocs/) is required to run this project locally. You can install it using the following command:

```bash
brew tap pygmystack/pygmy && brew install pygmy
```

After installing pygmy, you can start your local environment using the following command:

```bash
pygmy up
```

If you doesn't have the default ssh key (~/.ssh/id_rsa), you can specify the key file using the following command:

```bash
pygmy up --key /Users/your_name/.ssh/custom_key
```

After starting the pygmy, you need to start the docker containers using the following command:

```bash
docker compose up -d
```

If you want to check the status of the local environment, you can use the following command:

```bash
pygmy status
```

If you want to stop the local environment but do not want to remove it, you can use the following command:

```bash
pygmy stop
```

If you want to stop and remove the local environment, you can use the following command:

```bash
pygmy clean
```

To rebuild the local environment, you can use the following command:

```bash
docker compose down
docker compose up -d --force-recreate
```

### Install Concrete

First, access the cli container using the following command:

```bash
docker compose exec cli bash
```

Then, install Concrete CMS using the following command:

```bash
./vendor/bin/concrete c5:install -i --env=install
```

You can use the following information to use in the installation on the local environment:

| Database          | Value   |
|-------------------|---------|
| Database Server   | mariadb |
| Database Name     | lagoon  |
| Database User     | lagoon  |
| Database Password | lagoon  |

See [MariaDB - Environment Variables](https://docs.lagoon.sh/docker-images/mariadb/#environment-variables)

### References

- [Connecting to MySQL externally - pygmy](https://pygmystack.github.io/pygmy/connect_to_mysql_from_external/)

## Install Concrete CMS on Amazee.io

First, access the cli container using the following command:

```bash
lagoon ssh -i <your_key> -p <project_name> -e <environment>
```

Then, get the database information using the following command:

```bash
env | grep MARIADB
```

Now you can install Concrete CMS using the following command:

```bash
./vendor/bin/concrete c5:install -i --env=install
```

After installing Concrete CMS, you must generate the proxy classes on the nginx/php container.
You can access the nginx/php container with -s and -c options.

```bash
lagoon ssh -i <your_key> -p <project_name> -e <environment> -s=nginx -c=php
```

Then, you can generate the proxy classes using the following command:

```bash
./vendor/bin/concrete orm:generate-proxies
```

## Important Notes

After upgrading Concrete or applying any database schema changes,
you must commit the changes of the doctrine proxy classes.
