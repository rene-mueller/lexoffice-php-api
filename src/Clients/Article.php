<?php

declare(strict_types=1);

namespace Sysix\LexOffice\Clients;

use Sysix\LexOffice\Clients\Traits\CreateTrait;
use Sysix\LexOffice\Clients\Traits\DeleteTrait;
use Sysix\LexOffice\Clients\Traits\GetTrait;
use Sysix\LexOffice\Clients\Traits\UpdateTrait;
use Sysix\LexOffice\PaginationClient;

class Article extends PaginationClient
{
    use CreateTrait;
    use DeleteTrait;
    use GetTrait;
    use UpdateTrait;

    protected string $resource = 'articles';

    public ?string $articleNumber = null;

    public ?string $gtin = null;

    /** can be "PRODUCT" or "SERVICE" */
    public ?string $type = null;

    protected function buildQueryParams(array $params): string
    {
        $params['articleNumber'] = $this->articleNumber;
        $params['gtin'] = $this->gtin;
        $params['type'] = $this->type;

        return parent::buildQueryParams($params);
    }
}
