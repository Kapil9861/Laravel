<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user=\App\Models\User::factory()->create([
            //so that i can control the fields of the user information like
            //setting user or customer done before
            'name'=>'John Doe',
            'email'=>'john@gmail.com'
        ]);
        \App\Models\Listing::factory(6)->create([
            //This will send the user id of user that has been created just now 
            'user_id'=>$user->id
        ]);
        
        
        //For fixing the datas that are to be inserted in the database's user section
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //for manual data creation we can just create using
        Listing::create([// as it is imported we can avoid \APP\MODELS
            'id'=> 7,
            'user_id'=>1,
            'title'=>"Testing",
            'tags'=>'Testing / Gig',
            'company'=>'The Company Private Limited',
            'location'=>'Unknown Location',
            'email'=>'test@gmail.com',
            'website'=>"http://google.com",
            'description'=>"This is just a dummy data and pratical approach of
            inserting data to the database from the seeders i.e. manually inserting
            data in the database either dummy or real"
        ]);
    }
}
