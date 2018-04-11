<?php

function debugger($message)
{
    $fireBug = Fire\Bug::get();
    $trace = debug_backtrace();
    $debugger = new \Fire\Bug\Debugger();
    $debugger->setMessage($message);
    $debugger->setTrace($trace);
    $fireBug
        ->getPanel(\Fire\Bug\Panel\Debugger::ID)
        ->addDebugger($debugger);
}
