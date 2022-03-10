![logo](assets/logo.png)

#Add your package badges

[![PHP Composer](https://github.com/Syrian-Open-Source/laravel-package-template/actions/workflows/php.yml/badge.svg)](https://github.com/syrian-open-source/laravel-multi-process/actions/workflows/php.yml)
[![Run tests](https://github.com/Syrian-Open-Source/laravel-package-template/actions/workflows/tests.yml/badge.svg)](https://github.com/syrian-open-source/laravel-multi-process/actions/workflows/tests.yml)

Design a simple and expressive logo with the same model you see above,
the logo design helps to unify the visual identity and further develop the optimal packages to increase the quality of the software we develop

# Relational Metrics
This package will help you to make your metrics easier, You could get metrics about your Models, Models depending on their relations, or even metrics about your models depending on multiple conditions!!

It would be a very easy to get the number of your stores which has products has a price more than x$ ;)

##### 1 - Dependency
The first step is using composer to install the package and automatically update your composer.json file, you can do this by running:

```shell
composer require syrian-open-source/relational-metrics
```


Usage
---------
The Basic Usage of this package is the same of geting count of some model instances, but with a styled response 

```php
        $instance = (new RelationalMetrics(ModelName)); 
        // EX: new RelationalMetrics(Store);
        $metrics = $instance->getBasicMetrics();
        /*
	  *     Response will be like:
	  *	[
	  *	    'name' => 'Total Stores Number,
	  *	    'count' => 43,
	  *	];
	  *	
        */
```
What you can do next, you could get the metrics of a model depending on one of its relations!

Let's assume we want to get the number of stores that has products with price more than 500

```php
        $instance = (new RelationalMetrics(ModelName)); 
        // EX: new RelationalMetrics(Store);
        $metrics = $instance->getRelationalMetrics($relationName, $relationColumn, $value);
        // EX: $instance->getRelationalMetrics('products, 'price', 500);
        /*
	  *     Response will be like:
	  *	[
	  *	    'name' => 'Total Stores Number,
	  *	    'count' => 12,
	  *	];
	  *	
        */
```
At the previous Example the Package will return the number of the stores which has products with price equals to 500


And last but not least, You could get the metrics about a model depending on any number of conditions you want!


```php
        $instance = (new RelationalMetrics(ModelName)); 
        // EX: new RelationalMetrics(Store);
        $metrics = $instance->getRelationalMetrics($conditions);
        // EX: $instance->getRelationalMetrics(
        	[
        		['method' => 'where', 'column' => 'address', 'operator' => 'like', 'value' => '%UAE%'],
        		['method' => 'where', 'column' => 'rate', 'operator' => '>', 'value' => 3],
        	]
        );
        /*
	  *     Response will be like:
	  *	[
	  *	    'name' => 'Total Stores Number,
	  *	    'count' => 2,
	  *	];
	  *	
        */
```
At the previous Example the Package will return the number of the stores where their address contains "UAE" and their rate is more than 3



Changelog
---------
Please see the [CHANGELOG](https://github.com/syrian-open-source/laravel-package-template/blob/master/CHANGELOG.md) for more information about what has changed or updated or added recently.

Security
--------
If you discover any security related issues, please email them first to "your email", 
if we do not fix it within a short period of time please open a new issue describing your problem. 

Credits
-------
* [zainaldeenfayod@gmail.com](https://github.com/zainaldeen/laravel-relational-metrics-1)
* [All contributors](https://github.com/syrian-open-source/laravel-package-template/graphs/contributors)

