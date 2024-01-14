# Real-time Stock Price Aggregator

## Getting Started

1. **Clone Repository:**
    ```bash
    git clone https://github.com/GiorgiJangveladze/real-time-stock-app
    cd your-repository
    ```

2. **Set Up Environment:**
    ```bash
    cp .env.example .env
    ```

3. **Get Alpha Vantage API Key:**
    Register on [Alpha Vantage](https://www.alphavantage.co/) to obtain your free API key.

4. **Configure Environment Variables:**
    Open `.env` and add your Alpha Vantage API key:
    ```env
    ALPHA_VANTAGE_URL="https://www.alphavantage.co/query"
    ALPHA_VANTAGE_API_KEY="your-api-key"
    ```

5. **Install Docker:**
    Download and install Docker from [Docker's official website](https://www.docker.com/get-started).

6. **Run Docker Containers:**
    ```bash
    sail up
    ```

7. **Install Dependencies:**
    ```bash
    sail composer install
    ```

8. **Generate Laravel Application Key:**
    ```bash
    sail php artisan key:generate
    ```

9. **Run Migrations:**
    ```bash
    sail php artisan migrate
    ```

10. **Seed Database:**
    ```bash
    sail php artisan db:seed
    ```

11. **Connect to Database:**
    Use any database management tool to connect to the MySQL server running in the Docker container. Find the connection details in the unwrapped Docker MySQL server instance. Create the database and provide correct credentials in `.env`.

12. **Run Scheduler (Manually):**
    
    Use only in case if scheduler fails.
    The scheduler should be running automatically after sailing up.  
    In case the scheduler fails to run automatically, you can run it manually using the following command:
    ```bash
    sail php artisan schedule:run
    ```
