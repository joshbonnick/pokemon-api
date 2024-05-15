# Laravel Project Setup with Sail

Follow these steps to set up the project on your local machine using Laravel Sail.

## Prerequisites

Before you begin, ensure you have the following installed on your machine:

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Getting Started

1. **Clone the Repository**

    ```bash
    git clone https://github.com/joshbonnick/pokemon-api.git
    cd pokemon-api
    ```

2. **Installing Composer Dependencies**

    ```bash
   docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php83-composer:latest \
        composer install --ignore-platform-reqs
    ```

3. **Copy .env Example**

    ```bash
    cp .env.example .env
    ```

4. **Generate Application Key**

    ```bash
    ./vendor/bin/sail artisan key:generate
    ```

5. **Start the Development Environment**

    ```bash
    ./vendor/bin/sail up -d
    ```

6. **Run Database Migrations**

    ```bash
    ./vendor/bin/sail artisan migrate
    ```

7. **Access the Application**

   You can now access the application at [http://localhost](http://localhost).

## Importing Pokemon

    This process takes around 90 seconds.

```bash
    sail artisan pokemon:import
```
