<p align="center"><img src="https://hobohydrauliek.nl/wp-content/uploads/2019/04/cropped-Logo-2019-1.jpg" width="400" alt="Logo"></p>
<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Description

The objective of this minor is to create a full infrastructure to check maintenance for hydraulic bridges. This will save time and money, the mechanics do not have to check the bridges physically. This project will be carried out on behalf IoT Nederland and Hobo Hydrauliek.

## Installation

1. ``` git clone https://github.com/AkhtariH/HoboHydraulics.git ```
2. ``` cd HoboHydraulics ```
3. ``` composer install ```
4. ``` npm install ```
5. ``` npm install -g laravel-echo-server ```
6. ``` brew install redis-server ```
7. Modify ``` .env ``` file (DB, SMTP credentials, redis)
8. ``` php artisan migrate ```
9. ``` php artisan passport:client --personal ```
10. ``` redis-server ```
5. ``` laravel-echo-server init ```
11. ``` laravel-echo-server start ```
12. Start node JS server (TTN) ``` node index.js ```
13. ``` php artisan serve ```

## ToDo
### Version 1.0

- [X] Add user roles
- [X] Create admin panel
- [X] Create Mange user page
- [X] Create request classes
- [X] Create Dashboard page
- [X] Create profile page
- [X] Sends email when user is registered
- [X] Sends email when threshold is exceeded
- [X] Show bridges on map
- [X] Redis broadcasting, listening for new sensor_data inserts and refresh sensor value on page
- [X] Create forgot password function
- [X] Add help page
- [X] Create API to connect apps to it
- [ ] Refresh Graph after redis event
- [ ] Listener for new data -> notification + refresh data in APP
- [ ] Design App
- [ ] getSensorsOfBridge 
- [ ] Create defualt admin on laravel init
- [ ] Clean up code


### Version 2.0

- [ ] Add tasks page
- [ ] Add Manage sensors page
- [ ] Change threshold controller to SensorController
- [ ] Add ability to change date and time for graph in sensor detail page
- [ ] Dynamic locations map
- [ ] Forgot password and email verification
- [ ] Change notifications to slide down from the top
- [ ] Make UserController for actual user and ove password reset to usercontroller

### Version 3.0
- [ ] Roles and permission system
- [ ] Messaging system
- [ ] Mobile app

## Code of Conduct

[Code of Conduct](https://drive.google.com/drive/folders/1vlOG79cCyByT_JbV24JGf1kFkqOoX6yW).

## License
The MIT License (MIT) Copyright © Taylor Otwell, Hemran Akhtari