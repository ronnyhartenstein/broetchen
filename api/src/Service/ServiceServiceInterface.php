<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Service;

use Oqq\Broetchen\Domain\SearchPattern;
use Oqq\Broetchen\Domain\Service\Service;

interface ServiceServiceInterface
{
    public function findService(SearchPattern $pattern): array;
}
