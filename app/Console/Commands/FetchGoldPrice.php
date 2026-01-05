<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use App\Models\GoldPrice;

class FetchGoldPrice extends Command
{
    protected $signature = 'gold:fetch';

    // توضیحات دستور
    protected $description = 'دریافت قیمت طلا از BrsApi و ذخیره در دیتابیس';

    /**
     * @throws ConnectionException
     */
    public function handle()
    {
        $this->info('در حال دریافت اطلاعات از BrsApi...');


        // API Key for BrsApi service.
        // Get your own key from BrsApi.ir and replace 'YOUR_API_KEY_HERE'
        $response = \Illuminate\Support\Facades\Http::get('https://BrsApi.ir/Api/Market/Gold_Currency.php', [
            'key' => 'YOUR_API_KEY_HERE',
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $goldItems = $data['gold'];

            foreach ($goldItems as $item) {
                \App\Models\GoldPrice::create([
                    'type'        => $item['name'],  // مثلا: "سکه امامی"
                    'price'       => $item['price'], // مقدار عددی: 160010000
                    'market_date' => now()->format('Y-m-d'), // تاریخ امروز برای نمودار
                ]);
            }

            $this->info("تعداد " . count($goldItems) . " مورد با موفقیت ذخیره شد.");
        } else {
            $this->error('خطا در فراخوانی API: ' . $response->status());
        }
    }
}
