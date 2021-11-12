<?php

namespace UPFlex\MixUp\Core\Hooks;

use UPFlex\MixUp\Core\Hook;

class Action extends Hook
{
    public function run(): void
    {
        foreach ($this->getHooks() as $action) {
            $this->setAcceptedArgs($action['accepted_args']);
            $this->setCallback($action['callback']);
            $this->setName($action['name']);
            $this->setPriority($action['priority']);

            add_action($this->getName(), $this->getCallback(), $this->getPriority(), $this->getAcceptedArgs());
        }
    }
}