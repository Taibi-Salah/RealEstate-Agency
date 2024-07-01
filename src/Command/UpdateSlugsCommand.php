<?php

namespace App\Command;

use App\Entity\Property;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\String\Slugger\SluggerInterface;

class UpdateSlugsCommand extends Command
{
    protected static $defaultName = 'app:update-slugs';
    private $entityManager;
    private $slugger;

    public function __construct(EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->slugger = $slugger;
    }

    protected function configure()
    {
        $this
            ->setDescription('Update slugs and countries for existing properties');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $repository = $this->entityManager->getRepository(Property::class);
        $properties = $repository->findAll();
        $existingSlugs = [];

        foreach ($properties as $property) {
            // Update slug
            $slug = (string) $this->slugger->slug($property->getTitle())->lower();
            $originalSlug = $slug;
            $i = 1;

            // Ensure uniqueness of the slug
            while (isset($existingSlugs[$slug]) || $repository->findOneBy(['slug' => $slug])) {
                $slug = $originalSlug . '-' . $i;
                $i++;
            }

            $existingSlugs[$slug] = true;
            $property->setSlug($slug);

            // Set default country if null
            if (!$property->getCountry()) {
                $property->setCountry('Unknown'); // Replace 'Unknown' with a suitable default value
            }

            $this->entityManager->persist($property);
        }

        $this->entityManager->flush();

        $io->success('Slugs and countries updated successfully.');

        return Command::SUCCESS;
    }
}




