<?php
$this->get('/', '\Application\Controllers\EJournalController::get');
$this->post('/', '\Application\Controllers\EJournalController::add');
$this->put('/', '\Application\Controllers\EJournalController::save');
$this->delete('/', '\Application\Controllers\EJournalController::remove');