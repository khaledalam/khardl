#!/bin/bash


# MAC M1 --platform linux/amd64
export DOCKER_DEFAULT_PLATFORM=linux/amd64

docker-compose down --remove-orphans
docker-compose up -d --build --remove-orphans

cd backend && php artisan serv