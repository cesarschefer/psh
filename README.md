# Project Setup Instructions

### Steps

1. Clone the repository:
    ```bash
    git clone https://github.com/cesarschefer/psh.git
    ```
2. Change to development branch:
   ```bash
   git checkout devel
   ```
   
## Backend Setup (Laravel 11)

### Prerequisites
- Wampp or Xampp, to interact with Apache and MySQL.
- Composer

1. Inside the backend folder, install dependencies by running:
    ```bash
    composer install
     ```
   
2. Create a `.env` file (you can use `.env.example` as a template).
   
3. Run migrations:
    ```bash
    php artisan migrate
     ```
   
4. Start the server by running:
   ```bash
    php artisan serve
    ```
   By default, the server will be accessible at http://127.0.0.1:8000.

5. If you encounter SSL certificate issues when accessing the GET endpoint (/api/statistics), please refer to:
   [SSL Certificate Problem - Laravel Forum Discussion](https://laracasts.com/discuss/channels/laravel/guzzlehttp-exception-requestexception-curl-error-60-ssl-certificate-problem-unable-to-get-local-issuer-certificate-see-httpcurlhaxxselibcurlclibcurl-errorshtml)

6. To set up the cron job for scheduling:
  ```bash
   * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
  ```
  More info: https://laravel.com/docs/11.x/scheduling
	In case you want to execute manually you can send a POST request to the endpoint (/api/statistics)
   
7. To run the tests:
  Create psr_demo_test database.
  Run the tests:
  ```bash
   php artisan test
  ```

## Frontend Setup (React 18)

### Prerequisites
- Node

1. Inside the frontend folder, install dependencies by running:
   ```bash
   npm install
   ```

2. Start the frontend server with:
   ```bash
   npm start
   ```
	
