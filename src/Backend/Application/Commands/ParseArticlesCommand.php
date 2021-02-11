<?php

namespace App\Backend\Application\Commands;

use Symfony\Component\Console\Command\Command;
use App\Parser\Item\Application\Services\Parser;
use App\Parser\Item\Domain\Contracts\ServiceParserInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Parser\Site\Domain\Repository\SiteRepositoryInterface;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class ParseArticlesCommand extends Command
{
    protected static $defaultName = 'app:parse:articles';

    public function __construct(
        protected ServiceParserInterface $parser,
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
        $this->setDescription('Parse items');

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
            if ($site = $this->repository->findByTitle($input->getArgument('site'))) {
                $this->parser->process($site);
                return Command::SUCCESS;
            }
        } catch (\Throwable $e) {
            $output->writeln($e->getMessage());
            $output->writeln($e->getTraceAsString());
            return Command::FAILURE;
        }
    }
}
