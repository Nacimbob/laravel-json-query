laravel json query builder
==========

**laravel json query builder** makes working with json column much easier, using json columns ley you combine NoSQL and relational structures in the same database. now you can use json columns as if they were structered columns for filtering, selecting and searching.
We provide support for **Mysql, MariaDB, Sql Server**. 




## Installation

The recommended way to install **json-query-builder** is through [Composer](http://getcomposer.org/)

```bash
$ composer require canedoc/json-query-builder
```
## Usage

### selecting
```php
\DB::table('table')->addSelect('column->path->to->element', 'as_name');
```
or 
```php
ModelName::addSelect('column->path->to->element', 'as_name');
```

### filtering by the data content 
```php
\DB::table('table')->whereJsonValue('column->path->to->element', '=', 22);
```

```php
ModelName::whereJsonValue('column->path->to->element', '>', 22);
```

we can use operators : =, >, <, >=, <=, like.

### filtering valid/invalid json column content.

```php
\DB::table('table')->whereJsonIsValid('column');
```

```php
ModelName::whereJsonIsInvalid('column');
```

we can also use : orWhereJsonValue, orWhreJsonIsValid, orWhereJsonIsInvalid.
## tests
to test the package run:
```bash
./vendor/bin/testbench package:test
```
## Authors

* [Boubrit Nacim](https://github.com/canedoc)


## License

**Compoships** is licensed under the [MIT License](http://opensource.org/licenses/MIT).
