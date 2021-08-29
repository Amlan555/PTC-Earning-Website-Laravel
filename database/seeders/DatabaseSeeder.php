<?php

namespace Database\Seeders;

use App\Models\headline;
use App\Models\Level;
use App\Models\Pincode;
use App\Models\ReferBonus;
use App\Models\User;
use App\Models\Withdrawmethod;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'name' => 'admin',
        //     'slug' => 'admin',
        //     'email' => 'nahiduzzaman360@gmail.com',
        //     'mobile_no' => '01619332935',
        //     'subdistrict' => 'Hathazari',
        //     'district' => 'Chittagong',
        //     'address' => 'Fatehabad, Hathazari Chittagong',
        //     'level_id' => 1,
        //     'role_id' => 1,
        //     'pincode' => 121212,
        //     'password' => bcrypt('developer@nahid')
        // ]);

        // Pincode::create([
        //     'code' => '121212',
        //     'status' => true,
        //     'user_id' => '1'
        // ]);

        // Level::create([
        //     'name' => 'No Level',
        //     'commision' => 10,
        // ]);
        // Level::create([
        //     'name' => 'Level 1',
        //     'commision' => 30,
        // ]);
        // Level::create([
        //     'name' => 'Level 2',
        //     'commision' => 40,
        // ]);
        // Level::create([
        //     'name' => 'Level 3',
        //     'commision' => 50,
        // ]);

        // headline::create([
        //     'text' => 'Welcome to Our Website | Best Earning Platform in Bangladesh.'
        // ]);

        // Withdrawmethod::create([
        //     'name' => 'বিকাশ'
        // ]);
        // Withdrawmethod::create([
        //     'name' => 'নগদ'
        // ]);
        // Withdrawmethod::create([
        //     'name' => 'মোবাইল রিচার্জ'
        // ]);

        // ReferBonus::create([
        //     'bonus' => 10
        // ]);
    }
}
