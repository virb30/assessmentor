composer:
	docker-compose run composer composer $(filter-out $@, $(MAKECMDGOALS))

test:
	docker-compose exec --user ${UID}:${GID} app php ./vendor/bin/phpunit $(filter-out $@, $(MAKECMDGOALS))

add-coverage:
	git commit -i ./tests/coverage/coverage.xml -m "update coverage.xml" -n