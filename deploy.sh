
# shellcheck disable=SC2164
cd /home/khardl5/public_html/


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




#php artisan migrate:fresh --seed
#php artisan key:gen
#php artisan passport:install --force
#php artisan create:tenant

# [BE CAREFUL] Delete all databases the start with "restaurant_" prefix
#php backend/artisan delete:tenants

# nohup php /home/khardl5/public_html/backend/artisan queue:work --daemon &


# Alert discord
./scripts/discord.sh \
  --webhook-url="https://discord.com/api/webhooks/1190627943832100964/lc1t2A2Y9a-7TnLlMQC55oDjPhcmdiVQCyedOESLZ5UID-8ZBNbN75kiJm-k6vMZ_LUP" \
  --username "DeployLiveServerAlert" \
  --avatar "https://i.imgur.com/12jyR5Q.png" \
  --text "New deploy occurred on live server!"


