
# backup database
./db_backup.sh


cd backend;


# Handle frontend
npm i -f --silent
npm run dev --silent


# Handle backend
rm ./composer.lock
composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist



# Setup backend
php artisan migrate:fresh --seed
php artisan create:tenant

php artisan optimize:clear




#php artisan migrate:fresh --seed
#php artisan key:gen
#php artisan passport:install --force
#php artisan create:tenant

# [BE CAREFUL] Delete all databases the start with "restaurant_" prefix
#php backend/artisan delete:tenants

# nohup php /home/khardl5/public_html/backend/artisan queue:work --daemon &



cd ..

APP_ENV=$(cat ./backend/.env | grep 'APP_ENV=')

# Alert discord
./scripts/discord.sh \
  --webhook-url="https://discord.com/api/webhooks/1190627943832100964/lc1t2A2Y9a-7TnLlMQC55oDjPhcmdiVQCyedOESLZ5UID-8ZBNbN75kiJm-k6vMZ_LUP" \
  --username "DeployTesting" \
  --avatar "https://static.thenounproject.com/png/1907459-200.png" \
  --text "New deploy occurred on [Testing Server]! | https://khardl4test.xyz | $APP_ENV"


