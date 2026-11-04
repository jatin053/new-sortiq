# Sortiq Solutions Website and Admin Panel

This project is a Laravel 12 application for the Sortiq Solutions marketing website, content platform, and admin dashboard.

It includes:

- A public-facing company website
- A protected admin panel under `/sortiqadmin`
- Read-only JSON APIs for frontend content
- Database-backed blogs, reviews, client logos, videos, portfolios, and contact messages
- Shared SEO/meta handling
- A contact form API with optional reCAPTCHA and email notifications

This README is meant to be the main project guide for developers who open this codebase for the first time.

## 1. Project Purpose

The application is designed to do three jobs in one codebase:

1. Serve the Sortiq Solutions frontend website.
2. Provide an admin panel where content can be created and updated.
3. Expose lightweight API endpoints that the frontend JavaScript and external consumers can use.

In simple terms:

- Frontend visitors browse pages like home, about, services, portfolio, blog, reviews, clients, and videos.
- Admin users manage dynamic content such as blogs, reviews, portfolios, videos, client logos, and contact inquiries.
- Laravel handles routing, Blade rendering, validation, database access, and admin authentication.

## 2. Current Local Snapshot

The following counts were observed from the local MySQL database on `2026-04-20`:

| Table | Current Rows | Notes |
| --- | ---: | --- |
| `users` | 1 | Admin login account(s) |
| `blogs` | 36 | Public blog content |
| `reviews` | 12 | Public reviews and homepage testimonial feed |
| `client_logos` | 4 | Logo carousel / client section |
| `videos` | 4 | Videos page and homepage section |
| `portfolios` | 6 | Portfolio listing |
| `contact_messages` | 0 | Messages submitted from contact form |
| `site_layout_settings` | 1 | Stored header/footer settings record |

These counts will change over time as the admin panel is used.

## 3. Tech Stack

### Backend

- PHP `^8.2`
- Laravel `^12.0`
- MySQL
- Blade templating

### Frontend

- Blade-rendered HTML
- Tailwind loaded by CDN in the frontend layout
- Custom CSS from `public/frontend-assets/css/main.css`
- Custom JavaScript from `public/frontend-assets/js/main.js`
- Iconify icons

### Admin

- Blade-rendered admin UI
- Shared admin stylesheet from `public/css/admin.css`

### Build Tooling

- Vite is configured in `vite.config.js`
- `resources/css/app.css` and `resources/js/app.js` exist as Vite inputs
- Important note:
  The main frontend and admin layouts currently load CSS/JS directly from `public/...`, not through `@vite`

### Extra Integrations

- Google reCAPTCHA, optional
- Mail notifications for contact messages

## 4. Main URLs

### Public Website

- `/` redirects to `/sortiqsolution`
- `/sortiqsolution` home page
- `/about`
- `/clients`
- `/why-us`
- `/careers`
- `/expertise`
- `/videos`
- `/contact`
- `/reviews`
- `/portfolio`
- `/cases`
- `/internship`
- `/terms`
- `/faq`
- `/support`
- `/blog`
- `/blog/{slug}`
- `/services`
- `/services/{slug}`

### Admin

- `/sortiqadmin/login`
- `/sortiqadmin`
- `/sortiqadmin/blogs`
- `/sortiqadmin/portfolios`
- `/sortiqadmin/videos`
- `/sortiqadmin/client-logos`
- `/sortiqadmin/reviews`
- `/sortiqadmin/contact-messages`
- `/sortiqadmin/site-layout`

### API

- `GET /api/blogs`
- `GET /api/blogs/{blog}`
- `GET /api/reviews`
- `GET /api/reviews/{review}`
- `GET /api/client-logos`
- `GET /api/client-logos/{clientLogo}`
- `GET /api/videos`
- `GET /api/videos/{video}`
- `POST /api/contact-messages`

### Health Check

- `/up`

## 5. High-Level Architecture

The codebase is organized into three main controller layers:

- `App\Http\Controllers\Frontend`
  Renders public pages
- `App\Http\Controllers\Admin`
  Renders admin pages and handles content management
- `App\Http\Controllers\Api`
  Returns JSON responses

The app is mostly a hybrid Blade application:

- The page shell is server-rendered
- Some frontend widgets are hydrated or controlled by JavaScript
- Dynamic content comes from Eloquent models and MySQL

## 6. Request Flow

### Public page flow

