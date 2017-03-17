<?php

namespace Dekalee\Cdn77Bundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PurgeAllCacheCommand
 */
class PurgeAllCacheCommand extends ContainerAwareCommand
{
    /**
     * Configure the command
     */
    protected function configure()
    {
        $this
            ->setName('dekalee:cdn77:purge')
            ->setDescription('Purge some cache from cdn77')
            ->addOption('resource', null, InputOption::VALUE_OPTIONAL, 'If you want to purge only one resource')
            ->addOption('file', null, InputOption::VALUE_OPTIONAL, 'If you want to purge only the cache for one file')
        ;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $ressource = $input->getOption('resource');

        if ($file = $input->getOption('file')) {
            $this->getContainer()->get('dekalee_cdn77.query.purge_file')->execute($ressource, [$file]);
        } else {
            $this->getContainer()->get('dekalee_cdn77.query.purge_all')->execute($ressource);
        }

        $output->writeln('Purge query send');
    }

}
