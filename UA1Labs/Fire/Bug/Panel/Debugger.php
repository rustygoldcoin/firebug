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

namespace UA1Labs\Fire\Bug\Panel;

use \UA1Labs\Fire\Bug\Panel;
use \UA1Labs\Fire\Bug\Debugger as FireBugDebugger;
use \UA1Labs\Fire\BugException;

/**
 * This class represents the panel for debuggers to be displayed
 * in the FireBug Panel.
 */
class Debugger extends Panel
{

    const ID = 'debugger';

    /**
     * If true, allows xdebug overlays in var_dump outputs.
     *
     * @var boolean
     */
    private $enableXDebugOverlay;

    /**
     * An array containing all debuggers.
     *
     * @var array<\UA1Labs\Fire\Bug\Debugger>
     */
    private $debugger;

    /**
     * The class constructor.
     */
    public function __construct()
    {
        parent::__construct(self::ID, 'Debuggers {{count}}', __DIR__ . '/debugger.phtml');
        $this->setDescription(
            'This panel shows debug logs that were invoked using the debugger() function. ' .
            'The debugger() function is similar to var_dump() but will display the inspected ' .
            'variable in the panel below. The debug log will include a stack trace and ' .
            'the var_dump output.'
        );
        $this->debuggers = [];
    }

    /**
     * Returns all debuggers that have been added.
     *
     * @return array<\UA1Labs\Fire\Bug\Debugger>
     */
    public function getDebuggers()
    {
        return $this->debuggers;
    }

    /**
     * Adds a debugger to the array of debuggers for this panel.
     *
     * @param \UA1Labs\Fire\Bug\Debugger $debugger The debugger object
     */
    public function addDebugger($debugger)
    {
        if (!($debugger instanceof FireBugDebugger)) {
            throw new BugException('Debuggers must extend class \UA1Labs\Fire\Bug\Debugger.');
        }
        $this->debuggers[] = $debugger;
    }

    /**
     * Enables the x-debug overlay html. If this is enabled and you have x-debug
     * installed, you will be able to see all of the x-debug data that gets
     * added when you use var_dump().
     */
    public function enableXDebugOverlay()
    {
        $this->enableXDebugOverlay = true;
    }

    /**
     * Renders the panel HTML.
     */
    public function render() {
        if (!$this->enableXDebugOverlay) {
            ini_set('xdebug.overload_var_dump', 'off');
        }
        $debuggerCount = count($this->debuggers);
        $this->setName(str_replace('{{count}}', '{' . $debuggerCount . '}', $this->name));
        parent::render();
    }
}
