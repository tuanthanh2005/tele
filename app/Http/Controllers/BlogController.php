<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = [
            [
                'title' => 'Top 3 Bot Telegram Tín Hiệu Crypto Giúp Bạn Kiếm Tiền Tự Động 2026',
                'slug' => 'bot-telegram-tin-hieu-crypto',
                'excerpt' => 'Khám phá cách sử dụng bot Telegram để nhận tín hiệu giao dịch Crypto chuẩn xác. Tự động hóa quy trình kiếm tiền của bạn với công nghệ AI tiên tiến nhất hiện nay.',
                'image' => 'https://images.pexels.com/photos/844124/pexels-photo-844124.jpeg?auto=compress&cs=tinysrgb&w=800',
                'date' => '10/02/2026',
                'category' => 'Crypto'
            ],
            [
                'title' => 'Tại Sao Bạn Cần Bot Báo Giá Vàng Hôm Nay? Hướng Dẫn Cài Đặt Từ A-Z',
                'slug' => 'bot-bao-gia-vang-tu-dong',
                'excerpt' => 'Giá vàng biến động không ngừng. Đừng bỏ lỡ cơ hội chốt lời với Bot báo giá vàng qua Telegram. Cập nhật realtime, chính xác từng giây.',
                'image' => 'https://images.pexels.com/photos/47047/gold-ingots-golden-treasure-47047.jpeg?auto=compress&cs=tinysrgb&w=800',
                'date' => '09/02/2026',
                'category' => 'Vàng'
            ],
            [
                'title' => 'Bot Chứng Khoán Phái Sinh: Công Cụ Đắc Lực Cho Nhà Đầu Tư F0',
                'slug' => 'bot-chung-khoan-phai-sinh',
                'excerpt' => 'Đầu tư chứng khoán phái sinh chưa bao giờ dễ dàng hơn thế. Bot Telegram hỗ trợ phân tích kỹ thuật, đưa ra điểm mua/bán hợp lý cho người mới.',
                'image' => 'https://images.pexels.com/photos/6801874/pexels-photo-6801874.jpeg?auto=compress&cs=tinysrgb&w=800',
                'date' => '08/02/2026',
                'category' => 'Chứng Khoán'
            ]
        ];
        
        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        // Hardcoded detailed content for each post
        $postContent = [
            'bot-telegram-tin-hieu-crypto' => [
                'title' => 'Top 3 Bot Telegram Tín Hiệu Crypto Giúp Bạn Kiếm Tiền Tự Động 2026',
                'content' => '
                    <p class="mb-4">Trong thị trường Crypto đầy biến động, việc sở hữu một công cụ hỗ trợ ra quyết định nhanh chóng là vô cùng quan trọng. <strong>Bot Telegram tín hiệu Crypto</strong> đang trở thành xu hướng không thể thiếu cho các trader chuyên nghiệp lẫn người mới bắt đầu.</p>
                    
                    <h2 class="text-2xl font-bold mt-8 mb-4">1. Bot Telegram Tín Hiệu Crypto Là Gì?</h2>
                    <p class="mb-4">Bot Telegram Crypto là phần mềm tự động phân tích thị trường, theo dõi các chỉ số kỹ thuật (RSI, Bollinger Bands, MACD...) và gửi thông báo tín hiệu Mua/Bán (Long/Short) trực tiếp về điện thoại của bạn qua ứng dụng Telegram.</p>
                    
                    <h2 class="text-2xl font-bold mt-8 mb-4">2. Lợi Ích Của Việc Sử Dụng Bot Signal</h2>
                    <ul class="list-disc pl-6 mb-4 space-y-2">
                        <li><strong>Tiết kiệm thời gian:</strong> Không cần ngồi canh chart 24/7.</li>
                        <li><strong>Loại bỏ cảm xúc:</strong> Giao dịch dựa trên thuật toán, tránh FOMO hay sợ hãi.</li>
                        <li><strong>Độ chính xác cao:</strong> Phân tích dữ liệu lớn (Big Data) để tìm ra cơ hội tốt nhất.</li>
                        <li><strong>Kiếm tiền thụ động:</strong> Tự động đặt lệnh (nếu tích hợp API sàn).</li>
                    </ul>

                    <h2 class="text-2xl font-bold mt-8 mb-4">3. Top Bot Crypto Tốt Nhất 2026</h2>
                    <p class="mb-4">Tại <strong>BotBanHang.vn</strong>, chúng tôi cung cấp giải pháp Bot Crypto toàn diện với full source code Python, giúp bạn hoàn toàn làm chủ công cụ kiếm tiền của mình.</p>
                    <div class="bg-gray-100 p-4 rounded-lg border-l-4 border-purple-500 my-6">
                        <p class="font-bold">👉 Xem chi tiết sản phẩm: <a href="/san-pham/bot-crypto-alert" class="text-purple-600 hover:text-purple-800">Bot Crypto Alert</a></p>
                    </div>
                ',
                'image' => 'https://images.pexels.com/photos/844124/pexels-photo-844124.jpeg?auto=compress&cs=tinysrgb&w=800',
                'category' => 'Crypto',
                'date' => '10/02/2026'
            ],
            'bot-bao-gia-vang-tu-dong' => [
                 'title' => 'Tại Sao Bạn Cần Bot Báo Giá Vàng Hôm Nay? Hướng Dẫn Cài Đặt Từ A-Z',
                 'content' => '
                    <p class="mb-4">Giá vàng là một trong những chỉ số được quan tâm hàng đầu tại Việt Nam và thế giới. Việc cập nhật giá vàng realtime giúp các nhà đầu tư đưa ra quyết định mua bán chuẩn xác nhất.</p>

                    <h2 class="text-2xl font-bold mt-8 mb-4">Tại Sao Cần Theo Dõi Giá Vàng Realtime?</h2>
                    <p class="mb-4">Giá vàng biến động theo từng phút dựa trên tin tức kinh tế, chính trị thế giới (như tin FED lãi suất, chiến tranh...). Chậm trễ vài phút có thể khiến bạn mất đi cơ hội chốt lời hàng triệu đồng/lượng.</p>

                    <h2 class="text-2xl font-bold mt-8 mb-4">Tính Năng Nổi Bật Của Bot Báo Giá Vàng</h2>
                    <ul class="list-disc pl-6 mb-4 space-y-2">
                        <li>Cập nhật giá vàng SJC, PNJ, DOJI, vàng nhẫn 9999 liên tục.</li>
                        <li>Báo giá vàng thế giới (Spot Gold/XAUUSD).</li>
                        <li>Cảnh báo khi giá chạm ngưỡng cài đặt (Alert).</li>
                    </ul>
                    
                    <p class="mb-4">Bot của chúng tôi được viết bằng <strong>Python</strong>, dễ dàng tùy biến nguồn dữ liệu (SJC, Kitco...) và tích hợp vào nhóm chat Telegram của bạn.</p>

                    <div class="bg-yellow-50 p-4 rounded-lg border-l-4 border-yellow-500 my-6">
                        <p class="font-bold">👉 Sở hữu ngay: <a href="/san-pham/bot-gia-vang" class="text-yellow-600 hover:text-yellow-800">Source Code Bot Giá Vàng</a></p>
                    </div>
                 ',
                'image' => 'https://images.pexels.com/photos/47047/gold-ingots-golden-treasure-47047.jpeg?auto=compress&cs=tinysrgb&w=800',
                'category' => 'Vàng',
                'date' => '09/02/2026'
            ],
            'bot-chung-khoan-phai-sinh' => [
                'title' => 'Bot Chứng Khoán Phái Sinh: Công Cụ Đắc Lực Cho Nhà Đầu Tư F0',
                'content' => '
                    <p class="mb-4">Thị trường chứng khoán phái sinh (VN30F1M) là "mỏ vàng" cho những ai biết tận dụng đòn bẩy và biến động trong phiên. Tuy nhiên, nó cũng đầy rủi ro nếu thiếu kiến thức và kỷ luật.</p>

                    <h2 class="text-2xl font-bold mt-8 mb-4">Bot Phái Sinh Giúp Gì Cho Bạn?</h2>
                    <p class="mb-4">Thay vì phải căng mắt nhìn bảng điện và các chỉ báo kỹ thuật phức tạp, Bot sẽ tự động:</p>
                    <ul class="list-disc pl-6 mb-4 space-y-2">
                        <li>Xác định xu hướng Long/Short chính trong phiên.</li>
                        <li>Gợi ý vùng vào lệnh (Entry), chốt lời (TP), cắt lỗ (SL).</li>
                        <li>Cảnh báo đảo chiều xu hướng sớm.</li>
                    </ul>

                    <h2 class="text-2xl font-bold mt-8 mb-4">Tại Sao Nên Chọn Bot Telegram?</h2>
                    <p class="mb-4">Telegram có tốc độ gửi tin nhắn cực nhanh, API mở và hoàn toàn miễn phí. Kết hợp với sức mạnh xử lý dữ liệu của Python, bạn sẽ có một "trợ lý ảo" đắc lực.</p>

                    <div class="bg-blue-50 p-4 rounded-lg border-l-4 border-blue-500 my-6">
                         <p class="font-bold">👉 Xem demo: <a href="/san-pham/bot-chung-khoan" class="text-blue-600 hover:text-blue-800">Bot Chứng Khoán Phái Sinh</a></p>
                    </div>
                ',
                'image' => 'https://images.pexels.com/photos/6801874/pexels-photo-6801874.jpeg?auto=compress&cs=tinysrgb&w=800',
                'category' => 'Chứng Khoán',
                'date' => '08/02/2026'
            ]
        ];

        if (!array_key_exists($slug, $postContent)) {
            abort(404);
        }

        $post = (object) $postContent[$slug];
        
        return view('blog.show', compact('post'));
    }
}
