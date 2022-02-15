**_Note: This project has been archived in favor of logicent/propoint_**

# FrontDesk (PMS)

* Version: 3.x
* [Website](https://logicent.co)
* [Demo](https://fdesk.demo.logicent.co)
    Username: `admin`
    Password: `safdesk1`
* [Support Forum](https://github.com/logicent/frontdesk/issues) for comments, discussion and community support
<!-- [Release Documentation](https://github.com/logicent/frontdesk/docs) -->
<!-- [Release API browser](https://github.com/logicent/frontdesk/) -->
<!-- [Development branch Documentation](https://github.com/logicent/frontdesk/dev-docs) -->
<!-- [Development branch API browser](https://github.com/logicent/frontdesk/dev-api) -->

[![FrontDesk Dashboard](/public/images/fd-dashboard.png)](https://fdesk.demo.logicent.co)

## Description

FrontDesk is a property management system (PMS) for facilities and establishments offering accommodation, rental and hiring services.

FrontDesk is built using PHP (FuelPHP 1.8.2) and JavaScript (jQuery 3.4.1) with customized SBAdmin2 (Bootstrap 3) admin template.

## Requirements

- PHP 7.3 and php7.3-mbstring (PHP 7.2 should also work)
- MySQL 5.7
- Nginx _(sample nginx.conf included in project root)_

## Installation

### Setup via CLI

`git clone https://github.com/logicent/frontdesk.git <path/to/project>`

`cd <path/to/project>`

*Note: Ensure composer is installed for this install task*

`php oil refine install`

create/modify `db.php` settings as needed under `fuel/app/config/`

run tasks to create database tables

`php oil refine migrate --packages=auth`

`php oil refine migrate:current `

`php oil refine migrate`

TODO: create task to set/update default login 

TODO: create task to load default reports

### Setup (post-install) via UI 

Go to sidebar navigation menu to:

- add business detail

- add facility property, unit types, units, rate types and rates

- add facility services

- add users

<!-- ## More information -->

<!-- For more detailed information, see the [development wiki](https://github.com/logicent/frontdesk/wiki). -->

## Development Team

* Ken Mwai - Creator and Lead Developer/Maintainer ([@mwaigichuhi](https://twitter.com/mwaigichuhi))

### Want to contribute?

Thank you for considering contributing to FrontDesk. New contributors to improve the solution further or help provide support to issues are most welcome.

<!-- ### Alumni -->

<!-- * (none) -->

<!-- ## Sponsors -->
<!-- Support FrontDesk by becoming a sponsor on [Patreon](https://www.patreon.com/frontdesk). Your logo will show up here with a link to your website. One-time donation is welcomed through PayPal. -->

## License
FrontDesk is released under the [MIT license](https://opensource.org/licenses/MIT).
