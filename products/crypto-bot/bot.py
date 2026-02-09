#!/usr/bin/env python3
"""
Crypto Alert Bot - Telegram Bot
Cảnh báo giá cryptocurrency real-time

Author: BotBanHang.vn
Version: 1.0.0
"""

import logging
import requests
import sqlite3
from datetime import datetime
from telegram import Update, InlineKeyboardButton, InlineKeyboardMarkup
from telegram.ext import Application, CommandHandler, ContextTypes, CallbackQueryHandler
import asyncio

# Logging
logging.basicConfig(
    format='%(asctime)s - %(name)s - %(levelname)s - %(message)s',
    level=logging.INFO
)
logger = logging.getLogger(__name__)

# ===== CẤU HÌNH =====
BOT_TOKEN = "YOUR_BOT_TOKEN_HERE"  # Lấy từ @BotFather
COINGECKO_API = "https://api.coingecko.com/api/v3"

# Affiliate Links - THAY ĐỔI LINK CỦA BẠN
BINANCE_REF = "https://accounts.binance.com/register?ref=YOUR_REF"
OKX_REF = "https://www.okx.com/join/YOUR_REF"
BYBIT_REF = "https://www.bybit.com/invite?ref=YOUR_REF"

# ===== DATABASE =====
def init_db():
    """Khởi tạo database"""
    conn = sqlite3.connect('crypto_bot.db')
    c = conn.cursor()
    
    # Bảng alerts
    c.execute('''CREATE TABLE IF NOT EXISTS alerts
                 (id INTEGER PRIMARY KEY AUTOINCREMENT,
                  user_id INTEGER,
                  coin_id TEXT,
                  target_price REAL,
                  created_at TIMESTAMP)''')
    
    # Bảng users
    c.execute('''CREATE TABLE IF NOT EXISTS users
                 (user_id INTEGER PRIMARY KEY,
                  username TEXT,
                  first_name TEXT,
                  joined_at TIMESTAMP)''')
    
    conn.commit()
    conn.close()

def save_user(user_id, username, first_name):
    """Lưu thông tin user"""
    conn = sqlite3.connect('crypto_bot.db')
    c = conn.cursor()
    c.execute('''INSERT OR REPLACE INTO users (user_id, username, first_name, joined_at)
                 VALUES (?, ?, ?, ?)''', 
              (user_id, username, first_name, datetime.now()))
    conn.commit()
    conn.close()

def save_alert(user_id, coin_id, target_price):
    """Lưu alert"""
    conn = sqlite3.connect('crypto_bot.db')
    c = conn.cursor()
    c.execute('''INSERT INTO alerts (user_id, coin_id, target_price, created_at)
                 VALUES (?, ?, ?, ?)''',
              (user_id, coin_id, target_price, datetime.now()))
    conn.commit()
    conn.close()

def get_user_alerts(user_id):
    """Lấy danh sách alerts của user"""
    conn = sqlite3.connect('crypto_bot.db')
    c = conn.cursor()
    c.execute('SELECT * FROM alerts WHERE user_id = ?', (user_id,))
    alerts = c.fetchall()
    conn.close()
    return alerts

# ===== API FUNCTIONS =====
def get_crypto_price(coin_id):
    """Lấy giá crypto từ CoinGecko"""
    try:
        url = f"{COINGECKO_API}/simple/price"
        params = {
            'ids': coin_id,
            'vs_currencies': 'usd',
            'include_24hr_change': 'true',
            'include_market_cap': 'true'
        }
        response = requests.get(url, params=params, timeout=10)
        data = response.json()
        
        if coin_id in data:
            return data[coin_id]
        return None
    except Exception as e:
        logger.error(f"Error getting price: {e}")
        return None

def get_trending_coins():
    """Lấy top trending coins"""
    try:
        url = f"{COINGECKO_API}/search/trending"
        response = requests.get(url, timeout=10)
        data = response.json()
        return data.get('coins', [])[:5]
    except Exception as e:
        logger.error(f"Error getting trending: {e}")
        return []

