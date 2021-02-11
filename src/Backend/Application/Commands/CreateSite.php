<?php

namespace App\Backend\Application\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Parser\Site\Domain\Repository\SiteRepositoryInterface;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class CreateSite extends Command
{
    protected static $defaultName = 'app:create:site';

    /**
     * 
     * @param SiteRepositoryInterface $repository 
     * @return void 
     * @throws InvalidArgumentException 
     */
    public function __construct(
        protected SiteRepositoryInterface $repository) {
        parent::__construct();
    }

    /**
     * Configure command
     *
     * @return void
     */
    protected function configure()
    {
        $this->setDescription('Insert site');

        $this->addArgument('site', InputArgument::REQUIRED, 'Site name');
    }

    /**
     * Execute command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return integer
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->repository->create($input->getArgument('site'));
            return Command::SUCCESS;
        } catch (\Throwable $e) {
            $output->writeln($e->getMessage());
            return Command::FAILURE;
        }
    }
}
