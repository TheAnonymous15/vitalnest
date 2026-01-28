# Vitalnest Homecare

## Super‑Enterprise Microservices Healthcare Platform

**Feel human. Operate like a system. Grow like a platform.**

---

## 1. Executive Summary

This document defines a **complete, production‑grade, enterprise healthcare platform** for Vitalnest Homecare. It combines:

* Microservices architecture
* Role‑based dashboards
* Clinical & laboratory workflows
* Analytics & reporting
* A unified design system
* A practical execution roadmap

This is not a brochure website. It is **digital healthcare infrastructure**.

---

## 2. Design Tokens → Tailwind Configuration

### 2.1 Canonical Design Tokens

```js
// tailwind.config.js (conceptual)
module.exports = {
  theme: {
    extend: {
      colors: {
        primary: '#0F766E',        // Vital Teal
        primaryDark: '#134E4A',
        accent: '#F97316',         // Warm Orange
        accentSoft: '#FDBA74',
        surface: '#FFFBEB',
        panel: '#F3F4F6',
        border: '#D1D5DB',
        textPrimary: '#1F2933',
        success: '#16A34A',
        warning: '#EAB308',
        danger: '#DC2626',
        info: '#2563EB'
      }
    }
  }
}
```

### 2.2 Component Consistency

* Same tokens across web, dashboards, reports
* Zero color drift
* Dark mode possible without redesign

---

## 3. Dashboard Wireframes (Logical Layouts)

### 3.1 Admin Dashboard

**Top KPIs**

* Active patients
* Visits today
* Caregivers on duty
* Alerts pending

**Core Panels**

* Visit pipeline timeline
* Revenue & package performance
* Compliance alerts
* System health

---

### 3.2 Clinician Dashboard

**Overview**

* Assigned patients
* Critical alerts

**Patient View**

* Demographics
* Diagnoses
* Medications
* Lab trends (graphs)

**Actions**

* Approve care plans
* Order labs
* Add clinical notes

---

### 3.3 Lab Technician Dashboard

**Queue View**

* Pending samples
* Test type
* SLA timer

**Result Entry**

* Structured fields
* Normal ranges
* Auto‑flag abnormalities

**Submission Flow**

* Draft → Verified → Published

---

### 3.4 Caregiver Dashboard

* Daily assignments
* Patient snapshot
* Task checklist
* Visit report submission

---

### 3.5 Client / Family Dashboard

* Care plan overview
* Visit history
* Lab reports (PDF + trends)
* Notifications

---

## 4. Microservice → Dashboard Data Mapping

### Core Services

| Microservice       | Dashboards Using It                 |
| ------------------ | ----------------------------------- |
| Identity Service   | All                                 |
| Patient Service    | Admin, Clinician, Caregiver, Client |
| Scheduling Service | Admin, Caregiver                    |
| Medical Records    | Clinician, Client                   |
| Lab Service        | Lab, Clinician, Client              |
| Analytics Service  | Admin, Reports                      |
| Reporting Service  | Admin, Client                       |

---

## 5. API Contracts (Representative Examples)

### 5.1 Patient Service

```
GET /api/patients/{id}
POST /api/patients
GET /api/patients/{id}/history
```

### 5.2 Lab Service

```
POST /api/labs/orders
GET /api/labs/orders/{id}
POST /api/labs/results
GET /api/labs/results/{patientId}
```

### 5.3 Analytics Service

```
POST /api/events
GET /api/analytics/kpis
```

---

## 6. Analytics & Reporting Engine

### 6.1 Event‑Driven Analytics

Every action emits an event:

* Visit completed
* Lab result published
* Alert triggered

Events → Analytics Service → Dashboards

---

### 6.2 Reports

* Patient health trajectory
* Lab turnaround times
* Caregiver utilization
* Revenue per package
* Risk exposure

Exports: PDF, CSV

---

## 7. Execution Roadmap (Build Order)

### Phase 0 – Foundation (Weeks 1–2)

* Design system
* Tailwind setup
* Auth & RBAC

### Phase 1 – Core Platform (Weeks 3–6)

* Patient service
* Scheduling service
* Admin dashboard

### Phase 2 – Clinical & Lab (Weeks 7–10)

* Clinician dashboard
* Lab service & dashboard
* Medical records

### Phase 3 – Analytics & Reporting (Weeks 11–13)

* Event pipeline
* KPI dashboards
* Reports

### Phase 4 – Hardening (Weeks 14–16)

* Security review
* Performance tuning
* Compliance checks

---

## 8. Operational Excellence

### Observability

* Logs per service
* Health checks
* Error dashboards

### Security

* Role isolation
* Encrypted data
* Audit trails

---

## 9. Strategic Outcome

With this system, Vitalnest becomes:

* A **digitally coordinated care provider**
* A **clinical‑grade platform**
* A **data‑driven healthcare organization**

This architecture can support:

* Regional expansion
* Hospital partnerships
* Insurance integration
* AI‑assisted care

---

**Vitalnest is not building software.**
**Vitalnest is building healthcare infrastructure.**

---

---

## 10. Event Schemas (Event-Driven Backbone)

All critical actions emit immutable events. Events are published to the **Event Bus** and consumed by Analytics, Reporting, Notifications, and Audit services.

### 10.1 Core Event Structure

```json
{
  "event_id": "uuid",
  "event_type": "VISIT_COMPLETED",
  "source_service": "scheduling-service",
  "actor_role": "caregiver",
  "actor_id": "uuid",
  "patient_id": "uuid",
  "timestamp": "ISO-8601",
  "payload": {}
}
```

### 10.2 Key Events