# ===== BOT COMMANDS =====
async def start(update: Update, context: ContextTypes.DEFAULT_TYPE):
    """Command /start"""
    user = update.effective_user
    save_user(user.id, user.username, user.first_name)
    
    welcome_text = f"""
🤖 **Chào mừng {user.first_name}!**

Bot Crypto Alert giúp bạn:
✅ Xem giá crypto real-time
✅ Đặt cảnh báo giá tự động
✅ Theo dõi airdrop mới
✅ Kiếm tiền với affiliate

**📌 Lệnh cơ bản:**
/price <coin> - Xem giá coin
/alert <coin> <giá> - Đặt cảnh báo
/myalerts - Xem alerts của bạn
/trending - Top coins trending
/airdrop - Airdrop mới nhất
/help - Hướng dẫn chi tiết

**💰 Mua crypto:**
• Binance: [Đăng ký]({BINANCE_REF})
• OKX: [Đăng ký]({OKX_REF})
• Bybit: [Đăng ký]({BYBIT_REF})

Gõ /price bitcoin để bắt đầu! 🚀
"""
    
    await update.message.reply_text(
        welcome_text,
        parse_mode='Markdown',
        disable_web_page_preview=True
    )

async def price_command(update: Update, context: ContextTypes.DEFAULT_TYPE):
    """Command /price <coin>"""
    if not context.args:
        await update.message.reply_text(
            "❌ Vui lòng nhập tên coin!\n\n"
            "Ví dụ: /price bitcoin\n"
            "Hoặc: /price btc"
        )
        return
    
    coin_id = context.args[0].lower()
    
    # Map shortcuts
    coin_map = {
        'btc': 'bitcoin',
        'eth': 'ethereum',
        'bnb': 'binancecoin',
        'ada': 'cardano',
        'sol': 'solana',
        'xrp': 'ripple',
        'doge': 'dogecoin'
    }
    
    coin_id = coin_map.get(coin_id, coin_id)
    
    await update.message.reply_text("⏳ Đang lấy giá...")
    
    price_data = get_crypto_price(coin_id)
    
    if not price_data:
        await update.message.reply_text(
            f"❌ Không tìm thấy coin '{coin_id}'.\n\n"
            "Thử lại với tên đầy đủ, ví dụ: bitcoin, ethereum, cardano"
        )
        return
    
    price = price_data.get('usd', 0)
    change_24h = price_data.get('usd_24h_change', 0)
    market_cap = price_data.get('usd_market_cap', 0)
    
    change_emoji = "📈" if change_24h > 0 else "📉"
    change_sign = "+" if change_24h > 0 else ""
    
    message = f"""
💰 **{coin_id.upper()}**

**Giá:** ${price:,.2f}
{change_emoji} **24h:** {change_sign}{change_24h:.2f}%
📊 **Market Cap:** ${market_cap:,.0f}

🕐 Cập nhật: {datetime.now().strftime('%H:%M:%S')}

**💸 Mua {coin_id.upper()} tại:**
• [Binance]({BINANCE_REF}) - Sàn #1 thế giới
• [OKX]({OKX_REF}) - Phí thấp
• [Bybit]({BYBIT_REF}) - Giao dịch phái sinh

Gõ /alert {coin_id} <giá> để đặt cảnh báo!
"""
    
    await update.message.reply_text(
        message,
        parse_mode='Markdown',
        disable_web_page_preview=True
    )

