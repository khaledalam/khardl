# Create env files
cp .env.example .env
cp backend/.env.example backend/.env
cp frontend/.env.example frontend/.env

# Install packages
npm i --prefix frontend
compsoer install --working-dir backend

# Setup backend
php backend/artisan migrate:fresh --seed

# Build frontend
./run-frontend-build.sh


