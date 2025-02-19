<?php


namespace App\Modules\Course;

use Illuminate\Support\Arr;
use App\Modules\Course\PostFilter;
use Softonic\GraphQL\ClientBuilder;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\DomCrawler\Crawler;
use BendeckDavid\GraphqlClient\Facades\GraphQL;

class Main
{
    const GRAPHQL_URL = 'https://cms.cloudhunt.guru/graphql';
    protected $client;
    protected $data;
    protected $errors;
    protected $hasError = false;
    protected $fileName;
    protected $filter;
    protected $routeGroup = 'blog';
    protected $titleGroup = 'RunCloud Blog';
    private $pageSize;

    public function __construct()
    {
        $this->client = ClientBuilder::build(self::GRAPHQL_URL);

        $this->filter = app(PostFilter::class);
    }

    private function _readFile($fileName)
    {
        return Storage::disk('graphql')->get('query/' . $fileName . '.graphql');
    }

    private function _filterVariables($variables)
    {
        // if variables have key first and last, convert it to int
        // convert to int of first and last
        $filterInt = ['first', 'last'];
        $hasPagination = false;
        foreach ($filterInt as $key) {
            if (isset($variables[$key])) {
                $hasPagination = true;
                $this->pageSize = $variables[$key] = (int) $variables[$key];
            }
        }

        if (!$hasPagination) {
            $this->pageSize = 10;
        }

        return $variables;
    }

    public function query($fileName, $variables = [])
    {
        $variables = $this->_filterVariables($variables);

        $this->fileName = $fileName;
        $response = $this->client->query($this->_readFile($fileName), $variables);

        if ($response->hasErrors()) {
            // Returns an array with all the errors found.
            $this->hasError = true;
            $this->errors = $response->getErrors();
        } else {
            $this->data = $response->getData();
        }

        return $this;
    }

    public function hasError()
    {
        return $this->hasError;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function data($node = null)
    {
        if (empty($node)) {
            return $this->data;
        }

        return Arr::get($this->data, $node);
    }

    public function pagination($resourceName = null, $paged = 1, $slug = null)
    {
        $data = Arr::get($this->data, ($resourceName ?? $this->fileName).'.pageInfo.customPagination');

        $nextPage = $data['nextPage'] ?? null;
        $previousPage = $data['previousPage'] ?? null;

        return [
            'next' => $this->getUrl($resourceName, $nextPage, $slug),
            'previous' => $this->getUrl($resourceName, $previousPage, $slug),
        ];
    }

    private function getUrl($resourceName = null, $paged = null, $slug = null, $routeGroup = '') {

        if (empty($routeGroup)) {
            $routeGroup = $this->routeGroup;
        }

        $resourceName = $resourceName ?? $this->fileName;

        if ($resourceName === 'api') {
            return empty($slug) || $slug === 'introduction' ? route('api:index') : route('api:show', $slug);
        }

        if ($resourceName === 'post') {
            return !empty($slug) ? route($routeGroup.':show', $slug) : null;
        }

        if ($paged === null) {
            return null;
        }

        if ($resourceName === 'posts') {
            $routeName = $routeGroup;
        } else if (in_array($resourceName, ['category', 'category.posts'])) {
            $routeName = $routeGroup.':categories';
        } else if (in_array($resourceName, ['tag', 'tag.posts'])) {
            $routeName = $routeGroup.':tags';
        } else {
            // unknown resourceName
            return null;
        }

        if ((int)$paged === 1) {
            $routeName .= ':index';
            return !empty($slug) ? route($routeName, $slug) : route($routeName);
        } else {
            $routeName .= ':paged';
            return !empty($slug) ? route($routeName, [$slug, (int)$paged]) : route($routeName, (int)$paged);
        }
    }


}