<?php

class CommandBus
{
    public function __construct(array $handlers)
    {
        $this->handlers = $handlers;
    }

    public function handle($command)
    {
        $commandName = get_class($command);

        // add logging here
        // add transactional boundaries here

        if (isset($this->handlers[$commandName])) {
            $handler = $this->handlers[$commandName];

            return $handler($command);
        }
    }
}
