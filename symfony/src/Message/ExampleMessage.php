<?php

namespace App\Message;

class ExampleMessage
{
    private $id;

    private $context;

    /**
     * ExampleMessage constructor.
     *
     * @param int   $id
     * @param array $context
     */
    public function __construct(int $id, array $context = [])
    {
        $this->id = $id;
        $this->context = $context;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getContext(): array
    {
        return $this->context;
    }
}
