<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
## Quick Installation

    git clone git@github.com:SamuelGerges/task-EEC-Group.git
    cd SD_Project/
### Composer

    composer install
    composer update

### For Environment Variable Create

    cp .env.example .env

### create new database

### For Migration table in database

    php artisan migrate
    php artisan db:seed

### Server ON ```url: http://127.0.0.1:8000/```

    php artisan serve
    click in navbar in products or pharmacies

### Usage Package
    bootstrap 4
    JQuery
    select2
    

### video Of task ``` url: https://youtu.be/Fr5i410qxWE

### postman 
     file postman => EEC_Group_Task.postman_collection.json 
    

### Usage Skills  in Blog Project

    Repositry Design Pattern
    Service Provier
    Request Validation
    command line php artisann products:search-cheapest {productId} to get product in the cheapest 5 pharmacies
    

### About Task

For the task of simplicity, the
information we care about product (id, title, description, image, price, quantity) 
also we have several pharmacies. Each pharmacy has (id, name, address). 
There is a many-to-many relationship between pharmacies and products. 
Each product has many pharmacies and vice .

features :
- Products List/Create/Update/Delete.
- Pharmacies List/Create/Update/Delete.
- Page to search for pharmacies by name or similar.
- Page to search for products by name or similar.
- can add products in specific pharmacy.
- you can show all products in pharmacy.
- you can show details every all products in all pharmacies.
- CLI command that takes product id and returns cheapest 5 pharmacies.

End points of Api
- crud for pharmacy.
- crud for products .

