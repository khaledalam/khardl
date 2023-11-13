#!/bin/bash


# MAC M1 --platform linux/amd64
export DOCKER_DEFAULT_PLATFORM=linux/amd64

docker-compose down --remove-orphans
docker-compose up -d --build --remove-orphans

# confirm docker db is connected with laravel and up and running


TEST="MySQL server has gone away"
while true; do
    # shellcheck disable=SC2046
    TEST=$(php backend/artisan tinker --execute="dump(User::find(1)->email)") 2> /dev/null;
    if [[ "$TEST" != *"MySQL server has gone away"* ]]; then
        echo "MySQL server is available."
        break
    else
        # If the command fails, the MySQL server is not available yet
        echo "MySQL server is unavailable. Retrying in 2 seconds..."
        sleep 2
    fi
done

php backend/artisan migrate:fresh --seed

php backend/artisan create:tenant

php backend/artisan serv # --port 80


