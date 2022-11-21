#!/bin/bash

API_CONTEINER_NAME = promotions-api
USER_ID = $(shell id -u)

help:
	@echo 'usage: make [target]'
	@echo
	@echo 'targets:'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

projectInit:
	MAKE_ID=${USER_ID} docker-compose build
	cp .env .env.local
	MAKE_ID=${USER_ID} docker-compose up -d
	MAKE_ID=${USER_ID} docker exec --user ${USER_ID} -it ${API_CONTEINER_NAME} composer install --no-scripts --no-interaction --optimize-autoloader
	MAKE_ID=${USER_ID} docker exec -it --user ${USER_ID} ${API_CONTEINER_NAME} php bin/console asset:install
	sleep 10
	MAKE_ID=${USER_ID} docker exec -it --user ${USER_ID} ${API_CONTEINER_NAME} php bin/console doctrine:migrations:migrate -n
	sleep 5
	MAKE_ID=${USER_ID} docker exec -it --user ${USER_ID} ${API_CONTEINER_NAME} php bin/phpunit

test-run:
	MAKE_ID=${USER_ID} docker exec -it --user ${USER_ID} ${API_CONTEINER_NAME} php bin/phpunit