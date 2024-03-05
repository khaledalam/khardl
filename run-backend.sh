#!/bin/bash

killall -9 php

# MAC M1 --platform linux/amd64
export DOCKER_DEFAULT_PLATFORM=linux/amd64

docker stop $(docker ps -q)

docker compose -f backend/docker-compose.yml down --remove-orphans
docker compose -f backend/docker-compose.yml up -d --build --remove-orphans

# confirm docker db is connected with laravel and up and running
REAL="MySQL server has gone away"
while true; do
    # shellcheck disable=SC2046
    REAL=$(php backend/artisan tinker --execute="dump(User::find(1)->email)") 2> /dev/null;
    if [[ "$REAL" != *"MySQL server has gone away"* ]]; then
        echo "MySQL server is available."
        break
    else
        # If the command fails, the MySQL server is not available yet
        echo "MySQL server is unavailable. Retrying in 4 seconds..."
        sleep 4
    fi
done



cd backend;

composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist


php artisan migrate:fresh --seed --force
php artisan create:tenant first
php artisan create:tenant second
php artisan create:tenant third

php artisan serv # --port 80


