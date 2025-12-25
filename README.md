<p align="center"><img width="249" height="71" alt="logo-big" src="https://github.com/user-attachments/assets/3bd14f60-be61-4c54-b01d-8094611c2d72" /></p>


## About Pivlu

Pivlu is a free and open source CMS (Content Managementr System) and Website Builder. Pivlu is an WordPress alternative, written in PHP and using the Laravel framework.

> [!NOTE]
> **This repository contains the code for a fresh Pivlu project that is installed via the command line.**
> 
> The code for the core Pivlu CMS package can be found here: [Pivlu CMS core package repository](https://github.com/pivlu/cms).

## Quick Start Installation
If you have composer installed, run this in your terminal to create a fresh project in a directory named "myprivlu".

```composer create-project pivlu/pivlu mypivlu```

After creating the project, go to your project folder and install Pivlu CMS from command line..

```cd mypivlu```

```php artisan pivlu:install```

This command will create database tables, setup website, copy the assets files and create an admin user.
