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

namespace UA1Labs\Fire;

use \UA1Labs\Fire\Bug\Panel;
use \UA1Labs\Fire\Bug\Panel\Debugger as DebuggerPanel;
use \UA1Labs\Fire\BugException;

/**
 * The purpose of this class is to provide a single place where you
 * will interact with the FireBug library.
 */
final class Bug extends Panel
{

    const ID = 'firebug';
    const NAME = 'FireBug Panel';
    const TEMPLATE = '/firebug.phtml';

    /**
     * Instance of \UA1Labs\Fire\Bug.
     *
     * @var \UA1Labs\Fire\Bug
     */
    static private $instance;

    /**
     * Is FireBug enabled.
     *
     * @var boolean
     */
    private $enabled;

    /**
     * The firebug timer start time.
     *
     * @var float
     */
    private $startTime;

    /**
     * Array of panel objects.
     *
     * @var array<UA1Labs\Fire\Bug\Panel>
     */
    private $panels;

    /**
     * An array of panel IDs in the order you want them to display.
     *
     * @var array<string>
     */
    private $panelOrder;

    /**
     * The class constructor.
     */
    public function __construct()
    {
        parent::__construct(self::ID, self::NAME, __DIR__ . self::TEMPLATE);
        $this->panels = [];
        $this->enabled = false;
        $this->addPanel(new DebuggerPanel());
    }

    /**
     * Gets the instance of \UA1Labs\Fire\Bug.
     *
     * @return \UA1Labs\Fire\Bug
     */
    static function get()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Enables FireBug.
     *
     * @return void
     */
    public function enable()
    {
        $this->enabled = true;
        $this->startTime = $this->timer();
    }

    /**
     * Determines if FireBug is enabled.
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Destroys the current instance of FireBug.
     */
    static function destroy()
    {
        self::$instance = null;
    }

    /**
     * Adds a \UA1Labs\Fire\Bug\Panel object to the the array of panels.
     *
     * @param \UA1Labs\Fire\Bug\Panel $panel The panel you are adding to FireBug
     */
    public function addPanel(Panel $panel)
    {
        $id = $panel->getId();
        if (!empty($this->panels[$id])) {
            throw new BugException('A panel already exists with ID "' . $id . '".');
        }
        $this->panels[$id] = $panel;
    }

    /**
     * Gets a stored panel object by its ID.
     *
     * @param string $id The id of defined on the Fire\Bug\Panel instance object.
     * @return \UA1Labs\Fire\Bug\Panel
     */
    public function getPanel($id)
    {
        return $this->panels[$id];
    }

    /**
     * Gets all stored panels.
     *
     * @return array<\UA1Labs\Fire\Bug\Panel>
     */
    public function getPanels()
    {
        if (!$this->panelOrder) {
            return $this->panels;
        }

        $panels = [];
        foreach ($this->panelOrder as $panelId) {
            if (isset($this->panels[$panelId])) {
                $panels[$panelId] = $this->panels[$panelId];
            }
        }
        
        return $panels;
    }

    /**
     * Sets the order in which you want to see the panels.
     *
     * @param array<string> $panelOrder An array of panel ids
     */
    public function setPanelOrder($panelOrder)
    {
        $this->panelOrder = $panelOrder;
    }

    /**
     * Method used to measure the amount of time that passed in milliseconds.
     * If you pass in a $start time, then you will be returned time length from
     * the start time. If you don't pass anything in, a start time will be returned.
     *
     * @param float|null $start The start time.
     * @return float
     */
    public function timer($start = null)
    {
        if ($start) {
            $end = microtime(true);
            return round(($end - $start) * 1000, 4);
        } else {
            return microtime(true);
        }
    }

    /**
     * If the timer was started, the load time will be returned.
     *
     * @return float|boolean
     */
    public function getLoadTime()
    {
        if (!empty($this->startTime)) {
            return $this->timer($this->startTime);
        }
        return false;
    }

    /**
     * Method used to render FireBug.
     */
    public function render()
    {
        if ($this->enabled) {
            if (php_sapi_name() === 'cli') {
                echo 'FireBug: ' . $this->getLoadTime() . ' milliseconds' . "\n";
            } else {
                ob_start();
                include $this->template;
                $debugPanel = ob_get_contents();
                ob_end_clean();

                return $debugPanel;
            }
        }
    }

}
