import subprocess
from os import path
import time
import os
import signal
import random

def signal_handler(signum, frame): 
    os.system("taskkill /f /im  cat.exe")
    os.system("taskkill /f /im  1_fafa.exe")
    exit()

def add_handler(signum, frame): 
    print("hi!")
    if random.randint(0, 1):
        subprocess.Popen(path.dirname(__file__) + "\\1_fafa.exe")
    else:
        subprocess.Popen(path.dirname(__file__) + "\\cat.exe")

if __name__ == "__main__":
    signal.signal(signal.SIGINT, signal_handler)
    signal.signal(signal.SIGBREAK, add_handler)
    while True:
        pass