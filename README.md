# Concrete CMS Base for lagoon

## Local development

*pygmy* is required to run this project locally. You can install it using the following command:

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
docker compose -d --build
```

### How to install Concrete

```bash
docker compose exec cli bash
./vendor/bin/concrete c5:install -i
```

| Database          | Value   |
|-------------------|---------|
| Database Server   | mariadb |
| Database Name     | lagoon  |
| Database User     | lagoon  |
| Database Password | lagoon  |

See [MariaDB - Environment Variables](https://docs.lagoon.sh/docker-images/mariadb/#environment-variables)
