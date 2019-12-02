# Release Changes

* 2.1.0
    * Update the render method logic in the debugger panel to use $this->name instead of self::NAME.
    * Add the panel ID as a class to the HTML markup of the debug panel.
    * Added new escape method to panels that allows you to escape variables being echoed on the view.
* 2.0.0
    * Added UA1Labs to namespace
    * Bring code base up to PSR-2 compliance
    * Pull in FireTest 2.0 and update broken tests
* 1.8.1
    * Fix renderCode() so that it doesn't call htmlspecialchars() on entire panel.
* 1.8.0
    * Remove renderHtml() and update renderCode() to use htmlspecialchars() around the code.
    * Update debugger(debug, exit = false) to use exitNow to allow a user to render the debug panel and exit the execution.
* 1.7.2
    * Update the debugger.phtml panel to use the new rendering helpers.
* 1.7.1
    * Fix issue with all pre's being 200px
* 1.7.0
    * For pre tags, add max-height and functionality to reveal entire code.
    * Fix font-weight issues for p tags within panels.
* 1.6.1
    * Adjust CSS to target font-weight: normal for all elements in panel.
* 1.6.0
    * Add ability to renderSeparator() and renderLabel() within a panel.
* 1.5.0
    * Add ability to renderJson() which takes either and object or a json string and renders it within a <pre> tag.
    * Add ability to renderHtml() which takes string html and renders it within a <pre> tag.
    * Add ability to renderCode() which takes string of code and renders it within a <pre> tag.
* 1.4.2
    * Add style for fs-hr-dotted hr classes.
* 1.4.1
    * Updates to documentation
* 1.4.0
    * Update the debugger.phtml panel to use new renderTrace() helper method to render the trace for each debugger.
    * Remove the $echo parameter option from Fire\Bug::render method. By default this method will now return the rendered panel by default.
* 1.3.0
    * Add renderTrace() helper method to render a standard debug_backtrace() within a panel phtml template.
* 1.2.0
    * Remove composer.lock as it is not needed because this is a library.
    * Add overflow-x css rule for fs-content to allow tables to be scrollable. .fs-debug-panel .fs-section .fs-content overflow-x: scroll
* 1.1.1
    * Fix issue where we couldn't see load time on debug panel.
* 1.1.0
    * Stronger style selectors so that website styles don't overwrite panel styles.
    * Remove any instance where we are trying to set a constant using the __DIR__ magic variable. ex: const MYCONSTANT = __DIR__ . '/path.php'
    * On view/panels/debugger.phtml, add logic to check if $trace['file'] and $trace['line'] are not empty.
    * Add "Steps To Create Release" to RELEASE.md
    * On Fire\Bug::render(), allow a developer to pass in a parameter that determines if we should return the HTML or echo it.
    * The count of the number of debuggers in the debugger accordion. example: Debuggers (12)
    * Add hr styles for panel to include styles margin: 25px 0; color: #464646; border-top: 2px dashed; background-color: #f0f0f0;.
    * Add hr separator between debuggers.
* 1.0.0
    * Initial Release
