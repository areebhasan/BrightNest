# BrightNest

![Laravel](https://img.shields.io/badge/Laravel-11-red)
![Vue](https://img.shields.io/badge/Vue-3-green)
![Tailwind](https://img.shields.io/badge/TailwindCSS-3-blue)
![License](https://img.shields.io/badge/License-Educational-lightgrey)

### Childcare Administration Platform

BrightNest is a modern childcare administration platform designed to streamline operational workflows in early learning centres.

The system focuses on managing services, rooms, children, and enrolments while supporting automation such as **age-based room allocation**.

The platform is built using **Laravel, Vue 3, and Tailwind CSS** with a modern SaaS style interface.

---

## Application Screenshots

### Dashboard

![Dashboard Screenshot](docs/screenshots/dashboard.png)

### Rooms Management

![Rooms Screenshot](docs/screenshots/rooms.png)

### Children Management

![Children Screenshot](docs/screenshots/children.png)

---

## Key Features

• Secure authentication using Laravel Breeze  
• Multi-service workspace support  
• Room management with age range configuration  
• Children management with CRN and DOB  
• Automatic room suggestion based on child age  
• Vue component based SaaS UI  
• Responsive Tailwind interface

---

## Project Overview

BrightNest simulates real childcare management software used in early childhood education centres.

The system supports multiple childcare services, each with its own operational workspace where administrators can manage rooms, children, and enrolments.

The application also introduces automated logic to assist educators and administrators with operational decisions such as determining the most appropriate room for a child based on their age.

---

## Core Features

### Authentication System

Secure user authentication using Laravel Breeze.

Features include

• Login and session management  
• User profile management  
• Secure logout  
• Protected application routes  

---

### Multi Service Workspace

Users can manage multiple childcare services.

After login, users select an **active service workspace**, and all operations are scoped to that service.

This allows a single administrator to manage multiple centres.

Features include

• Active service selection  
• Session based service context  
• Isolated data per service  

---

### Room Management

Administrators can create and manage childcare rooms within each service.

Each room contains age configuration to support automated child placement.

Room fields include

• Room name  
• Age group description  
• Minimum age in months  
• Maximum age in months  
• Status (active or inactive)

---

### Children Management

Children enrolled within a service can be created and managed.

Child records include key enrolment information.

Fields include

• CRN (Child Reference Number)  
• First name  
• Last name  
• Date of birth  
• Status  

---

### Automatic Age Based Room Suggestion

One of the core features of BrightNest is the automated room suggestion system.

The application automatically:

1. Calculates the child's age in months using their date of birth  
2. Compares the age against configured room age ranges  
3. Suggests the most appropriate room for the child  

This replicates real operational workflows used in childcare centres when assigning children to rooms.

---

## Technology Stack

Backend  
Laravel  

Frontend  
Vue 3  

Styling  
Tailwind CSS  

Interactivity  
Alpine.js  

Database  
MySQL  

Authentication  
Laravel Breeze  

---

## System Architecture

BrightNest follows a modern full stack architecture.

Laravel handles

• Business logic  
• API endpoints  
• Database interactions  
• Authentication  

Vue manages

• Component driven UI  
• Dynamic frontend rendering  

Alpine.js is used for lightweight UI behaviour such as dropdowns and navigation interactions.

---

## Installation

Follow the steps below to run the project locally.

### 1. Clone the Repository

```bash
git clone https://github.com/YOUR_USERNAME/brightnest.git
cd brightnest
```

### 2. Install Backend Dependencies

```bash
composer install
```

### 3. Install Frontend Dependencies

```bash
npm install
```

### 4. Create Environment File

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Configure Database

Open `.env` and update the database configuration.

Example:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=brightnest
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Run Database Migrations

```bash
php artisan migrate
```

### 8. Start Laravel Server

```bash
php artisan serve
```

The application will run at:

```
http://127.0.0.1:8000
```

### 9. Start Frontend Development Server

In a separate terminal run:

```bash
npm run dev
```

---

## Running the Application

After starting both servers:

Open in your browser:

```
http://127.0.0.1:8000
```

Register a user account and begin creating services, rooms, and children.

---

## Current Modules

The platform currently includes the following modules:

Authentication  
Service workspace selection  
Room management  
Children management  
Age based room suggestions  

---

## Future Roadmap

Planned features include

Enrolments management  
Attendance tracking  
Staff management  
Child room transfers  
Room capacity management  
Compliance ratio monitoring  
Operational dashboards and analytics  

---

## Purpose of the Project

BrightNest was developed as a full stack portfolio project demonstrating:

• Laravel backend development  
• API design  
• Vue component architecture  
• SaaS style interface design  
• Business workflow modelling  

The project models real childcare operational workflows and can be extended into a full production platform.

---

## License

This project is provided for educational and portfolio purposes.
