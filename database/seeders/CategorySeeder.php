<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'موسیقی', 'description' => 'پادکست‌ها و آلبوم‌های موسیقی'],
            ['name' => 'فناوری', 'description' => 'پادکست‌های فناوری و تکنولوژی'],
            ['name' => 'آموزشی', 'description' => 'پادکست‌های آموزشی و یادگیری'],
            ['name' => 'طنز و کمدی', 'description' => 'پادکست‌های طنز و سرگرمی'],
            ['name' => 'اخبار', 'description' => 'پادکست‌های خبری و تحلیلی'],
            ['name' => 'ورزش', 'description' => 'پادکست‌های ورزشی'],
            ['name' => 'کسب‌وکار', 'description' => 'پادکست‌های کسب‌وکار و کارآفرینی'],
            ['name' => 'فرهنگ و هنر', 'description' => 'پادکست‌های فرهنگی و هنری'],
        ];

        foreach ($categories as $c) {
            Category::firstOrCreate(
                ['name' => $c['name']],
                ['description' => $c['description'], 'cover' => '/img/no-image.png']
            );
        }
    }
}
