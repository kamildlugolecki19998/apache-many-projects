<?php

namespace App\Shared\Command;


interface CommandHandlerIntrerface
{
    public function handle(CommandInterface $command): void;
}