<?php

namespace App\Command;

use App\Entity\User;
use League\Csv\Reader;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CsvImportCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure()
    {
        $this->setName('csv:import')
            ->setDescription('Import a list_adherents_pmt csv file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Attempting to import the feed');

        $csv = Reader::createFromPath('%kernel.root_dir%/../src/Data/list_adherents_pmt.csv');
        $csv->setHeaderOffset(0);

        $records = $csv->getRecords();

        foreach ($records as $row) {
            $user = (new User())
                ->setFirstname($row['firstname'])
                ->setLastname($row['lastname'])
                ->setEmail($row['email']);

            $this->em->persist($user);
        }
        $this->em->flush();

        $io->success('Everything went well!');
    }
}