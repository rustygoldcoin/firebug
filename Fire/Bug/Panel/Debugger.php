<?php

namespace Fire\Bug\Panel;

use Fire\Bug\Panel;
use Fire\Bug\Debugger as FireBugDebugger;

class Debugger extends Panel
{

    /**
     * Constants
     */
    const ID = 'debugger';
    const NAME = 'Debuggers';
    const TEMPLATE = __DIR__ . '/../../../view/panels/debugger.phtml';

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
        parent::__construct(self::ID, self::NAME, self::TEMPLATE);
        $this->_debuggers = [];
    }

    /**
     * 
     * @return [type] [description]
     */
    public function getDebuggers()
    {
        return $this->_debuggers;
    }

    public function addDebugger(FireBugDebugger $debugger)
    {
        $this->_debuggers[] = $debugger;
    }

    public function enableXDebugOverlay()
    {
        $this->_enableXDebugOverlay = true;
    }

    public function render() {
        if (!$this->_enableXDebugOverlay) {
            ini_set('xdebug.overload_var_dump', 'off');
        }
        parent::render();
    }
}
