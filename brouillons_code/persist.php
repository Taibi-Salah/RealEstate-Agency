$property1 = new Property();
        $property1->setTitle('Cose Appartement')
                 ->setDescription('Description de mon bien 1')
                 ->setSurface(600)
                 ->setRooms(9)
                 ->setBedrooms(6)
                 ->setFloor(2)
                 ->setCity('Paris')
                 ->setAddress('Cathédrale Notre-Dame de Paris')
                 ->setPostalCode('75001')
                 ->setParking(4)
                 ->setStatus(1)
                 ->setType(1)
                 ->setPrice(8000000);

        // Persist the first property
        $this->entityManager->persist($property1);

        // Create the second property
        $property2 = new Property();
        $property2->setTitle('Luxury Villa')
                 ->setDescription('Beautiful luxury villa in Los Angeles with stunning ocean views.')
                 ->setSurface(1200)
                 ->setRooms(12)
                 ->setBedrooms(8)
                 ->setFloor(3)
                 ->setCity('Los Angeles')
                 ->setAddress('123 Beverly Hills')
                 ->setPostalCode('90210')
                 ->setParking(6)
                 ->setStatus(1) 
                 ->setType(0) 
                 ->setPrice(15000000);

        // Persist the second property
        $this->entityManager->persist($property2);

        // Create the third property
        $property3 = new Property();
        $property3->setTitle('Modern Duplex')
               ->setDescription('Spacious modern duplex in the heart of Dubai with skyline views.')
               ->setSurface(800)
               ->setRooms(10)
               ->setBedrooms(5)
               ->setFloor(2)
               ->setCity('Dubai')
               ->setAddress('456 Dubai Marina')
               ->setPostalCode('00000') // Assuming a placeholder postal code for Dubai
               ->setParking(2)
               ->setStatus(1) // Assuming status 1 means 'available' or similar
               ->setType(2) // Assuming type 2 means 'duplex' or similar
               ->setPrice(2000000); // $2,000,000

        // Persist the third property
        $this->entityManager->persist($property3);

        // Flush all changes to the database
        $this->entityManager->flush();