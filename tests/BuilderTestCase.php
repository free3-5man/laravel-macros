<?php

namespace Freeman\LaravelMacros\Test;

use Freeman\LaravelMacros\MacroServiceProvider;
use Freeman\LaravelMacros\Test\Models\Article;
use Illuminate\Support\Facades\DB;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class BuilderTestCase extends Orchestra
{
    /**
     * {@inheritdoc}
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->resetDatabase();

        // $this->loadLaravelMigrations(['--database' => 'sqlite']);
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->withFactories(__DIR__ . '/database/factories');

        $this->artisan('migrate', ['--database' => 'sqlite']);

        $this->seedDB();
    }

    private function seedDB()
    {
        DB::table('users')->insert([
            [
                'name' => 'freeman',
                'birthday' => '2020-01-01',
                'height' => 175,
                'email' => 'freeman@163.com',
                'gender' => 'male',
            ],
            [
                'name' => 'michael',
                'birthday' => '2020-02-01',
                'height' => 185,
                'email' => null,
                'gender' => 'male',
            ],
            [
                'name' => 'david',
                'birthday' => '2020-03-01',
                'height' => 165,
                'email' => null,
                'gender' => 'male',
            ],
        ]);

        factory(Article::class)->times(5)->create([
            'author_id' => 1,
        ]);
        factory(Article::class)->times(3)->create([
            'author_id' => 2,
        ]);
        factory(Article::class)->times(8)->create([
            'author_id' => 3,
        ]);

        DB::table('films')->insert([
            [
                'name' => 'Star Wars',
                'start_time' => '2020-12-31 19:00:00',
                'end_time' => '2020-12-31 22:00:00',
            ],
            [
                'name' => 'The Avengers 4',
                'start_time' => '2020-12-31 21:30:00',
                'end_time' => '2021-01-01 00:30:00',
            ],
            [
                'name' => 'Avatar',
                'start_time' => '2021-01-01 01:00:00',
                'end_time' => '2021-01-01 03:00:00',
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getPackageProviders($app)
    {
        return [
            MacroServiceProvider::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => __DIR__ . '/database/database.sqlite',
            'prefix'   => '',
        ]);
        $app['config']->set('app.key', 'wslxrEFGWY6GfGhvN9L3wH3KSRJQQpBD');
    }

    /**
     * Reset the database.
     *
     * @return void
     */
    protected function resetDatabase()
    {
        file_put_contents(__DIR__ . '/database/database.sqlite', null);
    }
}
