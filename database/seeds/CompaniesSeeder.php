<?php

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
      Company::flushEventListeners();
      Company::create([
          'name'       => 'Paradox',
          'vat_number' => 'ZA4012345678',
          'telephone'  => '0860 000 000',
          'email'      => 'indo@paradox.com',
          'address'    => '1 Kingsway Street',
          'address_2'  => 'Auckland Park',
          'city'       => 'Johannesburg',
          'province'   => 'Gauteng',
          'country'    => 'South Africa',
      ]);
  }
}
