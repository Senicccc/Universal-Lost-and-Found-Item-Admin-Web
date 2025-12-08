# Universal Lost and Found (ULaF) – Admin Web Panel

The ULaF Admin Web Panel is a Laravel-based dashboard designed to manage all data related to lost and found item reports. It provides administrators with tools to monitor system activity, review user submissions, manage items, and maintain data integrity across the entire ULaF ecosystem.

This panel works together with the **ULaF Mobile App (Flutter)** and a **Laravel REST API backend**, forming a unified system for reporting, tracking, and organizing lost and found items.

---

## Key Features

###  Dashboard Overview
The dashboard displays essential system statistics including:
- Total registered users  
- Total reported items  
- Total unclaimed items  
- Recently added reports  

### Item Management
Admins can:
- View all items (lost & found)  
- Edit item data  
- Delete invalid or duplicate reports  
- Approve or update item statuses (e.g., *claimed*, *returned*)  
- View detailed item information including images  

###  User Management
- View all registered users  
- Edit or remove users if necessary  
- Monitor user activity related to item reports  

---

## System Architecture

The Admin Panel is tightly integrated with the backend API and mobile application:

1. **Mobile App (Flutter)**  
   Sends report data, images, and updates through API requests. You can access ULaF mobile app on **https://github.com/Senicccc/Universal-Lost-and-Found-Item-Mobile-App**

2. **Laravel API**  
   Processes mobile requests and provides endpoints to the admin panel.

3. **Admin Web Panel (this repository)**  
   Allows administrators to control and manage all system data using a clean UI built with Blade templates.

---

## Database Overview

The system uses MySQL named "ulaf_db" with tables such as:
- `users`
- `items`
- `item_status`
- `bookmarks`

This admin panel provides full CRUD access to almost all key tables, depending on feature implementation.

---

## 🚀 Tech Stack

- Laravel 12 (PHP)
- MySQL  

---
