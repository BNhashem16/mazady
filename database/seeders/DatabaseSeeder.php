<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Folder;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Auth::login($user);
        // $user->folders()->factory()->create();
        $folders = Folder::factory()->hasUser($user)->count(5)->create();
        // $folders[0]->factory()->notes()->count(5)->create();

        $folders->each(function (Folder $folder) {
            // dd($folder);
            Note::factory()->hasFolder()->count(5)->create(['folder_id' => $folder->id]);
            // $folder->notes()->factory()->count(5)->create();
        });

        $this->call(EmployeeSeeder::class);
        $this->call(SalarySeeder::class);
        $this->call(DepartmentSeeder::class);
        Artisan::call('passport:install');
    }
}
