<?php

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Compilers\BladeCompiler;

require_once __DIR__ . '/../vendor/autoload.php';

$container = new Container();
$events = new Dispatcher($container);

$viewsPath = __DIR__ . '/../app/Views';
$cachePath = __DIR__ . '/../cache/views';

$filesystem = new Filesystem();

$resolver = new EngineResolver();
$resolver->register('php', fn () => new PhpEngine($filesystem));
$resolver->register('blade', fn () => new CompilerEngine(
    new BladeCompiler($filesystem, $cachePath)
));

$finder = new FileViewFinder($filesystem, [$viewsPath]);

$view = new Factory($resolver, $finder, $events);

return $view;
