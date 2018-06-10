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


namespace Fire\Bug\Panel;

use \Fire\Bug\Panel;
use \Fire\Bug\Debugger as FireBugDebugger;
use \Fire\BugException;

/**
 * This class represents the panel for debuggers to be displayed
 * in the FireBug Panel.
 */
class Debugger extends Panel
{

    /**
     * Constants
     */
    const ID = 'debugger';
    const NAME = '{count} Debuggers';
    const TEMPLATE = '/debugger.phtml';

    /**
     * If true, allows xdebug overlays in var_dump outputs.
     * @var boolean
     */
    private $_enableXDebugOverlay;

    /**
     * The constructor
     */
    public function __construct()
    {
        parent::__construct(self::ID, self::NAME, __DIR__ . self::TEMPLATE);
        $this->_debuggers = [];
    }

    /**
     * Returns all debuggers that have been added.
     * @return \Fire\Bug\Debugger[]
     */
    public function getDebuggers()
    {
        return $this->_debuggers;
    }

    /**
     * Adds a debugger to the array of debuggers for this panel.
     * @param \Fire\Bug\Debugger $debugger
     * @return void
     */
    public function addDebugger($debugger)
    {
        if (!($debugger instanceof FireBugDebugger)) {
            throw new BugException('Debuggers must extend class Fire\Bug\Debugger.');
        }
        $this->_debuggers[] = $debugger;
    }

    /**
     * Enables the x-debug overlay html. If this is enabled and you have x-debug
     * installed, you will be able to see all of the x-debug data that gets
     * added when you use var_dump().
     * @return void
     */
    public function enableXDebugOverlay()
    {
        $this->_enableXDebugOverlay = true;
    }

    /**
     * Renders the panel HTML.
     * @return void
     */
    public function render() {
        if (!$this->_enableXDebugOverlay) {
            ini_set('xdebug.overload_var_dump', 'off');
        }
        $debuggerCount = count($this->_debuggers);
        $this->setName(str_replace('{count}', '{' . $debuggerCount . '}', self::NAME));
        parent::render();
    }
}
