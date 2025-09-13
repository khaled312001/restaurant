# PowerShell script to download files from server
$server = "u696043789@212.85.28.110"
$port = "65002"
$password = "support@Passord123"
$remotePath = "~/domains/kingkebablepouzin.fr/public_html"

# Function to run SSH commands with password
function Invoke-SSHCommand {
    param(
        [string]$Command,
        [string]$Server,
        [string]$Port,
        [string]$Password
    )
    
    $sshCommand = "ssh -p $Port -o StrictHostKeyChecking=no $Server `"$Command`""
    Write-Host "Executing: $sshCommand"
    
    # Use expect-like functionality or try to automate password input
    $process = Start-Process -FilePath "ssh" -ArgumentList "-p", $Port, "-o", "StrictHostKeyChecking=no", $Server, $Command -NoNewWindow -Wait -PassThru
    return $process
}

# Create a tar archive on the server
Write-Host "Creating tar archive on server..."
$tarCommand = "cd $remotePath && tar -czf /tmp/king_kebab_backup.tar.gz ."
Invoke-SSHCommand -Command $tarCommand -Server $server -Port $port -Password $password

# Download the tar file
Write-Host "Downloading tar file..."
$scpCommand = "scp -P $port $server`:/tmp/king_kebab_backup.tar.gz ."
Write-Host "Run this command manually: $scpCommand"
Write-Host "Password: $password"

# Extract the tar file
Write-Host "After downloading, extract with: tar -xzf king_kebab_backup.tar.gz"