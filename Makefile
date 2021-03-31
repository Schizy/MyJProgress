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

up:
	$(DC) up -d
down:
	$(DC) down -v --remove-orphans
php: ## Run remove for db
	$(EXEC) sh

cs:
	$(EXEC) tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src


test-db:
	$(EXEC) bin/console d:d:c -e test
	$(EXEC) bin/console d:s:c -e test
	$(EXEC) bin/console d:f:l -n -e test
	$(EXEC) mv var/data/test.sqlite tests/test.sqlite

db-dump:
	#Type password after command: root
	$(DC) exec $(DATABASE_CONTAINER) mysqldump  --add-drop-table -uroot -p jpgrammar > $(filter-out $@,$(MAKECMDGOALS))

db-load:
	$(DC) exec $(DATABASE_CONTAINER) mysql -uroot -proot jpgrammar < $(filter-out $@,$(MAKECMDGOALS))

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
