<?php
namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager): void
    {
        $this->faker = Factory::create();
        $this->createMany(Category::class, 10, function (Category $category){
            $category
                ->setName($this->faker->words(2, true))
                ->setText($this->faker->paragraphs(1, true));
            if ($this->faker->boolean(60)) {
                $category->setPublishedAt(new \DateTimeImmutable(sprintf('-%d days', rand(0, 50))))
                    ->setParentID($this->faker->randomDigitNotNull());
            }
        });
    }
}
