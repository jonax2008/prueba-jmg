<?php

namespace App\Shared\Domain\Event;

interface EventHandlerInterface
{
    public function handle(object $event): void;
}
