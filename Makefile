DC=docker-compose
CONTAINER=php
DATABASE_CONTAINER=db
EXEC=$(DC) exec $(CONTAINER)
PHP = php
CON = $(PHP) bin/console

##
## Database
##---------------------------------------------------------------------------
.PHONY: db-test

php: ## Run remove for db
	$(EXEC) sh

db-remove: ## Run remove for db
	$(EXEC) $(CON) doctrine:schema:drop -n

db-migrate: ## Run fixture for db
	$(EXEC) $(CON) doctrine:migrations:migrate -n

db-fixture: ## Run fixture for db
	$(EXEC) $(CON) doctrine:fixtures:load -n

db-test: db-remove db-migrate db-fixture

db-migration:  ## Runs the mongo DB migration
db-migration:
	$(EXEC) ./bin/console doctrine:migrations:migrate --no-interaction

##
## Tests
##---------------------------------------------------------------------------
.PHONY: unit-test unit-test-coverage

unit-test: ## Run unit tests
	$(EXEC) bin/phpunit

unit-test-coverage: ## Run unit tests with code coverage generate
	$(EXEC) bin/phpunit --coverage-html public/code-coverage
