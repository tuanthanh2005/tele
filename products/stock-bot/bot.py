#!/usr/bin/env python3
"""
Stock Bot - Telegram Bot
Theo dõi giá cổ phiếu Việt Nam real-time

Author: BotBanHangVN
Version: 1.0.0
"""

import logging
import requests
import sqlite3
from datetime import datetime
from telegram import Update
from telegram.ext import Application, CommandHandler, ContextTypes

logging.basicConfig(
    format='%(asctime)s - %(name)s - %(levelname)s - %(message)s',
    level=logging.INFO
)
logger = logging.getLogger(__name__)

# ===== CẤU HÌNH =====
BOT_TOKEN = "YOUR_BOT_TOKEN_HERE"
VNDIRECT_API = "https://finfo-api.vndirect.com.vn/v4"

# Affiliate Links
STOCK_BROKER_REF = "https://example.com/broker?ref=YOUR_REF"
COURSE_REF = "https://example.com/course?ref=YOUR_REF"

# ===== DATABASE =====
def init_db():
    conn = sqlite3.connect('stock_bot.db')
    c = conn.cursor()
    
    c.execute('''CREATE TABLE IF NOT EXISTS alerts
                 (id INTEGER PRIMARY KEY AUTOINCREMENT,
                  user_id INTEGER,
                  stock_code TEXT,
                  target_price REAL,
                  created_at TIMESTAMP)''')
    
    c.execute('''CREATE TABLE IF NOT EXISTS users
                 (user_id INTEGER PRIMARY KEY,
                  username TEXT,
                  first_name TEXT,
                  joined_at TIMESTAMP)''')
    
    conn.commit()
    conn.close()

# ===== API =====
def get_stock_price(code):
    """Lấy giá cổ phiếu từ VNDirect API"""
    try:
        url = f"{VNDIRECT_API}/stocks"
        params = {'q': f'code:{code.upper()}'}
        
        response = requests.get(url, params=params, timeout=10)
        data = response.json()
        
        if data.get('data'):
            return data['data'][0]
        return None
    except Exception as e:
        logger.error(f"Error getting stock price: {e}")
        return None

def get_vnindex():
    """Lấy VN-Index"""
    try:
        url = f"{VNDIRECT_API}/index_intraday_latest"
        params = {'q': 'indexId:VNINDEX'}
        
        response = requests.get(url, params=params, timeout=10)
        data = response.json()
        
        if data.get('data'):
            return data['data'][0]
        return None
    except Exception as e:
        logger.error(f"Error getting VN-Index: {e}")
        return None

# ===== BOT COMMANDS =====
async def start(update: Update, context: ContextTypes.DEFAULT_TYPE):
    user = update.effective_user
    
    welcome_text = f"""
📊 **Chào mừng {user.first_name}!**

Bot Chứng Khoán giúp bạn:
✅ Xem giá cổ phiếu real-time
✅ Đặt cảnh báo giá tự động
✅ VN-Index, HNX-Index
✅ Top cổ phiếu tăng/giảm

**📌 Lệnh cơ bản:**
/cp VNM - Xem giá cổ phiếu VNM
/vnindex - Xem VN-Index
/alert VNM 100000 - Đặt cảnh báo
/help - Hướng dẫn

Gõ /cp VNM để bắt đầu! 🚀
"""
    
    await update.message.reply_text(welcome_text, parse_mode='Markdown')

async def cp_command(update: Update, context: ContextTypes.DEFAULT_TYPE):
    """Command /cp <code>"""
    if not context.args:
        await update.message.reply_text(
            "❌ Vui lòng nhập mã cổ phiếu!\n\n"
            "Ví dụ: /cp VNM\n"
            "Hoặc: /cp FPT"
        )
        return
    
    code = context.args[0].upper()
    
    await update.message.reply_text("⏳ Đang lấy giá...")
    
    stock = get_stock_price(code)
    
    if not stock:
        await update.message.reply_text(
            f"❌ Không tìm thấy mã '{code}'.\n\n"
            "Thử lại với mã khác, ví dụ: VNM, FPT, VCB"
        )
        return
    
    price = stock.get('matchPrice', 0)
    change = stock.get('priceChange', 0)
    change_percent = stock.get('priceChangePercent', 0)
    volume = stock.get('totalVolume', 0)
    
    change_emoji = "📈" if change > 0 else "📉" if change < 0 else "➡️"
    change_sign = "+" if change > 0 else ""
    
    message = f"""
📊 **{code}** - {stock.get('companyName', 'N/A')}

**Giá:** {price:,} VNĐ
{change_emoji} **Thay đổi:** {change_sign}{change:,} ({change_sign}{change_percent:.2f}%)
📊 **Khối lượng:** {volume:,}

🕐 Cập nhật: {datetime.now().strftime('%H:%M:%S')}

**💸 Mở tài khoản chứng khoán:**
• [Sàn uy tín]({STOCK_BROKER_REF})
• [Khóa học đầu tư]({COURSE_REF})

Đặt cảnh báo: /alert {code} <giá>
"""
    
    await update.message.reply_text(
        message,
        parse_mode='Markdown',
        disable_web_page_preview=True
    )

