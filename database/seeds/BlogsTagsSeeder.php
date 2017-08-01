<?php

use Illuminate\Database\Seeder;

class BlogsTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 10;

        for ($i = 0; $i < $limit; $i++){
        	DB::table('blogs')->insert([ //,
        		'title' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        		'content' => $faker->realText($maxNbChars = 500, $indexSize = 2),
        	]);
        };

        for ($i = 0; $i < $limit; $i++){
        	DB::table('tags')->insert([ //,
        		'name' => $faker->safeColorName,
        	]);
        };
	}
}