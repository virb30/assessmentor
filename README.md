# Assessmentor

API for produce flexible assessments

## Description

## How to Use

With this template it is possible to:

- Start the environment
```console
docker-compose -f "docker-compose.yml" up -d --build
```
The application will be available at http://localhost:8080

  
- Install PHP dependencies with composer
```console
docker-compose run composer composer <composer command>
# alternativelly you can use the Makefile helper
make composer "<composer command>"
```

- Run tests
```console
docker-compose exec php php ./vendor/bin/phpunit
# to specify a test file
docker-compose exec php php ./vendor/bin/phpunit path/to/FileTest.php

# alternativelly you can use the Makefile command

make test
# or
make test /path/to/FileTest.php
```