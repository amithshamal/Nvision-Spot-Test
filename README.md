# Order Management System

This project is built with Laravel for managing a PHP REST API endpoint to process “New Order”
## Getting Started

To run this project locally, follow these steps:

### Prerequisites

- PHP >= 8.2
- Composer

### Installation

1. Clone this repository
2. Navigate to the project directory
3. run composer install to Install dependencies
4. Copy the .env.example file to .env
5. Update the database settings in the .env file.
6. Migrate the database (php artisan migrate)
7. open postman and import (File->import) Nvision Spot Test.postman_collection.json
8. Execute php artisan serve to start the development server and The API will be accessible at http://127.0.0.1:8000 by default
9. To execute test run php artisan test



## setup instructions
1. Import Postman collection to the postman
2. Register a user
3. Login to the system and get the token
4. Replace the Bearer token with new token
5. Call to order end point to create new order
6. Run php artisan queue:work to call to external api to submit data



## Endpoints

The following endpoints are available:

- Authentication:
  - POST /api/v1/login
  - POST /api/v1/register
  - POST /api/v1/logout


- Order Management:
  - POST /api/v1/order


## Postman Testing

You can use the provided Postman collection for testing the API endpoints.