1. A visitor hits a web route in `routes/web.php`.
2. Laravel either:
   - renders a static Blade view directly, or
   - goes through a frontend controller
3. The controller loads database content if needed.
4. The Blade view is rendered inside `resources/views/layouts/frontend.blade.php`.
5. Shared meta tags, footer blogs, and review feed data are added automatically.

### Admin flow

1. The admin visits `/sortiqadmin/login`.
2. Custom middleware checks whether the user is authenticated.
3. Admin controllers load models, return admin views, and save content changes.
4. Admin pages are rendered inside `resources/views/admin/layouts/app.blade.php`.

### API flow

1. The request hits `routes/api.php`.
2. The API controller loads published content.
3. JSON is returned through resources or direct arrays.

## 7. Important Route Configuration Files

### `routes/web.php`

This is the main route file for:

- frontend pages
- blog routes
- service routes
- admin login/dashboard/content management

It also includes:

- legacy redirects
- grouped admin resource-style route registration

### `routes/api.php`

This file defines the JSON API routes for:

- blogs
- reviews
- client logos
- videos
- contact messages

### `config/frontend-routes.php`

This file is very important because it centralizes:

- static page to view mappings
- service slugs
- legacy page redirects
- legacy blog slug redirects
- legacy service redirects

If a frontend page or service route needs to be added or renamed, this file is one of the first places to check.

## 8. Frontend Modules

### 8.1 Shared Frontend Layout

Main layout:

- `resources/views/layouts/frontend.blade.php`

This file is responsible for:

- `<title>` and meta tags
- canonical URL
- Open Graph and Twitter tags
- favicon links
- loading main frontend CSS and JS
- header/navigation
- footer
- modal shells
- contact API data attributes
- reCAPTCHA script loading

It also injects shared data such as:

- `data-contact-api-url`
- `data-whatsapp-number`
- `data-recaptcha-enabled`

### 8.2 Home Page

Controller:

- `app/Http/Controllers/Frontend/HomeController.php`

View:

- `resources/views/frontend/home/home-page.blade.php`

The home page currently pulls:

- published client logos
- up to 4 published videos

It also receives shared review/blog data through `AppServiceProvider`.

### 8.3 Static Informational Pages

Views are stored in:

- `resources/views/frontend/pages/`

Current static pages:

- `about.blade.php`
- `careers.blade.php`
- `case-studies.blade.php`
- `contact.blade.php`
- `expertise.blade.php`
- `faq.blade.php`
- `internship.blade.php`
- `support.blade.php`
- `terms.blade.php`
- `why-us.blade.php`

These are routed through `config/frontend-routes.php`.

### 8.4 Services Section

Views are stored in:

- `resources/views/frontend/services/`

Landing page:

- `services-page.blade.php`

Individual service pages:

- `apps.blade.php`
- `banners.blade.php`
- `bigcommerce.blade.php`
- `codeigniter.blade.php`
- `design.blade.php`
- `ecommerce.blade.php`
- `graphics.blade.php`
- `hubspot.blade.php`
- `laravel.blade.php`
- `logos.blade.php`
- `maintenance.blade.php`
- `marketing.blade.php`
- `mern.blade.php`
- `node.blade.php`
- `php.blade.php`
- `react.blade.php`
- `security.blade.php`
- `seo.blade.php`
- `shopify.blade.php`
- `smo.blade.php`
- `testing.blade.php`
- `vue.blade.php`
- `web.blade.php`
- `wordpress.blade.php`
- `zoho.blade.php`

These pages are mostly static Blade content.

### 8.5 Blog Module

Controller:

- `app/Http/Controllers/Frontend/BlogController.php`

Views:

- `resources/views/frontend/blog/blog-list.blade.php`
- `resources/views/frontend/blog/show.blade.php`

Features:

- paginated blog listing
- search by text
- category filter
- JSON feed endpoint
- legacy slug redirects
- view count increment on detail page
- dynamic SEO description/image

### 8.6 Reviews Module

Controller:

- `app/Http/Controllers/Frontend/ReviewController.php`

Views:

- `resources/views/frontend/reviews/reviews-page.blade.php`
- `resources/views/frontend/reviews/show.blade.php`

Features:

- paginated review listing
- review detail pages by slug
- view count increment on detail page
- homepage/shared testimonial feed support

### 8.7 Portfolio Module

Controller:

- `app/Http/Controllers/Frontend/PortfolioController.php`

View:

- `resources/views/frontend/portfolio/portfolio-page.blade.php`

