<?php

use Illuminate\Database\Seeder;

class PictureTableSeeder extends Seeder
{

    private $faker;

    /**
     * PictureTableSeeder constructor.
     */
    public function __construct(Faker\Generator $faker)
    {
        $this->faker = $faker;
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dirUpload = public_path(env('UPLOAD_PICTURE', 'uploads'));
        $files = File::allFiles($dirUpload);
        foreach($files as $file) {
            File::delete($file);
        }
        $posts = \App\Post::all();
        foreach($posts as $post){
            $uri = str_random(30).'_370x235.jpg';
            $id = rand(1,9);
            $fileName = file_get_contents("http://lorempicsum.com/up/370/235/$id");
            File::put($dirUpload.DIRECTORY_SEPARATOR.$uri, $fileName);
            $mime = mime_content_type($dirUpload.DIRECTORY_SEPARATOR.$uri);
            \App\Picture::create([
                'post_id' => $post->id,
                'uri' => $uri,
                'name' => $this->faker->name,
                'mime' => $mime,
                'size' => 200
            ]);
        }
    }
}
