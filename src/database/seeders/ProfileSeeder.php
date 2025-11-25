<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'buyer@example.com')->first();

        if ($user) {
            Profile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'avatar_path' => null,
                    'postal_code' => '123-4567',
                    'address'     => '東京都杉並区和田1-1-1',
                    'building'    => '杉並マンション101',
                ]
            );
        }
    }    
}
