# Khardl – Multi-Tenant Restaurant Management System

**Khardl** is a comprehensive, production-grade SaaS platform designed to streamline operations for restaurant chains and aggregators. The system supports **multi-tenancy**, **multi-role access control**, **multi-language support**, and **API-ready integration** for mobile apps and external services.

---

## 🚀 Key Features

- 🔐 Multi-role support (Admin, Super Admin, Restaurant Owner, Workers, Delivery Agents)
- 🌐 Multi-language and RTL support
- 🌍 Subdomain and tenant isolation
- 📋 Menu and category management
- 📦 Order tracking with status flow
- 📡 Push notification & SMS integrations
- 💳 TAP payment gateway support
- 📱 Integrated API endpoints and webhooks
- 📊 Dashboard analytics & reporting

---

## 🧑‍💼 User Roles

### 1. **Super Admin**
- Full access to all tenants and features
- Manages global settings, pricing plans, restaurants, users
- Approves restaurant ads, monitors logs, and system metrics


### 2. **Restaurant Owner**
- Manages restaurant profile, branches, menus, and orders
- Assigns workers and delivery agents
- Manages coupons, ads, and analytics


### 3. **Worker / Waiter**
- Handles incoming orders
- Marks items as prepared
- Coordinates with delivery agents

### 4. **Delivery Agent**
- Views assigned delivery requests
- Marks pickup/drop-off stages
- Real-time delivery tracking

### 5. **Public End-User**
- Restaurant subdomain with menu
- Add to cart, order, pay, and track status
- Signup/login + OTP support

---

## 🖼 Screenshots

### Central site (Public users):
| Home | Services | Signup | Signin |
|------|----------|--------|--------|
| ![](./screenshots/khardl_8000_home.png) | ![](./screenshots/khardl_8000_services.png) | ![](./screenshots/khardl_8000_signup.png) | ![](./screenshots/khardl_8000_signin.png) |


| OTP Login | Password Reset | FAQ | Advantages |
|-----------|----------------|-----|------------|
| ![](./screenshots/khardl_8000_login_with_code.png) | ![](./screenshots/khardl_8000_forget_password.png) | ![](./screenshots/khardl_8000_faq.png) | ![](./screenshots/khardl_8000_advantages.png) |

### Central site (Super Admin):

| Dashboard | Admins | Add Admin |
|----------|--------|------------|
| ![](./screenshots/superadmin_dashboard.png) | ![](./screenshots/superadmin_admins_all.png) | ![](./screenshots/superadmin_admins_add.png) |

| Ads List | Add Ad | Promotters |
|----------|--------|------------|
| ![](./screenshots/superadmin_ads_requests.png) | ![](./screenshots/superadmin_ads_requests_add.png) | ![](./screenshots/superadmin_promotters.png) |

| Purchase Notifications | Settings | Logs |
|------------------------|----------|------|
| ![](./screenshots/superadmin_purchase_notifications.png) | ![](./screenshots/superadmin_settings.png) | ![](./screenshots/superadmin_logs.png) |

| Restaurants List | App Requests | Owner Panel | Coupons |
|------------------|--------------|-------------|---------|
| ![](./screenshots/superadmin_restaurants_all.png) | ![](./screenshots/superadmin_restaurants_app_requests.png) | ![](./screenshots/superadmin_restaurants_owner.png) | ![](./screenshots/superadmin_sub_coupons.png) |


----


### Tenant site (Restaurant):
| Home | Signup | Customer Dashboard | Cart |
|-----------|----------------|-----|------------|
| ![](./screenshots/khardl_restaurant_homepage.png) | ![](./screenshots/khardl_restaurant_signup.png) | ![](./screenshots/khardl_restaurant_customer_dashboard.png) | ![](./screenshots/khardl_restaurant_cart.png) |
---

## 📦 Tech Stack

- PHP (Laravel)
- MySQL
- Tailwind CSS + Livewire
- Firebase (Push notifications)
- TAP Payment Gateway
- Msegat (SMS API)

---

## 📲 API Integration

The system is built with modular REST APIs that support:
- Mobile app integration
- Notifications
- Webhooks for orders & status
- JWT authentication

---

## 📂 Repository Contents

- `README.md`: Project overview
- `/screenshots`: All platform UI views

---

## 📧 Contact

For commercial use or collaboration, reach out to:  
**Khaled Alam**  
[LinkedIn](https://www.linkedin.com/in/khaledalam) | [khaledalam.net](https://khaledalam.net)

---

