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
use Fire\Bug as FireBug;
use Fire\Bug\Panel\Debugger as DebuggerPanel;
use Fire\BugException;

/**
 * Test Suite for Fire\Bug.
 */
class Bug extends TestCase
{

    /**
     * Runs after each test case.
     * @return void
     */
    public function afterEach()
    {
        FireBug::destroy();
    }

    /**
     * Tests that FireBug initializes properly.
     * @return void
     */
    public function testFireBugInitialization()
    {
        $fireBug = FireBug::get();
        $this->should('FireBug should generate an instance of itself.');
        $this->assert($fireBug instanceof FireBug);
    }

    /**
     * Tests that FireBug is destroyed properly.
     * @return void
     */
    public function testFireBugDestroy()
    {
        $fireBug = FireBug::get();
        $fireBug->test = true;
        $this->should('FireBug should contain a new property "test = true".');
        $this->assert($fireBug->test === true);

        FireBug::destroy();
        $fireBug = FireBug::get();
        $this->should('After destroying, FireBug should not contain the "test = true" property anymore.');
        $this->assert(!isset($fireBug->test));
    }

    /**
     * Tests all of the functionality of adding and acceing panels.
     * @return void
     */
    public function testFireBugPanelFunctionality()
    {
        $fireBug = FireBug::get();
        $debuggerPanel = $fireBug->getPanel(DebuggerPanel::ID);
        $this->should('FireBug should contain a "debugger" panel upon successful construction.');
        $this->assert($debuggerPanel instanceof DebuggerPanel);

        $allPanels = $fireBug->getPanels();
        $this->should('FireBug should contain all panels added.');
        $this->assert(is_array($allPanels) && count($allPanels) > 0);

        try {
            $fireBug->addPanel(new DebuggerPanel());
        } catch (BugException $e) {
            $exception = $e;
        }
        $this->should('A Fire\BugException should be thown when trying to add a panel with a duplicate id.');
        $this->assert(isset($exception) && $exception instanceof BugException);
    }

    /**
     * Tests functionality of the timer in FireBug.
     * @return void
     */
    public function testFireBugTimerFunctionality()
    {
        $fireBug = FireBug::get();
        $time = $fireBug->getLoadTime();
        $this->should('When you don\'t start the timer, FireBug shouldn\'t provide load time.');
        $this->assert($time === false);

        $fireBug->startTimer();
        $time = $fireBug->getLoadTime();
        $this->should('When the timer is started, the end time should be greater than 0.');
        $this->assert($time > 0);
    }
}
