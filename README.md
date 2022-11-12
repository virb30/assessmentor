# Assessmentor

API for produce flexible assessments

## Description

The main goal of this projects is to be source of study of Software architecture (such as Clean Architecture, 
Ports and adapters, Event Driven Architecture, DDD and so on) and other best practices by developing a platform to manage 
school assessment tests where users are able to create and manage exams, essays, questions, subscriptions, results and more.

### Technologies

This project uses PHP as main backend language with no definitions for front-end (yet!)

### How to Use

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

# optional: run tests using the Makefile command

make test
# or
make test /path/to/FileTest.php

# optional: run tests using shell script

./run-tests.sh
# or
./run-tests.sh /path/to/FileTest.php
```

## Rules

WIP
### Glossary

* Exam: an exam can contain subscriptions, essays (level and structures) and results
    * the exam configures how essays will be generated: such as difficulty level, disciplines, quantity of questions by discipline 
    essay duration (minimum and maximum).
* Exam Discipline: configuration of an exam that determines the quantity of questions by discipline that will be added to essays
* Level: difficulty level. Can be associated to a question and/or exams
* Discipline: the discipline associated to a question
* Question: one of the core entities of the application consists in a statement and options a.k.a. alternatives
* Question option: alternatives available to a specific question
* Essay: belogs to a subscription (customized essay). Consists in a set of questions
* Subscription: user that will take an essay.