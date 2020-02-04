<?php
namespace App\Controllers\Dtos;

trait ArrayTrait
{
    public static function fromArray(array $data)
    {
        $reflectionMethod = new \ReflectionMethod(static::class, '__construct');
        $reflectionParameters = $reflectionMethod->getParameters();
        $parameters = [];
        foreach ($reflectionParameters as $reflectionParameter) {
            $parameterName = $reflectionParameter->getName();
           
            $parameter = $data[$parameterName] ?? $reflectionParameter->getDefaultValue();
            if (\is_array($parameter) && $reflectionParameter->isVariadic()) {
                $parameters = \array_merge($parameters, $parameter);
                continue;
            }
            $parameters[] = $parameter;
        }

        return new static(...$parameters);
    }
}