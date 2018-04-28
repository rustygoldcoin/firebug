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

namespace Test\Fire\Bug;

use Fire\Test\TestCase;
use Fire\Bug\Debugger as FireBugDebugger;

/**
 * Test suite for class Fire\Bug\Debugger
 */
class DebuggerTest extends TestCase
{

    /**
     * Testing the setMessage()/getMessage() methods.
     * @return void
     */
    public function testSetAndGetValue()
    {
        $debugger = new FireBugDebugger();
        $test = [
            'string',
            1,
            [],
            (object) [],
            1.00
         ];
         foreach ($test as $value) {
            $debugger->setValue($value);
            $this->should('Value should be able to be any value and should be returned without mutating.');
            $message = $debugger->getValue();
            $this->assert($value === $message);
        }
     }

     /**
      * Testing the getTrace()/setTrace() methods.
      * @return void
      */
     public function testSetAndGetTrace()
     {
         $debugger = new FireBugDebugger();
         $stackTrace = ['stack_trace'];
         $debugger->setTrace($stackTrace);
         $trace = $debugger->getTrace();
         $this->should('Stack trace should not be mutated after it is set.');
         $this->assert($trace === $stackTrace);
     }

}
