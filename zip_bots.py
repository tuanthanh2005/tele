import shutil
import os

# Đường dẫn (đảm bảo đúng cấu trúc thư mục hiện tại)
base_dir = os.getcwd()
products_dir = os.path.join(base_dir, 'products')
public_downloads_dir = os.path.join(base_dir, 'public', 'downloads')

# Đảm bảo thư mục đích tồn tại
os.makedirs(public_downloads_dir, exist_ok=True)

bots = ['crypto-bot', 'gold-bot', 'stock-bot']

print(f"Creating zip files in {public_downloads_dir}...")

for bot in bots:
    source = os.path.join(products_dir, bot)
    destination = os.path.join(public_downloads_dir, bot)
    
    if os.path.exists(source):
        # Tạo file zip (shutil tự thêm đuôi .zip)
        shutil.make_archive(destination, 'zip', source)
        print(f"✅ Đã đóng gói: {bot}.zip (từ {source})")
    else:
        print(f"❌ Không tìm thấy source code: {bot}")

print("🎉 HOÀN TẤT! File download đã chứa code thật.")
