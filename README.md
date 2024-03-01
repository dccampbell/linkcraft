LinkCraft
=========

LinkCraft is a fictional URL shortening service.  
It serves as a simple example of a web application built in PHP
with [Laravel](https://laravel.com/) 10.

## Scope

- Guests can register an account and login.
    - The application will not verify or send emails.
- Users can provide a single URL to create a shortened link for.
- Users can upload a batch of URLs to be shortened via a CSV file.
- Visits to the shortened URLs will be tracked.
- Users can view their list of shortened URLs and analytics for them.
- Shortened URLs will work at the site root and all contain an underscore prefix.
    - e.g. `http://localhost:8000/_abc123`

### Potential Improvements

- Allow users to provide custom slugs for the shortened URLs.
- Allow users to deactivate/reactivate links.
- Allow users to export their link data as a CSV file.
- Improved URL validation (blocking non-HTTP/HTTPS URLs).
- Search and sort functionality for the list of links.
- Move `hits` data to a separate analytics table and add additional metrics.


## Setup/Usage

### Requirements

- PHP 8.2+
- Composer 2+
- NodeJS 20+

### Local Development

These instructions assume the above requirements are met 
and that commands are run from the root project directory.

```
composer run local
npm install
npm run build
php artisan serve
```

The application will be available at [localhost:8000](http://localhost:8000).

The default database is located at `database/database.sqlite`.

> Note: Make sure the `APP_URL` variable in `.env` is updated
> if the application is being served from a different URL.

### Testing

```
php artisan test
```
