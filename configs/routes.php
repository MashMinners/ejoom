<?php
//Журнал
$this->get('/', '\Application\Controllers\EJournalController::get');
$this->post('/', '\Application\Controllers\EJournalController::add');
$this->put('/', '\Application\Controllers\EJournalController::save');
$this->delete('/', '\Application\Controllers\EJournalController::remove');
//Сотрудники
$this->get('/employees', '\Application\Controllers\EmployeesController::get');
$this->post('/employees', '\Application\Controllers\EmployeesController::add');
$this->put('/employees', '\Application\Controllers\EmployeesController::save');
$this->delete('/employees', '\Application\Controllers\EmployeesController::remove');
//Контрагенты
$this->get('/counterparties', '\Application\Controllers\CounterpartiesController::get');
$this->post('/counterparties', '\Application\Controllers\CounterpartiesController::add');
$this->put('/counterparties', '\Application\Controllers\CounterpartiesController::save');
$this->delete('/counterparties', '\Application\Controllers\CounterpartiesController::remove');