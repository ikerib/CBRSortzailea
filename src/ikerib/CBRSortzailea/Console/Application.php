<?php

namespace ikerib\CBRSortzailea\Console;

use Symfony\Component\Console\Application as BaseApplication;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

use Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface;

use ikerib\CBRSortzailea\Console\Command;
use ikerib\CBRSortzailea\DependencyInjection\CBRSortzaileaExtension,
    ikerib\CBRSortzailea\DependencyInjection\Compiler;

class Application extends BaseApplication
{
    /**
     * @var ContainerBuilder
     */
    protected $container;

    public function __construct()
    {
        parent::__construct('CBRSortzailea', '1.0.0');

        $this->add(new Command\KonprimituCommand());
        $this->add(new Command\CompileCommand());
    }

    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        parent::run();
    }

    /**
     * @return ContainerBuilder
     */
    public function getContainer()
    {
        return $this->container;
    }

}