<?php

namespace UPFlex\MixUp\Core\Hooks;

use UPFlex\MixUp\Core\Hook;

class Filter extends Hook
{
    public function run(): void
    {
        foreach ($this->getHooks() as $filter) {
            $this->setAcceptedArgs($filter['accepted_args']);
            $this->setCallback($filter['callback']);
            $this->setName($filter['name']);
            $this->setPriority($filter['priority']);

            add_filter($this->getName(), $this->getCallback(), $this->getPriority(), $this->getAcceptedArgs());
        }
    }
}