# Laravel Skeleton

A starter template for Laravel applications with code quality tools, testing, and AI-assisted development support.

## Quick Start

```bash
laravel new my-app --using=maxwellmezadre/laravel-skeleton
```

Or clone manually:

```bash
git clone https://github.com/maxwellmezadre/laravel-skeleton.git my-app
cd my-app
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan boost:install
```

## Commands

| Command | Description |
|---------|-------------|
| `composer dev` | Start server, queue, logs and Vite |
| `composer test` | Run all tests and checks |
| `composer format` | Format code with Rector and Pint |

### Individual tests

```bash
composer test:types         # PHPStan
composer test:arch          # Architecture tests
composer test:unit          # Unit tests
composer test:type-coverage # Type coverage (100%)
composer test:typos         # Typo checking
```

## Stack

- **Laravel 12** with PHP 8.5+
- **Pest 4** for testing
- **PHPStan** for static analysis
- **Rector** + **Laravel Rector** for refactoring
- **Pint** for code style
- **Tailwind CSS 4** + **Vite 7**
- **Captain Hook** for git hooks
- **Laravel Boost** for AI-assisted development

## Git Hooks

- `commit-msg`: Validates Conventional Commits
- `pre-commit`: Formats code
- `pre-push`: Runs tests

## Locale

Configured for PT-BR by default (`config/app.php`).

---

Created by [Maxwell Mezadre](https://github.com/maxwellmezadre)
