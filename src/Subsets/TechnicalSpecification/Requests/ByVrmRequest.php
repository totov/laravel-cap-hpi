<?php

namespace Totov\Cap\Subsets\TechnicalSpecification\Requests;

use Totov\Cap\Cap;
use Totov\Cap\Requests\Request;

class ByVrmRequest extends Request
{
    public function __construct(
        protected string $accessToken,
        protected string $vrm,
        protected ?array $filteredCategoryIds,
        protected ?array $filteredItemIds
    )
    {
        if (! $this->filteredCategoryIds && ! $this->filteredItemIds) {
            $this->method = Request::METHOD_GET;
        }
    }

    protected function contentType(): string
    {
        return 'application/json';
    }

    protected function body(): string
    {
        if (! $this->filteredCategoryIds && ! $this->filteredItemIds) {
            return '';
        }

        $body = [
            'categoryIds' => $this->filteredCategoryIds,
            'itemIds' => $this->filteredItemIds,
        ];

        return json_encode($body, JSON_THROW_ON_ERROR);
    }

    protected function endpoint(): string
    {
        $version = Cap::VERSION;

        return "https://api.cap-hpi.co.uk/v{$version}/vrms/{$this->vrm}/derivative/technical-specification";
    }
}
