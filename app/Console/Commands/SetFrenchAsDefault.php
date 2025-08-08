<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Language;
use App\Models\BasicSetting;
use App\Models\BasicExtended;
use Illuminate\Support\Facades\File;

class SetFrenchAsDefault extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:set-french-default';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set French as the default language for the application';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Setting French as default language...');

        // Check if French language already exists
        $frenchLang = Language::where('code', 'fr')->first();

        if (!$frenchLang) {
            // Create French language entry
            $this->info('Creating French language entry...');
            
            // First, set all existing languages as non-default
            Language::where('is_default', 1)->update(['is_default' => 0]);

            // Create French language
            $frenchLang = Language::create([
                'name' => 'Français',
                'code' => 'fr',
                'is_default' => 1,
                'rtl' => 0
            ]);

            // Get the default language's basic settings to duplicate
            $defaultLang = Language::where('id', '!=', $frenchLang->id)->first();
            if ($defaultLang && $defaultLang->basic_setting) {
                $defaultSettings = $defaultLang->basic_setting->toArray();
                unset($defaultSettings['id'], $defaultSettings['language_id'], $defaultSettings['created_at'], $defaultSettings['updated_at']);
                
                $defaultSettings['language_id'] = $frenchLang->id;
                BasicSetting::create($defaultSettings);
            }

            // Create basic extended settings
            if ($defaultLang && $defaultLang->basic_extended) {
                $defaultExtended = $defaultLang->basic_extended->toArray();
                unset($defaultExtended['id'], $defaultExtended['language_id'], $defaultExtended['created_at'], $defaultExtended['updated_at']);
                
                $defaultExtended['language_id'] = $frenchLang->id;
                BasicExtended::create($defaultExtended);
            }

            $this->info('French language created successfully!');
        } else {
            // If French language exists, just set it as default
            $this->info('French language already exists. Setting as default...');
            
            // Set all languages as non-default
            Language::where('is_default', 1)->update(['is_default' => 0]);
            
            // Set French as default
            $frenchLang->is_default = 1;
            $frenchLang->save();
        }

        $this->info('French language has been set as default successfully!');
        $this->info('Language ID: ' . $frenchLang->id);
        $this->info('Language Name: ' . $frenchLang->name);
        $this->info('Language Code: ' . $frenchLang->code);

        return 0;
    }
}
