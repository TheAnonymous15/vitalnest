# Vitalnest Platform

A comprehensive microservices-based healthcare platform for home healthcare management.

## Architecture Overview

Vitalnest follows a microservices architecture with the following components:

### Gateway
- **API Gateway** (`gateway/`) - Central entry point for all API requests, handles routing, authentication, and service discovery

### Services
| Service | Port | Description |
|---------|------|-------------|
| Identity Service | 8001 | User authentication, authorization, and management |
| Patient Service | 8002 | Patient records and vitals tracking |
| Lab Service | 8003 | Laboratory orders and results management |
| Clinician Service | 8004 | Clinician profiles and scheduling |
| Scheduling Service | 8005 | Appointment management |
| Medical Records Service | 8006 | Clinical documentation and history |
| Analytics Service | 8007 | Platform analytics and metrics |
| Reporting Service | 8008 | Report generation and scheduling |
| Notification Service | 8009 | Multi-channel notifications |

### Frontend Dashboards
- **Public Site** - Marketing and information website
- **Admin Dashboard** - Platform administration
- **Clinician Dashboard** - Healthcare provider interface
- **Lab Dashboard** - Laboratory technician interface
- **Caregiver Dashboard** - Caregiver portal
- **Client Dashboard** - Patient/client portal

## Quick Start

### Prerequisites
- PHP 8.1+
- MySQL 8.0+
- Composer
- Node.js 18+ (for frontend)

### Running Services

Each service can be run independently:

```bash
# Start API Gateway
cd gateway
php -S localhost:8000 -t public

# Start Identity Service
cd services/identity-service
composer install
php -S localhost:8001 -t public

# Start Patient Service
cd services/patient-service
composer install
php -S localhost:8002 -t public

# ... and so on for other services
```

### API Endpoints

All requests go through the API Gateway at `http://localhost:8000/api`

#### Authentication
```
POST /api/auth/register - Register new user
POST /api/auth/login - User login
POST /api/auth/logout - User logout
GET  /api/auth/profile - Get current user
```

#### Patients
```
GET    /api/patients - List patients
GET    /api/patients/:id - Get patient
POST   /api/patients - Create patient
PUT    /api/patients/:id - Update patient
GET    /api/patients/:id/vitals - Get vitals history
POST   /api/patients/:id/vitals - Record vitals
```

#### Appointments
```
GET    /api/appointments - List appointments
POST   /api/appointments - Schedule appointment
GET    /api/appointments/today - Today's appointments
POST   /api/appointments/:id/cancel - Cancel appointment
POST   /api/appointments/:id/confirm - Confirm appointment
```

#### Lab Orders
```
GET    /api/lab-orders - List orders
POST   /api/lab-orders - Create order
GET    /api/lab-orders/:id/results - Get results
POST   /api/lab-orders/:id/results - Submit results
```

## Service Template Structure

Each service follows a consistent structure:

```
service-name/
├── app/
│   ├── Controllers/
│   ├── Models/
│   ├── Services/
│   └── Events/
├── database/
│   └── migrations/
├── routes/
│   └── api.php
├── config/
│   └── service.php
├── bootstrap/
│   └── app.php
├── public/
│   └── index.php
└── composer.json
```

## Event-Driven Communication

Services communicate through events:

- `user.registered` - New user registration
- `patient.created` - New patient added
- `appointment.scheduled` - New appointment
- `appointment.cancelled` - Appointment cancellation
- `lab.result_published` - Lab results ready
- `vitals.recorded` - New vitals recorded
- `notification.sent` - Notification dispatched

## Environment Configuration

Create `.env` file in each service:

```env
APP_DEBUG=true
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=vitalnest_service
DB_USERNAME=root
DB_PASSWORD=
JWT_SECRET=your-secret-key
```

## Database

Each service has its own database:
- `vitalnest_identity` - Identity Service
- `vitalnest_patients` - Patient Service
- `vitalnest_lab` - Lab Service
- `vitalnest_clinicians` - Clinician Service
- `vitalnest_scheduling` - Scheduling Service
- `vitalnest_records` - Medical Records Service
- `vitalnest_analytics` - Analytics Service
- `vitalnest_reports` - Reporting Service
- `vitalnest_notifications` - Notification Service

## License

Proprietary - All rights reserved.

