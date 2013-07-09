<?php

namespace ikerib\CBRSortzailea\Console\Command;

use Symfony\Component\Console\Command\Command,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputOption;

class KonprimituCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('sortu')
            ->setDescription('CBR fitxategia sortuko du.')
            ->addArgument('nora', InputArgument::OPTIONAL, 'The destination location.')
            ->addArgument('nondik', InputArgument::OPTIONAL, 'The destination location.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = "zip -r -X %s %s";

        $nora = $input->getArgument('nora');
        $nondik = $input->getArgument('nondik');

        if (!isset($nora)) {
            $nora = getcwd()."/";
            $izena =basename($nora).".cbr";
            $nora = $nora . $izena;
        }

        if(!isset($nondik))
        {
            $nondik = getcwd() . "/*.jpg";
        }
        echo "\n";
        echo "nondik: ";
        echo $nondik;
        echo "\n";
        echo "nora: ";
        echo $nora;
        echo "\n";
        echo "------------------";
        echo "\n";

        system( sprintf( $command, $nora, $nondik));   
    }
}