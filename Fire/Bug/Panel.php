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


namespace Fire\Bug;

/**
 * Abstract class all debug panels sould inheret from.
 */
abstract class Panel
{

    /**
     * The id given to the panel.
     * @var string
     */
    protected $_id;

    /**
     * A readable name given to the panel.
     * @var string
     */
    protected $_name;

    /**
     * A path to a pthml template.
     * @var string
     */
    protected $_template;

    /**
     * The Constructor
     * @param string $id The ID of this panel
     * @param string $name The name of this panel
     * @param string $template Path to a template for this panel
     */
    public function __construct($id, $name, $template)
    {
        $this->_id = $id;
        $this->_name = $name;
        $this->_template = $template;
    }

    /**
     * Gets the ID for the given panel.
     * @return string The ID
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Gets the name for the given panel.
     * @return string The name
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Renders the panel.
     * @return void
     */
    public function render()
    {
        ob_start();
        include __DIR__ . '/../../view/partials/panel-top.phtml';
        include $this->_template;
        include __DIR__ . '/../../view/partials/panel-bottom.phtml';
        ob_end_flush();
    }
}
