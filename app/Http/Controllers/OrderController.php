<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCompletedMail;

class OrderController extends Controller
{
    public function create($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('orders.create', compact('product'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:20',
            'payment_method' => 'required|in:bank_transfer,vnpay,momo'
        ]);

        $product = Product::findOrFail($validated['product_id']);
        
        // Tạo mã đơn hàng
        $orderCode = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        
        $order = Order::create([
            'order_code' => $orderCode,
            'product_id' => $product->id,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'amount' => $product->price,
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'pending'
        ]);

        return redirect()->route('orders.show', $orderCode)
            ->with('success', 'Đơn hàng đã được tạo! Vui lòng thanh toán để nhận sản phẩm.');
    }

    public function show($orderCode)
    {
        $order = Order::where('order_code', $orderCode)
            ->with('product')
            ->firstOrFail();
        
        return view('orders.show', compact('order'));
    }

    public function confirmPayment($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->with('product')->firstOrFail();
        
        $token = '8187679739:AAEbsH_miAXOOepBwsB9p7oraCqQdD4jIXI';
        $chatId = '8199725778';

        // Tạo link duyệt đơn (bảo mật đơn giản bằng hash)
        $secret = md5($order->order_code . 'MY_SECRET_KEY');
        $approveLink = route('orders.approve', ['orderCode' => $orderCode, 'token' => $secret]);
        
        $message = "💰 <b>KHÁCH ĐÃ CHUYỂN KHOẢN!</b>\n\n"
                 . "🆔 Mã đơn: <b>{$order->order_code}</b>\n"
                 . "👤 Khách: {$order->customer_name}\n"
                 . "📱 SĐT: {$order->customer_phone}\n"
                 . "💸 Số tiền: " . number_format($order->amount) . "đ\n"
                 . "📦 Sản phẩm: {$order->product->name}\n\n"
                 . "👉 <a href=\"{$approveLink}\">✅ BẤM VÀO ĐÂY ĐỂ DUYỆT ĐƠN & GỬI LINK</a>";

        try {
            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'HTML',
                'disable_web_page_preview' => true
            ]);
        } catch (\Exception $e) {
            // Log error
        }

        return redirect()->route('orders.show', $orderCode)
            ->with('success', 'Đã gửi thông báo xác nhận! Chúng tôi sẽ kiểm tra và gửi link ngay.');
    }

    public function approveOrder($orderCode, Request $request)
    {
        $order = Order::where('order_code', $orderCode)->with('product')->firstOrFail();

        // Check token bảo mật
        if ($request->token !== md5($order->order_code . 'MY_SECRET_KEY')) {
            abort(403, 'Invalid Token');
        }

        if ($order->payment_status !== 'paid') {
            // Cập nhật trạng thái
            $order->update([
                'payment_status' => 'paid',
                'paid_at' => now(),
                'download_sent' => true
            ]);

            // Gửi email link download
            try {
                Mail::to($order->customer_email)->send(new OrderCompletedMail($order));
                return "✅ ĐÃ DUYỆT ĐƠN! Email đã được gửi cho khách hàng.";
            } catch (\Exception $e) {
                return "⚠️ Đã duyệt đơn nhưng GỬI MAIL THẤT BẠI. Lỗi: " . $e->getMessage();
            }
        }

        return "ℹ️ Đơn hàng này đã được duyệt trước đó.";
    }
}
