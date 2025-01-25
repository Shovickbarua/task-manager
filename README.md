# Task Management API with Authentication

## Overview
This is a RESTful API for managing tasks built using Laravel. It includes user authentication via Laravel Sanctum.

## Features
- User authentication (register, login, and token-based authentication).
- Task management (create, retrieve, update, and delete tasks).
- Input validation and error handling.
- Unit tests for API endpoints, including authentication.

---

## Setup Instructions

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL
- Laravel Installer
- Postman (optional, for testing)

### Installation
- Clone the repository:
   ```bash
   git clone https://github.com/Shovickbarua/task-manager.git
   cd task-manager
   ```

- Install dependencies:
   ```bash
   composer install
   ```

- Copy the example environment file and set up environment variables:
   ```bash
   cp .env.example .env
   ```
   Update the `.env` file with your database credentials and other configurations.

- Generate the application key:
   ```bash
   php artisan key:generate
   ```

- Run migrations to set up the database:
   ```bash
   php artisan migrate
   ```

- Start the development server:
   ```bash
   php artisan serve
   ```

---

## API Endpoints

### Authentication Endpoints

#### Register
- **URL**: `POST /api/register`
- **Request Body**:
  ```json
  {
    "name": "John Doe",
    "email": "johndoe@example.com",
    "password": "password",
  }
  ```

#### Login
- **URL**: `POST /api/login`
- **Request Body**:
  ```json
  {
    "email": "johndoe@example.com",
    "password": "password"
  }
  ```

### Task Endpoints

#### Create a Task
- **URL**: `POST /api/tasks`
- **Headers**: `Authorization: Bearer your-auth-token`
- **Request Body**:
  ```json
  {
    "title": "New Task",
    "description": "Task description"
  }
  ```

#### Retrieve Tasks
- **URL**: `GET /api/tasks`
- **Headers**: `Authorization: Bearer your-auth-token`
- **Response**:
  ```json
  {
    "status",
      "data":{
          "data":{   
              "id": 1,
              "title": "New Task",
              "description": "Task description",
              "status": "pending",
              "created_at": "..."
          }
        } 
  }
  ```

#### Mark a Task as Completed
- **URL**: `PUT /api/tasks/{id}`
- **Headers**: `Authorization: Bearer your-auth-token`
- **Response**:
  ```json
  {
    "status",
      "data":{
          "data":{   
              "id": 1,
              "title": "New Task",
              "description": "Task description",
              "status": "completed",
              "created_at": "..."
          }
        } 
  }
  ```

#### Delete a Task
- **URL**: `DELETE /api/tasks/{id}`
- **Headers**: `Authorization: Bearer your-auth-token`
- **Response**:
  ```json
  {
   "data:{
    "message": "Task deleted successfully."
   }
  }
  ```

---

## Testing the API

### Using Postman
1. Register a user via `POST /api/register`.
2. Log in via `POST /api/login` to get the authentication token.
3. Use the token in the `Authorization` header for subsequent requests.
4. Test the task management endpoints.

### Running Unit Tests
1. Set up a testing database in `.env.testing`.
2. Run the tests:
   ```bash
   php artisan test
   ```


