# Katana static site & blog generator

[![Latest Version on Packagist](https://img.shields.io/packagist/v/themsaid/katana.svg?style=flat-square)](https://packagist.org/packages/themsaid/katana)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.txt)
[![Total Downloads](https://img.shields.io/packagist/dt/themsaid/katana.svg?style=flat-square)](https://packagist.org/packages/themsaid/katana)

PHP static site & blog generator with markdown support.

Using the power of laravel's Blade templating engine.

> This repository contains the core code. If you want to use Katana visit [this repository](https://github.com/themsaid/katana)

## Installation

To install a fresh Katana installation you need to [install composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx) & run the following command:

```
composer create-project themsaid/katana my-new-site
```

Once the installation is done you may build your website using the command:

```
php katana build
```

Katana is shipped with sample content to help you get started immediately, and after this command runs your site will be generated in the `/public` directory.

## Documentation

The complete Katana documentation can be found here: http://themsaid.github.io/katana/

## Blog generator

Katana is shipped with a static blog generator, all you need to do is create a new `.blade.php` file in the `/content/_blog` directory and Katana
will compile all the posts and present them in a view of your choice or you can run in terminal for create the file automatically.

```
php katana post "Title of the post"
```

If you prefer create a Markdown file, add `--m` in the end of the command.

Blog posts list is paginated based on the configuration options in `config.php`. There's also a `$blogPosts` variable available in all your blade
views that contains an array of posts.

## Blade templating engine

Blade is a simple yet powerful templating engine built for laravel, you need to [check Blade's documentation](https://laravel.com/docs/5.2/blade) if you're not already familiar with it.

## Using with GitHub Pages
You can use Katana to publish a website over GitHub Pages using subtrees, the idea is to deploy the public directory as the master branch of your user GitHub pages repository or the gh-pages branch of your project repository.

You can find the full details in [the documentation](http://themsaid.github.io/katana/).