<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bot Telegram - Kiếm Tiền Tự Động')</title>
    <meta name="description" content="@yield('meta_description', 'Bán bot Telegram crypto, vàng, chứng khoán. Full source code Python. Kiếm tiền tự động với affiliate.')">
    <meta name="keywords" content="@yield('meta_keywords', 'bot telegram, bot crypto, bot giá vàng, bot chứng khoán, kiếm tiền online')">
    
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
                    🤖 BotBanHang.vn
                </a>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-purple-600 font-medium">Trang Chủ</a>
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-purple-600 font-medium">Sản Phẩm</a>
                    <a href="{{ route('blog.index') }}" class="text-gray-700 hover:text-purple-600 font-medium">Blog</a>
                    <a href="#contact" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-2 rounded-full font-medium hover:shadow-lg transition">
                        Liên Hệ
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <button class="md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
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
                <div>
                    <h3 class="text-xl font-bold mb-4">🤖 BotBanHang.vn</h3>
                    <p class="text-gray-400">Bán bot Telegram chất lượng cao. Full source code, hướng dẫn chi tiết, support tận tình.</p>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4">Sản Phẩm</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('products.show', 'bot-crypto-alert') }}" class="hover:text-white">Bot Crypto</a></li>
                        <li><a href="{{ route('products.show', 'bot-gia-vang') }}" class="hover:text-white">Bot Giá Vàng</a></li>
                        <li><a href="{{ route('products.show', 'bot-chung-khoan') }}" class="hover:text-white">Bot Chứng Khoán</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4">Hỗ Trợ</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Hướng dẫn cài đặt</a></li>
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                        <li><a href="#" class="hover:text-white">Liên hệ</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4">Liên Hệ</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>📧 Email: tranthanhtuanfix@gmail.com</li>
                        <li>📱 Telegram: @specademy</li>
                        <li>🌐 Facebook: fb.com/specademy</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2026 BotBanHang.vn - Bán Bot Telegram Kiếm Tiền Tự Động</p>
            </div>
        </div>
    </footer>

    @yield('extra_js')
</body>
</html>
