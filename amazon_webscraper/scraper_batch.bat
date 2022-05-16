@echo off
:loop
python amazonScraper.py
timeout 60
goto loop