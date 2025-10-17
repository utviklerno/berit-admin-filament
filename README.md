# Berit Admin Filament

Laravel 12 + Filament 4 admin panel for managing Berit platform content, users, and configuration. The project combines Laravel's backend with Filament's component library and Tailwind-powered UI.

## Tech Stack

- **Backend:** Laravel 12, PHP 8.3
- **Admin UI:** Filament 4
- **Frontend Tooling:** Vite, Tailwind CSS
- **Database:** MySQL (see `database/migrations`)

## Local Development

1. Install dependencies:
   ```bash
   composer install
   npm ci
   ```
2. Configure environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. Run migrations & seeders as needed:
   ```bash
   php artisan migrate --seed
   ```
4. Start the dev stack:
   ```bash
   composer run dev
   ```

See `README.md` in the repo root or Filament docs for additional details about running queues, storage links, etc.

## Project Conventions

- PSR-12 coding style, format with `vendor/bin/pint -v`
- Filament resources live under `app/Filament`
- Blade overrides are placed in `resources/views/vendor/filament`
- Custom reusable Blade components live in `resources/views/components`
- Icons and other static assets live in `public/`

## Recent Customizations

These updates were made to align Filament actions with our custom UI and to resolve issues observed during record deletion:

- **Custom Filament action buttons** (`resources/views/vendor/filament/actions/edit.blade.php`, `delete.blade.php`)
  - Actions render bespoke buttons that use the shared `<x-custom-icon>` component for consistent styling.
- **Livewire delete action fix** (`resources/views/vendor/filament/actions/delete.blade.php`)
  - Updated to call `mountAction('delete', ..., { table: true, recordKey: @js($recordKey) })`, fixing the `callAction` Livewire error when deleting table records from custom templates.
- **Custom icon component** (`resources/views/components/custom-icon.blade.php`)
  - Centralized helper that renders SVGs from `public/images/icons/icons05`. Add new icons by dropping SVG files into that folder and referencing them via `<x-custom-icon name="icon-file-name" />`.

## Custom Icon Workflow

1. Save your SVG in `public/images/icons/icons05/<icon-name>.svg`.
2. Reference the icon with `<x-custom-icon name="<icon-name>" />` in your Blade view.
3. For Filament actions, point to a Blade override (see `Action::configureUsing()` in the relevant service provider) and include the component.

## Testing

Run the full test suite with:
```bash
composer test
```

## Contributing

- Create focused branches per feature/fix.
- Follow the coding standards and update tests/documentation as appropriate.
- Submit PRs with a summary of changes, screenshots for UI updates, and note any new env/config requirements.
