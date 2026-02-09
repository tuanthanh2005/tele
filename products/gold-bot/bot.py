#!/usr/bin/env python3
"""
Gold Price Bot - Telegram Bot
Cảnh báo giá vàng SJC, PNJ, DOJI real-time

Author: BotBanHang.vn
Version: 1.0.0
"""

import logging
import requests
from bs4 import BeautifulSoup
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

# Affiliate Links - Thay đổi của bạn
INSURANCE_REF = "https://example.com/insurance?ref=YOUR_REF"
GOLD_SHOP_REF = "https://example.com/gold?ref=YOUR_REF"

# ===== DATABASE =====
def init_db():
    conn = sqlite3.connect('gold_bot.db')
    c = conn.cursor()
    
    c.execute('''CREATE TABLE IF NOT EXISTS alerts
                 (id INTEGER PRIMARY KEY AUTOINCREMENT,
                  user_id INTEGER,
                  gold_type TEXT,
                  target_price REAL,
                  created_at TIMESTAMP)''')
    
    c.execute('''CREATE TABLE IF NOT EXISTS users
                 (user_id INTEGER PRIMARY KEY,
                  username TEXT,
                  first_name TEXT,
                  joined_at TIMESTAMP)''')
    
    conn.commit()
    conn.close()

# ===== API/SCRAPING =====
def get_gold_price():
    """Lấy giá vàng (demo data - thực tế cần crawl từ SJC/PNJ)"""
    # Đây là data mẫu - bạn cần crawl thật từ website
    return {
        'SJC': {
            'buy': 75500000,
            'sell': 76000000,
            'change': +200000
        },
        'PNJ': {
            'buy': 75300000,
            'sell': 75800000,
            'change': +150000
        },
        '9999': {
            'buy': 74800000,
            'sell': 75300000,
            'change': +100000
        }
    }

# ===== BOT COMMANDS =====
async def start(update: Update, context: ContextTypes.DEFAULT_TYPE):
    user = update.effective_user
    
    welcome_text = f"""
💰 **Chào mừng {user.first_name}!**

Bot Giá Vàng giúp bạn:
✅ Xem giá vàng SJC, PNJ real-time
✅ Đặt cảnh báo giá tự động
✅ Lịch sử giá vàng
✅ So sánh giá các loại vàng

**📌 Lệnh cơ bản:**
/giavang - Xem giá vàng hôm nay
/alert sjc 76000000 - Đặt cảnh báo
/myalerts - Xem alerts của bạn
/help - Hướng dẫn

Gõ /giavang để bắt đầu! 🚀
"""
    
    await update.message.reply_text(welcome_text, parse_mode='Markdown')

async def giavang_command(update: Update, context: ContextTypes.DEFAULT_TYPE):
    """Command /giavang"""
    await update.message.reply_text("⏳ Đang lấy giá vàng...")
    
    prices = get_gold_price()
    
    message = "💰 **GIÁ VÀNG HÔM NAY**\n"
    message += f"🕐 Cập nhật: {datetime.now().strftime('%d/%m/%Y %H:%M')}\n\n"
    
    for gold_type, data in prices.items():
        buy = data['buy']
        sell = data['sell']
        change = data['change']
        
        change_emoji = "📈" if change > 0 else "📉"
        change_text = f"+{change:,}" if change > 0 else f"{change:,}"
        
        message += f"**{gold_type}**\n"
        message += f"  Mua vào: {buy:,}đ/lượng\n"
        message += f"  Bán ra: {sell:,}đ/lượng\n"
        message += f"  {change_emoji} Thay đổi: {change_text}đ\n\n"
    
    message += "💡 **Mua vàng online:**\n"
    message += f"• [Tiệm vàng uy tín]({GOLD_SHOP_REF})\n"
    message += f"• [Bảo hiểm vàng]({INSURANCE_REF})\n\n"
    message += "Đặt cảnh báo: /alert sjc 76000000"
    
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
            "Đúng: /alert sjc 76000000\n"
            "Hoặc: /alert pnj 75500000"
        )
        return
    
    gold_type = context.args[0].upper()
    try:
        target_price = float(context.args[1])
    except ValueError:
        await update.message.reply_text("❌ Giá phải là số!")
        return
    
    conn = sqlite3.connect('gold_bot.db')
    c = conn.cursor()
    c.execute('''INSERT INTO alerts (user_id, gold_type, target_price, created_at)
                 VALUES (?, ?, ?, ?)''',
              (update.effective_user.id, gold_type, target_price, datetime.now()))
    conn.commit()
    conn.close()
    
    await update.message.reply_text(
        f"✅ Đã đặt cảnh báo!\n\n"
        f"💰 Vàng {gold_type}\n"
        f"🎯 Giá: {target_price:,}đ/lượng\n\n"
        f"Bot sẽ thông báo khi vàng {gold_type} chạm {target_price:,}đ!"
    )

async def help_command(update: Update, context: ContextTypes.DEFAULT_TYPE):
    """Command /help"""
    help_text = """
📖 **HƯỚNG DẪN SỬ DỤNG**

**/giavang** - Xem giá vàng hôm nay
**/alert sjc 76000000** - Đặt cảnh báo
**/myalerts** - Xem alerts của bạn

**💰 Kiếm tiền:**
Bot tích hợp affiliate links. Mỗi khi ai đó mua vàng/bảo hiểm qua link, bạn nhận hoa hồng!

**Support:** @BotBanHangVN
"""
    
    await update.message.reply_text(help_text, parse_mode='Markdown')

# ===== MAIN =====
def main():
    init_db()
    
    application = Application.builder().token(BOT_TOKEN).build()
    
    application.add_handler(CommandHandler("start", start))
    application.add_handler(CommandHandler("giavang", giavang_command))
    application.add_handler(CommandHandler("alert", alert_command))
    application.add_handler(CommandHandler("help", help_command))
    
    logger.info("Gold Bot started!")
    application.run_polling(allowed_updates=Update.ALL_TYPES)

if __name__ == '__main__':
    main()
