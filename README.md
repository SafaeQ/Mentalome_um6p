# Mentalome_um6p

## How to Run

### Should have:
* PHP V8.0
* composer V2.2.3
* nodeJs v16.14.2
* vue-cli v3.3.4

### Run:
* cd backend
* composer install
* php artisan migrate (Note: database access should be configured in .env file)
* php artisan db:seed
* php artisan serve
* cd frontend
* npm install
* npm run dev