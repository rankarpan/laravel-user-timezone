<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    private $table = [
        'users',
        'articles'
    ];

    private $seeder = [
        'UserTableSeeder',
        'ArticleTableSeeder'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();

        Model::unguard();

        foreach ($this->seeder as $tableSeeder)
        {
            $this->call($tableSeeder);
        }
    }

    private function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->table as $tableName)
        {
            DB::table($tableName)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
