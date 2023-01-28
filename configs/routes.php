<?php
$this->get('/', '\Application\Controllers\EJournalController::get');
$this->post('/', 'Application\Controllers\OutGoingMailController::add');
$this->put('/', 'Application\Controllers\OutGoingMailController::save');
$this->delete('/', 'Application\Controllers\OutGoingMailController::delete');