Features:

- loads all published portfolio items
- builds category filters
- passes normalized portfolio data to the frontend

### 8.8 Videos Module

Controller:

- `app/Http/Controllers/Frontend/VideoController.php`

View:

- `resources/views/frontend/videos/videos-page.blade.php`

Features:

- shows all published videos
- homepage uses the first 4 videos

### 8.9 Clients Module

Controller:

- `app/Http/Controllers/Frontend/ClientController.php`

View:

- `resources/views/frontend/clients/clients-page.blade.php`

This section renders the client logo data from the `client_logos` table.

## 9. Admin Modules

### Shared Admin Layout

Main layout:

- `resources/views/admin/layouts/app.blade.php`

Shared admin stylesheet:

- `public/css/admin.css`

This layout handles:

- sidebar
- responsive admin navigation
- mobile menu behavior
- workspace navigation
- admin page shell

### Admin Controllers

- `Admin\AuthController.php`
- `Admin\DashboardController.php`
- `Admin\BlogController.php`
- `Admin\PortfolioController.php`
- `Admin\VideoController.php`
- `Admin\ClientLogoController.php`
- `Admin\ReviewController.php`
- `Admin\ContactMessageController.php`
- `Admin\SiteLayoutSettingController.php`

### Admin Features by Module

#### Dashboard

- overview counts for blogs, portfolios, reviews, and client logos
- quick links to major admin sections

#### Blogs

- create
- edit
- show
- list/search/filter

#### Portfolios

- create
- edit
- show
- list/search/filter

#### Videos

- create
- edit
- show
- list/search/filter

#### Client Logos

- create
- edit
- show
- list/search/filter

#### Reviews

- create
- edit
- show
- list/search/filter

#### Contact Messages

- list submitted messages
- show a single message

#### Site Layout Settings

- manage stored header/footer configuration data
- upload logo and footer badge images
- preview values inside the admin screen

Important reality:

The `site_layout_settings` module stores real settings and is used as a fallback for contact notification email resolution, but the current frontend header/footer in `layouts/frontend.blade.php` is still largely hardcoded. So this module is only partially connected to the live frontend output right now.

## 10. API Modules

### Blogs API

- controller: `app/Http/Controllers/Api/BlogController.php`
- purpose: read-only published blog data

### Reviews API

- controller: `app/Http/Controllers/Api/ReviewController.php`
- purpose: read-only published reviews

### Client Logos API

- controller: `app/Http/Controllers/Api/ClientLogoController.php`
- purpose: read-only published client logos

### Videos API

- controller: `app/Http/Controllers/Api/VideoController.php`
- purpose: read-only published videos

### Contact Messages API

- controller: `app/Http/Controllers/Api/ContactMessageController.php`
- purpose: form submission endpoint

## 11. Models and Database Tables

### `App\Models\User`

Table:

- `users`

Purpose:

- admin authentication

### `App\Models\Blog`

Table:

- `blogs`

Purpose:

- blog listing and detail pages
- recent blog footer content
- API blog feed

### `App\Models\Review`

Table:

- `reviews`

Purpose:

- reviews listing/detail pages
- homepage testimonial feed
- admin review management
- API reviews endpoint

### `App\Models\ClientLogo`

Table:

- `client_logos`

Purpose:

- homepage client section
- clients page
- admin logo management
- API client logos endpoint

### `App\Models\Video`

Table:

- `videos`

Purpose:

- videos page
- homepage video section
- admin video management
- API videos endpoint

### `App\Models\Portfolio`

Table:

- `portfolios`

Purpose:

- portfolio page
- admin portfolio management

### `App\Models\ContactMessage`

Table:

- `contact_messages`

Purpose:

- stores contact form submissions
- admin review of inbound messages

### `App\Models\SiteLayoutSetting`

Table:

- `site_layout_settings`

Purpose:

- stores header/footer-related structured configuration data

### Core Laravel Tables

- `cache`
- `jobs`

These come from standard Laravel migrations.

## 12. Database Migrations Present

- `0001_01_01_000000_create_users_table.php`
- `0001_01_01_000001_create_cache_table.php`
- `0001_01_01_000002_create_jobs_table.php`
- `2026_04_15_000000_create_reviews_table.php`
- `2026_04_15_000001_create_blogs_table.php`
- `2026_04_15_000002_create_client_logos_table.php`
- `2026_04_15_000003_create_site_layout_settings_table.php`
- `2026_04_17_000004_create_videos_table.php`
- `2026_04_17_000005_create_contact_messages_table.php`
- `2026_04_17_000006_create_portfolios_table.php`

