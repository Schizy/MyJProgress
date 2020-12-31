<?php

namespace App\Command;

use App\Entity\Example;
use App\Message\ExampleMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

class DispatchExamplesCommand extends Command
{
    protected static $defaultName = 'app:dispatch-examples';

    private $bus;

    private $exampleRepository;

    public function __construct(EntityManagerInterface $em, MessageBusInterface $bus)
    {
        $this->bus = $bus;
        $this->exampleRepository = $em->getRepository(Example::class);

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Select all examples with "pending" state and dispatch ExampleMessages again')
            ->addArgument('limit', InputArgument::OPTIONAL, 'Limit for the select');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if ($input->getOption('verbose')) {
            $io->note('verbose mode 発動!!!');
        }

        if ($limit = $input->getArgument('limit')) {
            $io->note(sprintf('Select only %s examples', $limit));
        }

        if ($examples = $this->exampleRepository->getByState(Example::PENDING, $limit)) {
            $io->progressStart(count($examples));
            foreach ($examples as $example) {
                $io->progressAdvance(1);

                sleep(1);

                if ($io->isVerbose()) {
                    $io->comment('Example with ID #'.$example->getId().'('.$example->getPhrase().') dispatched.');
                }

                $this->bus->dispatch(new ExampleMessage($example->getId(), ['from' => 'console']));
            }

            $io->progressFinish();
        }

        $io->success(count($examples).' pending examples were dispatched again!');

        return Command::SUCCESS;
    }
}
