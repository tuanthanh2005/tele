@extends('layouts.app')

@section('title', 'Đơn Hàng #' . $order->order_code)

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4 max-w-3xl">
        @if($order->payment_status == 'pending')
        <!-- Pending Payment -->
        <div class="bg-white rounded-2xl p-8 shadow-lg text-center">
            <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <span class="text-5xl">⏳</span>
            </div>
            
            <h1 class="text-3xl font-bold mb-4">Đơn Hàng Đã Được Tạo!</h1>
            <p class="text-xl text-gray-600 mb-8">Mã đơn hàng: <span class="font-bold text-purple-600">#{{ $order->order_code }}</span></p>
            
            <div class="bg-purple-50 rounded-xl p-6 mb-8 text-left">
                <h2 class="text-xl font-bold mb-4">📋 Thông Tin Đơn Hàng</h2>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Sản phẩm:</span>
                        <span class="font-medium">{{ $order->product->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Khách hàng:</span>
                        <span class="font-medium">{{ $order->customer_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Email:</span>
                        <span class="font-medium">{{ $order->customer_email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Số điện thoại:</span>
                        <span class="font-medium">{{ $order->customer_phone }}</span>
                    </div>
                    <div class="border-t pt-2 mt-2"></div>
                    <div class="flex justify-between text-xl">
                        <span class="font-bold">Tổng tiền:</span>
                        <span class="font-bold text-purple-600">{{ number_format($order->amount) }}đ</span>
                    </div>
                </div>
            </div>
            
            <!-- VietQR Section -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-purple-100">
                <h2 class="text-xl font-bold mb-6 text-center text-purple-700">👇 Quét Mã QR Để Thanh Toán 👇</h2>
                
                <div class="flex flex-col md:flex-row gap-8 items-center justify-center">
                    <!-- QR Code -->
                    <div class="bg-white p-2 rounded-lg shadow-sm border border-gray-200">
                        <img src="https://img.vietqr.io/image/MB-0708910952-compact2.png?amount={{ $order->amount }}&addInfo={{ $order->order_code }}&accountName=TRAN%20THANH%20TUAN" 
                             alt="VietQR Payment" 
                             class="w-64 h-auto">
                    </div>

                    <!-- Details -->
                    <div class="text-left space-y-3">
                        <div>
                            <p class="text-sm text-gray-500">Ngân hàng</p>
                            <p class="font-bold text-lg text-blue-800">MB Bank (Quân Đội)</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Số tài khoản</p>
                            <p class="font-bold text-xl text-blue-800 tracking-wider">0708 9109 52</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Chủ tài khoản</p>
                            <p class="font-bold text-lg uppercase">TRAN THANH TUAN</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Số tiền</p>
                            <p class="font-bold text-2xl text-purple-600">{{ number_format($order->amount) }}đ</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Nội dung</p>
                            <p class="font-bold text-lg bg-yellow-100 text-yellow-800 px-3 py-1 rounded inline-block">{{ $order->order_code }}</p>
                        </div>
                        <p class="text-xs text-red-500 italic mt-2">* Vui lòng không sửa nội dung chuyển khoản</p>
                    </div>
                </div>
            </div>

            <!-- Confirmation Button -->
            <div class="text-center mb-10">
                <form action="{{ route('orders.confirm', $order->order_code) }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="bg-green-600 text-white px-8 py-4 rounded-full font-bold text-xl hover:bg-green-700 hover:shadow-xl transition transform hover:scale-105 animate-pulse">
                        ✅ BẤM VÀO ĐÂY SAU KHI CHUYỂN KHOẢN
                    </button>
                    <p class="text-sm text-gray-500 mt-3">Hệ thống sẽ gửi thông báo đến Admin ngay lập tức!</p>
                </form>
            </div>
            
            <div class="space-y-4">
                <p class="text-gray-600">
                    Sau khi chuyển khoản, link download sẽ được gửi qua email 
                    <strong>{{ $order->customer_email }}</strong> trong vòng <strong>5-30 phút</strong>.
                </p>
                
                <div class="flex gap-4 justify-center">
                    <a href="mailto:tranthanhtuanfix@gmail.com?subject=Đơn hàng {{ $order->order_code }}" 
                       class="bg-white border-2 border-purple-600 text-purple-600 px-6 py-3 rounded-full font-bold hover:bg-purple-50 transition">
                        📧 Liên Hệ Support
                    </a>
                    <a href="{{ route('home') }}" 
                       class="bg-gray-200 text-gray-700 px-6 py-3 rounded-full font-bold hover:bg-gray-300 transition">
                        🏠 Về Trang Chủ
                    </a>
                </div>
            </div>
        </div>
        
        @elseif($order->payment_status == 'paid')
        <!-- Paid -->
        <div class="bg-white rounded-2xl p-8 shadow-lg text-center">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <span class="text-5xl">✅</span>
            </div>
            
            <h1 class="text-3xl font-bold mb-4 text-green-600">Thanh Toán Thành Công!</h1>
            <p class="text-xl text-gray-600 mb-8">Đơn hàng #{{ $order->order_code }}</p>
            
            <div class="bg-green-50 rounded-xl p-6 mb-8">
                <p class="text-lg mb-4">
                    Link download đã được gửi đến email: <strong>{{ $order->customer_email }}</strong>
                </p>
                <p class="text-gray-600">
                    Nếu không thấy email, vui lòng kiểm tra thư mục Spam hoặc liên hệ support.
                </p>
            </div>
            
            <a href="{{ route('home') }}" class="inline-block bg-purple-600 text-white px-8 py-3 rounded-full font-bold hover:bg-purple-700 transition">
                🏠 Về Trang Chủ
            </a>
        </div>
        @endif
        
        <!-- Support Info -->
        <div class="mt-8 bg-white rounded-xl p-6 text-center">
            <h3 class="font-bold mb-3">Cần Hỗ Trợ?</h3>
            <div class="flex gap-4 justify-center text-sm">
                <a href="https://t.me/specademy" class="text-purple-600 hover:underline">📱 Telegram</a>
                <a href="mailto:tranthanhtuanfix@gmail.com" class="text-purple-600 hover:underline">📧 Email</a>
            </div>
        </div>
    </div>
</div>
@endsection
