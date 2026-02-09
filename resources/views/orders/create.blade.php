@extends('layouts.app')

@section('title', 'Đặt Hàng - ' . $product->name)

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        <h1 class="text-4xl font-bold mb-8 text-center">Đặt Hàng</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Product Summary -->
            <div class="bg-white rounded-2xl p-6 shadow-lg h-fit sticky top-24">
                <h2 class="text-2xl font-bold mb-4">Sản Phẩm</h2>
                
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-indigo-600 rounded-xl flex items-center justify-center text-4xl">
                        @if($product->category == 'crypto') 🪙
                        @elseif($product->category == 'gold') 💰
                        @else 📊
                        @endif
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">{{ $product->name }}</h3>
                        <p class="text-gray-600">{{ ucfirst($product->category) }}</p>
                    </div>
                </div>
                
                <div class="border-t pt-4">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Giá sản phẩm:</span>
                        <span class="font-bold">{{ number_format($product->price) }}đ</span>
                    </div>
                    @if($product->original_price)
                    <div class="flex justify-between mb-2 text-sm text-green-600">
                        <span>Tiết kiệm:</span>
                        <span>{{ number_format($product->original_price - $product->price) }}đ</span>
                    </div>
                    @endif
                    <div class="border-t pt-2 mt-2">
                        <div class="flex justify-between text-xl font-bold text-purple-600">
                            <span>Tổng cộng:</span>
                            <span>{{ number_format($product->price) }}đ</span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 bg-purple-50 rounded-xl p-4">
                    <h4 class="font-bold mb-2">✨ Bạn sẽ nhận được:</h4>
                    <ul class="text-sm space-y-1 text-gray-700">
                        <li>✓ Full source code Python</li>
                        <li>✓ Hướng dẫn cài đặt chi tiết</li>
                        <li>✓ Support 1 tháng miễn phí</li>
                        <li>✓ Update miễn phí 6 tháng</li>
                    </ul>
                </div>
            </div>

            <!-- Order Form -->
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <h2 class="text-2xl font-bold mb-6">Thông Tin Đặt Hàng</h2>
                
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">Họ và tên *</label>
                            <input type="text" name="customer_name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="Nguyễn Văn A">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2">Email *</label>
                            <input type="email" name="customer_email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="email@example.com">
                            <p class="text-sm text-gray-500 mt-1">Link download sẽ gửi qua email này</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2">Số điện thoại *</label>
                            <input type="tel" name="customer_phone" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="0912345678">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2">Phương thức thanh toán *</label>
                            <div class="space-y-3">
                                <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-purple-500 transition">
                                    <input type="radio" name="payment_method" value="bank_transfer" checked class="mr-3">
                                    <div>
                                        <div class="font-medium">🏦 Chuyển khoản ngân hàng</div>
                                        <div class="text-sm text-gray-500">Nhanh nhất, xác nhận trong 5 phút</div>
                                    </div>
                                </label>
                                
                                <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-purple-500 transition opacity-50">
                                    <input type="radio" name="payment_method" value="vnpay" disabled class="mr-3">
                                    <div>
                                        <div class="font-medium">💳 VNPay</div>
                                        <div class="text-sm text-gray-500">Đang cập nhật</div>
                                    </div>
                                </label>
                                
                                <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-purple-500 transition opacity-50">
                                    <input type="radio" name="payment_method" value="momo" disabled class="mr-3">
                                    <div>
                                        <div class="font-medium">📱 Momo</div>
                                        <div class="text-sm text-gray-500">Đang cập nhật</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <p class="text-sm text-yellow-800">
                                ⚠️ Sau khi đặt hàng, bạn sẽ nhận được thông tin chuyển khoản. 
                                Link download sẽ được gửi qua email sau khi xác nhận thanh toán (5-30 phút).
                            </p>
                        </div>
                        
                        <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-4 rounded-full font-bold text-lg hover:shadow-2xl transition transform hover:scale-105">
                            🛒 Đặt Hàng Ngay - {{ number_format($product->price) }}đ
                        </button>
                        
                        <p class="text-center text-sm text-gray-500">
                            Bằng việc đặt hàng, bạn đồng ý với 
                            <a href="#" class="text-purple-600 hover:underline">Điều khoản dịch vụ</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Trust Badges -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div class="bg-white rounded-xl p-6">
                <div class="text-4xl mb-3">🔒</div>
                <h3 class="font-bold mb-2">An Toàn 100%</h3>
                <p class="text-sm text-gray-600">Thanh toán an toàn, bảo mật thông tin</p>
            </div>
            <div class="bg-white rounded-xl p-6">
                <div class="text-4xl mb-3">⚡</div>
                <h3 class="font-bold mb-2">Giao Hàng Nhanh</h3>
                <p class="text-sm text-gray-600">Link download trong 5-30 phút</p>
            </div>
            <div class="bg-white rounded-xl p-6">
                <div class="text-4xl mb-3">💬</div>
                <h3 class="font-bold mb-2">Support 24/7</h3>
                <p class="text-sm text-gray-600">Hỗ trợ tận tình, giải đáp mọi thắc mắc</p>
            </div>
        </div>
    </div>
</div>
@endsection
