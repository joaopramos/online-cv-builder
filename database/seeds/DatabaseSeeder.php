<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('UsersTableSeeder');
        $this->call('TemplatesTableSeeder');

        Model::reguard();
    }
}

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => env('ADMIN_EMAIL'),
            'password' => bcrypt(env('ADMIN_PASS')),
            'admin' => true,
        ]);
    }
}

class TemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('templates')->insert([
            'name' => 'default',
            'template' => $this->readFile('default.html.txt'),
            'css' => $this->readFile('default.css.txt'),
            'pdf_template' => $this->readFile('default.pdf.txt'),
            'thumbnail' => 'dist/images/default.png',
        ]);
        DB::table('templates')->insert([
            'name' => 'flat',
            'template' => $this->readFile('flat.html.txt'),
            'css' => $this->readFile('flat.css.txt'),
            'pdf_template' => $this->readFile('flat.pdf.txt'),
            'thumbnail' =>'dist/images/flat.png',
        ]);
    }

    public function readFile($filename) {
        $path = base_path('resources/assets/templates/');
        try {
        $file = fopen($path.$filename, "r") or die("Unable to open file!");
        $txt = fread($file,filesize($path.$filename));
        } catch(Exception $e) {
            return '';
        }
        fclose($file);
        return $txt;
    }
}
