# AuthGuard

This is a web application built using Vue.js and Laravel with Inertia.js. The app manages OTP codes with a secret key, implements role-based access control using Spatie Permissions, and integrates an API for requesting OTP codes.

## Features

- **Vue.js & Laravel with Inertia.js** for a seamless SPA experience.
- **OTP Management** using a secret key.
- **Spatie Permissions** for role and permission handling.
- **API Integration** to request OTP codes securely.

## Technologies Used

- Laravel
- Vue.js
- Inertia.js
- Spatie Permissions
- API for OTP requests

## Installation

1. **Clone the repository:**

    ```sh
    git clone https://github.com/mehdighallam6/authguard.git
    cd authguard
    ```

2. **Install dependencies:**

    ```sh
    composer install
    npm install
    ```

3. **Set up environment variables:**

    ```sh
    cp .env.example .env
    ```

    - Update `.env` with database details.

4. **Generate application key:**

    ```sh
    php artisan key:generate
    ```

5. **Run migrations and seed user/roles**

    ```sh
    php artisan migrate
    ```

    ```sh
    php artisan db:seed
    ```

After running the seeder, two users are available for testing:

| Role         | Email                    | Password     |
| ------------ | ------------------------ | ------------ |
| **Admin**    | test@authguard.hello     | admin@789    |
| **Standard** | standard@authguard.hello | standard@123 |

You can use these credentials to log in and test different role-based access levels.

6. **Build frontend assets:**

    ```sh
    npm run dev
    ```

## API Endpoints

All API endpoints require authentication using Laravel Sanctum except `/api/login`.

- `POST /api/login` - Authenticate user and get access token
- `POST /api/logout` - Logout and invalidate token
- `GET /api/user` - Get authenticated user details
- `POST /api/get-otp` - Request a new OTP code
