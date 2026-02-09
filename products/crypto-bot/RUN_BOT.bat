@echo off
TITLE Crypto Bot - Auto Installer
COLOR 0A
ECHO ===================================================
ECHO       🤖 CRYPTOCURRENCY BOT AUTO-RUNNER  
ECHO       (Danh cho nguoi moi bat dau)
ECHO ===================================================
ECHO.

:: Check Python
python --version >nul 2>&1
IF %ERRORLEVEL% NEQ 0 (
    ECHO [X] Loi: May ban CHUA CAI PYTHON!
    ECHO.
    ECHO Hay cai dat Python 3.11 tuyet doi dung quen tich vao o "Add Python to PATH"
    ECHO Link tai: https://www.python.org/ftp/python/3.11.8/python-3.11.8-amd64.exe
    ECHO.
    PAUSE
    EXIT /B
)

ECHO [OK] Tim thay Python! Dang kiem tra thu vien...
ECHO.

:: Install Libraries
pip install -r requirements.txt
pip install "python-telegram-bot[job-queue]"

ECHO.
ECHO [OK] Da cai dat xong thu vien!
ECHO.
ECHO Dang khoi dong Bot... (Dung tat cua so nay nhe!)
ECHO ===================================================

:: Run Bot
python bot.py

:: Pause if error
PAUSE
