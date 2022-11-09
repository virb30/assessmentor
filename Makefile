composer:
	docker-compose run composer composer $(filter-out $@, $(MAKECMDGOALS))

test:
	docker-compose exec --user ${UID}:${GID} app php ./vendor/bin/phpunit $(filter-out $@, $(MAKECMDGOALS))

add-coverage:
	git add tests/coverage/coverage.xml