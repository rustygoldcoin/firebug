<?php
//include FireBug library
require_once __DIR__ . '/../vendor/autoload.php';

//get instance of Fire\Bug
$bug = Fire\Bug::get();

//start timer to get processing time
$bug->startTimer();

//call debugger
debugger('debug');

debugger($bug);

//render the firebug debug panel
$bug->render();
