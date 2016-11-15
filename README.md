Overview
=========
I put this application together to demonstrate getting up to speed with the Symfony3 php framework. I tacked this in the following way:

* Started off getting to grips with the overall framework, by running through the tutorial available at http://symfony.com/doc/current/index.html. This involved quite a lot of setup and installation of the required software packages.
* Getting up-to-speed with the basics of the php language here: http://www.w3schools.com/php/ - it appears that php is pretty easy to understand from a syntax point of view.
* Setting up a SQLite db to be able to persist data for the app
* Building a CRUD API using Symfony. Starting with outputting all records in the database using `findAll()`, I moved onto to create a `create`, `update`, `delete` and `deleteall` endpoint.
* I investigated using the built in Symfony forms functionality but this seemed a little bit of a black-box and given time constraints I went with a more straightforward implementation.
* Setting about building the interface, I plumped for jQuery for its simplicity and my familiarity with it. I hit the API endpoints from the interface using `$.ajax()` GET requests for ease of implementation.
* Having got the JS functionality working, I then built the layout using Bootstrap4's flex-grid system to provide an easy to use responsive UI grid system and populated it with Bootstrap components.
* Having a little more time than I thought, I went to http://wemakeawesomesh.it/ to get an idea of their branding, and decided to use a cinemagraph background for my app along with a similar colour palette. I'm not a designer btw!!
* Finally I deployed to a staging server I have running on Ubuntu14.04 behind an Nginx web server to make the app available online.

The above took me around 20 hours over the course of 8 days.

Installation
=========
To install this app from github, you need php5.6 and Symfony installed on your machine, instructions here: http://symfony.com/doc/current/setup.html. There are a couple of additional elements that need to be added in.

* Once cloned, `cd` into your project directory and issue the following at the command line `mkdir app/data`. This is where the database will be created.

* Then `php bin/console doctrine:database:create` to create the db.

* To create the db schema you need to `php bin/console doctrine:schema:update --force` at the command line.

* Finally to start the server, `php bin/console server:run`

* The app should now be available at `localhost:8000`



