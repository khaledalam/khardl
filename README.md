# Khardl – Multi-Tenant Restaurant Management System

**Khardl** is a full-featured SaaS solution built for restaurant chains, aggregators, and food service providers. Designed with **multi-tenancy**, **multi-language**, **modular dashboards**, and **mobile-first APIs**, Khardl simplifies the end-to-end restaurant operations across branches, roles, and services.

---

## 🚀 Key Features

- 🔐 Role-based access (Super Admin, Restaurant Admin, Staff, Delivery Agent, Customer)
- 🏢 Tenant isolation via subdomains (e.g. `restaurant1.khardl.com`)
- 🗺 Multi-language and RTL support
- 🍽 Menu & category builder with multi-level modifiers
- 🛒 Customer ordering + cart + live status tracking
- 📦 Branch and service area management
- 👷 Staff management, roles, and permissions
- 🚚 Delivery company integration
- 💬 Notifications (Push via Firebase, SMS via Msegat)
- 💳 Online payments via TAP
- 📈 Real-time dashboards, summaries, and logs
- 🌐 REST APIs and Webhooks for mobile integration

---

## 👥 User Roles & Permissions

### 1. **Super Admin**
- Manage all tenants (restaurants), users, pricing
- View platform-wide metrics and logs
- Approve or reject restaurant ad campaigns
- Configure global app settings
- Monitor restaurant activity and issue resolution

### 2. **Restaurant Admin**
- Manage restaurant profile, branches, and subdomains
- Build full menus and categories with options
- Assign staff roles (cashier, waiter, kitchen, delivery)
- Track orders, assign delivery drivers
- Handle customer database and loyalty points
- Design landing pages with a live site editor
- View branch-level analytics and daily summaries
- Manage ads, coupons, and delivery companies

### 3. **Worker / Waiter**
- Manage dine-in, take-away, or delivery orders
- Mark food stages (in kitchen, ready, delivered)
- Coordinate with delivery staff

### 4. **Delivery Agent**
- View new orders requiring delivery
- Update statuses (Picked up, On the way, Delivered)
- Track orders in real-time

### 5. **Customer / Public User**
- Browse restaurant menus from subdomain
- Place orders, pay online, and track delivery
- Login via email/OTP or register with mobile

---



## 🖼 Screenshots

##### Home (EN)
![](./screenshots/khardl_8000_home.png)

##### Home (AR)
![](./screenshots/khardl_8000_home_ar.png)


### Central Platform (SaaS):

| Home | Services | Signup | Signin |
|------|----------|--------|--------|
| ![](./screenshots/khardl_8000_home.png) | ![](./screenshots/khardl_8000_services.png) | ![](./screenshots/khardl_8000_signup.png) | ![](./screenshots/khardl_8000_signin.png) |


| OTP Login | Forgot Password | FAQ | Why Us |
|-----------|----------------|-----|------------|
| ![](./screenshots/khardl_8000_login_with_code.png) | ![](./screenshots/khardl_8000_forget_password.png) | ![](./screenshots/khardl_8000_faq.png) | ![](./screenshots/khardl_8000_advantages.png) |

----

#### Restaurant Tenant (Admin Dashboard)

| Branches | Add Branch | Coupons | Customers |
|----------|------------|---------|-----------|
| ![](./screenshots/khardl_restaurant_admin_branches.png) | ![](./screenshots/khardl_restaurant_admin_branches_add.png) | ![](./screenshots/khardl_restaurant_admin_coupons.png) | ![](./screenshots/khardl_restaurant_admin_customers.png) |

| Delivery Companies | Drivers | Add Driver | Loyalty Points |
|--------------------|---------|------------|----------------|
| ![](./screenshots/khardl_restaurant_admin_delivery_companies.png) | ![](./screenshots/khardl_restaurant_admin_drivers.png) | ![](./screenshots/khardl_restaurant_admin_drivers_add.png) | ![](./screenshots/khardl_restaurant_admin_loyalty_points.png) |

| Menu | Orders | Services | Settings |
|------|--------|----------|----------|
| ![](./screenshots/khardl_restaurant_admin_menu.png) | ![](./screenshots/khardl_restaurant_admin_orders.png) | ![](./screenshots/khardl_restaurant_admin_services.png) | ![](./screenshots/khardl_restaurant_admin_settings.png) |

| Site Editor 1 | Site Editor 2 | Site Editor 3 | Summary |
|---------------|----------------|----------------|---------|
| ![](./screenshots/khardl_restaurant_admin_siteeditor.png) | ![](./screenshots/khardl_restaurant_admin_siteeditor_2.png) | ![](./screenshots/khardl_restaurant_admin_siteeditor_3.png) | ![](./screenshots/khardl_restaurant_admin_summary.png) |

| Staff | Add Staff |
|-------|-----------|
| ![](./screenshots/khardl_restaurant_admin_staff.png) | ![](./screenshots/khardl_restaurant_admin_staff_new.png) |


---

### Super Admin Panel:

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


-------


### Restaurant Front-End (Customer View)

| Home | Signup | Customer Dashboard | Cart |
|-----------|----------------|-----|------------|
| ![](./screenshots/khardl_restaurant_homepage.png) | ![](./screenshots/khardl_restaurant_signup.png) | ![](./screenshots/khardl_restaurant_customer_dashboard.png) | ![](./screenshots/khardl_restaurant_cart.png) |



---

## 📦 Tech Stack

- PHP (Laravel)
- MySQL
- Laravel Nova
- Docker
- docker-compose
- Apache/Nginx, Shared Hosting, Subdomain Routing
- React.js
- React Native
- Livewire
- Tailwind CSS + Livewire
- Firebase (Push notifications)
- TAP Payment Gateway
- Msegat (SMS API)
- REST (JWT Auth), Webhooks

---
## 🔌 API Integration

- Full REST APIs for mobile app integration
- Order tracking, status updates, and notifications
- JWT authentication and webhooks
- Supports driver, waiter, and public-facing mobile apps

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

