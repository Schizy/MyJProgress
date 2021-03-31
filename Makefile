DC=docker-compose
PHP=$(DC) exec php
CONS=$(PHP) bin/console
DB=$(DC) exec db

##
## Docker-Compose
##---------------------------------------------------------------------------

u: up
up:
	$(DC) up -d

d: down
down:
	$(DC) down -v --remove-orphans

php:
	$(PHP) sh

##
## Database
##---------------------------------------------------------------------------

dd: db-dump
db-dump:
	#Type password after command: root
	 $(DB) mysqldump  --add-drop-table -uroot -p jpgrammar > $(filter-out $@,$(MAKECMDGOALS))

dl: db-load
db-load:
	$(DB) mysql -uroot -proot jpgrammar < $(filter-out $@,$(MAKECMDGOALS))

dm: db-migration
db-migration:
	$(CONS) doctrine:migrations:migrate --no-interaction

##
## Tests
##---------------------------------------------------------------------------

t: test
test: ## Run unit tests
	$(PHP) bin/phpunit

tc: test-coverage
test-coverage: ## Run unit tests with code coverage generate
	$(PHP) bin/phpunit --coverage-html public/code-coverage

td: test-db
test-db:
	$(PHP) rm var/data/test.sqlite
	$(CONS) d:d:c -e test
	$(CONS) d:s:c -e test
	$(CONS) d:f:l -n -e test
	$(PHP) mv var/data/test.sqlite tests/test.sqlite

##
## Code Style
##---------------------------------------------------------------------------

cs: code-style
code-style:
	$(PHP) tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src
