<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 08/11/2018
 * Time: 12:00
 */

namespace Services\Bootstrap;

use Roots\Sage\Container;
use Services\Cache\Cache;
use Services\Config\CustomConfigLoader;
use Services\Contracts\BootableInterface;
use Services\LsDb\LsDb;
use Services\Support\SessionServiceProvider;


/**
 * Class App
 * @package Services\Bootstrap
 */
class App
{

    /**
     * @var mixed|string
     */
    protected $theme_file_path = '';

    /**
     * App constructor.
     *
     */
    public function __construct()
    {

        $this->theme_file_path = $this->getThemePath();

    }

    /**
     *
     */
    public function boot()
    {

        $this->loadCustomConfig();

        (new SessionServiceProvider())->register();

        $this->bindServices();

        $this->loadComponents();

        $this->loadClasses();

        $this->loadPostTypes();

        Container::getInstance()
            ->bindIf("cache", function () {
                return (new Cache("127.0.0.1", 11211))->setPrefix("");
            }, true);

        Container::getInstance()
            ->bindIf("database", function () {
                return LsDb::instance();
            }, true);

    }

    /**
     * @return string
     */
    public function getThemePath()
    {

        return \App\sage('config')['theme.dir'];

    }

    /**
     * @return array
     */
    public function getComponentsToLoad(): array
    {

        return \App\sage('config')['components'];

    }

    /**
     * @return array
     */
    public function getClassesToLoad(): array
    {

        return \App\sage('config')['classes'];

    }

    /**
     * @return array
     */
    public function getControllersToLoad(): array
    {

        return \App\sage('config')['controllers'];

    }

    /**
     * @return array
     */
    public function getProvidersToLoad(): array
    {

        return \App\sage('config')['providers'];

    }

    /**
     * @return array
     */
    public function getPostTypesToLoad(): array
    {

        return \App\sage('config')['posttypes'];

    }

    /**
     *
     */
    public function loadCustomConfig(): void
    {

        $files = require $this->theme_file_path . '/Src/Config/filestoload.php';

        array_map(function($config_file_key) {

            $this->loadCustomConfigFile($config_file_key);

        }, $files);

        //TODO Make this scan the directory to pull in all config files.

    }

    /**
     * @param $key
     */
    public function loadCustomConfigFile($key)
    {

        (new CustomConfigLoader())->mergeFile(
            $key,
            $this->theme_file_path . '/Src/Config/'.$key.'.php'
        );

    }

    /**
     *
     */
    private function loadComponents()
    {
        array_map(function($component) {

            if (method_exists($this, $component))
            {

                return $this->$component();

            }
            else if (class_exists($component)) {

                $this->bootComponent(new $component);

            }
            else
            {

                throw new \Exception('Invalid component loaded on boot - ' . $component);

            }

        }, $this->getComponentsToLoad());

    }

    /**
     *
     */
    private function bindServices()
    {

        foreach ($this->getProvidersToLoad() as $key => $class) {

            Container::getInstance()
                ->bindIf($key, function () use ($class) {
                    return new $class;
                }, true);

        }

    }

    /**
     * @param BootableInterface $component
     * @return mixed
     */
    private function bootComponent(BootableInterface $component)
    {

        return $component->boot();

    }

    /**
     * @param $path
     * @param $attr
     * @return mixed
     */
    public function loadBlock($path, $attr)
    {

        $path = "App\\Elements\\".$path."\\".$path;

        return new $path($attr);

    }

    /**
     *
     */
    public function loadPostTypes()
    {

        foreach ($this->getPostTypesToLoad() as $posttype) {

            new $posttype();

        }

    }

    /**
     *
     */
    public function loadClasses()
    {

        foreach ($this->getClassesToLoad() as $classname) {

            new $classname();

        }

    }

}
