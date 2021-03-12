<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Style;
use Illuminate\Support\Facades\DB;

class Styles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        DB::table('styles')->truncate();
        $bjcpData = \json_decode(Storage::disk('local')->get('bjcp-2015.json'));

        foreach($bjcpData->styleguide->category as $category) {
            $categoryModel = Category::create(['name' => $category->name]);
            foreach($category->subcategory as $style) {
                Style::create([
                    'name' => $style->name,
                    'code' => $style->id,
                    'category_id' => $categoryModel->id
                ]);
            }
        }
    }
}
