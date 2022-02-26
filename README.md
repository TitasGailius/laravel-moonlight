I stand with Ukraine | 🇺🇦
:---: | :---

# Laravel Moonlight

Laravel Moonlight is a carefully crafted Laravel preset for your next SPA application.

Leverage an existing server-side framework to create a fully client-side rendered, single-page application without much of the complexity that comes with a modern SPA.

![Laravel Moonlight](./screenshots/logo.jpg)

---

## Stack

* [TailwindCSS](https://tailwindcss.com/)
* [InertiaJS](https://inertiajs.com/)
* [VueJS](https://vuejs.org/)
* [Ziggy](https://github.com/tightenco/ziggy) (Use named routes in your JS)

## Installation

Installed using composer:
```bash
composer require titasgailius/laravel-moonlight
```

## Usage

Once the package has been installed, you may install the scaffolding using the ui Artisan command:

```bash
// Generate basic scaffolding
php artisan ui moonlight

// Include authentication scaffolding
php artisan ui moonlight --auth
```

## Screenshots

![GitHub Logo](screenshots/signin.png)
---
![GitHub Logo](screenshots/signup.png)
---
![GitHub Logo](screenshots/email.png)
---
![GitHub Logo](screenshots/reset.png)
---
![GitHub Logo](screenshots/confirm.png)

![GitHub Logo](screenshots/home.png)

## Project Structure
```
project
│ - webpack.mix.js
│
└───resources
│   |
│   └───js
│   |   │ - app.js
│   |   │ - bootstrap.js
│   |   │
│   |   └───components // Global components that are auto-registered.
|   |   |   | - form-input.vue
|   |   |
│   |   └───layouts
|   |   |   | - app.vue
|   |   |
│   |   └───pages // This is where you put your application pages.
│   |       │ - home.vue
│   |       │ - welcome.vue
│   |       │
│   |       └───auth
│   |           │ - login.vue
│   |           │ - register.vue
│   |           │ - verify.vue
│   |           │
│   |           └───passwords
│   |               │ - confirm.vue
│   |               │ - email.vue
│   |               │ - reset.vue
│   |
│   └───sass
│   |   | - app.scss
│   │
│   └───views
│       │ - app.blade.php
|
└───app/Providers
    | // Here you may register any variables that are shared between pages.
    │ - InertiaServiceProvider.php
```
