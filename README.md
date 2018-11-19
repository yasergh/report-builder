# Report Builder

Generate PDF report like (invoice, receipt ) for laravel

## Requirement
    * "php >= 5.4.0
    * ext-gd
    * ext-dom
    * ext-mbstring
    * phenx/php-font-lib
    * phenx/php-svg-lib
    * ext-bcmath
    * illuminate/support
    * illuminate/view
    * nesbot/carbon
    
----
    
## Install with composer

```bash
composer require snono/report-builder
```




## Publish the Configration 

```bash
php artisan vendor:publish --tag=report-bulder
```



Example Usage:
 First you need add import class ReportBuilder
 
```php
use Snono\ReportBuilder\Builder\Classes\ReportBuilder;
```



see example code blow

```php

$invoice = ReportBuilder::make()
            ->template('default')
            ->language('ar')  
            ->currency('IQD')
            ->orientation('portrait')
            ->isRTL(false)
            ->addItem('ماتزال تداعيات التقييم الذي أصدرته وكالة ', 10.25, 2, 1412)
            ->addItem('Test Item 2', 5, 2, 923)
            ->addItem('Test Item 3', 15.55, 5, 42)
            ->addItem('Test Item 4', 1.25, 1, 923)
            ->addItem('Test Item 4', 1.25, 1, 923)
            ->addItem('Test Item 4', 1.25, 1, 923)
            ->addItem('Test Item 4', 1.25, 1, 923)
            ->addItem('Test Item 4', 1.25, 1, 923)
            ->number(4021)
            ->tax(21)
            ->notes('Lrem ipsum dolor sit amet, consectetur adipiscing elit.')
            ->customer([
                        'name' => 'Èrik Campobadal Forés',
            'id' => '12345678A',
            'phone' => '+34 123 456 789',
            'location' => 'C / Unknown Street 1st',
            'zip' => '08241',
            'city' => 'Manresa',
            'country' => 'Spain',
            ])
            ->download('demo');
```

##### Notes 
The PHP extension bcmath is required so check you php version by command 

```
php -v
```

```
sudo apt install php7.2-bcmath
```