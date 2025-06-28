# 💳 Bankist - PHP Banking App

A modern and lightweight banking web app built with **PHP**, **JavaScript**, **MySQL**, and custom **session-based authentication**. Inspired by clean UI/UX principles and real-world banking operations.

---

## 🚀 Features

- ✅ User registration & login with session management
- 🔐 Session timeout with **5-minute inactivity auto-logout**
- 💸 Transfer money between accounts
- 🏦 Request loans (based on account history)
- ❌ Close account (with confirmation)
- 💰 Real-time balance and transaction history
- 🌘 Beautiful **dark mode UI**

---

## 🕒 Session Timeout Logic

- After login or any transaction (loan / transfer), a 5-minute timer starts.
- If the user is inactive for 5 minutes, the session automatically ends and user is logged out.
- Timer resets on each valid activity.

---

## ⚙️ Stack

- **Backend**: PHP (Vanilla PHP, OOP)
- **Frontend**: HTML, CSS, JavaScript (ES6+)
- **Database**: MySQL via Medoo (lightweight PHP DB wrapper)
- **Sessions**: PHP-native `$_SESSION` for auth and timers

---

## 🧪 How to Use

### 🔧 Prerequisites

- PHP 8.0+
- MySQL
- Composer

### 📥 Installation

```bash
git clone https://github.com/AmirRiahi2008/bankist-app-php.git
cd bankist-app-php
composer install
```
### 💾 Database

- Go to database/bankist.sql
