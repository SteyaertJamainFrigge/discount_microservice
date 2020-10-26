# discount_microservice


Install [Composer](https://getcomposer.org/)

Install [symfony 4.2](https://symfony.com/download)

Go to the project folder with the terminal.

Install project dependencies with the command:
```shell script
composer install
```

Run the symfony server with the command: 

````shell script
symfony server:start
````

Check in the php.ini to which port it's listening (usually port 8000)

Send a post request to the url below with the json template data found in the Resources folder.

Personally I find [Postman](https://www.postman.com/downloads/) to be the most useful tool for this purpose.

````http request
localhost:8000/discount
````
