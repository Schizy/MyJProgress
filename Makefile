DC=docker-compose
CONTAINER=php
DATABASE_CONTAINER=db
EXEC=$(DC) exec $(CONTAINER)
PHP = php
CON = $(PHP) bin/console

##
## Database
##---------------------------------------------------------------------------
.PHONY: db-fixture db-remove db-reset

db-fixture: ## Run fixture for db
	$(EXEC) $(CON) doctrine:fixtures:load -n -e=test

db-remove: ## Run remove for db
	$(EXEC) $(CON) doctrine:schema:drop -e=test

db-reset: ## Run reset for db and run fixture
db-reset: db-remove db-fixture

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
