# Repository Guidelines

Concise guide for contributing to this Laravel 12 + Filament 4 app with Vite + Tailwind.

## Project Structure & Module Organization
- `app/` domain logic and admin UI (`app/Filament`, `app/Services`); HTTP in `app/Http`.
- `routes/` route definitions (`web.php`, `api.php`).
- `resources/` Blade, JS/CSS, and Vite entrypoints.
- `database/` migrations, factories, seeders.
- `tests/` unit and feature tests.
- `public/`, `storage/`, `config/` for assets, app storage, and configuration.
- See `IMAGE_UPLOAD_README.md` for image processing and storage details.

## Build, Test, and Development Commands
- Install deps: `composer install && npm ci`
- Configure app: `cp .env.example .env && php artisan key:generate`
- Migrate/seed DB: `php artisan migrate` (add `--seed` as needed)
- Dev workflows: `composer run dev` (serves app, queue, logs, Vite)
- Build frontend: `npm run build`
- Run tests: `composer test` (clears config, runs PHPUnit)

## Coding Style & Naming Conventions
- PHP PSR-12; format with Pint: `vendor/bin/pint -v`
- 4-space indents; UTF-8; Unix line endings
- Naming: Classes `PascalCase`; methods/vars `camelCase`; tables `snake_case_plural`
- Blade paths under `resources/views/...` with kebab-case filenames
- Routes use dot notation (e.g., `items.index`)

## Testing Guidelines
- Framework: PHPUnit (`phpunit.xml`)
- Locations: `tests/Feature/*Test.php`, `tests/Unit/*Test.php`
- Conventions: arrange–act–assert; single responsibility per test; names like `it_updates_user_profile`
- Run: `composer test` or `php artisan test`; prefer factories/seeders for realistic data

## Commit & Pull Request Guidelines
- Commits: imperative and scoped (e.g., "Add item image upload")
- PRs: state purpose, summarize changes, add screenshots for Filament UI, note migrations, link issues
- Keep PRs focused; include a checklist when adding config/env

## Security & Configuration Tips
- Do not commit secrets; ensure `APP_KEY` is set
- Fix permissions for `storage/` and `bootstrap/cache/`
- Create storage symlink if needed: `php artisan storage:link`

## Custom Agents
- `Laravel & Filament Specialist`: Use when work requires deep knowledge of Filament 4+ or Laravel 12 internals. See `agents/laravel-filament-specialist.md` for persona, workflow, and quality guardrails.
