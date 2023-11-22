<?php

namespace FGO\Service;

class ServiceFactory extends AbstractServiceFactory
{
    private static array $classMap = [
        'article' => ArticleService::class,
        'invoice' => InvoiceService::class,
        'taxonomy' => TaxonomyService::class,
    ];

    protected function getServiceClass(string $name)
    {
        return \array_key_exists($name, self::$classMap) ? self::$classMap[$name] : null;
    }
}