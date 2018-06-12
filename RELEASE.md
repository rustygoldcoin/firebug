# Release Changes
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
