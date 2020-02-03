# Release Changes

* 2.2.0
    * Added the ability to configure the order in which panels would be displayed. ie Bug::setPanelOrder().
* 2.1.0
    * Update the render method logic in the debugger panel to use $this->name instead of self::NAME.
    * Add the panel ID as a class to the HTML markup of the debug panel.
    * Added new escape method to panels that allows you to escape variables being echoed on the view.
* 2.0.0
    * Added UA1Labs to namespace
    * Bring code base up to PSR-2 compliance
    * Pull in FireTest 2.0 and update broken tests
