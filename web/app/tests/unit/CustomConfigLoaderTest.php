<?php

namespace Tests\Unit;

use Illuminate\Config\Repository;
use PHPUnit\Framework\TestCase;
use Services\Config\CustomConfigLoader;


class CustomConfigLoaderTest extends TestCase
{

    public function setup()
    {

        require_once __DIR__ . '/../../themes/odl/vendor/autoload.php';
        require_once __DIR__ . '/../mocks/app.php';

    }

    /**
     * @test
     */
    public function must_return_a_repository_class()
    {

        $config = (new CustomConfigLoader())->mergeFile(
            'view',
            '/srv/www/odl/site/web/app/tests/mocks/view.php'
        );


        $this->assertInstanceOf(Repository::class, $config);

    }

    /**
     * @test
     */
    public function returns_three_paths()
    {

        $config = (new CustomConfigLoader())->mergeFile(
            'view',
            '/srv/www/odl/site/web/app/tests/mocks/view.php'
        );

        $this->assertCount(3, $config->get('view.paths'));

    }

    /**
     * @test
     */
    public function throws_exception_if_missing_first_parameter()
    {

        $this->expectException(\Exception::class);

        $config = (new CustomConfigLoader())->mergeFile(
            null,
            '/srv/www/odl/site/web/app/tests/mocks/view.php'
        );

    }

}

