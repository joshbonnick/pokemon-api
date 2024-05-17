## Installation

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

4. **Start the Development Environment**

    ```bash
    ./vendor/bin/sail up -d
    ```

5. **Generate Application Key**

    ```bash
    ./vendor/bin/sail artisan key:generate
    ```

6. **Run Database Migrations**

    ```bash
    ./vendor/bin/sail artisan migrate
    ```

7. **Install NPM Packages**

    ```bash
    ./vendor/bin/sail npm install
    ```

8. **Build Front-End Assets**

    ```bash
    ./vendor/bin/sail npm run build
    ```

9. **Access the Application**

   You can now access the application at [http://localhost](http://localhost).

## Importing Pokemon

Queue must either be set to `sync` or run the jobs that are queued with `artisan queue:work`

**This process takes around 90 seconds when running the queue synchronously.**

```bash
./vendor/bin/sail artisan pokemon:import
```
