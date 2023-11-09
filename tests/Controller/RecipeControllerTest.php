<?php

namespace App\Test\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RecipeControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private RecipeRepository $repository;
    private string $path = '/recipe/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Recipe::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Recipe index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'recipe[title]' => 'Testing',
            'recipe[category]' => 'Testing',
            'recipe[diet_type]' => 'Testing',
            'recipe[serving]' => 'Testing',
            'recipe[prep_time]' => 'Testing',
            'recipe[cook_time]' => 'Testing',
            'recipe[instructions]' => 'Testing',
            'recipe[image_url]' => 'Testing',
            'recipe[season]' => 'Testing',
        ]);

        self::assertResponseRedirects('/recipe/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Recipe();
        $fixture->setTitle('My Title');
        $fixture->setCategory('My Title');
        $fixture->setDiet_type('My Title');
        $fixture->setServing('My Title');
        $fixture->setPrep_time('My Title');
        $fixture->setCook_time('My Title');
        $fixture->setInstructions('My Title');
        $fixture->setImage_url('My Title');
        $fixture->setSeason('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Recipe');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Recipe();
        $fixture->setTitle('My Title');
        $fixture->setCategory('My Title');
        $fixture->setDiet_type('My Title');
        $fixture->setServing('My Title');
        $fixture->setPrep_time('My Title');
        $fixture->setCook_time('My Title');
        $fixture->setInstructions('My Title');
        $fixture->setImage_url('My Title');
        $fixture->setSeason('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'recipe[title]' => 'Something New',
            'recipe[category]' => 'Something New',
            'recipe[diet_type]' => 'Something New',
            'recipe[serving]' => 'Something New',
            'recipe[prep_time]' => 'Something New',
            'recipe[cook_time]' => 'Something New',
            'recipe[instructions]' => 'Something New',
            'recipe[image_url]' => 'Something New',
            'recipe[season]' => 'Something New',
        ]);

        self::assertResponseRedirects('/recipe/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getCategory());
        self::assertSame('Something New', $fixture[0]->getDiet_type());
        self::assertSame('Something New', $fixture[0]->getServing());
        self::assertSame('Something New', $fixture[0]->getPrep_time());
        self::assertSame('Something New', $fixture[0]->getCook_time());
        self::assertSame('Something New', $fixture[0]->getInstructions());
        self::assertSame('Something New', $fixture[0]->getImage_url());
        self::assertSame('Something New', $fixture[0]->getSeason());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Recipe();
        $fixture->setTitle('My Title');
        $fixture->setCategory('My Title');
        $fixture->setDiet_type('My Title');
        $fixture->setServing('My Title');
        $fixture->setPrep_time('My Title');
        $fixture->setCook_time('My Title');
        $fixture->setInstructions('My Title');
        $fixture->setImage_url('My Title');
        $fixture->setSeason('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/recipe/');
    }
}
