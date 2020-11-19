# Hobo Hydralic APP
<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Hobo Hydraulic

...

## Installation

...

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
- [ ] Clean up code
- [ ] Test color sensor


npm install -g laravel-echo-server
laravel-echo-server start

redis-server


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

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

...

## License

...
