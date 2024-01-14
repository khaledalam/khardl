#!/bin/bash

killall -9 php

# MAC M1 --platform linux/amd64
export DOCKER_DEFAULT_PLATFORM=linux/amd64

docker-compose down --remove-orphans
docker-compose up -d --build --remove-orphans

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
        echo "MySQL server is unavailable. Retrying in 1 second..."
        sleep 1
    fi
done

#TEST="Testing MySQL server has gone away"
#while true; do
#    # shellcheck disable=SC2046
#    TEST=$(php backend/artisan migrate:fresh --seed --database=mysql_testing) 2> /dev/null;
#    if [[ "$TEST" != *"Testing MySQL server has gone away"* ]]; then
#        echo "Testing MySQL server is available."
#        break
#    else
#        # If the command fails, the MySQL server is not available yet
#        echo "Testing MySQL server is unavailable. Retrying in 1 second..."
#        sleep 1
#    fi
#done
#


cd backend;

rm ./composer.lock
composer install


php artisan migrate:fresh --seed

#php artisan migrate:fresh --seed --database=mysql_testing

php artisan create:tenant

#php artisan create:tenant --testing=true

php artisan serv # --port 80


