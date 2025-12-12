Vista Release & Installation Workflow
1. Development Phase
Source code lives in src/ (PHP classes, service provider, commands).

Frontend assets in resources/js/dashboard (Vue SPA, Vite build).

Tests in tests/ (Orchestra Testbench, PHPUnit).

Config, routes, views in their respective folders.

Daily workflow
Write PHP code under Vista\… namespace.

Build Vue SPA with:

bash
npm install
npm run dev   # for local development
npm run build # for production build
Run tests:

bash
vendor/bin/phpunit
2. Preparing a Release
Update version in composer.json and package.json (keep them in sync).

Build frontend assets:

bash
npm run build
→ This generates compiled JS/CSS in resources/js/vendor/vista or dist/. → Commit these compiled assets so users don’t need Node/Vite.

Update CHANGELOG.md with release notes.

Tag the release:

bash
git add .
git commit -m "Release v0.5.0"
git tag v0.5.0
git push origin v0.5.0
Verify on GitHub/Packagist:

GitHub → Releases shows v0.5.0.

Packagist auto‑updates and makes 0.5.0 installable.

3. Installation (End‑User Workflow)
For developers installing Vista:

Require via Composer:

bash
composer require chege-simon/vista:^0.5
Auto‑discovery:

Laravel auto‑loads VistaServiceProvider thanks to your extra.laravel.providers block.

No manual provider registration needed.

Publish assets/config/views:

bash
php artisan vendor:publish --tag=vista-config
php artisan vendor:publish --tag=vista-views
php artisan vendor:publish --tag=vista-assets
Run the dashboard:

Visit /vista → Vue SPA loads.

Run the supervisor:

bash
php artisan vista
Verify tasks:

Redis registry shows scheduled tasks.

Dashboard displays task status.

4. Maintenance Cycle
Bugfixes → bump patch version (v0.5.1).

New features → bump minor version (v0.6.0).

Breaking changes → bump major version (v1.0.0).

Always:

Update CHANGELOG.md..

Tag and push.

Commit compiled assets.

