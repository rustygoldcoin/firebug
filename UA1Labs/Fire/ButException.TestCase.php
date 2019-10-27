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

namespace Test\UA1Labs\Fire;

use \UA1Labs\Fire\Test\TestCase;
use \UA1Labs\Fire\BugException;

/**
 * Test suite for Fire\BugException.
 */
class BugExceptionTestCase extends TestCase
{
    /**
     * Tests that there is a Fire\BugException.
     * @return void
     */
    public function testBugExceptionThrown()
    {
        try {
            throw new BugException();
        } catch (BugException $e) {
            $this->should('When UA1Labs\Fire\BugException is thrown, it should be of the right type.');
            $this->assert($e instanceof BugException);
        }
    }

}
