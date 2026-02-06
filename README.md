# Symfony ObjectMapper Examples

This project provides a hands-on demonstration of various data mapping and transformation techniques in a modern Symfony application, based on the concepts from the article *"Moving Beyond the Basics with Symfony’s ObjectMapper."*

While the article focuses on the `ObjectMapper`, this codebase clarifies a key distinction:
*   The **`ObjectMapper`** is excellent for mapping data between existing objects.

This project aims to implement all the article's examples.

## Examples Included

The application is divided into several routes, each demonstrating a specific use case:

*   **Immutable DTOs**: Mapping a flat array to a modern, immutable PHP `readonly class`.
*   **Nested Objects & Collections**: This example *intends* to demonstrate the correct way to hydrate a nested data structure into a graph of immutable DTOs.
*   **Custom Normalizer**: Shows how to map a custom string format (like an ISO 8601 date) to a `\DateTimeImmutable` object.
*   **Naming Conventions**: Bridges the gap between `snake_case` from a source array and `camelCase` in a DTO using the `#[Map]` attribute.
*   **Validation**: Integrates the Symfony Validator component to validate DTOs after they are mapped, ensuring data integrity.
*   **Versioning**: A simple example of using namespaced DTOs (V1, V2) to handle evolving data structures.

## Setup and Installation

### Prerequisites
*   PHP 8.4 or higher
*   Composer

### Instructions
1.  **Clone the repository:**
    ```bash
    ggit clone https://github.com/mattleads/SymfonyObjectMapperSample.git
    cd SymfonyObjectMapperSample
    ```

2.  **Install dependencies:**
    ```bash
    composer install
    ```

## Running the Application

You can use the built-in PHP web server to run the application.

1.  **Start the server from the project root:**
    ```bash
    php -S localhost:8000 -t public
    ```
    (If you have the Symfony CLI installed, you can also use `symfony server:start`)

2.  **Access the application:**
    Open your web browser and navigate to:
    [http://localhost:8000](http://localhost:8000)

You will see an index page with links to each of the examples.
