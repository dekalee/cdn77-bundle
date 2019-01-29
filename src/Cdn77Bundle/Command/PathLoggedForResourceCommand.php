<?php

namespace Dekalee\Cdn77Bundle\Command;

use Dekalee\Cdn77\Query\ResourceLogQuery;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PathLoggedForResourceCommand
 */
class PathLoggedForResourceCommand extends Command
{
    protected $resourceLogQuery;

    /**
     * @param ResourceLogQuery $resourceLogQuery
     */
    public function __construct(ResourceLogQuery $resourceLogQuery)
    {
        parent::__construct();
        $this->resourceLogQuery = $resourceLogQuery;
    }


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

        $logs = $this->resourceLogQuery->execute($ressource);

        $output->writeln('List of file in the log');

        foreach ($logs as $log) {
            $output->writeln($log['path']);
        }
    }
}
