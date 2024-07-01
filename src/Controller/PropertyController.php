<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class PropertyController extends AbstractController
{
    private $entityManager;
    private $propertyRepository;
    private $slugger;

    public function __construct(EntityManagerInterface $entityManager, PropertyRepository $propertyRepository, SluggerInterface $slugger)
    {
        $this->entityManager = $entityManager;
        $this->propertyRepository = $propertyRepository;
        $this->slugger = $slugger;
    }

    #[Route('/properties', name: 'app_property')]
    public function index(): Response
    {
        // Fetch all visible properties
        $properties = $this->propertyRepository->findAllVisible();
        dump($properties);

        return $this->render('property/index.html.twig', [
            'controller_name' => 'PropertyController',
            'properties' => $properties,
        ]);
    }

    #[Route('/add-property', name: 'app_add_property')]
    public function addProperty(): Response
    {
        // Create a new property
        $property = new Property();
        $property->setTitle('New Property')
                 ->setDescription('Description of the new property')
                 ->setSurface(1000)
                 ->setRooms(10)
                 ->setBedrooms(5)
                 ->setFloor(1)
                 ->setCity('New City')
                 ->setAddress('123 New Street')
                 ->setPostalCode('00000')
                 ->setCountry('New Country')
                 ->setParking(2)
                 ->setStatus(1)
                 ->setType(1)
                 ->setPrice(500000);

        // Generate a slug for the property title
        $slug = (string) $this->slugger->slug($property->getTitle())->lower();
        $property->setSlug($slug);

        // Persist the property to the database
        $this->entityManager->persist($property);
        $this->entityManager->flush();

        return new Response('Property added successfully.');
    }

    #[Route('/biens/{slug}-{id<[0-9]+>}', name: 'app_property_show', requirements: ["slug" => "[a-z0-9\-]*"])]
    public function show(Property $property, string $slug): Response
    {
        if ($property->getSlug() !== $slug) {
            return $this->redirectToRoute('app_property_show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug(),
            ], 301);
        }

        return $this->render('property/show.html.twig', [
            'property' => $property,
        ]);
    }
}







