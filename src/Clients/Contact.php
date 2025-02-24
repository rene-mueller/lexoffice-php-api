<?php

declare(strict_types=1);

namespace Sysix\LexOffice\Clients;

use Sysix\LexOffice\Clients\Traits\CreateTrait;
use Sysix\LexOffice\Clients\Traits\GetTrait;
use Sysix\LexOffice\Clients\Traits\UpdateTrait;
use Sysix\LexOffice\PaginationClient;

class Contact extends PaginationClient
{
    use CreateTrait;
    use GetTrait;
    use UpdateTrait;

    protected string $resource = 'contacts';

    public ?string $email = null;

    public ?string $name = null;

    public ?int $number = null;

    public ?bool $customer = null;

    public ?bool $vendor = null;

    protected function buildQueryParams(array $params): string
    {
        $params['email'] = $this->email;
        $params['name'] = $this->name;
        $params['number'] = $this->number;
        $params['customer'] = $this->customer;
        $params['vendor'] = $this->vendor;

        return parent::buildQueryParams($params);
    }
}
