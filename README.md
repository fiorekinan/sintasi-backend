
# Clinic API (Laravel + Sanctum)

A RESTful API backend for clinic patient management and visit tracking system.

---

## Tech Stack
- Laravel 13
- Laravel Sanctum (Authentication)
- MySQL
- PHP

---

## Installation

Clone the repository:
```bash
git clone <repo-url>
cd sintasi-backend
````

Install dependencies:

```bash
composer install
```

Setup environment file:

```bash
cp .env.example .env
php artisan key:generate
```

---

## Database Setup

Configure your `.env` file:

```env
DB_DATABASE=clinic_db
DB_USERNAME=root
DB_PASSWORD=
```

Run database migration:

```bash
php artisan migrate
```

---

## Authentication (Sanctum)

### Register User

```http
POST /api/register
```

### Login User

```http
POST /api/login
```

Response:

```json
{
  "token": "your-sanctum-token"
}
```

Use the token in request headers:

```
Authorization: Bearer {token}
```

---

## Patients

### Create Patient

```http
POST /api/patients
```

### Get Patient by Medical Record Number

```http
GET /api/patients/{medical_record_number}
```

Features:

* Encrypted NIK and Email
* Auto-generated Medical Record Number (RM0001, RM0002, etc.)
* Total visit count per patient

---

## Visits

### Create Visit

```http
POST /api/visits
```

Request Body:

```json
{
  "medical_record_number": "RM0001"
}
```

Features:

* Create visit based on medical record number
* Automatic visit tracking per patient
* Total visits counter

---

## Features Summary

* Authentication using Laravel Sanctum
* Patient management
* Auto-generated Medical Record Number
* Encrypted sensitive data (NIK & Email)
* Visit tracking system
* Total visit counter per patient

---

## Notes

* All patient and visit endpoints require authentication
* Sensitive data is encrypted before storing in database
* This project is still in MVP stage and under development


