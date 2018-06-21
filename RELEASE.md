# Release Changes
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

**Steps To Create Release**

1. Make sure all code is commented out in `demo/standard.php`
2. Add version changes to `RELEASE.md`.
3. Update release version in `composer.json`.
4. Run `composer run build` to generate the new documentation for the updates and to run unit tests.
5. Merge changes to master branch and push master branch changes upstream.
6. Create git tag with release version: `git tag X.X.X`
7. Push new git tag upstream.
