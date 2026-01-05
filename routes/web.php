<?php

use Illuminate\Support\Facades\Route;
use App\Models\GoldPrice;

Route::get('/', function () {
    $lastEntry = GoldPrice::latest()->first();
    $lastUpdate = $lastEntry ? $lastEntry->created_at->format('H:i:s') . ' (امروز)' : 'داده‌ای یافت نشد';
    $totalRecords = GoldPrice::count();

    return "
    <style>
        body, html { margin: 0; padding: 0; height: 100%; overflow: hidden; }
        .container {
            display: flex; justify-content: center; align-items: center;
            height: 100vh; background-color: #f4f7f6; font-family: Tahoma, sans-serif;
        }
        .card {
            background: white; width: 90%; max-width: 400px; padding: 25px;
            border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); text-align: center;
        }
    </style>
    <div class='container' dir='rtl'>
        <div class='card'>
            <h2 style='color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px; margin-top: 0;'>وضعیت سیستم تحلیل طلا ✅</h2>
            <div style='text-align: right; margin-top: 20px;'>
                <p>🚀 وضعیت سرور: <strong style='color: #27ae60;'>فعال</strong></p>
                <p>⏰ آخرین بروزرسانی: <strong style='color: #e67e22;'>$lastUpdate</strong></p>
                <p>📊 کل داده‌های ذخیره شده: <strong>$totalRecords</strong></p>
            </div>
            <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
            <small style='color: #95a5a6;'>! Developed by Hossein</small>
        </div>
    </div>
    ";
});
