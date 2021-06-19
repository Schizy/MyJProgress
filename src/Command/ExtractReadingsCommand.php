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

class ExtractReadingsCommand extends Command
{
    protected static $defaultName = 'app:kanji:extractReadings';

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
            ->setDescription('Populate the reading colons of kanji table')
            ->addArgument('limit', InputArgument::OPTIONAL, 'How many kanjis to populate in one go');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $kanjis = $this->repository->findNoReadings($input->getArgument('limit') ?? 50);
        $io->progressStart(count($kanjis));

        // 1. récupérer la liste de kunyomi et la liste de onyomi
        // 2. stocker le premier kun en remplacant ce qu'il y a avant le point par le kanji ( くる.しい)
        // 3. récupérer le premier mot common qui utilise le ON (苦 く #common)
        // 4. garder la liste complète des kun et on, mettre les examples dans des champs à part (exempleKun, exempleOn)

        /**
         * @var Kanji $kanji
         */
        foreach ($kanjis as $i => $kanji) {
            $readings = JishoExtractor::getReadings($kanji->getKanji());

            $kanji
                ->setKunyomi(explode(";", $readings['kun']))
                ->setOnyomi(explode(";", $readings['on']));

            if ($i % 10 == 0) {
                $this->em->flush();
            }
            $io->progressAdvance();
        }

        $this->em->flush();
        $io->progressFinish();
        $io->success('All the kanjis have readings now!');

        return Command::SUCCESS;
    }
}
