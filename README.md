# Concrete CMS Base for lagoon

A template to make Concrete CMS run on Lagoon.

* [Lagoon - the developer-focused application delivery platform for Kubernetes](https://docs.lagoon.sh/)
* [Concrete CMS](https://www.concretecms.org/)

This template includes everything you need to get started with Concrete CMS to run on Lagoon.
It was referenced [official composer base](https://github.com/concretecms/composer) and [community docker image](https://github.com/concrete5-community/docker5) but modified to work with Lagoon.

## Included Services

This template includes the following services:

* Concrete CMS 9.3
* PHP 8.3 (FPM)
* Nginx
* MariaDB 10.11

## Initial Setup

You can change the following values to fit your project:

* Language code to install translations in `.lagoon.yml` file. Default is `ja_JP`.
* Time zone of your system default in `docker-compose.yml` and `php.ini` files. Default is `Asia/Tokyo`.

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

On amazee.io environment, you can use the following command to get the database information:

```bash
env | grep MARIADB
```

## Update Concrete

You need to update the doctrine proxy classes and commit them after updating the Concrete CMS.
You can use the following command to update the doctrine proxy classes:

```bash
./vendor/bin/concrete orm:generate-proxies
```
