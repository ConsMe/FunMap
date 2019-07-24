<?php

use Illuminate\Database\Seeder;
use App\Point;
use App\Category;

class PointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Category::count() || Point::count()) return;
        factory(Category::class, 5)->create()->each(function ($category) {
            $category->points()->saveMany(factory(Point::class, 5)->make());
        });
    }
}
