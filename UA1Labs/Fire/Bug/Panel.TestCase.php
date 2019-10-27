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
use \UA1Labs\Fire\Bug\Panel;

/**
 * Test suite for Fire\Bug\Panel
 */
class PanelTestCase extends TestCase
{

    const ID = 'testPanel';
    const NAME = 'Test Panel';
    const TEMPLATE = __DIR__ . '/test.phtml';

    public function beforeEach()
    {
        $this->testPanel = new PanelMock(self::ID, self::NAME, self::TEMPLATE);
    }

    /**
     * Tests the functionality of Fire\Bug\Panel::getId();
     * @return void
     */
    public function testGetId()
    {
        $this->should('After a new panel is constructed, it should maintain the ID it was given.');
        $this->assert($this->testPanel->getId() === self::ID);
    }

    /**
     * Tests the functionality of Fire\Bug\Panel::getName();
     * @return void
     */
    public function testGetName()
    {
        $this->should('After a new panel is constructed, it should maintain the name it was given.');
        $this->assert($this->testPanel->getName() === self::NAME);
    }

}

/**
 * Test panel used so we can test the functionality of
 * the abstract \UA1Labs\Fire\Bug\Panel class.
 */
class PanelMock extends Panel
{

}
