# Laravel Records Filter


Laravel record filter provides an easy and intuitive way to filter and sort records in your Laravel applications. It mimics the familiar syntax of the Laravel Paginator, making it simple to implement complex filtering logic.

## Requerment
This package requires your app to include tailwind and alpinejs in your views


## Installation

You can install the package via composer:

```bash
composer require musta20/laravel-records-filter
```
make sure to rebuild tailwind assets if you are not running vite dev 
```bash
yarn vite build
```

## Using the package

In your model use the trait HasFilter:
```php

use Musta20\LaravelRecordsFilter\HasFilter;

class Post extends Model
{
    use HasFactory, HasFilter;


```
#### implement the following function in your model according to your need

### Sorting 

The following example show how to implement sorting

```php


    public function sortFilterOptions()
    {

        return  [
            [
                "lable" => "oldest",    // label name to display in the filtering form
                "type" => 'ASC',        // sorting type
                "filed" => "created_at" // talbel filed name
            ],
            [
                "lable" => "newest",
                "type" => 'DESC',
                "filed" => "created_at"
            ],
            [
                "lable" => "high price",
                "type" => 'DESC',
                "filed" => "price"
            ],
            [
                "lable" => " lowest price",
                "type" => 'ASC',
                "filed" => "price"
            ],

        ];
    }



```

### Filter by relation 

You can filter record based on relation to other table: 

```php


    public function relationsFilterOptions()
    {
        return [
            [
                'label' => 'auther',     // label name to display in the filtering form
                'label_filed' => 'name', // filed name in the relation tabel
                'id' => 'user_id',      // label name in the relation tabel
                'model' => 'App\Models\User',
            ],
            [
                'label' => 'category',
                'label_filed' => 'name',
                'id' => 'category_id',
                'model' => 'App\Models\category',
            ]
        ];
    }




```


### Search

You can search in records by defining the table name in search function: 

```php


    public function searchFields()
    {
        return  [
            'title',
            'body'
        ];
    }


```

### Filtering

You can define filtering term like the following :

```php



    public function filterOptions()
    {

        return [
            [
                'label' => 'reviewing',     // label name to display in the filtering form
                'type' => 'checkbox',       // checkbox | select | radio group | date | between 
                'filed' => 'article_type',  // filed name in the tabel
                'operation' => '=',         // opertaion type
                'options' => [              // the  values you want to filter based on 
                    'reviewed' => 1,        // the first key will be used as label 
                    'not reviewed' => 0
                ],
            ],
            [
                'label' => 'publish status',
                'type' => 'select',    //checkbox | select | radio group | date | between 
                'filed' => 'is_published',
                'options' => [
                    'drafted' => 0,
                    'publish' => 1
                ]

            ],
            [
                'label' => 'font size',
                'type' => 'radio group', //checkbox | select | radio group | date | between 
                'filed' => 'font_type',
                'options' => [
                    'small' => 10,
                    'big' => 20
                ]

            ],
            [
                'label' => 'issue date',
                'type' => 'date', //checkbox | select | radio group | date | between 
                'filed' => 'created_at',
                'operation' => '='

            ]
            ,
            [
                'label' => 'issue period',
                'type' => 'range', //checkbox | select | radio group | date | between 
                'filed' => 'created_at',
                'inputType' => 'date',//date/number
                'operation' => 'between',
                'options' => [
                    'from',
                    'to'
                ]
            ]
            ,
            [
                'label' => 'price range',
                'type' => 'range', //checkbox | select | radio group | date | between 
                'filed' => 'price',
                'inputType' => 'number',//date/number
                'operation' => 'between',
                'options' => [
                    'max',
                    'min'
                ]
            ]
        ];
    }



```

### querying 
you must use the function Filter() to retrieve the data keep in mind you have to call it the last in the query and do not call the paginate as it automatically paginated

```php

    $posts= Post::filter();

    // or

    $posts=  Post::where('name','alie')->filter();


```
Finally, run in your view call the filter nav using the function.

```php
{{ $posts->filterLinks() }}
```

![Screenshot from 2024-06-10 13-01-00](https://github.com/musta20/laravel-records-filter/assets/46521416/d702564d-1550-472c-adef-a289e2527372)


You can use different view like nav-filter to show all filtering option in linear view

```php
 {{ $posts->filterLinks('laravelRecordsFilter::nav-filter') }}
```

![Screenshot from 2024-06-10 13-46-03](https://github.com/musta20/laravel-records-filter/assets/46521416/eb1668e6-acbc-48fb-b5db-4aaf39799028)

You can also display filtering option in sidebar view by using the following function

for the side bar :

```php
  {{ $posts->filterLinks('laravelRecordsFilter::sidebar-filter') }}

```

for the nav : 

```php
   {{ $posts->filterNav() }}

```
![Screenshot from 2024-06-10 13-55-58](https://github.com/musta20/laravel-records-filter/assets/46521416/9fe2cfbc-7749-4ceb-9d31-85d66ab12ff8)

now of curse the view will not always match your style so you can publish the view and edit it the way you want
```bash
php artisan vendor:publish --tag=laravel-Records-Filter
```


## License

The MIT License (MIT). Please see [License File](LICENSE.txt) for more information.