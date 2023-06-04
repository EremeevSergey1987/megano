<?php
namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Products;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager): void
    {
        $this->faker = Factory::create();
        $this->createMany(Category::class, 10, function (Category $category) use ($manager)
        {
            $category
                ->setName($this->faker->words(2, true))
                ->setText($this->faker->paragraphs(1, true))
                ->setNo('123');
            if ($this->faker->boolean(60)) {
                $category->setPublishedAt(new \DateTimeImmutable(sprintf('-%d days', rand(0, 50))))
                    ->setCategory($category);

            }
            $products = (new Products())
                ->setName($this->faker->words(2, true))
                ->setCategory($category)
                ->setSlug($this->faker->words(2, true))
                ->setImg('img.jpg')
                ->setPublishedAt(new \DateTimeImmutable(sprintf('-%d days', rand(0, 50))))
                ->setDescription($this->faker->words(2, true));
            $manager->persist($products);

            $products = (new Products())
                ->setName($this->faker->words(2, true))
                ->setCategory($category)
                ->setSlug($this->faker->words(2, true))
                ->setImg('img.jpg')
                ->setPublishedAt(new \DateTimeImmutable(sprintf('-%d days', rand(0, 50))))
                ->setDescription($this->faker->words(2, true));
            $manager->persist($products);

            $products = (new Products())
                ->setName($this->faker->words(2, true))
                ->setCategory($category)
                ->setSlug($this->faker->words(2, true))
                ->setImg('img.jpg')
                ->setPublishedAt(new \DateTimeImmutable(sprintf('-%d days', rand(0, 50))))
                ->setDescription($this->faker->words(2, true));
            $manager->persist($products);

        });
    }
}
