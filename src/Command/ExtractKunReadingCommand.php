<?php

namespace App\Command;

use App\Entity\Kanji;
use App\Kanji\JishoExtractor;
use App\Repository\KanjiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ExtractKunReadingCommand extends Command
{
    protected static $defaultName = 'app:kanji:extractKunReading';

    public function __construct(
        protected KanjiRepository $repository,
        protected EntityManagerInterface $em,
    )
    {
        parent::__construct(self::$defaultName);
    }

    protected function configure()
    {
        $this
            ->setDescription('Populate the kun example colon of kanji table')
            ->addArgument('limit', InputArgument::OPTIONAL, 'How many kanjis to populate in one go');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $kanjis = $this->repository->findNoKunExample($input->getArgument('limit') ?? 50);
        $io->progressStart(count($kanjis));

        /**
         * @var Kanji $kanji
         */
        foreach ($kanjis as $kanji) {
            $kanji->generateKunExample();
            $io->progressAdvance();
        }

        $this->em->flush();
        $io->progressFinish();
        $io->success('All the kanjis have Kun examples now!');

        return Command::SUCCESS;
    }
}
