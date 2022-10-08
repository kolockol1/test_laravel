<?php


namespace Tests\Api;

use Illuminate\Support\Facades\DB;
use Tests\Support\ApiTester;

class EmployeeFindCest
{
    public function fillDB()
    {
        DB::connection()->getPdo()->exec("insert into main.employees (id, name, position, superior_id, start_date, end_date, created_at, updated_at)
        values  (1, 'name1', 'position1', 3, '2022-10-11', null, '2022-10-08 21:32:59', '2022-10-08 21:32:59'),
                (2, 'name2', 'position2', 1, '2022-10-11', null, '2022-10-08 21:32:59', '2022-10-08 21:32:59'),
                (3, 'name3', 'position0', null, '2022-10-11', null, '2022-10-08 21:32:59', '2022-10-08 21:32:59'),
                (4, 'name4', 'position2', 1, '2022-10-11', null, '2022-10-08 21:32:59', '2022-10-08 21:32:59'),
                (5, 'name5', 'position3', 6, '2022-10-11', null, '2022-10-08 21:32:59', '2022-10-08 21:32:59'),
                (6, 'name6', 'position2', 1, '2022-10-11', null, '2022-10-08 21:32:59', '2022-10-08 21:32:59'),
                (7, 'name7', 'position2', 1, '2022-10-11', null, '2022-10-08 21:32:59', '2022-10-08 21:32:59'),
                (8, 'name8', 'position3', 6, '2022-10-11', null, '2022-10-08 21:32:59', '2022-10-08 21:32:59'),
                (9, 'name9', 'position2', 1, '2022-10-11', null, '2022-10-08 21:32:59', '2022-10-08 21:32:59'),
                (10, 'name10', 'position3', 6, '2022-10-11', null, '2022-10-08 21:32:59', '2022-10-08 21:32:59'),
                (11, 'name11', 'position3', 6, '2022-10-11', null, '2022-10-08 21:32:59', '2022-10-08 21:32:59'),
                (12, 'name12', 'position3', 6, '2022-10-11', null, '2022-10-08 21:32:59', '2022-10-08 21:32:59')
                ;");
    }

    // tests
    public function findBySuperiorTest(ApiTester $I): void
    {
        $this->fillDB();
        $testCases = [
            ['id' => 1, 'expectedResponse' => '{"employees":[{"id":2,"name":"name2","position":"position2","superior_id":1,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"},{"id":4,"name":"name4","position":"position2","superior_id":1,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"},{"id":6,"name":"name6","position":"position2","superior_id":1,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"},{"id":7,"name":"name7","position":"position2","superior_id":1,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"},{"id":9,"name":"name9","position":"position2","superior_id":1,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"}]}'],
            ['id' => 2, 'expectedResponse' => '{"employees":[]}'],
            ['id' => 3, 'expectedResponse' => '{"employees":[{"id":1,"name":"name1","position":"position1","superior_id":3,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"}]}'],
            ['id' => 4, 'expectedResponse' => '{"employees":[]}'],
            ['id' => 5, 'expectedResponse' => '{"employees":[]}'],
            ['id' => 6, 'expectedResponse' => '{"employees":[{"id":5,"name":"name5","position":"position3","superior_id":6,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"},{"id":8,"name":"name8","position":"position3","superior_id":6,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"},{"id":10,"name":"name10","position":"position3","superior_id":6,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"},{"id":11,"name":"name11","position":"position3","superior_id":6,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"},{"id":12,"name":"name12","position":"position3","superior_id":6,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"}]}'],
            ['id' => 7, 'expectedResponse' => '{"employees":[]}'],
            ['id' => 8, 'expectedResponse' => '{"employees":[]}'],
            ['id' => 9, 'expectedResponse' => '{"employees":[]}'],
            ['id' => 10, 'expectedResponse' => '{"employees":[]}'],
            ['id' => 11, 'expectedResponse' => '{"employees":[]}'],
            ['id' => 12, 'expectedResponse' => '{"employees":[]}'],
        ];
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');

        foreach ($testCases as $testCase) {
            $I->sendPost('/findBySuperior', ['id' => $testCase['id'],]);

            $I->seeResponseCodeIsSuccessful();
            $I->seeResponseIsJson();
            $I->seeResponseContains($testCase['expectedResponse']);
        }
    }

    public function findByPositionTest(ApiTester $I): void
    {
        $this->fillDB();
        $testCases = [
            ['position' => 'position0', 'expectedResponse' => '{"employees":[{"id":3,"name":"name3","position":"position0","superior_id":null,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"}]}'],
            ['position' => 'position1', 'expectedResponse' => '{"employees":[{"id":1,"name":"name1","position":"position1","superior_id":3,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"}]}'],
            ['position' => 'position2', 'expectedResponse' => '{"employees":[{"id":2,"name":"name2","position":"position2","superior_id":1,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"},{"id":4,"name":"name4","position":"position2","superior_id":1,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"},{"id":6,"name":"name6","position":"position2","superior_id":1,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"},{"id":7,"name":"name7","position":"position2","superior_id":1,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"},{"id":9,"name":"name9","position":"position2","superior_id":1,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"}]}'],
            ['position' => 'position3', 'expectedResponse' => '{"employees":[{"id":5,"name":"name5","position":"position3","superior_id":6,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"},{"id":8,"name":"name8","position":"position3","superior_id":6,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"},{"id":10,"name":"name10","position":"position3","superior_id":6,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"},{"id":11,"name":"name11","position":"position3","superior_id":6,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"},{"id":12,"name":"name12","position":"position3","superior_id":6,"start_date":"2022-10-11","end_date":null,"created_at":"2022-10-08T21:32:59.000000Z","updated_at":"2022-10-08T21:32:59.000000Z"}]}'],
        ];
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');

        foreach ($testCases as $testCase) {
            $I->sendPost('/findByPosition', ['position' => $testCase['position'],]);

            $I->seeResponseCodeIsSuccessful();
            $I->seeResponseIsJson();
            $I->seeResponseContains($testCase['expectedResponse']);
        }
    }
}
