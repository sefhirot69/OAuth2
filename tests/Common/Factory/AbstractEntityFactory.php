<?php

declare(strict_types=1);

namespace App\Tests\Common\Factory;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractEntityFactory
{
    protected $faker;
    private array $attributeSet = [];

    public function __construct(protected readonly EntityManagerInterface $entityManager)
    {
        $this->faker = MotherFactory::random();
        $this->setDefaults();
    }

    public function create(): object
    {
        $class  = static::getClass();
        $entity = new $class(...$this->getAttributes());
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    /**
     * @param int $total
     *
     * @throws \Exception
     *
     * @return ArrayCollection
     */
    public function createMany(int $total = 1): ArrayCollection
    {
        $arrayCollection = new ArrayCollection();

        for ($i = 0; $i < $total; ++$i) {
            $this->setDefaults();
            $entity = $this->create();
            $this->entityManager->persist($entity);
            $arrayCollection->add($entity);
        }
        $this->entityManager->flush();

        return $arrayCollection;
    }

    public function withAttribute(array $attributes = []): self
    {
        $this->setAttributeSet(array_merge($this->getAttributes(), $attributes));

        return $this;
    }

    abstract protected function setDefaults(): void;

    abstract protected static function getClass(): string;

    protected function setAttributeSet(array $attributeSet): void
    {
        $this->attributeSet = $attributeSet;
    }

    /**
     * @return array
     */
    private function getAttributes(): array
    {
        return $this->attributeSet;
    }
}
