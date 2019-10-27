# FireBug

An expandable PHP debug panel.

The true power of FireBug is that it can easily be added to any project and expanded upon! You can even create your own panels to track whatever data you care about while your going through debugging. FireBug comes featured with a `Debuggers` panel. Which allows you to call `debugger()` anywhere inside of your application. All debuggers will display the entire `debug_trace` along with `var_dump` within the "Debuggers" section of the FireBug Panel.

### Documentation

https://ua1.us/projects/firebug/

### Installation FireBug Using Composer

    composer require ua1-labs/firebug

### Enable FireBug

For performance reasons, firebug is initially disabled and needs enabled in order to use it. Here's how:

    $fireBug = \UA1Labs\Fire\Bug::get();
    $fireBug->enable();

**FireBug Timer**

Once FireBug is enabled, it will start a timer that will report how much time it takes to load your page and return your request. Keep in mind, that times are determined by when you enable FireBug.

### Render FireBug

Once you've installed FireBug, it's time to output it somewhere in your HTML.

    $fireBug = \UA1Labs\Fire\Bug::get();
    echo $fireBug->render();

When rendering out FireBug, it is suggested that you place it the footer of your application.

### Debugger Panel

As mentioned before, FireBug comes bundled with a "Debuggers" panel. This panel allows you to replace your use of `var_dump` and `debug_trace`. When FireBug is installed in your application, all you have to do is call the `debugger(mixed $value);` function and let FireBug do the work. This function can take any value and will simply `var_dump` and `debug_trace` it within the "Debuggers" panel of FireBug.

Example:

    debugger('debug value...');

Debuggers also take a second parameter called `exit`. If you decide you need to exit the execution of any process and render the debug panel at that point in execution, you may do so by passing in true as a second parameter.

Example:

    debugger('debug value...', true);

#### Debugger Panel and X-Debug Overlay

In this project, it was decided to disable x-debug overlay for var_dumps. This makes it easier to read the entire output of debuggers without having to scroll to much left and right. So, if you would like to enable it, here is the code you will want to run when you initize your application.

    $fireBug = \UA1Labs\Fire\Bug::get();
    $debuggerPanel = $fireBug->getPanel(\UA1Labs\Fire\Bug\Panel\Debugger::ID);
    $fireBug->enableXDebugOverlay();

### Creating And Registering Your Own Panel

We've given you everything you need to easily create your own panel.

1. Create your own Panel Class:

        namespace \UA1Labs\Fire\Bug\Panel;

        use \UA1Labs\Fire\Bug\Panel;

        class MyOwnPanel extends Panel
        {
            const ID = 'myOwnPanel';
            const NAME = 'My Own Panel';
            const TEMPLATE = '/path-to/my-own-panel.phtml';

            public $myName;

            public function __construct()
            {
                parent::__construct(self::ID, self::NAME, __DIR__ . self::TEMPLATE);
                $this->myName = 'Testy Testerson';
            }

            public function myInfo()
            {
                return '1 Awesome Dude, Orlando, FL, 32708';
            }
        }

2. Create a panel template file:

        <div class="my-own-panel">
            <?php echo $this->myName; ?>
            <?php echo $this->myInfo(); ?>
        </div>

3. Register Your Panel

        $fireBug = Fire\Bug::get();
        $fireBug->addPanel(new \UA1Labs\Fire\Bug\Panel\MyOwnPanel());

Three easy steps and you just added your own panel to FireBug! Now with that being said, here is some info about how it works behind the scenes. Panels act as ViewModels. In the way that any data or methods you add to the panel object itself will also be available to the template object. In the example panel above you can see that the panel was created with a public property called `myName` and a method `myInfo`. In the template, you can see we are echoing out these values.

### Timer

FireBug also comes bundled with a timer you may use to detect how much time a process takes. Here's how to use the timer:

    $fireBug = Fire\Bug::get();
    //get a start time
    $startTime = $fireBug->timer();
    //get time length in milliseconds
    $timeLength = $fireBug->timer($startTime);