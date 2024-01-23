# backup database
./db_backup.sh


cd backend;


# Handle frontend
npm i -f --silent
npm run prod --silent


# Handle backend
rm ./composer.lock
composer install



# Setup backend
php artisan migrate
php artisan tenants:migrate
#php artisan db:seed

php artisan optimize:clear



cd ..

APP_ENV=$(cat ./backend/.env | grep 'APP_ENV=')

# Alert discord
./scripts/discord.sh \
  --webhook-url="https://discord.com/api/webhooks/1190627943832100964/lc1t2A2Y9a-7TnLlMQC55oDjPhcmdiVQCyedOESLZ5UID-8ZBNbN75kiJm-k6vMZ_LUP" \
  --username "DeployLive" \
  --avatar "https://cdn-icons-png.flaticon.com/512/4334/4334058.png" \
  --text "New deploy occurred on [Live Server]! | https://khardl.com | $APP_ENV"


