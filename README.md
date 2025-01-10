<h1 align="center" id="title">laravel-patient-management-backend</h1>

<p align="center" id="description"> <strong>Webservice API for Patient Management System with Multi-User Access. </strong></p>

<p align="center">
  A modern and secure REST API designed to handle all aspects of patient management, including role-based access control for different users.
</p>

---

## 🌟 Project Overview 

The **Patiently - Webservice API** is a comprehensive REST API built to manage patient data. It supports core functionalities such as:

- **Patient Management 🧑‍⚕️:** Manage patient information.
- **Role-Based Access Control 🔐:** Secure user roles and permissions using JWT Auth.
- **Secure Authentication & Authorization 🔑:** Ensure safe access control for various user roles (e.g., admin, viewer).
- **Testing with Postman 🧪:** Validate API functionality and ensure smooth integration.

---

## ⚙️ Technologies Used 

- **Backend 💻:** Laravel 11
- **Database 🗄️:** MySQL
- **Security 🔐:** JWT Auth for authentication and authorization
- **API Documentation 📜:** Postman for endpoint documentation and testing

---

<h2>🗂️ ERD (Entity-Relationship Diagram)</h2>

<div style="display: flex; justify-content: center;">
  <img width="100%" alt="ERD for Patient Management System" src="https://github.com/user-attachments/assets/7a0a6e8c-9915-4331-94e8-54436a031b85">
</div>

---

<h2>🌐 Api Endpoint</h2>

Here're some of the project's API Endpoint :

<br />

> [!NOTE]  
> * **Authentication**: Using Bearer token (JWT) for requests requiring authentication.

<br />

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

---
  
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

> [!NOTE]
> Information in command:
> * Admin account initialized (email: admin@example.com, pass: admin123)

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

---
