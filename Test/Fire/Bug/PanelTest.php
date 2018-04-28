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
use Test\Mock\Fire\Bug\PanelMock;

/**
 * Test suite for Fire\Bug\Panel
 */
class PanelTest extends TestCase
{

    /**
     * Constants
     */
    const ID = 'testPanel';
    const NAME = 'Test Panel';
    const TEMPLATE = __DIR__ . '/../../view/fire/bug/panel.phtml';

    public function beforeEach()
    {
        $this->_testPanel = new PanelMock(self::ID, self::NAME, self::TEMPLATE);
    }

    /**
     * Tests the functionality of Fire\Bug\Panel::getId();
     * @return void
     */
    public function testGetId()
    {
        $this->should('After a new panel is constructed, it should maintain the ID it was given.');
        $this->assert($this->_testPanel->getId() === self::ID);
    }

    /**
     * Tests the functionality of Fire\Bug\Panel::getName();
     * @return void
     */
    public function testgetName()
    {
        $this->should('After a new panel is constructed, it should maintain the name it was given.');
        $this->assert($this->_testPanel->getName() === self::NAME);
    }

    /**
     * Tests the functionality of rendering the panel.
     * @return void
     */
    public function testRender()
    {
        $this->_testPanel->test = 'testing...';
        ob_start();
        $this->_testPanel->render();
        $result = ob_get_contents();
        ob_end_clean();
        $expected = file_get_contents(__DIR__ . '/../../view/fire/bug/panel-result.phtml');
        $this->should('Rendering a panel should include panel header and footer and interpolate model correctly.');
        $this->assert($result === $expected);
    }

}
