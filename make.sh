#!/bin/bash

docker compose -f provisioning/docker-compose.yml rm -f
docker compose -f provisioning/docker-compose.yml build --no-cache
docker compose -f provisioning/docker-compose.yml run php-line-endings-normalizer composer install
docker compose -f provisioning/docker-compose.yml run php-line-endings-normalizer vendor/bin/phpunit -c .
