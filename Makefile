# Docker Compose command
DOCKER_COMP = docker-compose

# Default target
.DEFAULT_GOAL := help
.PHONY: help init build up start down vendor clear-cache

## ————————————————————————————————————————————————————————————————————————————————
## All Projects Management
## ————————————————————————————————————————————————————————————————————————————————
##
help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9\./_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

## —— Project Management  —————————————————————————————————————————————————————————
init: start init-sms init-oms init-cms ## Initialize all projects

## —— 🐳 Docker 🐳 ————————————————————————————————————————————————————————————————
build: ## Builds the Docker images
	@$(DOCKER_COMP) build --pull --no-cache

up: ## Start the docker hub in detached mode (no logs)
	@$(DOCKER_COMP) up --detach

start: build up ## Build and start the containers

down: ## Stop the docker hub
	@$(DOCKER_COMP) down --remove-orphans

## —— 📦 Vendor Commands 📦 ———————————————————————————————————————————————————————
vendor: vendor-sms vendor-oms vendor-cms ## Install vendors for all projects

## —— 🎵 Symfony 🎵 ———————————————————————————————————————————————————————————————
clear-cache: clear-cache-sms clear-cache-oms clear-cache-cms ## Clear the cache for all projects

##
## ————————————————————————————————————————————————————————————————————————————————
## Stock Management System (SMS)
## ————————————————————————————————————————————————————————————————————————————————
##
SMS_PHP_CONTAINER = $(DOCKER_COMP) exec sms_php
SMS_PHP = $(SMS_PHP_CONTAINER) php
SMS_COMPOSER = $(SMS_PHP_CONTAINER) composer
SMS_SYMFONY = $(SMS_PHP_CONTAINER) bin/console

.PHONY: init-sms shell-sms composer-sms vendor-sms symfony-sms clear-cache-sms

## —— Project Management  —————————————————————————————————————————————————————————
init-sms: vendor-sms clear-cache-sms ## Initialize the SMS project: Install dependencies and clear cache

## —— 🐚 Docker Shell 🐚 ——————————————————————————————————————————————————————————
shell-sms: ## Connect to the SMS PHP FPM container
	$(SMS_PHP_CONTAINER) sh

## —— 🧙 Composer Commands 🧙 —————————————————————————————————————————————————————
composer-sms: ## Run composer command for SMS, usage: make composer-sms c="require some/package"
	@$(eval c ?=)
	$(SMS_COMPOSER) $(c)

## —— 📦 Vendor Commands 📦 ———————————————————————————————————————————————————————
vendor-sms: ## Install vendors for SMS according to the current composer.lock file
vendor-sms: c=install --prefer-dist --no-dev --no-progress --no-scripts --no-interaction
vendor-sms:	composer-sms

## —— 🎵 Symfony 🎵 ———————————————————————————————————————————————————————————————
symfony-sms: ## Run Symfony console command for SMS, usage: make symfony-sms c="cache:clear"
	@$(eval c ?=)
	@$(SMS_SYMFONY) $(c)

clear-cache-sms: ## Clear the cache for SMS
clear-cache-sms: c=cache:clear
clear-cache-sms: symfony-sms

##
## ————————————————————————————————————————————————————————————————————————————————
## Order Management System (OMS)
## ————————————————————————————————————————————————————————————————————————————————
##
OMS_PHP_CONTAINER = $(DOCKER_COMP) exec oms_php
OMS_PHP = $(OMS_PHP_CONTAINER) php
OMS_COMPOSER = $(OMS_PHP_CONTAINER) composer
OMS_SYMFONY = $(OMS_PHP_CONTAINER) bin/console

.PHONY: init-oms shell-oms composer-oms vendor-oms symfony-oms clear-cache-oms

## —— Project Management  —————————————————————————————————————————————————————————
init-oms: vendor-oms clear-cache-oms ## Initialize the OMS project: Install dependencies and clear cache

## —— 🐚 Docker Shell 🐚 ——————————————————————————————————————————————————————————
shell-oms: ## Connect to the OMS PHP FPM container
	$(OMS_PHP_CONTAINER) sh

## —— 🧙 Composer Commands 🧙 —————————————————————————————————————————————————————
composer-oms: ## Run composer command for OMS, usage: make composer-oms c="update"
	@$(eval c ?=)
	$(OMS_COMPOSER) $(c)

## —— 📦 Vendor Commands 📦 ———————————————————————————————————————————————————————
vendor-oms: ## Install vendors for OMS according to the current composer.lock file
vendor-oms: c=install --prefer-dist --no-dev --no-progress --no-scripts --no-interaction
vendor-oms:	composer-oms

## —— 🎵 Symfony 🎵 ———————————————————————————————————————————————————————————————
symfony-oms: ## Run Symfony console command for OMS, usage: make symfony-oms c="about"
	@$(eval c ?=)
	@$(OMS_SYMFONY) $(c)

clear-cache-oms: ## Clear the cache for OMS
clear-cache-oms: c=cache:clear
clear-cache-oms: symfony-oms

##
## ————————————————————————————————————————————————————————————————————————————————
## Catalog Management System (OMS)
## ————————————————————————————————————————————————————————————————————————————————
##
CMS_PHP_CONTAINER = $(DOCKER_COMP) exec cms_php
CMS_PHP = $(CMS_PHP_CONTAINER) php
CMS_COMPOSER = $(CMS_PHP_CONTAINER) composer
CMS_SYMFONY = $(CMS_PHP_CONTAINER) bin/console

.PHONY: init-cms shell-cms composer-cms vendor-cms symfony-cms clear-cache-cms

## —— Project Management  —————————————————————————————————————————————————————————
init-cms: vendor-cms clear-cache-cms ## Initialize the CMS project: Install dependencies and clear cache

## —— 🐚 Docker Shell 🐚 ——————————————————————————————————————————————————————————
shell-cms: ## Connect to the CMS PHP FPM container
	$(CMS_PHP_CONTAINER) sh

## —— 🧙 Composer Commands 🧙 —————————————————————————————————————————————————————
composer-cms: ## Run composer command for CMS, usage: make composer-cms c="update"
	@$(eval c ?=)
	$(CMS_COMPOSER) $(c)

## —— 📦 Vendor Commands 📦 ———————————————————————————————————————————————————————
vendor-cms: ## Install vendors for CMS according to the current composer.lock file
vendor-cms: c=install --prefer-dist --no-dev --no-progress --no-scripts --no-interaction
vendor-cms:	composer-cms

## —— 🎵 Symfony 🎵 ———————————————————————————————————————————————————————————————
symfony-cms: ## Run Symfony console command for CMS, usage: make symfony-cms c="about"
	@$(eval c ?=)
	@$(CMS_SYMFONY) $(c)

clear-cache-cms: ## Clear the cache for CMS
clear-cache-cms: c=cache:clear
clear-cache-cms: symfony-cms
