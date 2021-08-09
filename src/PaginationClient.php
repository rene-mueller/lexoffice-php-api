<?php declare(strict_types=1);

namespace Clicksports\LexOffice;

use Psr\Http\Message\ResponseInterface;
use stdClass;

abstract class PaginationClient extends BaseClient
{
    public int $size = 100;

    /**
     * @param int $page
     * @return string
     */
    public function generateUrl(int $page): string
    {
        return $this->resource . '?page=' . $page . '&size=' . $this->size;
    }

    /**
     * @param int $page
     * @return ResponseInterface
     * @throws Exceptions\LexOfficeApiException
     */
    public function getPage(int $page): ResponseInterface
    {
        $api = $this->api->newRequest(
            'GET',
            $this->generateUrl($page)
        );

        return $api->getResponse();
    }

    /**
     * @return ResponseInterface
     * @throws Exceptions\LexOfficeApiException
     */
    public function getAll(): ResponseInterface
    {
        $response = $this->getPage(0);
        /** @var stdClass{totalPages:int, content:\stdClass[]} $result */
        $result = $this->getAsJson($response);

        if ($result->totalPages == 1) {
            return $response;
        }

        // update content to get all contacts
        for ($i = 1; $i < $result->totalPages; $i++) {
            $responsePage = $this->getPage($i);
            /** @var stdClass{totalPages:int, content:\stdClass[]} $resultPage */
            $resultPage = $this->getAsJson($responsePage);

            foreach ($resultPage->content as $entity) {
                $result->content = [
                    ...$result->content,
                    $entity
                ];
            }
        }

        return $response->withBody($this->createStream($result));
    }
}