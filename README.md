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
11. ``` laravel-echo-server start ```
12. Start node JS server (TTN) ``` node index.js ```
13. ``` php artisan serve ```

## ToDo
### Version 1.0

- [X] Add remaining tables and migrate
- [X] Add user roles
- [X] Add admin panel
- [X] Change [register] to [add user] in admin controller
- [X] Create user show view
- [X] Create request classes for BridgeController, UserController
- [X] Create index for admin panel
- [X] Create DashboardController
- [X] Create Employee view
- [X] Employee should be able to change threshold_value of sensor
- [X] Add auth Middleware
- [X] Paginate for Bridge views
- [X] Create Customer view (Can't change threhsold value)
- [X] Edit profile page
- [X] Sends email when user is registered and when threshold is exceeded
- [X] Sends email when threshold is exceeded
- [X] Show bridges on map
- [X] Redis broadcasting, listening for new sensor_data inserts and refresh sensor value on page
- [X] Give warning when threshold is exceeded for Color sensor
- [X] Open detail sensor view only if there are more than two data_collection
- [X] Instead of refreshing page, refresh only sensor values
- [X] Create forgot password page
- [X] Change email template for forgot password
- [X] Add help page
- [X] Change help page pagiantor to carousel Jquery
- [X] Create bridge api and connect flutter app to it
- [X] Delete api token after logout in app
- [ ] Middleware group for routes web (see api routes)
- [ ] Refresh Graph after redis event
- [ ] Listener for new data -> notification + refresh data in APP
- [ ] Design App
- [ ] getSensorsOfBridge 
- [ ] Create defualt admin on laravel init
- [ ] Clean up code


### Version 2.0

- [ ] 
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

## Security Vulnerabilities

...

## License

...