async def alert_command(update: Update, context: ContextTypes.DEFAULT_TYPE):
    """Command /alert <coin> <price>"""
    if len(context.args) < 2:
        await update.message.reply_text(
            "❌ Sai cú pháp!\n\n"
            "Đúng: /alert bitcoin 50000\n"
            "Hoặc: /alert btc 50000"
        )
        return
    
    coin_id = context.args[0].lower()
    try:
        target_price = float(context.args[1])
    except ValueError:
        await update.message.reply_text("❌ Giá phải là số!")
        return
    
    # Map shortcuts
    coin_map = {
        'btc': 'bitcoin',
        'eth': 'ethereum',
        'bnb': 'binancecoin'
    }
    coin_id = coin_map.get(coin_id, coin_id)
    
    # Lưu alert
    save_alert(update.effective_user.id, coin_id, target_price)
    
    await update.message.reply_text(
        f"✅ Đã đặt cảnh báo!\n\n"
        f"🪙 Coin: {coin_id.upper()}\n"
        f"💰 Giá mục tiêu: ${target_price:,.2f}\n\n"
        f"Bot sẽ thông báo khi {coin_id.upper()} chạm ${target_price:,.2f}!\n\n"
        f"Xem tất cả alerts: /myalerts"
    )

async def myalerts_command(update: Update, context: ContextTypes.DEFAULT_TYPE):
    """Command /myalerts"""
    alerts = get_user_alerts(update.effective_user.id)
    
    if not alerts:
        await update.message.reply_text(
            "📭 Bạn chưa có alert nào.\n\n"
            "Đặt alert: /alert bitcoin 50000"
        )
        return
    
    message = "🔔 **Danh sách alerts của bạn:**\n\n"
    for alert in alerts:
        alert_id, user_id, coin_id, target_price, created_at = alert
        message += f"• {coin_id.upper()}: ${target_price:,.2f}\n"
    
    message += "\n💡 Alerts sẽ tự động kiểm tra mỗi 5 phút."
    
    await update.message.reply_text(message, parse_mode='Markdown')

async def trending_command(update: Update, context: ContextTypes.DEFAULT_TYPE):
    """Command /trending"""
    await update.message.reply_text("⏳ Đang lấy dữ liệu...")
    
    trending = get_trending_coins()
    
    if not trending:
        await update.message.reply_text("❌ Không thể lấy dữ liệu trending.")
        return
    
    message = "🔥 **Top 5 Trending Coins:**\n\n"
    
    for i, coin in enumerate(trending, 1):
        item = coin.get('item', {})
        name = item.get('name', 'N/A')
        symbol = item.get('symbol', 'N/A')
        rank = item.get('market_cap_rank', 'N/A')
        
        message += f"{i}. **{name}** ({symbol.upper()})\n"
        message += f"   Rank: #{rank}\n\n"
    
    message += f"\n💸 **Mua crypto tại:**\n"
    message += f"• [Binance]({BINANCE_REF})\n"
    message += f"• [OKX]({OKX_REF})\n"
    
    await update.message.reply_text(
        message,
        parse_mode='Markdown',
        disable_web_page_preview=True
    )

async def airdrop_command(update: Update, context: ContextTypes.DEFAULT_TYPE):
    """Command /airdrop"""
    # Đây là data mẫu - bạn có thể crawl từ website airdrop
    airdrops = [
        {
            'name': 'LayerZero Airdrop',
            'reward': '100-1000 ZRO',
            'tasks': 'Bridge tokens qua LayerZero',
            'link': 'https://layerzero.network'
        },
        {
            'name': 'zkSync Airdrop',
            'reward': '500-5000 ZK',
            'tasks': 'Giao dịch trên zkSync Era',
            'link': 'https://zksync.io'
        }
    ]
    
    message = "🎁 **Airdrop Mới Nhất:**\n\n"
    
    for airdrop in airdrops:
        message += f"**{airdrop['name']}**\n"
        message += f"💰 Reward: {airdrop['reward']}\n"
        message += f"📝 Tasks: {airdrop['tasks']}\n"
        message += f"🔗 Link: {airdrop['link']}\n\n"
    
    message += "⚠️ **Lưu ý:** Luôn DYOR trước khi tham gia airdrop!\n\n"
    message += f"💡 Cần ví crypto? Đăng ký [Binance]({BINANCE_REF}) miễn phí!"
    
    await update.message.reply_text(
        message,
        parse_mode='Markdown',
        disable_web_page_preview=True
    )

