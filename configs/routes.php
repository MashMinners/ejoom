<?php
//Журнал
$this->get('/', '\Application\Controllers\EJournalController::get');
$this->post('/', '\Application\Controllers\EJournalController::add');
$this->put('/', '\Application\Controllers\EJournalController::save');
$this->delete('/', '\Application\Controllers\EJournalController::remove');
//Сотрудники
$this->get('/employee', '\Application\Controllers\EmployeesController::get');
$this->post('/employee', '\Application\Controllers\EmployeesController::add');
$this->put('/employee', '\Application\Controllers\EmployeesController::save');
$this->delete('/employee', '\Application\Controllers\EmployeesController::remove');
//Контрагенты
$this->get('/counterparties', '\Application\Controllers\CounterpartiesController::get');
$this->post('/counterparties', '\Application\Controllers\CounterpartiesController::add');
$this->put('/counterparties', '\Application\Controllers\CounterpartiesController::save');
$this->delete('/counterparties', '\Application\Controllers\CounterpartiesController::remove');