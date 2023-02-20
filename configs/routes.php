<?php
//Журнал
$this->get('/records', '\Application\Controllers\EJournalController::get');
$this->post('/records', '\Application\Controllers\EJournalController::add');
$this->put('/records', '\Application\Controllers\EJournalController::save');
$this->delete('/records', '\Application\Controllers\EJournalController::remove');
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