# PetStore API Client Application

## Overview

This application is a Laravel 10 based example of interacting with the [PetStore API](https://petstore.swagger.io/). It allows users to add, view, edit, and delete pet information through a simple web interface, demonstrating the capabilities of the PetStore API.

## System Requirements

-   PHP 8.1
-   Laravel 10
-   Composer

## Installation

To set up the application:

1. **Clone the Repository**

    ```bash
    git clone [repository URL]
    ```

2. **Install Dependencies**

    ```bash
    composer install
    ```

3. **Environment Setup**
    - Copy `.env.example` to `.env` and configure your database and other settings.
    - Generate an application key:
        ```bash
        php artisan key:generate
        ```
4. **Start the Local Server**

    ```bash
    php artisan serve
    ```

5. **Storage Link for Images**
    - Since the application stores images locally, create a symbolic link to the public storage directory:
    ```bash
     php artisan storage:link
    ```

## Usage

### Key Functionalities

-   **Add a Pet**: Users can add new pets with their name, status, and photos.
-   **View Pets**: Filter pets by their status - available, pending, or sold.
-   **Edit a Pet**: Update pet information and photos.
-   **Delete a Pet**: Remove pets from the database.
-   **View a Single Pet**: Display details of a specific pet.

### Routes

-   `GET /`: Home page, redirects to add pet page.
-   `GET /pet/add`: Display the form to add a new pet.
-   `POST /pet`: Add a new pet.
-   `GET /pet/{id}/edit`: Edit a specific pet.
-   `PUT /pet/{id}`: Update a specific pet.
-   `DELETE /pet/{id}`: Delete a specific pet.
-   `GET /pets/show/{status}`: View pets by status.
-   `GET /pets/{id}`: View details of a specific pet.
