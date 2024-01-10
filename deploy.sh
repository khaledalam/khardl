# Create env files
#cp .env.example .env
#cp backend/.env.example backend/.env
#cp frontend/.env.example frontend/.env


cd /home/khardl5/public_html/

# Install packages
#npm i --prefix frontend
rm backend/composer.lock
composer install --working-dir backend



# [BE CAREFUL] Delete all databases the start with "restaurant_" prefix
#php backend/artisan delete:tenants

# Setup backend
php backend/artisan migrate
#php backend/artisan migrate:fresh --seed
#php backend/artisan key:gen
#php backend/artisan passport:install --force

#php backend/artisan create:tenant

php backend/artisan optimize:clear


# nohup php /home/khardl5/public_html/backend/artisan queue:work --daemon &

# Build frontend
#./run-frontend-build.sh

# Alert discord
./discord.sh \
  --webhook-url="https://discord.com/api/webhooks/1190627943832100964/lc1t2A2Y9a-7TnLlMQC55oDjPhcmdiVQCyedOESLZ5UID-8ZBNbN75kiJm-k6vMZ_LUP" \
  --username "DeployLiveServerAlert" \
  --avatar "https://i.imgur.com/12jyR5Q.png" \
  --text "New deploy occurred on live server!"


