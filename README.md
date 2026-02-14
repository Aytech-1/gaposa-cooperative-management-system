# GAPOSA Cooperative Management System 🚀

![CI](https://img.shields.io/badge/CI-Ready-success)
![PHP](https://img.shields.io/badge/PHP-8.4-blue)
![Laravel](https://img.shields.io/badge/Laravel-12-red)
![Status](https://img.shields.io/badge/Status-Active%20Development-success)

The **GAPOSA Cooperative Management System** is a **policy-driven, API-first financial management platform** developed for the **Gateway Polytechnic Saapade Cooperative Society (GAPOSA)**.

The system automates cooperative operations including **member management, savings and contributions, loan processing, interest computation, salary-based repayments, guarantor enforcement, and financial reporting**, with strong emphasis on **transparency, accountability, and auditability**.

This is a **production-oriented system**, designed with enterprise standards and not a demo or toy academic project.

---

## 📑 Table of Contents

- [Product Vision](#-product-vision)
- [System Architecture](#-system-architecture)
- [Technology Stack](#-technology-stack)
- [Core System Features](#-core-system-features)
- [Loan & Repayment Model](#-loan--repayment-model)
- [API Documentation](#-api-documentation)
- [API Testing (Postman)](#-api-testing-postman)
- [API Documentation (Swagger / OpenAPI)](#-api-documentation-swagger--openapi)
- [Security & Compliance](#-security--compliance)
- [Local Development Setup](#-local-development-setup)
- [Versioning & Release Notes](#-versioning--release-notes)
- [Development Workflow](#-development-workflow)
- [License](#-license)
- [Institution](#-institution)

---

## 🧠 Product Vision

Many cooperative societies still rely on **manual records, spreadsheets, and fragmented processes**, leading to errors, delays, weak accountability, and difficulty in tracking loans, repayments, and guarantor obligations.

The GAPOSA Cooperative Management System addresses these challenges by providing a **centralized, secure, and automated platform** that enforces cooperative policies while giving administrators and members **real-time visibility** into financial activities.

---

## 🏗️ System Architecture

- API-First Architecture
- Single-Tenant Cooperative Design
- Policy-Driven Business Logic
- Stateless RESTful APIs
- Modular Laravel Architecture
- Role-Based Access Control (RBAC)

The system is deployed for **one cooperative society (GAPOSA)**, with clearly separated **Admin** and **Member** access layers.

---

## 🧰 Technology Stack

### Backend
- **Laravel 12**
- **PHP 8.4**
- **MySQL**
- **Redis** (optional for cache and queues)

### Frontend (Clients)
- RESTful API Consumers
- Web-based Admin and Member Portals

### Tooling & Infrastructure
- Git & GitHub
- Laravel Queues & Jobs
- Laravel Scheduler
- Laravel Logging & Auditing

---

## ✨ Core System Features

### 👥 Member Management
- Member registration (Academic & Non-Academic)
- Status management (Active, Suspended, Retired, Resigned, Dismissed)
- Profile and employment record tracking

### 💰 Savings & Contribution Management
- Compulsory savings enforcement
- Voluntary contribution support
- Contribution history tracking
- Refund handling on exit
- Target savings (Ileya, Christmas, custom goals)

### 🏦 Loan Management
- Loan eligibility validation
- Savings-based loan limits (e.g. 10× savings)
- Configurable loan duration
- Flat interest calculation
- Loan approval workflows
- Automated repayment schedules

### 🔄 Loan Repayment & Deduction
- Salary-based repayment tracking
- Monthly repayment posting
- Missed repayment detection
- Loan completion and closure
- Default escalation handling

### 🤝 Guarantor Management
- Guarantor assignment per loan
- Exposure tracking
- Automatic guarantor activation on default

### 📊 Reports & Transparency
- Member financial statements
- Loan performance reports
- Monthly financial summaries
- Defaulters and risk reports
- Exportable reports (PDF / Excel)

### 🧾 Audit & Accountability
- User activity logs
- Financial audit trails
- Policy change tracking
- Read-only auditor access

---

## 💳 Loan & Repayment Model

- **Loan Eligibility**
  - Minimum contribution period (e.g. 6 months)
  - Active membership status
  - No existing active loan

- **Interest Model**
  - Flat interest rate (e.g. 10%)
  - Calculated at loan approval
  - Spread evenly across repayment duration

- **Repayment Flow**
  - Salary deduction
  - Wallet debit
  - Loan balance reduction
  - Automatic loan closure on full repayment

---

## 📡 API Documentation

The GAPOSA Cooperative Management System exposes a **RESTful API** that powers both the **Admin Portal** and **Member Portal**.

### API Design Principles
- Stateless requests
- JSON request and response payloads
- Secure token-based authentication
- Role-based authorization for all protected routes

### API Base URL (Local)
```text
http://localhost/api

## 📦 Local Development Setup

```bash
git clone https://github.com/YOUR_USERNAME/gaposa-cooperative-management-system.git
cd gaposa-cooperative-management-system
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

📄 License

This system is developed for GAPOSA Cooperative Society.
Licensing and redistribution are subject to institutional approval.

🏢 Institution

Gateway ICT Polytechnic Saapade
Cooperative Management System (GAPOSA)
