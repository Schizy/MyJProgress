<?php

namespace App\Command;

use App\Kanji\JishoExtractor;
use App\Repository\KanjiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ExtractCommonStatCommand extends Command
{
    protected static $defaultName = 'app:kanji:extractCommon';

    public function __construct(
        protected KanjiRepository $repository,
        protected EntityManagerInterface $em,
    ) {
        parent::__construct(self::$defaultName);
    }

    protected function configure()
    {
        $this
            ->setDescription('Populate the commonStat colon of kanji table')
            ->addArgument('limit', InputArgument::OPTIONAL, 'How many kanjis to populate in one go');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $limit = $input->getArgument('limit');

        foreach ($this->repository->findNullCommonStat($limit ?? 50) as $i => $kanji) {
            $common = JishoExtractor::getCommonCount($kanji->getKanji());
            $kanji->setCommonStat($common);

            if ($i % 10 == 0) {
                $this->em->flush();
            }
        }

        $this->em->flush();

        $io->success('All the kanjis have a commonStat now!');

        return Command::SUCCESS;
    }
}
