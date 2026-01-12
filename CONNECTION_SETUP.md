# Frontend-Backend Connection Setup

This document explains how the Next.js frontend (`public-site`) is connected to the Laravel backend (`laravel-site`).

## Architecture Overview

- **Frontend**: Next.js application in `public-site/`
- **Backend**: Laravel API in `laravel-site/`
- **Communication**: RESTful API via HTTP requests
- **CORS**: Configured to allow cross-origin requests

## API Endpoints

The Laravel backend exposes the following API endpoints:

- `GET /api/categories` - Get all active categories
- `GET /api/site-settings` - Get site configuration
- `POST /api/quote-requests` - Submit a quote request

## Environment Configuration

### Laravel Backend (`laravel-site/.env`)

Make sure your `.env` file has:

```env
APP_URL=http://localhost:8000
```

The API will be available at `http://localhost:8000/api/*`

### Next.js Frontend (`public-site/.env.local`)

Create a `.env.local` file with:

```env
NEXT_PUBLIC_API_URL=http://localhost:8000/api
```

For production, update this to your production API URL.

## Running the Applications

### Backend (Laravel)

```bash
cd laravel-site
php artisan serve
```

The API will run on `http://localhost:8000`

### Frontend (Next.js)

```bash
cd public-site
npm run dev
```

The frontend will run on `http://localhost:3000` (default)

## CORS Configuration

CORS is configured in `laravel-site/bootstrap/app.php` to allow API requests from the Next.js frontend. 

For production, you may want to restrict CORS to specific domains by configuring it in the middleware or environment variables.

## API Client

The frontend uses the API client in `public-site/src/lib/api.ts` to communicate with the backend. This client:

- Handles request/response formatting
- Provides TypeScript types
- Handles errors consistently
- Supports both server and client components

## Data Flow

1. **Server Components** (pages): Fetch data directly from API using `fetch` in async server components
2. **Client Components**: Use the API client functions for interactive features (like form submission)

## Testing the Connection

1. Start the Laravel backend: `cd laravel-site && php artisan serve`
2. Start the Next.js frontend: `cd public-site && npm run dev`
3. Visit `http://localhost:3000` - the site should load data from the API
4. Check browser console for any CORS or API errors

## Troubleshooting

### CORS Errors

If you see CORS errors in the browser console:
- Ensure both servers are running
- Check that `NEXT_PUBLIC_API_URL` matches your Laravel server URL
- Verify CORS middleware is configured in `bootstrap/app.php`

### API Not Found (404)

- Verify Laravel API routes are registered in `routes/api.php`
- Check that `bootstrap/app.php` includes the API routes configuration
- Ensure Laravel server is running on the correct port

### Empty Data

- Check that categories and site settings exist in the database
- Verify database connection in Laravel `.env` file
- Check Laravel logs in `storage/logs/laravel.log`

