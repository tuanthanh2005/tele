<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bot Telegram - Kiếm Tiền Tự Động')</title>
    <meta name="description" content="@yield('meta_description', 'Bán bot Telegram crypto, vàng, chứng khoán. Full source code Python. Kiếm tiền tự động với affiliate.')">
    <meta name="keywords" content="@yield('meta_keywords', 'bot telegram, bot crypto, bot giá vàng, bot chứng khoán, kiếm tiền online')">
    <link rel="icon" type="image/png" href="{{ asset('tele.png') }}">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
    
    @yield('extra_css')
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="text-2xl font-bold gradient-text">
                 Bot Tele
                </a>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-purple-600 font-medium">Trang Chủ</a>
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-purple-600 font-medium">Sản Phẩm</a>
                    <a href="{{ route('blog.index') }}" class="text-gray-700 hover:text-purple-600 font-medium">Blog</a>
                </div>
                
                <!-- Mobile menu button -->
                <button id="mobile-menu-toggle" class="md:hidden" aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="md:hidden hidden mt-4 space-y-2">
                <a href="{{ route('home') }}" class="block text-gray-700 hover:text-purple-600 font-medium">Trang Chủ</a>
                <a href="{{ route('products.index') }}" class="block text-gray-700 hover:text-purple-600 font-medium">Sản Phẩm</a>
                <a href="{{ route('blog.index') }}" class="block text-gray-700 hover:text-purple-600 font-medium">Blog</a>
                <a href="#contact" class="block bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-4 py-2 rounded-full font-medium text-center hover:shadow-lg transition">
                    Liên Hệ
                </a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-20">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center md:text-left">
                    <h3 class="text-xl font-bold mb-4">🤖 Bot Tele</h3>
                    <p class="text-gray-400">Bán bot Telegram chất lượng cao. Full source code, hướng dẫn chi tiết, support tận tình.</p>
                </div>
                
                <div class="text-center md:text-left">
                    <h4 class="font-bold mb-4">Sản Phẩm</h4>
                    <button data-modal="products" class="inline-flex items-center justify-center w-full md:w-auto text-gray-400 hover:text-white">Xem danh sách</button>
                </div>
                
                <div class="text-center md:text-left">
                    <h4 class="font-bold mb-4">Hỗ Trợ</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><button onclick="document.getElementById('guide-modal').classList.remove('hidden'); document.getElementById('guide-modal').classList.add('flex')" class="hover:text-white transition">Hướng dẫn cài đặt</button></li>
                        <li><button onclick="document.getElementById('faq-modal').classList.remove('hidden'); document.getElementById('faq-modal').classList.add('flex')" class="hover:text-white transition">FAQ</button></li>
                    </ul>
                </div>
                
                <div class="text-center md:text-left">
                    <h4 class="font-bold mb-4">Liên Hệ</h4>
                    <button onclick="document.getElementById('contact-modal').classList.remove('hidden'); document.getElementById('contact-modal').classList.add('flex')" class="inline-flex items-center justify-center w-full md:w-auto text-gray-400 hover:text-white font-medium">Xem liên hệ</button>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2026 BotBanHang.vn - Bán Bot Telegram Kiếm Tiền Tự Động</p>
            </div>
        </div>
    </footer>

    <!-- Footer Modals -->
    <div id="footer-modal" class="fixed inset-0 hidden items-center justify-center bg-black/60 z-50 px-4">
        <div class="bg-white rounded-2xl w-full max-w-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 id="footer-modal-title" class="text-xl font-bold text-gray-900"></h3>
                <button id="footer-modal-close" class="text-gray-500 hover:text-gray-900" aria-label="Close">✕</button>
            </div>
            <div id="footer-modal-body" class="space-y-3 text-gray-700"></div>
        </div>
    </div>

    <!-- Hardcoded Contact Modal -->
    <div id="contact-modal" class="fixed inset-0 hidden items-center justify-center bg-black/60 z-50 px-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl w-full max-w-md p-6 relative shadow-2xl">
            <button onclick="document.getElementById('contact-modal').classList.add('hidden'); document.getElementById('contact-modal').classList.remove('flex')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-900 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <h3 class="text-2xl font-bold mb-6 text-gray-900">Liên Hệ Hỗ Trợ</h3>
            <div class="space-y-4">
                <a href="https://t.me/specademy" target="_blank" class="flex items-center gap-4 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition group">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white text-xl">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 11.944 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Telegram</p>
                        <p class="font-bold text-gray-900 group-hover:text-blue-600 transition">@specademy</p>
                    </div>
                </a>

                <a href="mailto:tranthanhtuanfix@gmail.com" class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition group">
                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center text-white text-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Email Support</p>
                        <p class="font-bold text-gray-900 group-hover:text-gray-700 transition">tranthanhtuanfix@gmail.com</p>
                    </div>
                </a>

                <a href="https://www.facebook.com/thanh.tuan.378686?locale=vi_VN" target="_blank" class="flex items-center gap-4 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition group">
                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white text-xl">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Facebook</p>
                        <p class="font-bold text-gray-900 group-hover:text-blue-600 transition">fb.com/specademy</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Hardcoded Guide Modal -->
    <div id="guide-modal" class="fixed inset-0 hidden items-center justify-center bg-black/60 z-50 px-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl w-full max-w-2xl p-6 relative shadow-2xl overflow-y-auto max-h-[90vh]">
            <button onclick="document.getElementById('guide-modal').classList.add('hidden'); document.getElementById('guide-modal').classList.remove('flex')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-900 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <h3 class="text-2xl font-bold mb-6 text-gray-900">Hướng Dẫn Cài Đặt</h3>
            <div class="space-y-6 text-gray-700">
                <div class="border-b pb-4">
                    <h4 class="font-bold text-lg text-purple-600 mb-2">Bước 1: Chuẩn bị môi trường</h4>
                    <ul class="list-disc pl-5 space-y-1">
                        <li>Cài đặt Python 3.8 trở lên (tích chọn Add to PATH).</li>
                        <li>Cài đặt Git (tùy chọn, để clone code).</li>
                        <li>Một trình soạn thảo code (VS Code, PyCharm).</li>
                    </ul>
                </div>
                <div class="border-b pb-4">
                    <h4 class="font-bold text-lg text-purple-600 mb-2">Bước 2: Cài đặt thư viện</h4>
                    <p class="mb-2">Mở terminal tại thư mục chứa source code và chạy lệnh:</p>
                    <div class="bg-gray-100 p-3 rounded font-mono text-sm">pip install -r requirements.txt</div>
                    <p class="mt-2 text-sm text-gray-500">* Nếu gặp lỗi, hãy thử: <code>python -m pip install -r requirements.txt</code></p>
                </div>
                <div class="border-b pb-4">
                    <h4 class="font-bold text-lg text-purple-600 mb-2">Bước 3: Cấu hình Bot</h4>
                    <ul class="list-disc pl-5 space-y-1">
                        <li>Đổi tên file <code class="bg-gray-100 px-1 rounded">.env.example</code> thành <code class="bg-gray-100 px-1 rounded">.env</code></li>
                        <li>Mở file .env và điền Token Bot của bạn (lấy từ @BotFather).</li>
                        <li>Điền các thông số API khác nếu cần (Binance API, v.v.).</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-lg text-purple-600 mb-2">Bước 4: Chạy Bot</h4>
                    <p class="mb-2">Chạy lệnh sau để khởi động bot:</p>
                    <div class="bg-gray-100 p-3 rounded font-mono text-sm">python main.py</div>
                    <p class="mt-2 text-green-600 font-medium">✅ Bot đã sẵn sàng hoạt động!</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Hardcoded FAQ Modal -->
    <div id="faq-modal" class="fixed inset-0 hidden items-center justify-center bg-black/60 z-50 px-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl w-full max-w-2xl p-6 relative shadow-2xl overflow-y-auto max-h-[90vh]">
            <button onclick="document.getElementById('faq-modal').classList.add('hidden'); document.getElementById('faq-modal').classList.remove('flex')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-900 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <h3 class="text-2xl font-bold mb-6 text-gray-900">Câu Hỏi Thường Gặp (FAQ)</h3>
            <div class="space-y-4">
                <div class="bg-gray-50 p-4 rounded-xl">
                    <h4 class="font-bold text-gray-900 mb-2">1. Bot có chạy được trên VPS không?</h4>
                    <p class="text-gray-600">Có, bot được tối ưu để chạy trên mọi nền tảng VPS (Windows, Linux, Ubuntu). Chúng tôi khuyến nghị dùng Ubuntu 20.04 trở lên.</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-xl">
                    <h4 class="font-bold text-gray-900 mb-2">2. Tôi có được update code mới không?</h4>
                    <p class="text-gray-600">Khách hàng được update miễn phí trọn đời khi có phiên bản mới hoặc sửa lỗi từ phía Telegram API.</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-xl">
                    <h4 class="font-bold text-gray-900 mb-2">3. Tôi không biết code có cài được không?</h4>
                    <p class="text-gray-600">Hoàn toàn được. Chúng tôi có video hướng dẫn chi tiết từng bước. Ngoài ra đội ngũ support sẽ hỗ trợ cài đặt qua UltraViewer/TeamViewer nếu bạn gặp khó khăn.</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-xl">
                    <h4 class="font-bold text-gray-900 mb-2">4. Chính sách bảo hành thế nào?</h4>
                    <p class="text-gray-600">Bảo hành code bot 12 tháng. Hỗ trợ fix lỗi phát sinh trong quá trình sử dụng. Cam kết bot hoạt động ổn định 24/7.</p>
                </div>
            </div>
        </div>
    </div>

    @yield('extra_js')
    <script>
        (function () {
            var toggle = document.getElementById('mobile-menu-toggle');
            var menu = document.getElementById('mobile-menu');
            if (!toggle || !menu) return;
            toggle.addEventListener('click', function () {
                menu.classList.toggle('hidden');
            });
        })();
    </script>
    <script>
        (function () {
            // Products Modal Logic
            var modal = document.getElementById('footer-modal');
            var title = document.getElementById('footer-modal-title');
            var body = document.getElementById('footer-modal-body');
            var closeBtn = document.getElementById('footer-modal-close');
            
            var content = {
                products: {
                    title: 'Sản Phẩm',
                    items: [
                        '<a href="/san-pham/bot-crypto-alert" class="block p-3 rounded hover:bg-gray-50 text-purple-600 font-medium">Bot Crypto</a>',
                        '<a href="/san-pham/bot-gia-vang" class="block p-3 rounded hover:bg-gray-50 text-purple-600 font-medium">Bot Giá Vàng</a>',
                        '<a href="/san-pham/bot-chung-khoan" class="block p-3 rounded hover:bg-gray-50 text-purple-600 font-medium">Bot Chứng Khoán</a>'
                    ]
                }
            };

            function openModal(key) {
                var data = content[key];
                if (!data) return;
                title.textContent = data.title;
                body.innerHTML = data.items.join('');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            document.querySelectorAll('[data-modal]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    openModal(btn.getAttribute('data-modal'));
                });
            });

            if(closeBtn) closeBtn.addEventListener('click', closeModal);
            if(modal) {
                modal.addEventListener('click', function (e) {
                    if (e.target === modal) closeModal();
                });
            }

            // Close Contact Modal on outside click
            var contactModal = document.getElementById('contact-modal');
                contactModal.addEventListener('click', function(e) {
                    if (e.target === contactModal) {
                        contactModal.classList.add('hidden');
                        contactModal.classList.remove('flex');
                    }
                });
            }

            // Close Guide Modal on outside click
            var guideModal = document.getElementById('guide-modal');
            if(guideModal) {
                guideModal.addEventListener('click', function(e) {
                    if (e.target === guideModal) {
                        guideModal.classList.add('hidden');
                        guideModal.classList.remove('flex');
                    }
                });
            }

            // Close FAQ Modal on outside click
            var faqModal = document.getElementById('faq-modal');
            if(faqModal) {
                faqModal.addEventListener('click', function(e) {
                    if (e.target === faqModal) {
                        faqModal.classList.add('hidden');
                        faqModal.classList.remove('flex');
                    }
                });
            }
        })();
    </script>
</body>
</html>
