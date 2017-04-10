# Siravel - Add a CMS to any Laravel app to gain control of: pages, blogs, galleries, events, custom modules, images and more.

[![Build Status](https://travis-ci.org/YABhq/Siravel.svg?branch=master)](https://travis-ci.org/YABhq/Siravel)
[![Packagist](https://img.shields.io/packagist/dt/yab/siravel.svg?maxAge=2592000)](https://packagist.org/packages/yab/siravel)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg?maxAge=2592000)](https://packagist.org/packages/yab/siravel)

Siravel is a full fledged CMS that can be added to any Laravel application. It provides you with full control of things like: pages, menus, links, widgets, blogs, events, faqs etc.

Siravel comes with a module builder for all your custom CMS needs, as well as a module publishing tools. So if you decide to reuse some modules on future projects you can easily publish thier assets seamlessly. If you wish to make your Siravel module into a PHP package, then you will need to have it publish its assets to the `siravel/modules` directory.

### What is simple vs complex setup?
Simple setup uses Laracogs as the backbone of an app for you using Laravel, once the setup command has been run you will have a full CMS as an app. Complex setup is specifically for developers who want to add a CMS to their existing app.

## Documentation
[http://siravelcms.com](http://siravelcms.com)

## Sitec Newsletter
[Subscribe](http://eepurl.com/ck7dSv)

## Requirements
1. PHP 5.6+
1. MySQL 5.6+
2. OpenSSL

## Recommended
1. PHP 7+
1. MySQL 5.7+

## Compatibility Guide

| Laravel Version | Package Tag | Supported |
|-----------------|-------------|-----------|
| 5.4.x | 2.3.x | yes |
| 5.3.x | 2.0.x - 2.2.x | no |
| 5.1.x - 5.2.x | 1.4.x | no |

## Installation

Create a new Laravel application, and make a database somewhere and update the .env file.

* Run the following command:

```bash
composer require sitec/siravel
```

* Add the following to your Providers array in your config/app.php file:

```php
Sitec\Siravel\SiravelProvider::class,
```

* Then run the vendor publish:

```bash
php artisan vendor:publish --provider="Sitec\Siravel\SiravelProvider"
```

## Simple Setup

If you're looking to do a simple website with a powerful CMS, and the only people logging on to the app are the CMS managers. Then you can run the setup command.
Siravel will install everything it needs, run its migrations and give you a login to start with. Take control of your website in seconds.

```php
php artisan siravel:setup
```

Now your done setup. Login, and start building your amazing new website!

## Complex Setup

If you just want to add Siravel to your existing application and already have your own

* Add the following to your routes provider:

```php
require base_path('routes/siravel.php');
```

* Add the following to your app.scss file, you will want to modify depending on your theme of choice.

```css
@import "resources/themes/default/assets/sass/_theme.scss";
```

* Then migrate:

```bash
php artisan migrate
```

* Then add to the Kernel Route Middleware:

```php
'siravel' => \App\Http\Middleware\Siravel::class,
'siravel-api' => \App\Http\Middleware\SiravelApi::class,
'siravel-language' => \App\Http\Middleware\SiravelLanguage::class,
'siravel-analytics' => \Sitec\Siravel\Middleware\SiravelAnalytics::class,
```

In order to have modules load as well please add the following to your composer file under autoload psr-4 object:
```php
"Siravel\\": "siravel/",
```
This should be added to the autoloader below the App itself.

## Siravel Access
Route to the administration dashboard is "/siravel/dashboard".

Siravel requires Laracogs to run (only for the FormMaker), but Siravel does not require you to use the Laracogs version of roles. But you will still need to ensure some degree of control for Siravel's access. This is done in the Siravel Middleware, using the gate and the Siravel Policy. If you opt in to the roles system provided by Laracogs, then you can replace 'siravel' with admin to handle the Siravel authorization, if not, you will need to set your own security policy for access to Siravel. To do this simply add the Siravel policy to your `app/Providers/AuthServiceProvider.php` file, and ensure that any rules you wish it to use are in within the policy method. We suggest a policy similar to below.

Possible Siravel Policy:
```
Gate::define('siravel-api', function ($user) {
    return true;
});

Gate::define('siravel', function ($user) {
    return (bool) $user;
});
```

Or Using Laracogs:
```
Gate::define('siravel', function ($user) {
    return ($user->roles->first()->name === 'admin');
});
```

### Roles & Permissions (simple setup only)

With the roles middleware you can specify which roles are applicable separating them with pipes: `['middleware' => ['roles:admin|moderator|member']]`.

The Siravel middleware utilizes the roles to ensure that a user is an 'admin'. But you can elaborate on this substantially, you can create multiple roles, and then set their access in your app, using the roles middleware. But, what happens when you want to allow multiple roles to access Siravel but only allow Admins to access your custom modules? You can use permissions for this. Similar to the roles middleware you can set the permissions `['middleware' => ['permissions:admin|siravel']]`. You can set custom permissions in `config/permissions.php`. This means you can set different role permissions for parts of your CMS, giving you even more control.

## API Endpoints

Siravel comes with a collection of handy API endpoints if you wish to use them. You can define your own policies for access and customize the middleware as you see fit.

#### Token

The basic Siravel API endpoints must carry the Siravel `apiToken` defined in the config for the app. This can be provided by adding the following to any request:

```
?token={your token}
```

** All published and public facing data will be available via the API by default.

```
/siravel/api/blog
/siravel/api/blog/{id}
/siravel/api/events
/siravel/api/events/{id}
/siravel/api/files
/siravel/api/files/{id}
/siravel/api/images
/siravel/api/images/{id}
```

## License

Siravel is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

### Bug Reporting and Feature Requests

Please add as many details as possible regarding submission of issues and feature requests

### Disclaimer

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
