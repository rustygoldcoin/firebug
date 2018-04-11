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

namespace Fire;

use Fire\Bug\Panel;
use Fire\Bug\Panel\Debugger as DebuggerPanel;
use Fire\BugException;

/**
 * The purpose of this class is to provide a single place where you
 * will interact with the FireBug library.
 */
final class Bug extends Panel
{

    /**
     * Constants
     */
    const ID = 'firebug';
    const NAME = 'FireBug Panel';
    const TEMPLATE = __DIR__ . '/../view/firebug.phtml';

    /**
     * Instance of Fire\Bug
     * @var Fire\Bug
     */
    static private $_instance;

    /**
     * The firebug timer start time
     * @var float
     */
    private $_startTime;

    /**
     * Array of panel objects.
     * @var array<Fire\Bug\Panel>
     */
    private $_panels;

    /**
     * The constructor
     */
    public function __construct()
    {
        parent::__construct(self::ID, self::NAME, self::TEMPLATE);
        $this->_panels = [];
        $this->addPanel(new DebuggerPanel());
    }

    /**
     * Gets the instance of Fire\Bug.
     * @return Fire\Bug
     */
    static function get()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Destroys the current instance of FireBug.
     * @return void
     */
    static function destroy()
    {
        self::$_instance = null;
    }

    /**
     * Adds a Fire\Bug\Panel object to the the array of panels.
     * @param Fire\Bug\Panel $panel The panel you are adding to FireBug
     */
    public function addPanel(Panel $panel)
    {
        $id = $panel->getId();
        if (!empty($this->_panels[$id])) {
            throw new BugException('[FireBug] No panels exist with ID "' . $id . '".');
        }
        $this->_panels[$id] = $panel;
    }

    /**
     * Gets a stored panel object by its ID.
     * @param [type] $id The id of defined on the Fire\Bug\Panel instance object.
     * @return [type] Fire\Bug\Panel
     */
    public function getPanel($id)
    {
        return $this->_panels[$id];
    }

    /**
     * Gets all stored panels.
     * @return array<Fire\Bug\Panel>
     */
    public function getPanels()
    {
        return $this->_panels;
    }

    /**
     * Starts the timer for calculating app run time.
     * @return void
     */
    public function startTimer()
    {
        $this->_startTime = microtime(true);
    }

    /**
     * If the timer was started, the load time will be returned
     * @return float
     */
    public function getLoadTime()
    {
        if (!empty($this->_startTime)) {
            $timeEnd = microtime(true);
            return ($timeEnd - $this->_startTime) * 1000;
        }
        return false;
    }

    /**
     * Method used to render FireBug.
     * @return void
     */
    public function render()
    {
        ob_start();
        include $this->_template;
        ob_end_flush();
    }

}
