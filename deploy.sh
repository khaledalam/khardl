# Create env files
#cp .env.example .env
#cp backend/.env.example backend/.env
#cp frontend/.env.example frontend/.env

# Install packages
#npm i --prefix frontend
#compsoer install --working-dir backend

cd /home/khardl5/public_html/


# [BE CAREFUL] Delete all databases the start with "restaurant_" prefix
php backend/artisan delete:tenants

# Setup backend
php backend/artisan migrate:fresh --seed
#php backend/artisan key:gen
#php backend/artisan passport:install --force

php backend/artisan create:tenant

php backend/artisan optimize:clear


# Build frontend
#./run-frontend-build.sh