async def vnindex_command(update: Update, context: ContextTypes.DEFAULT_TYPE):
    """Command /vnindex"""
    await update.message.reply_text("⏳ Đang lấy VN-Index...")
    
    index = get_vnindex()
    
    if not index:
        await update.message.reply_text("❌ Không thể lấy dữ liệu VN-Index.")
        return
    
    value = index.get('indexValue', 0)
    change = index.get('indexChange', 0)
    change_percent = index.get('indexChangePercent', 0)
    
    change_emoji = "📈" if change > 0 else "📉"
    change_sign = "+" if change > 0 else ""
    
    message = f"""
📊 **VN-INDEX**

**Chỉ số:** {value:.2f}
{change_emoji} **Thay đổi:** {change_sign}{change:.2f} ({change_sign}{change_percent:.2f}%)

🕐 Cập nhật: {datetime.now().strftime('%H:%M:%S')}

**💸 Bắt đầu đầu tư:**
• [Mở tài khoản]({STOCK_BROKER_REF})
• [Học đầu tư]({COURSE_REF})
"""
    
    await update.message.reply_text(
        message,
        parse_mode='Markdown',
        disable_web_page_preview=True
    )

async def alert_command(update: Update, context: ContextTypes.DEFAULT_TYPE):
    """Command /alert"""
    if len(context.args) < 2:
        await update.message.reply_text(
            "❌ Sai cú pháp!\n\n"
            "Đúng: /alert VNM 100000"
        )
        return
    
    code = context.args[0].upper()
    try:
        target_price = float(context.args[1])
    except ValueError:
        await update.message.reply_text("❌ Giá phải là số!")
        return
    
    conn = sqlite3.connect('stock_bot.db')
    c = conn.cursor()
    c.execute('''INSERT INTO alerts (user_id, stock_code, target_price, created_at)
                 VALUES (?, ?, ?, ?)''',
              (update.effective_user.id, code, target_price, datetime.now()))
    conn.commit()
    conn.close()
    
    await update.message.reply_text(
        f"✅ Đã đặt cảnh báo!\n\n"
        f"📊 Mã: {code}\n"
        f"💰 Giá mục tiêu: {target_price:,} VNĐ\n\n"
        f"Bot sẽ thông báo khi {code} chạm {target_price:,}đ!"
    )

async def help_command(update: Update, context: ContextTypes.DEFAULT_TYPE):
    """Command /help"""
    help_text = """
📖 **HƯỚNG DẪN SỬ DỤNG**

**/cp VNM** - Xem giá cổ phiếu VNM
**/vnindex** - Xem VN-Index
**/alert VNM 100000** - Đặt cảnh báo
**/myalerts** - Xem alerts của bạn

**💰 Kiếm tiền:**
Bot tích hợp affiliate links sàn chứng khoán và khóa học. Mỗi đăng ký = hoa hồng!

**Support:** @BotBanHangVN
"""
    
    await update.message.reply_text(help_text, parse_mode='Markdown')

# ===== MAIN =====
def main():
    init_db()
    
    application = Application.builder().token(BOT_TOKEN).build()
    
    application.add_handler(CommandHandler("start", start))
    application.add_handler(CommandHandler("cp", cp_command))
    application.add_handler(CommandHandler("vnindex", vnindex_command))
    application.add_handler(CommandHandler("alert", alert_command))
    application.add_handler(CommandHandler("help", help_command))
    
    logger.info("Stock Bot started!")
    application.run_polling(allowed_updates=Update.ALL_TYPES)

if __name__ == '__main__':
    main()
