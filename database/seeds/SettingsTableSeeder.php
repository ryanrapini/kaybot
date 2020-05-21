<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     *  We generate a number of users (see readme) and various workgroups for them
     *  to belong to.
     */
    public function run(): void
    {
        $settings = DB::table('settings');

        $settings->insert([
            'name' => 'min_delay',
            'value' => '600',
        ]);

        $settings->insert([
            'name' => 'max_delay',
            'value' => '86400',
        ]);

        $settings->insert([
            'name' => 'last_time',
            'value' => '0',
        ]);
    }
}
