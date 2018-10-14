<?php

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Casperw\LaravelTidyTables\Commands\TidyTableCommand;

class TidyTableCommandTest extends TestCase
{
    use RefreshDatabase;

    private $subject;

    /**
     * @var TidyTableCommand
     */
    public function setUp()
    {
        parent::setUp();

        $migrator_mock = $this->createMock(Migrator::class);

        $this->subject = new TidyTableCommand($migrator_mock);
    }

    /**
     * @dataProvider columnProvider
     *
     * @param $column_structure
     */
    public function testWhenTidyCommandIsRanThenColumnsAreStructuredCorrectly($column_structure)
    {
        $this->prepareTable($column_structure);

        $this->subject->handle();

        $this->assertEquals([
            0 => 'id',
            1 => 'uuid',
            2 => 'acccount_id',
            3 => 'person_id',
            4 => 'title',
            5 => 'body',
            6 => 'created_at',
            7 => 'updated_at',
            8 => 'deleted_at',
        ], $this->getTableColumns('tests'));
    }

    private function getTableColumns($table)
    {
        return DB::getSchemaBuilder()->getColumnListing($table);
    }

    private function prepareTable($columns)
    {
        Schema::dropIfExists('tests');

        Schema::connection('mysql')->create('tests', function ($table) use ($columns) {
            foreach ($columns as $column) {
                foreach ($column as $data_type => $column_name) {
                    $table->$data_type($column_name);
                }
            }
        });
    }

    public function columnProvider()
    {
        return [
            [
                [
                    ['increments' => 'id'],
                    ['uuid' => 'uuid'],
                    ['integer' => 'person_id'],
                    ['integer' => 'acccount_id'],
                    ['string' => 'title'],
                    ['text' => 'body'],
                    ['timestamps' => ''],
                    ['softDeletes' => 'deleted_at'],
                ],
            ],
            [
                [
                    ['increments' => 'id'],
                    ['uuid' => 'uuid'],
                    ['timestamps' => ''],
                    ['string' => 'title'],
                    ['text' => 'body'],
                    ['softDeletes' => 'deleted_at'],
                    ['integer' => 'person_id'],
                    ['integer' => 'acccount_id'],
                ],
            ],
            [
                [
                    ['increments' => 'id'],
                    ['integer' => 'person_id'],
                    ['uuid' => 'uuid'],
                    ['softdeletes' => 'deleted_at'],
                    ['string' => 'title'],
                    ['integer' => 'acccount_id'],
                    ['text' => 'body'],
                    ['timestamps' => ''],
                ],
            ],
            [
                [
                    ['increments' => 'id'],
                    ['timestamps' => ''],
                    ['uuid' => 'uuid'],
                    ['string' => 'title'],
                    ['integer' => 'person_id'],
                    ['softdeletes' => 'deleted_at'],
                    ['integer' => 'acccount_id'],
                    ['text' => 'body'],
                ],
            ],
            [
                [
                    ['integer' => 'person_id'],
                    ['increments' => 'id'],
                    ['string' => 'title'],
                    ['text' => 'body'],
                    ['timestamps' => ''],
                    ['uuid' => 'uuid'],
                    ['softdeletes' => 'deleted_at'],
                    ['integer' => 'acccount_id'],
                ],
            ],
            [
                [
                    ['integer' => 'person_id'],
                    ['integer' => 'acccount_id'],
                    ['increments' => 'id'],
                    ['string' => 'title'],
                    ['text' => 'body'],
                    ['timestamps' => ''],
                    ['uuid' => 'uuid'],
                    ['softdeletes' => 'deleted_at'],
                ],
            ],
            [
                [
                    ['integer' => 'person_id'],
                    ['softdeletes' => 'deleted_at'],
                    ['timestamps' => ''],
                    ['uuid' => 'uuid'],
                    ['increments' => 'id'],
                    ['string' => 'title'],
                    ['text' => 'body'],
                    ['integer' => 'acccount_id'],
                ],
            ],
            [
                [
                    ['integer' => 'person_id'],
                    ['timestamps' => ''],
                    ['increments' => 'id'],
                    ['uuid' => 'uuid'],
                    ['integer' => 'acccount_id'],
                    ['softdeletes' => 'deleted_at'],
                    ['string' => 'title'],
                    ['text' => 'body'],
                ],
            ],
            [
                [
                    ['integer' => 'person_id'],
                    ['integer' => 'acccount_id'],
                    ['increments' => 'id'],
                    ['uuid' => 'uuid'],
                    ['softdeletes' => 'deleted_at'],
                    ['string' => 'title'],
                    ['text' => 'body'],
                    ['timestamps' => ''],
                ],
            ],
            [
                [
                    ['integer' => 'person_id'],
                    ['increments' => 'id'],
                    ['string' => 'title'],
                    ['text' => 'body'],
                    ['integer' => 'acccount_id'],
                    ['softdeletes' => 'deleted_at'],
                    ['timestamps' => ''],
                    ['uuid' => 'uuid'],
                ],
            ],
        ];
    }
}
