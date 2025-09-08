<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallWkhtmltopdf extends Command
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install-wkhtmltopdf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install wkhtmltopdf if it is not already installed.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       
        $wkhtmltopdfPath = "C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf.exe";

        if (file_exists($wkhtmltopdfPath)) {
            $this->info('wkhtmltopdf is already installed.');
        } else {
            $this->info('wkhtmltopdf not found. Installing...');
            $this->installWkhtmltopdf();
        }
    }
    private function installWkhtmltopdf()
    {
        // PowerShell script to download and install wkhtmltopdf
        $psScript = "
            Invoke-WebRequest -Uri https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/0.12.6/wkhtmltox_0.12.6-1.msvc2015_64.exe -OutFile C:\Temp\wkhtmltox_installer.exe
            Start-Process -FilePath C:\Temp\wkhtmltox_installer.exe -ArgumentList '/silent' -Wait
            Remove-Item C:\Temp\wkhtmltox_installer.exe
            Write-Host 'wkhtmltopdf has been installed.'
        ";

        // Run the PowerShell script
        exec("powershell -Command \"$psScript\"");

        $this->info('wkhtmltopdf installation complete.');
    }
}
