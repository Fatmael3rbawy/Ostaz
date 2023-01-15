<?php

namespace App\Traits;

trait ModelTrait
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters ?? [];
    }

}
