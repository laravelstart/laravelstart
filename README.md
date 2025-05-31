# Laravel Start

<p align="center">
  <img src="/public/images/og-preview.png" alt="Laravel Start Logo" width="400"/>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel Start

Laravel Start is an open-source platform that helps developers create, manage, and reuse Laravel starter kits. It allows you to:

- Share your Laravel workflow with the community
- Bootstrap personal projects to speed up development
- Discover starter kits created by other developers
- Track and manage your projects based on these kits

Whether you're looking to kickstart a new project with a proven setup or share your own workflow with others, Laravel Start streamlines the process of working with Laravel starter kits.

## Features

- **Browse Starter Kits**: Explore a variety of Laravel starter kits categorized by features and technologies
- **Kit Details**: View comprehensive information about each kit including dependencies, installation count, and preview images
- **GitHub Integration**: Connect with GitHub to easily import and share starter kits
- **Project Management**: Create and manage projects based on starter kits
- **Personalization**: Pin your favorite kits for quick access
- **User Dashboard**: Track your kits, projects, and activity
- **Technology Tags**: Filter kits by technologies (Laravel, Filament, Inertia, React, Vue, etc.)
- **Email Notifications**: Stay updated about new kits and activities

## Requirements

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL or compatible database
- Git

## Local Setup

### 1. Clone the repository

```bash
git clone https://github.com/yourusername/laravel-start.git
cd laravel-start
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit the `.env` file to configure:
- Database connection (DB_*)
- GitHub OAuth credentials (GITHUB_*)
- Resend API key for emails (RESEND_API_KEY)
- Admin emails (ADMIN_EMAILS)

### 4. Set up the database

```bash
php artisan migrate
```

### 5. Build frontend assets

```bash
npm run build
```

### 6. Start the development server

```bash
# Option 1: Run all services with the dev script
composer dev

# Option 2: Run services individually
php artisan serve
php artisan queue:listen
npm run dev
```

The application will be available at http://localhost:8000

## Usage

### Browsing Starter Kits

Visit the homepage to browse available starter kits. You can filter by technology tags or search for specific kits.

### Creating a Project from a Kit

1. Sign in to your account
2. Browse and select a starter kit
3. Click "Create Project" and follow the setup wizard
4. Your new project will be available in your dashboard

### Sharing Your Own Starter Kit

1. Sign in to your account
2. Connect your GitHub account
3. Click "Create Kit" in your dashboard
4. Provide the GitHub repository details and additional information
5. Submit your kit for review

## Contributing

We welcome contributions to Laravel Start! Here's how you can help:

### Reporting Issues

If you find a bug or have a feature request, please open an issue on GitHub with:
- A clear description of the issue/feature
- Steps to reproduce (for bugs)
- Any relevant screenshots or error messages

### Development Workflow

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Make your changes
4. Test your changes carefully before submitting (as a contributor, you are responsible for ensuring your changes work correctly)
5. Commit your changes (`git commit -m 'Add some amazing feature'`)
6. Push to the branch (`git push origin feature/amazing-feature`)
7. Open a Pull Request

### Coding Standards

- Follow PSR-12 coding standards
- Keep documentation up-to-date
- Use type hints and return types where possible

> **Note:** As a regular user of Laravel Start, you don't need to worry about tests or static analysis. However, if you're contributing code, please ensure your changes are thoroughly tested before submission.

## License

Laravel Start is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Acknowledgements

- [Laravel](https://laravel.com) - The web framework used
- [Filament](https://filamentphp.com) - Admin panel toolkit
- [Inertia.js](https://inertiajs.com) - The modern monolith
- [Tailwind CSS](https://tailwindcss.com) - For styling
- [GitHub API](https://docs.github.com/en/rest) - For repository integration
