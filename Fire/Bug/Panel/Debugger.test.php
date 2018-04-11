<?php

namespace Test\Fire\Bug\Panel;

use Fire\Test\TestCase;

class Debugger extends TestCase {

    public function testThisWorks()
    {
        $this->should('Test should be the next to fire.');
        $this->assert(true);
    }

}
