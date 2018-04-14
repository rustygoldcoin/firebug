<?php

/**
 *    __  _____   ___   __          __
 *   / / / /   | <  /  / /   ____ _/ /_  _____
 *  / / / / /| | / /  / /   / __ `/ __ `/ ___/
 * / /_/ / ___ |/ /  / /___/ /_/ / /_/ (__  )
 * `____/_/  |_/_/  /_____/`__,_/_.___/____/
 *
 * @package FireStudio
 * @subpackage FireBug
 * @author UA1 Labs Developers https://ua1.us
 * @copyright Copyright (c) UA1 Labs
 */

/**
 * The debugger method for generating a debug message and stack trace.
 * @param  mixed $message The value you are debugging
 * @return void
 */
function debugger($message)
{
    $fireBug = Fire\Bug::get();
    $debugger = new \Fire\Bug\Debugger();
    $debugger->setMessage($message);
    $debugger->setTrace(debug_backtrace());
    $fireBug
        ->getPanel(\Fire\Bug\Panel\Debugger::ID)
        ->addDebugger($debugger);
}
