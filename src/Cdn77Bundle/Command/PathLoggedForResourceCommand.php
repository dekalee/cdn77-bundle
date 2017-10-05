<?php

namespace Dekalee\Cdn77Bundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PathLoggedForResourceCommand
 */
class PathLoggedForResourceCommand extends ContainerAwareCommand
{
    /**
     * Configure the command
     */
    protected function configure()
    {
        $this
            ->setName('dekalee:cdn77:path-logged-for-resource')
            ->setDescription('Get all the path stored in the log for a resource')
            ->addOption('resource', null, InputOption::VALUE_REQUIRED, 'The resource to get the log from')
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

        $logs = $this->getContainer()->get('dekalee_cdn77.query.resource_log')->execute($ressource);

        $output->writeln('List of file in the log');

        foreach ($logs as $log) {
            $output->writeln($log['path']);
        }
    }
}
