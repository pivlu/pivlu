<p align="center">
  <a href="https://pivlu.com" target="_blank">
    <strong style="font-size: 2rem;">Pivlu</strong>
  </a>
</p>

<p align="center">
  <strong>Open source Business Platform</strong>
</p>

<p align="center">
  <a href="https://opensource.org/license/agpl-v3"><img src="https://img.shields.io/badge/License-AGPL--3.0-blue.svg" alt="License"></a>
  <a href="https://github.com/pivlu/pivlu"><img src="https://img.shields.io/github/stars/pivlu/pivlu?style=social" alt="Stars"></a>
</p>

---

Pivlu is a free, open source, self-hosted business platform. It comes with a complete suite of tools that any business, team, or website owner needs — all in one place.

## Features

### Release 1 — Website Builder
- Pages (create, edit, publish, with blocks/sections)
- Blog (posts, categories)
- Navigation builder
- Footer builder
- Contact form
- Theme/style system
- SEO meta per page
- Media library

### Planned
- Basic CRM (contacts, deals)
- Bookings
- Forms
- Invoicing

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 13 |
| Authentication | Laravel Fortify |
| CSS | Bootstrap 5.3 (CDN) |
| Icons | Bootstrap Icons (CDN) |
| Font | Nunito (Google Fonts) |
| JS | Vanilla JavaScript |
| Database | MySQL / MariaDB |

## Requirements

- PHP 8.3+
- MySQL 8.0+ or MariaDB 10.6+
- Composer

## Installation

```bash
# Clone the repository
git clone https://github.com/pivlu/pivlu.git
cd pivlu

# Install dependencies
composer install

# Copy environment file and generate key
cp .env.example .env
php artisan key:generate

# Configure your database in .env, then run migrations
php artisan migrate

# Seed the database (optional)
php artisan db:seed

# Start the development server
php artisan serve
```

Then open `http://localhost:8000` in your browser.

## Configuration

Edit the `.env` file to configure:

```
APP_NAME=Pivlu
APP_URL=http://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=pivlu
DB_USERNAME=root
DB_PASSWORD=
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/your-feature`)
3. Commit your changes (`git commit -m 'Add your feature'`)
4. Push to the branch (`git push origin feature/your-feature`)
5. Open a Pull Request

## Security Vulnerabilities

If you discover a security vulnerability, please send an email to [office@pivlu.com](mailto:office@pivlu.com). All security vulnerabilities will be promptly addressed.

## License

Pivlu is open source software licensed under the [AGPL-3.0 License](https://opensource.org/license/agpl-v3).

Copyright (c) Iosif Gabriel Chimilevschi — [pivlu.com](https://pivlu.com)
