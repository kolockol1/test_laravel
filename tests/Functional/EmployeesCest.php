<?php

namespace Tests\Functional;

use App\Models\Employee;
use Tests\Support\FunctionalTester;

class EmployeesCest
{
    public function indexTest(FunctionalTester $I): void
    {
        $I->amOnPage('/employees');
        $I->see('Employees', 'h1');
    }

    public function createPageTest(FunctionalTester $I): void
    {
        $I->amOnPage('/employees');
        $I->click('Add Employees');
        $I->see('Add Employee', 'h1');
    }

    public function createActionTest(FunctionalTester $I): void
    {
        $I->amOnPage('/employees/create');
        $I->see('Add Employee', 'h1');

        $I->fillField('start_date', '13.10.2022');
        $I->click('Add Employee');
        $I->see('The name field is required.', '.alert');
        $I->see('The position field is required.', '.alert');

        $I->fillField('start_date', '13.10.2022');
        $I->fillField('superior_id', '1');
        $I->click('Add Employee');
        $I->see('The name field is required.', '.alert');
        $I->see('The position field is required.', '.alert');
        $I->see('The superior_id with that ID not exists.', '.alert');

        $I->fillField('start_date', '13.10.2022');
        $I->fillField('position', 'Position1');
        $I->click('Add Employee');
        $I->see('The name field is required.', '.alert');

        $I->fillField('start_date', '13.10.2022');
        $I->fillField('position', 'Position1');
        $I->fillField('name', 'Name1');
        $I->click('Add Employee');

        $I->see('Employees', 'h1');
        $I->see('Employee saved.', '.alert-success');
    }

    public function editPageTest(FunctionalTester $I): void
    {
        $this->createEmployee();

        $I->amOnPage('/employees/1/edit');
        $I->see('Editing employee', 'h1');
    }

    public function editActionTest(FunctionalTester $I): void
    {
        $this->createEmployee();

        $I->amOnPage('/employees/1/edit');
        $I->see('Editing employee', 'h1');

        $I->fillField('start_date', '13.10.2022');
        $I->fillField('end_date', '12.10.2022');
        $I->click('Update');
        $I->see('The end_date have to be greater, than start_date.', '.alert');

        $I->fillField('superior_id', '111');
        $I->click('Update');
        $I->see('The superior_id with that ID not exists.', '.alert');

        $I->fillField('superior_id', '1');
        $I->click('Update');
        $I->see('Employee not allowed to be superior for themself', '.alert');

        $I->fillField('start_date', '14.10.2022');
        $I->fillField('end_date', '15.10.2022');
        $I->click('Update');

        $I->see('Employees', 'h1');
        $I->see('Employee updated.', '.alert-success');
    }

    public function editPageForNotExistingEmployeeTest(FunctionalTester $I): void
    {
        $this->createEmployee();

        $I->amOnPage('/employees/1/edit');
        $I->see('Editing employee', 'h1');

        $I->amOnPage('/employees/2/edit');
        $I->see('Not Found', 'title');
    }

    private function createEmployee(): void
    {
        $employee = new Employee([
            'name' => 'testName',
            'position' => 'testPosition',
            'startDate' => '2022-10-20'
        ]);
        $employee->save();
    }
}
