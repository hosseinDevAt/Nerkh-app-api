<?php

namespace App\Services;

use App\Models\GoldPrice;

class AnalysisService
{
    public function getPrediction($type = 'طلای 18 عیار')
    {
        // خیلی مهم: حتما شرط where اضافه شود تا قیمت‌ها قاطی نشوند
        $prices = GoldPrice::where('type', $type)
            ->orderBy('market_date', 'desc')
            ->orderBy('id', 'desc') // برای اطمینان از ترتیب در یک روز
            ->take(6)
            ->get();

        // اگر تعداد داده‌ها برای این "نوع خاص" کم باشد
        if ($prices->count() < 2) {
            return [
                'action' => 'WAIT',
                'message' => "داده کافی برای $type موجود نیست.",
            ];
        }

        $todayPrice = $prices->first()->price;

        // میانگین گیری فقط از همان نوع
        $average = $prices->avg('price');

        $diffPercent = (($todayPrice - $average) / $average) * 100;

        // منطق تحلیل
        if ($diffPercent < -1) {
            $action = 'BUY';
            $title = 'پیشنهاد خرید';
            $msg = "قیمت $type کاهش داشته، زمان ورود است.";
        } elseif ($diffPercent > 1) {
            $action = 'SELL';
            $title = 'پیشنهاد فروش';
            $msg = "قیمت $type بالا رفته، سود را ذخیره کنید.";
        } else {
            $action = 'HOLD';
            $title = 'صبر';
            $msg = 'نوسان بازار عادی است.';
        }

        return [
            'advice' => [
                'action' => $action,
                'title' => $title,
                'description' => $msg,
            ],
            'market_stats' => [
                'current_price' => number_format($todayPrice) . ' تومان',
                'change_percent' => round($diffPercent, 2) . '%',
            ],
            'chart_points' => $prices->pluck('price')->reverse()->values(),
            'chart_labels' => $prices->pluck('market_date')->reverse()->values()
        ];
    }
}
