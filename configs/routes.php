<?php
$this->get('/', '\Application\Controllers\EJournalController::get');
$this->post('/', '\Application\Controllers\EJournalController::add');
$this->put('/', '\Application\Controllers\EJournalController::save');
$this->delete('/', '\Application\Controllers\EJournalController::remove');

$this->get('/employee', '\Application\Controllers\EmployeesController::get');
$this->post('/employee', '\Application\Controllers\EmployeesController::add');
$this->put('/employee', '\Application\Controllers\EmployeesController::save');
$this->delete('/employee', '\Application\Controllers\EmployeesController::remove');