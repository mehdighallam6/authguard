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

5. **Run migrations and seed roles/permissions:**

    ```sh
    php artisan migrate --seed
    ```

6. **Build frontend assets:**

    ```sh
    npm run dev
    ```

## API Endpoints

- `POST /api/request-otp` - Request a new OTP.
