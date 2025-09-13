@echo off
echo Downloading files from server...
echo.

REM Download the entire public_html directory
echo Creating tar archive on server...
ssh -p 65002 u696043789@212.85.28.110 "cd ~/domains/kingkebablepouzin.fr/public_html && tar -czf /tmp/king_kebab_backup.tar.gz ."

echo.
echo Downloading tar file...
scp -P 65002 u696043789@212.85.28.110:/tmp/king_kebab_backup.tar.gz .

echo.
echo Extracting files...
tar -xzf king_kebab_backup.tar.gz

echo.
echo Cleaning up...
del king_kebab_backup.tar.gz

echo.
echo Download complete!
pause