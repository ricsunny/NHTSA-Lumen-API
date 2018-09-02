# PHP API Development using Lumen Micro Framework

## Framework & Language(s) 
Lumen (5.5.2) (Laravel Components 5.5.*)

PHP >= 7.1.3

NHTSA NCAP 5 Star Safety Ratings API

# Installation
The system utilizes [Composer](https://getcomposer.org/download/) to manage its dependencies. So, before using the system, make sure you have `Composer` installed on your machine.

Clone repository via git: 
`https://github.com/ricsunny/NHTSA-Lumen-API.git`

* Move to `<root>` directory

* cd `<root>`

* run "composer update"

* Start Server

php -S localhost:8080 -t ./public

# Example
You could use [Postman app](https://www.getpostman.com/apps) to run examples

*Requirement 1*

http://localhost:8080/vehicles/2015/Audi/A3

http://localhost:8080/vehicles/2015/Toyota/Yaris

http://localhost:8080/vehicles/2015/Ford/Crown Victoria

*Requirement 2*

http://localhost:8080/vehicles

```
POST variables set 1:
{
 "modelYear": 2015,
 "manufacturer": "Audi",
 "model": "A3"
}

```
POST variables set 2:
{
 "modelYear": 2015,
 "manufacturer": "Toyota",
 "model": "Yaris"
}

```
POST variables set 3:
{
 "manufacturer": "Honda",
 "model": "Accord"
}


*Requirement 3*

http://localhost:8080/vehicles/2015/Audi/A3/?withRating=true

http://localhost:8080/vehicles/2015/Toyota/Yaris/?withRating=false

http://localhost:8080/vehicles/2015/Toyota/Yaris/?withRating=bananas


## License
[MIT license](http://opensource.org/licenses/MIT)