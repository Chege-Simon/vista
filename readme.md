# Vista

Vista is a Horizon-style scheduler monitor for Laravel. It provides a beautiful Vue-powered dashboard to view, supervise, and manage your scheduled tasks in real time. With Vista, you can track the status of your jobs, monitor the scheduler loop, and ensure your application's scheduled commands are running reliably.

---

## ✨ Features

- 📊 **Dashboard UI** — A Vue SPA that displays your scheduled tasks and their execution status.
- ⏱️ **Scheduler Supervisor** — Runs `schedule:run` at configurable intervals.
- ⚙️ **Configurable Interval** — Control how often Vista checks and runs tasks.
- 🔌 **Laravel Package** — Ships as a reusable package with auto-discovery.
- 🧪 **Tested with Orchestra Testbench** — Ensures reliability across Laravel versions.

---

## 📦 Installation

Require Vista via Composer:

```bash
composer require chege-simon/vista
```

## 🔧 Publishing Assets

Vista ships with configuration, views, and compiled dashboard assets. Publish them with:

```bash
php artisan vendor:publish --tag=vista-config
php artisan vendor:publish --tag=vista-views
php artisan vendor:publish --tag=vista-assets

```

## ⚙️ Configuration

The default configuration file is `config/vista.php`. You can adjust the scheduler interval:

```php
return [
    'interval' => 60, // seconds between schedule checks
];
```

## 🚀 Usage

Start the Vista scheduler supervisor:

```bash
php artisan vista
```

This will run `schedule:run` every configured interval and log output to your console.

## 🖥️ Dashboard

After installation, visit:

```
http://your-app.test/vista
```

to access the Vue SPA dashboard. Here you can monitor scheduled tasks, view logs, and confirm that your scheduler is running smoothly.

## 🔄 Release Workflow

For maintainers:

1. Build frontend assets with Vite:

```bash
npm run build
```

2. Commit compiled assets.
3. Update `CHANGELOG.md`.
4. Tag a release:

```bash
git tag v0.5.0
git push origin v0.5.0
```

5. Packagist will auto-update, making the new version installable.

## 🧪 Testing

Vista uses Orchestra Testbench to ensure compatibility with Laravel. Run the test suite with:

```bash
vendor/bin/phpunit
```

## 🤝 Contributing

Pull requests are welcome! Please include tests and follow Laravel package conventions. For major changes, open an issue first to discuss what you would like to change.

## 📜 License

Vista is open-source software licensed under the MIT license.