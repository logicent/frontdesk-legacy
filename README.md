# FrontDesk (PMS)

* Version: 3.x
* [Website](https://logicent.co)
* [Demo](https://fdesk.demo.logicent.co)
    Username: admin
    Password: safdesk1
<!-- [Release Documentation](https://github.com/logicent/frontdesk/docs) -->
<!-- [Release API browser](https://github.com/logicent/frontdesk/) -->
<!-- [Development branch Documentation](https://github.com/logicent/frontdesk/dev-docs) -->
<!-- [Development branch API browser](https://github.com/logicent/frontdesk/dev-api) -->
* [Support Forum](https://github.com/logicent/frontdesk/issues) for comments, discussion and community support

## Description

FrontDesk is a property management system (PMS) for facilities and establishments offering accommodation, rental and hiring services.

FrontDesk is built using PHP (FuelPHP) and JavaScript (jQuery) with Bootstrap 3 UI by SBAdmin2.

## Installation

### Setup via cli

`git clone https://github.com/logicent/frontdesk.git <path/to/project>`

#### composer install

`cd <path/to/project>`

`php oil refine install`

create/modify db.php settings as needed under `fuel/app/config/`

run task to create database tables

`php oil refine migrate --packages=auth`

`php oil refine migrate:current `

`php oil refine migrate`

run task to set/update default login 

run task to load default reports

### Setup (Post-install) via app UI 

`/settings`

- add business detail

- add facility property, unit types, units, rate types and rates

- add facility services

- add users

## More information

For more detailed information, see the [development wiki](https://github.com/logicent/frontdesk/wiki).

## Development Team

* Ken Mwai - Creator and Lead Developer/Maintainer ([@mwaigichuhi](https://twitter.com/mwaigichuhi))

### Want to join?

The FrontDesk development team is always looking for new team members, who are willing to help lift the solution to the next level, and have the commitment to not only produce awesome code, but also great documentation, and support to our users.

You can apply for internship. Start by sending in pull-requests, work on outstanding feature requests or bugs, and become active in the #logicent GitHub issues. If your skills are up to scratch, we will notice you, and will ask you to become a team member.

### Alumni

* (none)
