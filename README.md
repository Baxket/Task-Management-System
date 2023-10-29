# Laravel Application Setup Guide

This guide provides step-by-step instructions on how to set up a Laravel application from scratch. Follow these instructions to get your Laravel project up and running.

### Getting Started

- Base URL: This app is ran locally and therefore not hosted as a base url.  The app is hosted at the default, `http://127.0.0.1:8000/`.
- Authentication: This version of the application requires authentication.


#### Pre-requisites and Local Development


To run this project, ensure that you have the following prerequisites installed on your system:

- [Composer](https://getcomposer.org/): A PHP package manager
- [PHP](https://www.php.net/): PHP 7.4 or higher
- [MySQL](https://www.mysql.com/) or [PostgreSQL](https://www.postgresql.org/) (or any other supported database)
- [Node.js](https://nodejs.org/): For managing front-end assets (optional)
- [Git](https://git-scm.com/): Version control (optional)
- [VSCode](https://code.visualstudio.com/): For viewing and editing codes


## Installation

1. **Extract the zip file:**

   Extract the zip file to get all the files or if from github, clone it and open it with vsCode.

   ```bash
   git clone <repository-url>
   cd <your-project-directory>
    ```
2. **Install PHP Dependencies:**

    Open the terminal from vsCode and use Composer to install PHP dependencies using the command below.
   ```bash
    composer install
    ```
3. **Environment Configuration:**

    Create a copy of the .env.example file and name it .env. Update the .env file with your database and other configuration settings using the command below.

    ```bash
    cp .env.example .env
    ```
4. **Generate an Application Key:**

    Generate a unique application key for the application using the command below.
     ```bash
    php artisan key:generate
    ```

5. **Database Setup:**

    Create a new database for your application and update the database connection settings in the .env file like stated below with your right details.

     ```bash
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=task_management
        DB_USERNAME=root
        DB_PASSWORD=
    ```
6. **Run Database Migrations:**

    Start the Laravel development server by entering this command.
       ```bash
    php artisan serve
    ```
    The application will be accessible at http://localhost:8000.
