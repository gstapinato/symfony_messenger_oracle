# Desription

Small docker compose application which shows a bug on Messenger component when `messenger:failed:show` is executed.

## Features
- Php 8.2
- Symfony 5.4(lowest maintained branch)
- Symfony Messenger
- Oracle 21


## Installation

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `docker compose up --build --remove-orphans -d` to create and start containers.
3. Run `docker compose logs database` to see database service log. Wait for database is up and ready for requests.

Should be shown:

```
...
#########################

DATABASE IS READY TO USE!

#########################
...
```


4. Run `STABILITY=dev SYMFONY_VERSION=5.4.* docker compose run php bin/phpunit` to execute a phpunit test.
 
5. Run `docker compose down --remove-orphans` to stop and remove Docker containers.
 

