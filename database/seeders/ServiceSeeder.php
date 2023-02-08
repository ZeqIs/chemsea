<?php

namespace Database\Seeders;

use App\Models\ServiceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceType::create([
            'name' => 'Extraction',
            'abbr' => 'ext',
            'description' => 'Extraction service'
        ]);

        ServiceType::create([
            'name' => 'Element Analysis (ICP)',
            'abbr' => 'icp',
            'description' => 'Element Analysis (ICP) service'
        ]);

        ServiceType::create([
            'name' => 'Element Analysis (AAS)',
            'abbr' => 'aas',
            'description' => 'Element Analysis (AAS) service'
        ]);

        ServiceType::create([
            'name' => 'Chemical Isolation',
            'abbr' => 'ci',
            'description' => 'Chemical Isolation service'
        ]);

        ServiceType::create([
            'name' => 'Organic Compound Identification',
            'abbr' => 'oci',
            'description' => 'Organic Compound Identification service'
        ]);
    }
}
