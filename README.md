<h1 align="center" id="title">laravel-patient-management-backend</h1>

<p align="center" id="description">RESTful API for Patient Management System with Multi-User Access.</p>

<br>
<h2 align="center">ERD (Entity-Relationship Diagram)</h2>
<div style="display: flex; justify-content: center;">
  <img width="100%" alt="ERD for Patient Management System" src="https://github.com/user-attachments/assets/7a0a6e8c-9915-4331-94e8-54436a031b85">
</div>

<br>
<h2>🚀 Requirements</h2>

Here're some of the project's requirments :

The app need to show your capability to handle:
1. Authentication (Login - you can use dummy/sample account) ✔️
2. CRUD proses (Create, Read, Update, Delete) ✔️
3. Data Search + Input Validation ✔️
4. Data Pagination ✔️

<br>
<h2>🌐 Api Endpoint</h2>

Here're some of the project's API Endpoint :

<h3>Authentication</h3>

| Endpoint                     | Method | Authentication Required | Description                                    | Request Body                                                                                  | Query Parameters |
|------------------------------|--------|-------------------------|------------------------------------------------|------------------------------------------------------------------------------------------------|-------------------|
| `/auth/login`                 | POST   | None                    | Login User as Admin or Viewer                 | `{ "email": "admin@example.com", "password": "admin123" }`                                      | None              |
| `/auth/register-admin`        | POST   | Admin                   | Register a new Admin                          | `{ "name": "Admin New", "email": "adminNew@example.com", "password": "adminNew123" }`           | None              |
| `/auth/register-viewer`       | POST   | Admin                   | Register a new Viewer                         | `{ "name": "Viewer", "email": "viewer@example.com", "password": "viewer123" }`                  | None              |
| `/auth/logout`                | POST   | Admin                   | Logout                                        | No body                                                                                         | None              |

<h3>Patient Management</h3>

| Endpoint                     | Method | Authentication Required | Description                                       | Request Body                                                                                  | Query Parameters           |
|------------------------------|--------|-------------------------|---------------------------------------------------|------------------------------------------------------------------------------------------------|----------------------------|
| `/patients`                   | POST   | Admin                   | Add a new patient                                | `{ "name": "John Doe", "date_of_birth": "1985-06-15", "gender": "male", "phone_number": "1234567890", "email": "johndoe@example.com", "address": "123 Main Street", "emergency_contact_name": "Jane Doe", "emergency_contact_phone": "0987654321" }` | None                       |
| `/patients`                   | GET    | Viewer or Admin          | Show all patients                               | None                                                                                           | 'name=John&is_active=1&sort=created_at&direction=desc&page=1&size=2'  |
| `/patients/{id}`              | GET    | Viewer or Admin          | Show a specific patient                         | None (URL params: `id` for the patient ID)                                                     | None                       |
| `/patients/{id}`              | PUT    | Admin                   | Edit patient details                            | `{ "name": "John Doe", "date_of_birth": "1990-05-15", "gender": "male", "phone_number": "123456789", "email": "john.doe@example.com", "address": "123 Main Street", "emergency_contact_name": "Jane Doe", "emergency_contact_phone": "987654321" }` | None                       |
| `/patients/{id}`              | DELETE | Admin                   | Delete a patient                                | None (URL params: `id` for the patient ID)                                                     | None                       |

<h3>Data Constraints</h3>

- **Name**: Must be unique for each patient. Two patients cannot share the same name.
- **Email**: Must be unique for each patient. Two patients cannot share the same email address.
- **Phone Number**: Must be unique for each patient. Two patients cannot share the same phone number.

<h3>Query Parameters Explanation</h3>

- **name**: (Optional) Filter patients by name. Example: `name=John` will return patients whose name is "John".
- **is_active**: (Optional) Filter by patient status. Example: `is_active=1` will return only active patients. Valid values are `1` for active patient, `0` for inactive patient, the default is_active will be both
- **sort**: (Optional) Define the field by which the results should be sorted. Valid values are `name`, `date_of_birth`, `created_at`, or `updated_at`. If the value is invalid, the default sort will be `name`.
- **direction**: (Optional) Define the sorting order. Possible values are `asc` (ascending) or `desc` (descending). Default value: `desc`. Example: `direction=desc` will return results sorted in descending order.
- **page**: (Optional) Define the page number for pagination. Default value: `1`. Example: `page=1` will return the first page of results.
- **size**: (Optional) Define the number of results per page. Default value: `10`. Example: `size=2` will return 2 results per page.

  
<h2>🛠️ Installation Steps :</h2>

<p>1. Clone Repository</p>

```
git clone https://github.com/mdzakied/laravel-patient-management-backend.git
```

<br />
<p>2. Prepare database (create db_patient_management in mySql using xampp) and enable xampp </p>

<br />
<p>3. Complete configuration in file .env</p>

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_patient_management
DB_USERNAME=root
DB_PASSWORD=
```

<br />
<p>4. Complete configuration in config/database.php</p>

```
        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'db_hotel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_general_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
```

<br />
<p>5. Run Command</p>

```
composer install
```
```
php artisan migrate:fresh
```
```
php artisan db:seed 
```

<br />
<p>6. Run Project for Development</p>

```
php artisan serve  
```

<h2>📃 Docs API</h2>
  
Postman :
* Run Project
* Open Postman and Import for collections docs/Patient Management.postman_collection.json
* Open Postman and Import for environments docs/Patient Management.postman_environment.json


<h2>💻 Built with</h2>

Technologies used in the project :

*   MySql
*   Laravel 11
*   JWT Auth
*   Postman
