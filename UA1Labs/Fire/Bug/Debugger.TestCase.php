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

namespace Test\UA1Labs\Fire\Bug;

use \UA1Labs\Fire\Test\TestCase;
use \UA1Labs\Fire\Bug\Debugger;

/**
 * Test suite for class Fire\Bug\Debugger
 */
class DebuggerTestCase extends TestCase
{

    /**
     * Testing the setMessage()/getMessage() methods.
     */
    public function testSetAndGetValue()
    {
        $debugger = new Debugger();
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
      */
     public function testSetAndGetTrace()
     {
         $debugger = new Debugger();
         $stackTrace = ['stack_trace'];
         $debugger->setTrace($stackTrace);
         $trace = $debugger->getTrace();
         $this->should('Stack trace should not be mutated after it is set.');
         $this->assert($trace === $stackTrace);
     }

}
