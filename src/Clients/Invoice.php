<?php declare(strict_types=1);

namespace Clicksports\LexOffice\Clients;

use Clicksports\LexOffice\BaseClient;
use Clicksports\LexOffice\Clients\Traits\CreateFinalizeTrait;
use Clicksports\LexOffice\Clients\Traits\DocumentClientTrait;
use Clicksports\LexOffice\Clients\Traits\GetTrait;
use Clicksports\LexOffice\Exceptions\LexOfficeApiException;
use Psr\Http\Message\ResponseInterface;

class Invoice extends BaseClient
{
    use GetTrait;
    use DocumentClientTrait;
    use CreateFinalizeTrait;

    protected string $resource = 'invoices';

    /**
     * @return ResponseInterface
     * @throws LexOfficeApiException
     */
    public function getAll(): ResponseInterface
    {
        $client = new VoucherList($this->api);

        $client->setToEverything();
        $client->types = ['invoice'];

        return $client->getAll();
    }
}