## 13. Shared SEO and Meta System

The SEO system is split into two main pieces:

- `config/seo.php`
- `app/Support/Seo/PageMeta.php`

How it works:

- `config/seo.php` stores route-based default descriptions
- `PageMeta` creates a structured meta object
- `resources/views/layouts/frontend.blade.php` renders:
  - title
  - meta description
  - canonical
  - Open Graph tags
  - Twitter tags

Dynamic usage examples:

- blog detail pages use blog excerpt/content
- review detail pages use review summary/content
- videos/portfolio/reviews listing pages can use counts in the meta text

## 14. Shared Frontend Data Injection

`app/Providers/AppServiceProvider.php` injects shared data into frontend views:

- `frontendReviewFeed`
- `footerRecentBlogs`

This means:

- the homepage testimonial widget can work without each controller manually passing reviews
- the footer can show recent blog links everywhere

The JSON payload is rendered by:

- `resources/views/components/frontend-data-scripts.blade.php`

## 15. Contact Form, Mail, and reCAPTCHA

### Contact flow

1. The frontend layout exposes the contact API URL in a `data-` attribute.
2. Frontend JavaScript submits the form to `POST /api/contact-messages`.
3. The request is validated by `ContactMessageRequest`.
4. A `contact_messages` row is created.
5. Laravel tries to send a notification email.

### reCAPTCHA

Support class:

- `app/Support/Recaptcha.php`

Config:

- `config/services.php`

Environment keys:

- `RECAPTCHA_ENABLED`
- `RECAPTCHA_SITE_KEY`
- `RECAPTCHA_SECRET_KEY`

Local behavior:

- when reCAPTCHA is enabled on `localhost` or `127.0.0.1`, the app can use Google's test keys

### Notification email resolution order

The app tries these values in order:

1. `CONTACT_NOTIFICATION_EMAIL`
2. site layout header email
3. site layout footer email
4. `MAIL_FROM_ADDRESS` if it is valid and not the default placeholder

## 16. Authentication and Middleware

Custom middleware aliases are registered in:

- `bootstrap/app.php`

Aliases:

- `admin.auth`
- `admin.guest`

Files:

- `app/Http/Middleware/EnsureAdminAuthenticated.php`
- `app/Http/Middleware/RedirectIfAdminAuthenticated.php`

Current behavior:

- unauthenticated users trying to open admin pages are redirected to `admin.login`
- authenticated users trying to revisit the login page are redirected to the dashboard

## 17. Assets and Media

### Shared frontend assets

- `public/frontend-assets/css/main.css`
- `public/frontend-assets/js/main.js`
- `public/frontend-assets/media/*`

Important brand assets:

- `public/frontend-assets/media/admin-use.png`
- `public/frontend-assets/media/admin-tab-mark.png`

### Admin assets

- `public/css/admin.css`

### Upload directories

- `public/uploads/blogs`
- `public/uploads/client-logos`
- `public/uploads/portfolios`
- `public/uploads/site-layout`

Current known uploaded/generated project media includes:

- blog images and SVG covers
- client logo SVG files
- portfolio SVG preview covers
- layout settings uploads when saved through the admin panel

## 18. Project Structure

```text
app/
  Http/
    Controllers/
      Admin/
      Api/
      Frontend/
    Middleware/
    Requests/
      Admin/
      Api/
  Models/
  Providers/
  Support/
    Seo/
      PageMeta.php
    Recaptcha.php

bootstrap/
  app.php

config/
  frontend-routes.php
  seo.php
  services.php

database/
  migrations/
  seeders/

public/
  css/
    admin.css
  frontend-assets/
    css/main.css
    js/main.js
    media/
  uploads/
    blogs/
    client-logos/
    portfolios/
    site-layout/

resources/
  views/
    admin/
    components/
    frontend/
      blog/
      clients/
      home/
      pages/
      portfolio/
      reviews/
      services/
      videos/
    layouts/
    partials/

routes/
  web.php
  api.php

README.md
vite.config.js
composer.json
package.json
```

## 19. Important Files to Know First

If a new developer joins this project, these files are the fastest way to understand it:

