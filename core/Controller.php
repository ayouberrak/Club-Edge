<?php

namespace Core;

class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = require __DIR__ . '/../bootstrap/blade.php';

        // base_url (global)
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $dir = dirname($scriptName);
        $dir = str_replace('\\', '/', $dir);
        if ($dir === '/') $dir = '';

        $this->view->share('base_url', $dir);

        $this->helperUrl();
    }

    protected function render(string $view, array $data = [])
    {
        echo $this->view->make($view, $data)->render();
    }

    protected function helperUrl()
    {
        $this->view->getEngineResolver()
            ->resolve('blade')
            ->getCompiler()
            ->directive('url', function ($expression) {
                return "<?php echo \\Core\\Helpers::url($expression); ?>";
            });
    }
}
