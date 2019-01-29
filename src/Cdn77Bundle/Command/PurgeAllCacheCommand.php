<?php

namespace Dekalee\Cdn77Bundle\Command;

use Dekalee\Cdn77\Query\PurgeAllQuery;
use Dekalee\Cdn77\Query\PurgeFileQuery;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PurgeAllCacheCommand
 */
class PurgeAllCacheCommand extends Command
{
    protected $purgeFileQuery;
    protected $purgeAllQuery;

    /**
     * @param PurgeFileQuery $purgeFileQuery
     * @param PurgeAllQuery  $purgeAllQuery
     */
    public function __construct(PurgeFileQuery $purgeFileQuery, PurgeAllQuery $purgeAllQuery)
    {
        parent::__construct();
        $this->purgeFileQuery = $purgeFileQuery;
        $this->purgeAllQuery = $purgeAllQuery;
    }


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
            $this->purgeFileQuery->execute($ressource, [$file]);
        } else {
            $this->purgeAllQuery->execute($ressource);
        }

        $output->writeln('Purge query send');
    }

}