async def help_command(update: Update, context: ContextTypes.DEFAULT_TYPE):
    """Command /help"""
    help_text = """
📖 **HƯỚNG DẪN SỬ DỤNG BOT**

**🔍 Xem giá:**
/price bitcoin - Giá Bitcoin
/price eth - Giá Ethereum
/price bnb - Giá BNB

**🔔 Đặt cảnh báo:**
/alert bitcoin 50000 - Báo khi BTC = $50k
/alert eth 3000 - Báo khi ETH = $3k
/myalerts - Xem alerts của bạn

**📊 Thông tin:**
/trending - Top coins trending
/airdrop - Airdrop mới nhất

**💰 Kiếm tiền:**
Bot này tích hợp affiliate links. Mỗi khi ai đó đăng ký sàn qua link của bạn, bạn nhận hoa hồng!

**🛠️ Support:**
Telegram: @BotBanHangVN
Email: support@botbanhang.vn

**📦 Mua source code:**
Website: botbanhang.vn
"""
    
    await update.message.reply_text(help_text, parse_mode='Markdown')

# ===== BACKGROUND TASK: CHECK ALERTS =====
async def check_alerts(context: ContextTypes.DEFAULT_TYPE):
    """Kiểm tra alerts định kỳ (chạy mỗi 5 phút)"""
    conn = sqlite3.connect('crypto_bot.db')
    c = conn.cursor()
    c.execute('SELECT * FROM alerts')
    alerts = c.fetchall()
    
    for alert in alerts:
        alert_id, user_id, coin_id, target_price, created_at = alert
        
        # Lấy giá hiện tại
        price_data = get_crypto_price(coin_id)
        if not price_data:
            continue
        
        current_price = price_data.get('usd', 0)
        
        # Kiểm tra nếu chạm mốc
        if current_price >= target_price:
            # Gửi thông báo
            message = f"""
🔔 **ALERT TRIGGERED!**

🪙 {coin_id.upper()} đã chạm mục tiêu!

💰 Giá hiện tại: ${current_price:,.2f}
🎯 Giá mục tiêu: ${target_price:,.2f}

📊 Xem chi tiết: /price {coin_id}

💸 **Trade ngay:**
• [Binance]({BINANCE_REF})
• [OKX]({OKX_REF})
• [Bybit]({BYBIT_REF})
"""
            
            try:
                await context.bot.send_message(
                    chat_id=user_id,
                    text=message,
                    parse_mode='Markdown',
                    disable_web_page_preview=True
                )
                
                # Xóa alert đã trigger
                c.execute('DELETE FROM alerts WHERE id = ?', (alert_id,))
                conn.commit()
                
            except Exception as e:
                logger.error(f"Error sending alert: {e}")
    
    conn.close()

# ===== MAIN =====
def main():
    """Chạy bot"""
    # Khởi tạo database
    init_db()
    
    # Tạo application
    application = Application.builder().token(BOT_TOKEN).build()
    
    # Thêm handlers
    application.add_handler(CommandHandler("start", start))
    application.add_handler(CommandHandler("price", price_command))
    application.add_handler(CommandHandler("alert", alert_command))
    application.add_handler(CommandHandler("myalerts", myalerts_command))
    application.add_handler(CommandHandler("trending", trending_command))
    application.add_handler(CommandHandler("airdrop", airdrop_command))
    application.add_handler(CommandHandler("help", help_command))
    
    # Background task: Check alerts mỗi 5 phút
    job_queue = application.job_queue
    job_queue.run_repeating(check_alerts, interval=300, first=10)
    
    # Chạy bot
    logger.info("Bot started!")
    application.run_polling(allowed_updates=Update.ALL_TYPES)

if __name__ == '__main__':
    main()