- `routes/web.php`
- `routes/api.php`
- `config/frontend-routes.php`
- `config/seo.php`
- `app/Providers/AppServiceProvider.php`
- `app/Support/Seo/PageMeta.php`
- `app/Support/Recaptcha.php`
- `resources/views/layouts/frontend.blade.php`
- `resources/views/admin/layouts/app.blade.php`
- `public/frontend-assets/js/main.js`
- `public/frontend-assets/css/main.css`
- `public/css/admin.css`

## 20. Local Setup

### Requirements

- PHP 8.2+
- Composer
- Node.js and npm
- MySQL
- XAMPP or equivalent local PHP/MySQL stack is fine

### Install

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate
npm install
```

### Build frontend resources

```bash
npm run build
```

### Development mode

```bash
composer run dev
```

This runs:

- `php artisan serve`
- queue listener
- Laravel Pail log viewer
- Vite dev server

### Useful cache commands

```bash
php artisan optimize:clear
php artisan view:cache
php artisan route:clear
php artisan config:clear
```

## 21. Environment Notes

Important `.env.example` defaults currently include:

- `APP_URL=http://localhost`
- `DB_CONNECTION=mysql`
- `DB_HOST=127.0.0.1`
- `DB_PORT=3306`
- `MAIL_MAILER=log`
- `RECAPTCHA_ENABLED=false`

The local database used while documenting this project was:

- `DB_DATABASE=sortiq`

You can change this for your own machine.

## 22. How to Add or Edit Content

### Blogs

- go to `/sortiqadmin/blogs`
- create or edit a blog
- published blogs appear on `/blog`

### Reviews

- go to `/sortiqadmin/reviews`
- create or edit a review
- published reviews appear on `/reviews`
- published reviews also feed the homepage testimonials

### Client Logos

- go to `/sortiqadmin/client-logos`
- published logos appear on the clients page and homepage

### Videos

- go to `/sortiqadmin/videos`
- published videos appear on `/videos`
- the homepage shows a limited set

### Portfolios

- go to `/sortiqadmin/portfolios`
- published items appear on `/portfolio`

### Contact Messages

- visitors submit through the frontend contact form
- records appear in `/sortiqadmin/contact-messages`

### Header/Footer Settings

- go to `/sortiqadmin/site-layout`
- values are stored in `site_layout_settings`
- remember:
  parts of the public header/footer are still hardcoded, so not every saved setting changes the live frontend yet

## 23. Routing and Content Reality

This project uses a mixed content strategy:

- static Blade pages for many company/service pages
- dynamic database-driven pages for blogs, reviews, client logos, videos, and portfolios

That means:

- not every page is editable from the admin panel
- service pages are currently file-based
- blog/review/video/portfolio/client content is database-driven

## 24. Known Architectural Notes

These are important for anyone maintaining the project:

1. Vite exists, but the main live layouts currently load static assets from `public/`.
2. The site layout settings module is only partially wired into the public frontend.
3. `config/frontend-routes.php` is the central place for page/service/legacy slug mapping.
4. Shared review and recent blog data are injected globally by `AppServiceProvider`.
5. Most service pages are large static Blade templates and are not stored in the database.

## 25. Troubleshooting

### A page is not updating

Try:

```bash
php artisan optimize:clear
php artisan view:cache
```

### A dynamic section is empty

Check:

- the related database table has rows
- content status is `published`
- uploaded media path exists in `public/uploads/...`

### Contact form saves but no email arrives

Check:

- `MAIL_*` settings
- `CONTACT_NOTIFICATION_EMAIL`
- site layout header/footer email values
- Laravel logs

### reCAPTCHA errors

Check:

- `RECAPTCHA_ENABLED`
- site key and secret key
- whether the host is local or production

## 26. Suggested First Read for a New Developer

If you are onboarding into this codebase, read in this order:

1. `README.md`
2. `routes/web.php`
3. `config/frontend-routes.php`
4. `resources/views/layouts/frontend.blade.php`
5. `app/Providers/AppServiceProvider.php`
6. `app/Http/Controllers/Frontend/*`
7. `app/Http/Controllers/Admin/*`
8. `app/Models/*`

## 27. Summary

This project is a Laravel-based business website with:

- a database-backed blog system
- a review/testimonial system
- a portfolio section
- a videos section
- client logos
- contact form handling
- an admin dashboard for content management
- route-based SEO and metadata
- responsive frontend and admin layouts

If you keep in mind the split between static Blade content and database-driven content, the structure becomes much easier to understand and maintain.
