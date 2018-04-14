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

namespace Test\Fire;

use Fire\Test\TestCase;
use Fire\BugException as FireBugException;

/**
 * Test suite for Fire\BugException.
 */
class BugException extends TestCase
{
    /**
     * Tests that there is a Fire\BugException.
     * @return void
     */
    public function testBugExceptionThrown()
    {
        try {
            throw new FireBugException();
        } catch (FireBugException $e) {
            $this->should('When Fire\BugException is thrown, it should be of the right type.');
            $this->assert($e instanceof FireBugException);
        }
    }

}
