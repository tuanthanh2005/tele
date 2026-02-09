<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\BlogPost::create([
            'title' => 'Cách Kiếm 10 Triệu/Tháng Với Bot Telegram Tự Động',
            'slug' => 'cach-kiem-10-trieu-thang-voi-bot-telegram',
            'excerpt' => 'Hướng dẫn chi tiết cách tạo nguồn thu nhập thụ động từ việc chia sẻ bot Telegram crypto và chứng khoán.',
            'content' => "Bạn đang tìm kiếm một nguồn thu nhập thụ động? Telegram Bot chính là câu trả lời.

Với sự bùng nổ của thị trường Crypto và Chứng khoán, nhu cầu cập nhật thông tin nhanh chóng là cực kỳ lớn. Bot Telegram giải quyết vấn đề này bằng cách gửi thông báo real-time.

## Tại sao nên kiếm tiền với Bot Telegram?

1. **Thị trường lớn:** Hàng triệu người đang trade coin/chứng khoán mỗi ngày.
2. **Tự động hóa:** Bot chạy 24/7, bạn không cần làm gì cả.
3. **Chi phí thấp:** Chỉ cần một VPS giá rẻ hoặc hosting miễn phí.

## Cách thực hiện:

Bước 1: Sở hữu một con bot chất lượng (như Crypto Alert Bot).
Bước 2: Đăng ký Affiliate của các sàn (Binance, OKX, Bybit).
Bước 3: Tích hợp link affiliate vào bot.
Bước 4: Chia sẻ bot vào các group cộng đồng.

Khi người dùng thấy bot hữu ích, họ sẽ sử dụng hàng ngày. Khi họ đăng ký tài khoản qua link của bạn, bạn nhận hoa hồng trọn đời!",
            'thumbnail' => null,
            'meta_title' => 'Kiếm tiền với Bot Telegram - Hướng dẫn từ A-Z',
            'meta_description' => 'Cách tạo thu nhập thụ động 10 triệu/tháng với Bot Telegram Crypto và Chứng khoán.',
            'views' => 1250,
            'is_published' => true,
            'published_at' => now(),
        ]);

        \App\Models\BlogPost::create([
            'title' => 'Top 3 Bot Telegram Cần Thiết Cho Trader 2026',
            'slug' => 'top-3-bot-telegram-cho-trader-2026',
            'excerpt' => 'Danh sách 3 bot Telegram không thể thiếu giúp trader nắm bắt cơ hội thị trường nhanh nhất.',
            'content' => "Trong trading, thông tin là tiền bạc. Ai biết tin trước, người đó thắng. Dưới đây là 3 bot Telegram giúp bạn đi trước thị trường:

## 1. Crypto Alert Bot
Bot này giúp bạn track giá của hơn 100+ đồng coin.
- Cảnh báo khi giá chạm target.
- Cập nhật airdrop mới nhất.
- Theo dõi ví cá voi.

## 2. Gold Price Bot
Dành cho dân buôn vàng hoặc đầu tư tích trữ.
- Cập nhật giá vàng SJC, PNJ real-time.
- So sánh giá chênh lệch giữa các tiệm.

## 3. Stock Signal Bot
Bot tín hiệu chứng khoán Việt Nam.
- Báo tín hiệu mua/bán dựa trên phân tích kỹ thuật.
- Cập nhật tin tức vĩ mô.

Sở hữu trọn bộ 3 bot này tại **BotBanHang.vn** để nâng cao hiệu suất đầu tư của bạn!",
            'thumbnail' => null,
            'meta_title' => 'Top 3 Bot Telegram Trader Cần Có',
            'meta_description' => 'Review 3 bot Telegram tốt nhất cho trader Crypto và Chứng khoán năm 2026.',
            'views' => 850,
            'is_published' => true,
            'published_at' => now()->subDays(2),
        ]);

        \App\Models\BlogPost::create([
            'title' => 'Hướng Dẫn Cài Đặt Bot Telegram Trên VPS Giá Rẻ',
            'slug' => 'huong-dan-cai-dat-bot-telegram-vps',
            'excerpt' => 'Tutorial chi tiết cách deploy bot Telegram Python lên VPS Ubuntu chỉ với 50k/tháng.',
            'content' => "Bạn đã mua source code bot nhưng chưa biết cách chạy 24/7? Bài viết này sẽ hướng dẫn bạn deploy lên VPS.

## Chuẩn bị:
- 1 VPS (mua tại Vultr, DigitalOcean hoặc các nhà cung cấp VN). Hệ điều hành Ubuntu 22.04.
- Source code bot (từ BotBanHang.vn).
- Phần mềm PuTTY hoặc Terminal.

## Các bước cài đặt:

1. **SSH vào VPS:**
`ssh root@ip-cua-ban`

2. **Cài đặt Python và Pip:**
`sudo apt update && sudo apt install python3 python3-pip -y`

3. **Upload code:**
Dùng FileZilla để upload code lên thư mục `/root/mybot`.

4. **Cài thư viện:**
`cd /root/mybot`
`pip3 install -r requirements.txt`

5. **Chạy bot với PM2 (giúp bot tự khởi động lại nếu crash):**
`sudo apt install npm -y`
`sudo npm install pm2 -g`
`pm2 start bot.py --interpreter python3`

Xong! Bot của bạn giờ đã chạy online 24/7.",
            'thumbnail' => null,
            'meta_title' => 'Cách deploy Bot Telegram lên VPS',
            'meta_description' => 'Hướng dẫn chi tiết cài đặt bot Telegram Python trên VPS Ubuntu.',
            'views' => 500,
            'is_published' => true,
            'published_at' => now()->subDays(5),
        ]);
    }
}
