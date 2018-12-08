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
     * Sets the name for the given panel.
     * @param string $name The name of the panel.
     * @return void
     */
    public function setName($name)
    {
        $this->_name = $name;
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
     * Returns a label.
     * @param  string $content The content of the label
     * @param  string  $class CSV list of classes you want to add
     * @param  string  $style Custom styles you want added
     * @return string HTML code for the separator
     */
    public function renderLabel($content, $class = '', $style = '')
    {
        $styleAttr = ($style) ? ' style="' . $style . '"' : '';
        $classes = ($class) ? ' ' . $class : '';
        $renderLabel = '';
        $renderLabel .= '<span class="fs-label' . $classes . '"' . $style . '>';
        $renderLabel .= $content;
        $renderLabel .= '</span>';
        return $renderLabel;
    }

    /**
     * Returns a separator.
     * @param  boolean $bold Do you want a bold separator
     * @param  string  $class CSV list of classes you want to add
     * @param  string  $style Custom styles you want added
     * @return string HTML code for the separator.
     */
    public function renderSeparator($bold = true, $class = '', $style = '')
    {
        $styleAttr = ($style) ? ' style="' . $style . '"' : '';
        $classes = ($class) ? ' ' . $class : '';
        if ($bold) {
            return '<hr class="fs-hr' . $classes . '"' . $styleAttr . '>';
        } else {
            return '<hr class="fs-hr-dotted' . $classes . '"' . $styleAttr . '>';
        }
    }

    /**
     * Returns the code passed in wrapped within a <pre> tag.
     * @param  string $content The code you want to render
     * @param  boolean $dark Do you want the dark theme?
     * @return string The HTML to render
     */
    public function renderCode($code, $dark = true)
    {
        $darkClass = ($dark) ? ' fs-dark' : '';
        $renderCode = '';
        $renderCode .= '<span class="fs-label">';
        $renderCode .= '<span class="fs-pre-expand">expand</span>';
        $renderCode .= ' | ';
        $renderCode .= '<span class="fs-pre-wrap">wrap</span>';
        $renderCode .= '<pre class="debugger'. $darkClass . '">';
        $renderCode .= htmlspecialchars($code);
        $renderCode .= '</pre>';
        $renderCode .= '</span>';

        return $renderCode;
    }

    /**
     * Returns the JSON passed in wrapped within a <pre> tag.
     * @param  string $content The code you want to render
     * @param  boolean $dark Do you want the dark theme?
     * @return string The HTML to render
     */
    public function renderJson($json, $dark = true)
    {
        if (is_object($json)) {
            $jsonCode = json_encode($json, JSON_PRETTY_PRINT);
        } else if (is_array($json)) {
            $jsonCode = json_encode(($json) ? $json : (object) $json, JSON_PRETTY_PRINT);
        } else {
            $jsonCode = json_encode(json_decode($json), JSON_PRETTY_PRINT);
        }
        return $this->renderCode($jsonCode, $dark);
    }

    /**
     * Returns a rendered debug_backtrace.
     * @param array $debug_backtrace
     * @return string
     */
    public function renderTrace($debug_backtrace)
    {
        $renderTrace = '';
        $renderTrace .= '<span class="fs-label">';
        foreach ($debug_backtrace as $index => $trace) {
            $renderTrace .= '#' . $index . ' ';
            if (!empty($trace['file'])) {
                $renderTrace .= $trace['file'];
            }
            if (!empty($trace['line'])) {
                $renderTrace .= '(' . $trace['line'] . ') ';
            }
            if (!empty($trace['class'])) {
                $renderTrace .= $trace['class'] . '::';
            }
            $renderTrace .= $trace['function'] . '()'
                . '<br>';
        }
        $renderTrace .= '</span>';
        return $renderTrace;
    }

    /**
     * Renders the panel.
     * @return void
     */
    public function render()
    {
        ob_start();
        include __DIR__ . '/panel-top.phtml';
        include $this->_template;
        include __DIR__ . '/panel-bottom.phtml';
        ob_end_flush();
    }
}
