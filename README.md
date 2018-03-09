Biblioteca para ler arquivos de textos sem delimitadores físicos e retornar em formato legível

[![Build Status](https://travis-ci.org/convenia/textMapable.svg?branch=master)](https://travis-ci.org/convenia/textMapable)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/c7d43bcb24294fb29151142651eaf1ee)](https://www.codacy.com/app/Convenia/dominio-payroll-export?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=convenia/dominio-payroll-export&amp;utm_campaign=Badge_Grade)

## Requisitos

* PHP >= 7.1

### Instale usando o composer [Composer](http://getcomposer.org/)

```bash
composer require convenia/textMapable
```

## Exemplos de Uso

### Criando um novo field
```php
use Convenia\TextMap\Field;

class NameField extends Field
{
    protected $name = 'name'
    protected $length = 10;
    protected $offset = 30;
}
```

### Definindo o arquivo de leitura e seus fields
```php
use Convenia\TextMap\Mapable;

/* ... */

$mapable = new Mapable();
$mapable
    ->readFile($greatFile)
    ->addField($someFieldsInArray)
    ->addField($aFieldOutOfAnArray);
``` 

### Obtendo o mapa dos fields com seus valores
```php
use Convenia\TextMap\Mapable;

/* ... */

$map = $mapable->getMap();
```