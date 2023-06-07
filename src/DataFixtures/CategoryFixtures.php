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
                ->setText($this->faker->words(2, true))
                ->setNo('123')
                ->setParentID('2');

            if ($this->faker->boolean(60)) {
                $category->setPublishedAt(new \DateTimeImmutable(sprintf('-%d days', rand(0, 50))))
                    ->setCategory($category);

            }

            for($i = 1; $i < 29; $i++){
                $products = (new Products())
                    ->setName($this->faker->words(2, true))
                    ->setCategory($category)
                    ->setImg($this->faker->imageUrl(210, 210, 'Notebook', true))
                    ->setPublishedAt(new \DateTimeImmutable(sprintf('-%d days', rand(0, 50))))
                    ->setDescription($this->faker->words(2, true))
                    ->setPrice($this->faker->numberBetween(300, 9000));
                $manager->persist($products);
            }

        });
    }
}
