<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::create([
            'name' => 'Bot Telegram Crypto Alert',
            'slug' => 'bot-crypto-alert',
            'description' => 'Bot Telegram tự động cảnh báo giá cryptocurrency real-time. Hỗ trợ hàng trăm đồng coin, alert tùy chỉnh, thông tin airdrop mới nhất. Kiếm tiền tự động với affiliate Binance, OKX, Bybit.',
            'features' => [
                'Xem giá real-time hơn 100+ coins',
                'Cảnh báo giá tự động 24/7',
                'Thông tin airdrop mới nhất',
                'Theo dõi phí gas ETH/BSC',
                'Tích hợp affiliate links sẵn',
                'Full source code Python',
                'Hướng dẫn cài đặt chi tiết',
                'Support 1 tháng miễn phí',
                'Update miễn phí 6 tháng'
            ],
            'price' => 3000000,
            'original_price' => 5000000,
            'demo_link' => 't.me/CryptoAlertDemoBot',
            'download_link' => null, // Sẽ tạo sau khi khách mua
            'thumbnail' => '/images/bot-crypto.jpg',
            'category' => 'crypto',
            'tech_stack' => 'Python 3.11, python-telegram-bot, CoinGecko API, SQLite',
            'sales_count' => 0,
            'is_active' => true
        ]);

        \App\Models\Product::create([
            'name' => 'Bot Telegram Giá Vàng',
            'slug' => 'bot-gia-vang',
            'description' => 'Bot Telegram cập nhật giá vàng SJC, PNJ, DOJI real-time. Cảnh báo khi vàng tăng/giảm. Lịch sử giá vàng. Kiếm tiền với affiliate tiệm vàng online, bảo hiểm.',
            'features' => [
                'Giá vàng SJC, PNJ, DOJI real-time',
                'Cảnh báo giá vàng tự động',
                'Lịch sử giá vàng',
                'So sánh giá các loại vàng',
                'Tích hợp affiliate sẵn',
                'Full source code Python',
                'Hướng dẫn cài đặt',
                'Support 1 tháng',
                'Update miễn phí 6 tháng'
            ],
            'price' => 2000000,
            'original_price' => 3000000,
            'demo_link' => 't.me/GoldPriceVNBot',
            'download_link' => null,
            'thumbnail' => '/images/bot-gold.jpg',
            'category' => 'gold',
            'tech_stack' => 'Python 3.11, python-telegram-bot, Web Scraping, SQLite',
            'sales_count' => 0,
            'is_active' => true
        ]);

        \App\Models\Product::create([
            'name' => 'Bot Telegram Chứng Khoán',
            'slug' => 'bot-chung-khoan',
            'description' => 'Bot Telegram theo dõi giá cổ phiếu Việt Nam real-time. Cảnh báo giá, VN-Index, top tăng/giảm. Kiếm tiền với affiliate chứng khoán, khóa học đầu tư.',
            'features' => [
                'Giá cổ phiếu real-time',
                'Cảnh báo giá cổ phiếu',
                'VN-Index, HNX-Index',
                'Top cổ phiếu tăng/giảm',
                'Thông tin doanh nghiệp',
                'Tích hợp affiliate sẵn',
                'Full source code Python',
                'Hướng dẫn cài đặt',
                'Support 1 tháng',
                'Update miễn phí 6 tháng'
            ],
            'price' => 3000000,
            'original_price' => 5000000,
            'demo_link' => 't.me/StockVNBot',
            'download_link' => null,
            'thumbnail' => '/images/bot-stock.jpg',
            'category' => 'stock',
            'tech_stack' => 'Python 3.11, python-telegram-bot, VNDirect API, SQLite',
            'sales_count' => 0,
            'is_active' => true
        ]);
    }
}
