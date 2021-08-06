<?php

use Illuminate\Database\Seeder;
use App\Models\PostModel;

class PostModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        */
    public function run()
    {
    	for ($i = 12; $i < 100; $i++) {
    		$post = new PostModel();
    		$post->name = 'Sản Phẩm' . $i;
    		$post->slug = 'Sản Phẩm' . $i;
    		$post->description = 'Sản Phẩm' . $i;

           //lưu xuống database
    		$post->save();

    	}
    }
}
