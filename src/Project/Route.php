<?php

declare(strict_types=1);

namespace Project;

class Route
{
    private string $method;

    private array $pathArr = [];

    private \DI\FactoryInterface $factory;

    public function __construct(
        \DI\FactoryInterface $factory
    )
    {
        $this->factory = $factory;

        $this->method = mb_strtolower($_SERVER['REQUEST_METHOD']);

        $path = parse_url($_SERVER['REQUEST_URI'])['path'];

        // remove first slash
        $path = substr($path, 1);

        $this->pathArr = explode('/', $path);
    }

    /**
     * @return void
     */
    public function route(): void
    {
        $routeData = $this->getRouteData();
        $method = $routeData['method'];

        if ($routeData['controllerName'] === '404' || $method === '') {
            $notFound = $this->factory->get('NotFoundController');
            $notFound->return404();
        }

        $controller = $this->factory->get($routeData['controllerName']);
        $controller->$method(...$routeData['params']);
    }

    /**
     * @return array  ['controllerName', 'method', 'params']
     */
    private function getRouteData(): array
    {
        $outputArr = [
            'controllerName' => $this->getControllerName(),
            'method' => $this->getMethod(),
            'params' => $this->getParams()
        ];

        return $outputArr;
    }

    private function getControllerName(): string
    {
        switch ($this->pathArr[0]) {
            case '':
                $controllerName = 'CompanyController';
                break;
            case 'company':
                $controllerName = 'CompanyController';
                break;
            case 'store':
                $controllerName = 'StoreController';
                break;
            case '404':
                $controllerName = '404';
                break;
            default:
                $controllerName = '404';
        }

        return $controllerName;
    }

    /**
     * @return string
     */
    private function getMethod(): string
    {

        switch ($this->method) {
            case 'post':
                $method = $this->getPostMethod();
                break;
            case 'get':
                $method = $this->getViewMethod();
                break;
            case 'delete':
                $method = 'delete';
                break;
            default:
                $method = '';
        }

        return $method;
    }

    /**
     * @return bool
     * Check if isset the second parameter in our URL for choosing right method create or show list
     */
    private function hasId(): bool
    {
        if ( isset($this->pathArr[1] )
            && is_numeric($this->pathArr[1])
        ) {
            return true;
        }

        return false;
    }

    /**
     * @return array
     * Get parameters we need to pass the controller
     */
    private function getParams(): array
    {
        $paramsArr = [];

        if ( $this->hasId() ) {
            $paramsArr[] = (int) $this->pathArr[1];
        }

        if ( $this->method === 'post' ) {
            $paramsArr[] = $_POST;
        }

        /*
         * $this->pathArr[2] is company_id
         * for routes added new store
         * or show store list of companies
         */
        if ( isset($this->pathArr[2]) ) {
            $paramsArr[] = (int) $this->pathArr[2];
        } else {
            $paramsArr[] = null;
        }

        return $paramsArr;
    }

    /**
     * @return string
     * Get the controller's method for all POST queries
     */
    private function getPostMethod(): string
    {
        if ( $this->hasId() ) {
            return 'update';
        }
        else {
            return 'store';
        }
    }

    /**
     * @return string
     * Get the controller's method for all GET queries
     */
    private function getViewMethod(): string
    {
        if ( $this->hasId()
            && !isset($this->pathArr[2])
        ) {
            return 'edit';
        } elseif (
            isset($this->pathArr[1]) &&
            $this->pathArr[1] == 'add'
        ) {
            return 'add';
        } else {
            return 'getAll';
        }
    }
}