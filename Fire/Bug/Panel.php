<?php

namespace Fire\Bug;

abstract class Panel
{

    protected $_id;

    protected $_name;

    protected $_template;

    public function __construct($id, $name, $template)
    {
        $this->_id = $id;
        $this->_name = $name;
        $this->_template = $template;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function render()
    {
        ob_start();
        include __DIR__ . '/../../view/partials/panel-top.phtml';
        include $this->_template;
        include __DIR__ . '/../../view/partials/panel-bottom.phtml';
        ob_end_flush();
    }
}
