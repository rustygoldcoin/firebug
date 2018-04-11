<?php

namespace Fire\Bug;

class Debugger
{

    private $_message;

    private $_trace;

    public function __construct()
    {
        $this->_message = '';
        $this->_trace = '';
    }

    public function setMessage($message)
    {
        $this->_message = $message;
    }

    public function getMessage()
    {
        return $this->_message;
    }

    public function setTrace($trace)
    {
        $this->_trace = $trace;
    }

    public function getTrace()
    {
        return $this->_trace;
    }

}
