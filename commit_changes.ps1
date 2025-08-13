# Script PowerShell pour commiter tous les changements
Write-Host "Configuration de Git..." -ForegroundColor Green
git config --global user.name "khaled312001"
git config --global user.email "khaled312001@example.com"

Write-Host "Ajout de tous les fichiers..." -ForegroundColor Green
git add .

Write-Host "Création du commit..." -ForegroundColor Green
git commit -m "Initial commit: Ajout de tous les fichiers du projet restaurant"

Write-Host "Push vers le repository distant..." -ForegroundColor Green
git push -u origin main

Write-Host "Commit terminé avec succès!" -ForegroundColor Green
