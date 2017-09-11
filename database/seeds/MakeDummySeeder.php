<?php

use Illuminate\Database\Seeder;

class MakeDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        factory(App\User::class, 40)->create()->each(function ($u) {
            for($i=0; $i < 3; $i++) {
                $u->posts()->save(factory(App\Post::class)->make());
            }
        });
        DB::commit();
    }
}
