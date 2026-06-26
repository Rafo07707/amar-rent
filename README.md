# AMAR Rent Armenia — Laravel 11 (PHP 8.2) + MySQL

Multilingual (Armenian / Russian / English) car-rental website with an admin
panel for managing cars, bookings, and page content (CMS). Mobile-first,
SEO-friendly (per-language meta tags, sitemap.xml, robots.txt, friendly
slugs, hreflang tags).

This folder is an **overlay**: a set of files to drop into a fresh Laravel 11
project. It does not include Laravel's core framework files (those come from
`composer create-project`), only the application code specific to this site.

---

## 1. Requirements

- PHP >= 8.2 with extensions: pdo_mysql, mbstring, openssl, tokenizer, xml, ctype, json, bcmath
- Composer 2.x
- MySQL 8.x (or MariaDB 10.6+)
- Node.js (optional, only if you want to rebuild/minify the CSS — not required, plain CSS is provided)

## 2. Create the base Laravel project

```bash
composer create-project laravel/laravel bx-rentcar-armenia "^11.0"
cd bx-rentcar-armenia
```

## 3. Copy the overlay files

Copy **everything** from this package into the new project root, merging
folders (don't overwrite `vendor/`, `.env` if already configured, or
`bootstrap/cache/`):

```bash
# from inside this package's folder
cp -r app/* /path/to/bx-rentcar-armenia/app/
cp -r database/* /path/to/bx-rentcar-armenia/database/
cp -r resources/* /path/to/bx-rentcar-armenia/resources/
cp -r routes/* /path/to/bx-rentcar-armenia/routes/
cp -r public/assets /path/to/bx-rentcar-armenia/public/
cp bootstrap/app.php /path/to/bx-rentcar-armenia/bootstrap/app.php
cp .env.example /path/to/bx-rentcar-armenia/.env.example
```

> Laravel 11's default `routes/web.php` and `bootstrap/app.php` get
> **replaced** by the versions in this overlay (they register the locale
> middleware and load `routes/admin.php`).

## 4. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your MySQL credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bx_rentcar
DB_USERNAME=root
DB_PASSWORD=your_password

APP_URL=http://localhost:8000
APP_LOCALE=hy
APP_FALLBACK_LOCALE=en

MAIL_MAILER=log
```

Create the database:

```sql
CREATE DATABASE bx_rentcar CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

## 5. Run migrations + seed demo data

```bash
php artisan migrate --seed
```

This creates all tables (cars, locations, bookings, pages, faqs, settings,
users) and seeds:

- 9 demo cars (compact / sedan / SUV / premium) — text in HY/RU/EN
- 4 locations: Yerevan, Gyumri, Dilijan, Tsaghkadzor
- CMS pages: home, about, services, contact, privacy, terms
- 14 FAQ items
- Site settings (phone, whatsapp, email, company info)
- 1 admin user:
  - **email:** admin@bxrentcar.am
  - **password:** password

## 6. Storage link (for car images)

```bash
php artisan storage:link
```

## 7. Run it

```bash
php artisan serve
```

- Public site: `http://localhost:8000/hy` (also `/ru`, `/en`)
- Admin panel: `http://localhost:8000/admin/login`

---

## What's in the admin panel

- **Dashboard** — quick stats (cars, new bookings, locations)
- **Cars** — add/edit/delete, set name/description per language, category,
  transmission, fuel, seats, price/day, image upload, active/featured toggle
- **Bookings** — list of customer requests from the contact/booking form,
  change status (new / confirmed / completed / cancelled)
- **Locations** — add/edit branch locations with translated name/address
- **Pages (CMS)** — edit title/content/meta title/meta description per
  language for: Home, About, Services, Contact, Privacy, Terms
- **FAQ** — add/edit/reorder/delete FAQ entries per language
- **Settings** — phone, WhatsApp number, email, company name, VAT number,
  working hours

## Translatable content model

Translatable fields (`name`, `description`, `title`, `content`,
`meta_title`, `meta_description`, etc.) are stored as JSON columns:

```json
{"hy": "Տոյոտա Յարիս", "ru": "Тойота Ярис", "en": "Toyota Yaris"}
```

The `App\Traits\Translatable` trait automatically returns the string for the
current locale when you access `$car->name`, and `$car->getTranslation('name','ru')`
/ `$car->setTranslation('name','ru','Тойота Ярис')` for admin forms.

## SEO

- URL structure: `/hy/...`, `/ru/...`, `/en/...` (locale prefix, no query strings)
- `<title>` and meta description pulled from the `pages` table per locale
- `hreflang` alternate links automatically generated on every page
- `/sitemap.xml` — auto-generated, includes all locales × all pages/cars/locations
- `/robots.txt`
- Friendly slugs for cars and locations (e.g. `/hy/fleet/toyota-rav4`)
- Open Graph tags on every page

## Notes

- This is a working demo intended for local testing. Before production:
  add CSRF-safe rate limiting on the booking form, image validation/resizing,
  email notifications for new bookings (currently just stored in DB), and
  proper queue/cache drivers.
# amar-rent