* PATIENT_CREATED
* VISIT_SCHEDULED
* VISIT_COMPLETED
* LAB_ORDERED
* LAB_RESULT_PUBLISHED
* CARE_PLAN_UPDATED
* ALERT_TRIGGERED

---

## 11. Database Schemas (Per Microservice)

### 11.1 Patient Service (Relational)

**patients**

* id (uuid)
* full_name
* dob
* gender
* primary_contact
* created_at

**patient_consents**

* id
* patient_id
* consent_type
* granted_at

---

### 11.2 Clinician / Medical Records Service

**clinical_notes**

* id
* patient_id
* clinician_id
* diagnosis
* notes
* created_at

**medications**

* id
* patient_id
* drug_name
* dosage
* frequency

---

### 11.3 Lab Service

**lab_orders**

* id
* patient_id
* ordered_by
* status
* created_at

**lab_results**

* id
* lab_order_id
* test_name
* value
* unit
* normal_range
* flagged

---

### 11.4 Scheduling Service

**visits**

* id
* patient_id
* caregiver_id
* scheduled_time
* status

---

## 12. Care Workflows (System Truth)

### 12.1 Home Visit Workflow

1. Client requests visit
2. Admin approves & schedules
3. Caregiver assigned
4. Visit completed
5. Report submitted
6. Clinician review (if required)

---

### 12.2 Lab Workflow

1. Clinician orders test
2. Lab technician receives request
3. Sample collected
4. Result entered
5. Clinician signs off
6. Client notified

---

### 12.3 Escalation Workflow

1. Abnormal reading detected
2. Alert triggered
3. Clinician notified
4. Action logged

---

## 13. Disaster Recovery & Uptime Strategy

### 13.1 Availability Targets

* Core services: 99.9%
* Analytics: 99.5%

### 13.2 Backup Strategy

* Daily encrypted backups
* Cross-region replication

### 13.3 Failure Isolation

* Service-level isolation
* Graceful degradation

---

## 14. Governance & Auditability

* Immutable audit logs
* Role-based traceability
* Regulatory-ready reporting

---

**End of Master System Design Document**

---

## 15. Single-File Implementation Blueprint (Folders + Service Skeletons + Migrations)

> This section intentionally consolidates **folder structures**, **service skeletons**, and **database migrations** into **one executable reference file** for rapid bootstrapping. Teams can split it later without redesign.

```text
// FILE: vitalnest-enterprise-bootstrap.md

# VITALNEST ENTERPRISE PLATFORM – BOOTSTRAP FILE

===============================================
1) MONOREPO FOLDER STRUCTURE
===============================================

vitalnest-platform/
├── gateway/
│   ├── public/index.php
│   ├── middleware/AuthMiddleware.php
│   └── routes/api.php
│
├── services/
│   ├── identity-service/
│   ├── patient-service/
│   ├── clinician-service/
│   ├── lab-service/
│   ├── scheduling-service/
│   ├── medical-records-service/
│   ├── analytics-service/
│   └── reporting-service/
│
├── frontend/
│   ├── public-site/
│   ├── admin-dashboard/
│   ├── clinician-dashboard/
│   ├── lab-dashboard/
│   ├── caregiver-dashboard/
│   └── client-dashboard/
│
├── shared/
│   ├── events/
│   ├── contracts/
│   └── auth/
│
└── infra/
    ├── docker/
    └── nginx/


===============================================
2) SERVICE SKELETON (LAB SERVICE – REFERENCE)
===============================================

/services/lab-service/
├── app/
│   ├── Controllers/LabController.php
│   ├── Models/LabOrder.php
│   ├── Models/LabResult.php
│   ├── Services/LabWorkflowService.php
│   └── Events/LabResultPublished.php
│
├── database/migrations/
│   ├── 2026_01_01_create_lab_orders_table.php
│   └── 2026_01_01_create_lab_results_table.php
│
├── routes/api.php
├── public/index.php
└── composer.json


--- LabController.php ---

<?php
namespace App\Controllers;

use App\Services\LabWorkflowService;

class LabController
{
    public function createOrder(array $data)
    {
        return LabWorkflowService::createOrder($data);
    }

    public function submitResult(array $data)
    {
        return LabWorkflowService::publishResult($data);
    }

    public function getPatientResults(string $patientId)
    {
        return LabWorkflowService::getResultsForPatient($patientId);
    }
}


--- LabWorkflowService.php ---

<?php
namespace App\Services;

use App\Models\LabOrder;
use App\Models\LabResult;
use App\Events\LabResultPublished;

class LabWorkflowService
{
    public static function createOrder(array $data)
    {
        return LabOrder::create($data);
    }

    public static function publishResult(array $data)
    {
        $result = LabResult::create($data);
        event(new LabResultPublished($result));
        return $result;
    }

    public static function getResultsForPatient(string $patientId)
    {
        return LabResult::where('patient_id', $patientId)->get();
    }
}


===============================================
3) DATABASE MIGRATIONS (LAB SERVICE)
===============================================

--- create_lab_orders_table.php ---

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('lab_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('patient_id');
            $table->uuid('ordered_by');
            $table->string('test_type');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }
}


--- create_lab_results_table.php ---

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsTable extends Migration
{
    public function up()
    {
        Schema::create('lab_results', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('lab_order_id');
            $table->string('test_name');
            $table->string('value');
            $table->string('unit')->nullable();
            $table->string('normal_range')->nullable();
            $table->boolean('flagged')->default(false);
            $table->timestamps();
        });
    }
}


===============================================
END OF SINGLE-FILE BOOTSTRAP
===============================================
```

---

**Usage Notes**

* This file is the **source of truth** for initial setup.
* Teams may split it into repos/services after scaffolding.
* Patterns repeat identically for Patient, Clinician, Scheduling, and Records services.

---

