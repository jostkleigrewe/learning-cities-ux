<?php

namespace App\Tests\Controller;

use App\Entity\Place;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PlaceControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $placeRepository;
    private string $path = '/place/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->placeRepository = $this->manager->getRepository(Place::class);

        foreach ($this->placeRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Place index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'place[name]' => 'Testing',
            'place[slug]' => 'Testing',
            'place[category]' => 'Testing',
            'place[address]' => 'Testing',
            'place[latitude]' => 'Testing',
            'place[longitude]' => 'Testing',
            'place[district]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->placeRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Place();
        $fixture->setName('My Title');
        $fixture->setSlug('My Title');
        $fixture->setCategory('My Title');
        $fixture->setAddress('My Title');
        $fixture->setLatitude('My Title');
        $fixture->setLongitude('My Title');
        $fixture->setDistrict('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Place');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Place();
        $fixture->setName('Value');
        $fixture->setSlug('Value');
        $fixture->setCategory('Value');
        $fixture->setAddress('Value');
        $fixture->setLatitude('Value');
        $fixture->setLongitude('Value');
        $fixture->setDistrict('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'place[name]' => 'Something New',
            'place[slug]' => 'Something New',
            'place[category]' => 'Something New',
            'place[address]' => 'Something New',
            'place[latitude]' => 'Something New',
            'place[longitude]' => 'Something New',
            'place[district]' => 'Something New',
        ]);

        self::assertResponseRedirects('/place/');

        $fixture = $this->placeRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getSlug());
        self::assertSame('Something New', $fixture[0]->getCategory());
        self::assertSame('Something New', $fixture[0]->getAddress());
        self::assertSame('Something New', $fixture[0]->getLatitude());
        self::assertSame('Something New', $fixture[0]->getLongitude());
        self::assertSame('Something New', $fixture[0]->getDistrict());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Place();
        $fixture->setName('Value');
        $fixture->setSlug('Value');
        $fixture->setCategory('Value');
        $fixture->setAddress('Value');
        $fixture->setLatitude('Value');
        $fixture->setLongitude('Value');
        $fixture->setDistrict('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/place/');
        self::assertSame(0, $this->placeRepository->count([]));
    }
}
