<?php

/**
 *    __  _____   ___   __          __
 *   / / / /   | <  /  / /   ____ _/ /_  _____
 *  / / / / /| | / /  / /   / __ `/ __ `/ ___/
 * / /_/ / ___ |/ /  / /___/ /_/ / /_/ (__  )
 * `____/_/  |_/_/  /_____/`__,_/_.___/____/
 *
 * @package FireBug
 * @author UA1 Labs Developers https://ua1.us
 * @copyright Copyright (c) UA1 Labs
 */

/**
 * The debugger method for generating a debug message and stack trace.
 *
 * @param mixed $value The value you are debugging
 * @param boolean $exit If we want to stop execution and render the panel
 */
function debugger($value, $exit = false)
{
    if (php_sapi_name() === 'cli') {
        var_dump($value);
        if ($exit) {
            exit();
        }
    } else {
        $fireBug = \UA1Labs\Fire\Bug::get();
        $debugger = new \UA1Labs\Fire\Bug\Debugger();
        $debugger->setValue($value);
        $debugger->setTrace(debug_backtrace());
        $fireBug
            ->getPanel(\UA1Labs\Fire\Bug\Panel\Debugger::ID)
            ->addDebugger($debugger);

        if ($exit) {
            echo $fireBug->render();
            exit();
        }
    }
}
