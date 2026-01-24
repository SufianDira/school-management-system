# School Management System API (Backend)
Mini school management system API for managing students, teachers, and classrooms. This is a Laravel REST API backend designed to pair with a Vue 3 SPA frontend.

## Features
- RESTful endpoints for students, teachers, and classrooms
- Model relationships, factories, and seed data
- Policies for authorization
- Form requests with shared pagination/include parameters
- API resources for consistent response formatting
- Sanctum SPA auth (CSRF cookie mode)
- Postman collection for testing without a frontend

## Tech stack
- PHP / Laravel
- SQLite (or compatible)
- Laravel Sanctum

## Prerequisites
- PHP 8.x
- Composer
- A database server (SQLite recommended)

## Run locally
1) Install dependencies.
```bash
composer install
```

2) Create the environment file and generate the app key.
```bash
copy .env.example .env
php artisan key:generate
```

3) Configure `.env`.
- Set `APP_URL` to your backend URL (example: `http://localhost:8000`).
- Set `SESSION_DOMAIN` to match your domain (example: `localhost`).
- Configure database credentials (DB_*).

4) Run migrations and seed data.
```bash
php artisan migrate --seed
```

5) Start the server.
```bash
php artisan serve
```

## Seed configuration (optional)
- `SEED_TEACHERS_COUNT`
- `SEED_CLASSROOMS_PER_TEACHER`
- `SEED_STUDENTS_PER_CLASSROOM`

## Postman
- Collection: `postman/collections/school-management-system.postman_collection.json`
- Import the collection into Postman to test all endpoints.
