# 🪙 Gold & Coin Analysis API

A smart, lightweight backend service built with **Laravel 11** to fetch real-time gold and coin prices and provide buy/sell/hold analysis based on statistical methods.

## 🚀 Key Features
* **Auto-Fetch:** Automatically retrieves prices from reliable sources using custom Artisan commands.
* **Smart Analysis:** Analyzes market trends using a 5-day Simple Moving Average (SMA) strategy.
* **Automated Workflow:** Fully automated updates via Cron Jobs.
* **Android Ready:** Optimized JSON output designed for seamless integration with mobile apps (Retrofit/Volley).
* **Monitoring Dashboard:** A clean, minimal index page to monitor API health and database records at a glance.

## 🛠 Tech Stack
* **Framework:** Laravel 11
* **PHP Version:** 8.2+
* **Database:** MySQL
* **Design Pattern:** Service-Pattern (Decoupling analysis logic from controllers for better maintainability).

## 📍 API Endpoints
* `GET /` : System Health Check & Database Monitoring.
* `GET /api/gold/analyze` : Real-time market analysis and predictions.

---
⚠️ **Academic Disclaimer** This API was developed as part of a **university project** and is intended strictly for **academic purposes**. The analysis provided is based on a simplified algorithm and should not be used as professional financial advice.

Note: To run the fetcher, you need to obtain an API Key from the source website and paste it into the code.
