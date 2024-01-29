<?php

declare(strict_types=1);

namespace App\Auth\Credential\Domain;

final class Scopes
{
    private function __construct(
        private array $items
    ) {
    }

    public function __toString(): string
    {
        return implode(' ', $this->toPrimitives());
    }

    public static function fromArray(array $items): self
    {
        $result = new self([]);

        foreach ($items as $item) {
            $scope = Scope::tryFrom($item);
            if (!$scope instanceof Scope) {
                throw new \InvalidArgumentException('Scope is invalid');
            }
            $result = $result->add($scope);
        }

        return $result;
    }

    /**
     * @return array<int, string>
     */
    public function toPrimitives(): array
    {
        return array_map(
            fn (Scope $scope) => $scope->value,
            $this->getItems()
        );
    }

    public function add(Scope $item): self
    {
        $items   = $this->items;
        $items[] = $item;

        return new self($items);
    }

    /**
     * @param array<int, Scope> $items
     *
     * @return self
     */
    public static function create(array $items): self
    {
        return new self($items);
    }

    public function remove(mixed $item): self
    {
        $items = $this->items;
        $key   = array_search($item, $items, true);
        if (false !== $key) {
            unset($items[$key]);
        }

        return new self($items);
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    public function clear(): void
    {
        $this->items = [];
    }
}
