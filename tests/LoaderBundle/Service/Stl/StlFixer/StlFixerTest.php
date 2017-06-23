<?php

namespace Tests\AppBundle\Service\Stl;

use LoaderBundle\Service\Stl\StlConverterService;
use LoaderBundle\Service\Stl\StlFixerService;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemInterface;
use PHPUnit\Framework\TestCase;
use Tests\AppBundle\BaseTest;

class StlFixer extends BaseTest
{
    /** @var StlFixerService */
    protected $stlFixer;

    protected $input;

    public function setUp()
    {
        parent::setUp();

        $this->stlFixer = new StlFixerService($this->getParameter('admesh_bin'));
        $this->input = __DIR__ . '/fixtures/ascii.stl';
    }

    public function tearDown()
    {
        $this->filesystem->delete('output.stl');
    }

    public function testFixing()
    {
        $this->stlFixer->fix($this->input,$this->filesystem->getAdapter()->getPathPrefix().'/output.stl');

        $this->assertTrue($this->filesystem->has('output.stl'));
    }
}