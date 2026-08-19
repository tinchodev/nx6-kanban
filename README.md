<p align="center">
    <img src="https://site.gitscrum.com/img/gitscrum-mockup-whitelabel-3.png" />
</p>

# What is GitScrum?

**GitScrum is a Project Management Tool**, developed to help entrepreneurs, freelancers, managers, and teams Skyrocket their Productivity with the Agile methodology and Gamification.

It’s a powerful and functional tool you can use to organize your projects and manage your team's tasks within workspaces.

GitScrum brings all important features for you to establish high standard objectives and lead your team to reach them, working in an interactive and collaborative way. It facilitates tasks delegation and monitoring, with visual resources that help you guide your team throughout all projects execution, from start to finish.

Get rid of the outdated confusing methods that mixed dozens of isolated apps, files, emails and physical sticky notes and switch communication madness by an effective working project management tool that’s “all in one” with everything you need - GitScrum Board with dynamic Kanban boards, GitScrum Sprints to associate your tasks to milestones, GitScrum Gantt Charts for an agenda view, slick integrations and many more interactive features.

GitScrum is a way better option to manage your tasks, because not only will you take notes on your pending actions, but you’ll turn them into objectives and accomplish them.

Promote collaboration among team members, partners, clients and stakeholders working together in all project stages to develop innovative solutions. Create discussions, comment on each other's actions, recall attention by mentioning each other’s names.

Improve your products and services with GitScrum User Stories - small reports on end-users’ needs and wishes, applying the agile principles of welcoming changes and delivering value constantly.

Make GitScrum yours, choosing your preference among 23 languages, dozens of project templates and, the best: with the possibility to showcase YOUR BRAND and domain with the GitScrum White Label feature.

Is that all? No! GitScrum helps you turn your team members into Superstars, with the power of gamification. Meet the GitScrum Rock Star Team feature to add joy and healthy competitiveness to your work environment.

Our team of Scrum and Agile specialists have developed the ultimate tool for you to create amazing projects, manage your tasks smartly, lead your team to enthusiasm and reach unprecedented results.

**Skyrocket your productivity with GitScrum!**



Site: <b>https://site.gitscrum.com</b>

Learm more about GitScrum and Agile Methodologies : <b>https://magazine.gitscrum.com</b>

<hr>
<p align="center">
<b><a href="#overview">Overview</a></b>
|
<b><a href="#installation">Installation</a></b>
|
<b><a href="#setup">Setup</a></b>
|
<b><a href="#screens">Screens</a></b>
|
<b><a href="#questions-and-issues">Questions and Issues</a></b>
|
<b><a href="#contributing">Contributing</a></b>
|
<b><a href="#license">License</a></b>
</p>

[![Laravel 12](https://img.shields.io/badge/Laravel-12-brightgreen.svg?style=flat-square)](http://laravel.com)
[![PHP 8.4](https://img.shields.io/badge/PHP-8.4-777bb4.svg?style=flat-square)](https://www.php.net/)
[![CI](https://img.shields.io/github/actions/workflow/status/tinchodev/nx6-kanban/ci.yml?branch=master&style=flat-square&label=CI)](https://github.com/tinchodev/nx6-kanban/actions/workflows/ci.yml)
[![License](http://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](./LICENSE.md)

<hr>

<p align="center"> GitScrum's goal is to "Transform your IT Team into Instant Rock Stars" !!!</p>
<br/>
<b>Facebook Group: https://www.facebook.com/groups/gitscrum/ </b>
<br />
<b>Follow us on Twitter: https://twitter.com/gitscrum </b>
</p>

<hr>

## About This Fork

This repository ([tinchodev/nx6-kanban](https://github.com/tinchodev/nx6-kanban)) is a modernized fork of GitScrum Community Edition, originally released in 2016/2017 on Laravel 5.4/PHP 7.1. It has since been upgraded to a current, actively runnable stack:

- **Laravel 12 / PHP 8.4**, migrated directly from Laravel 5.5 (dependencies audited and replaced or removed where abandoned).
- **Vite** asset pipeline, replacing the original Gulp 3 setup.
- A **Sanctum token-based REST API** for Issues (`/api/v1/issues`), with token management at `/account/api-tokens`.
- **GitHub Actions CI** running lint, build, migrations, a route smoke-test, and PHPUnit on every push/PR.
- A **Docker Compose** local dev environment (PHP 8.4 + Node 22, no host toolchain required).
- A **GitHub Actions deploy workflow** for shared hosting environments.

See [Overview](#overview) below for GitScrum's original feature set, which this fork preserves.

## Overview

This version available here is the first code of the GitScrum application developed in 2016 and supported until 2017, since modernized as described [above](#about-this-fork).

It's a free and open source version, if you want to know the current GitScrum, go to our website [ https://site.gitscrum.com ]

### GitScrum Open Source - Features

GitScrum can be integrated with **Github** or **Gitlab** or **Bitbucket**.

- **Product Backlog** contains the Product Owner's assessment of business value

- **User Story** is a description consisting of one or more sentences in the everyday or business language that captures what a user does or needs to do as part of his or her job function.

	**Features**: Acceptance criteria, prioritization using MoSCoW, definition of done checklist, pie chart, assign labels, team members, activities, comments and issues.

- **Sprint Backlog** is the property of the development team and all included estimates are provided by development team. Often an accompanying sprint planning is the board used to see and change state of the issues.

	**Features**: Sprint planning using Kanban board, burndown chart, definition of done checklist, effort, attachments, activities, comments and issues.

- **Issue** is added in user story to one sprint backlog, or directly in sprint backlog. Generally, each issue should be small enough to be easily completed within a single day.

	**Features**: Progress state (e.g. to do, in progress, done or archived), issue type (e.g. Improvement, Support Request, Feedback, Customer Problem, UX, Infrastructure, Testing Task, etc...), definition of done checklist, assign labels, effort, attachments, comments, activities, team members.

![GitScrum Dashboard](https://i.imgur.com/xFFSha7.png)

![GitScrum Board](https://i.imgur.com/ppiYPMK.png)

![GitScrum Sprint](https://i.imgur.com/ZHrhKPy.png)

## GitScrum Open Source - Installation

The requirements for this fork are:

- **PHP**: >= 8.2 (8.4 recommended)
- **Node.js**: 22+ (for the Vite asset pipeline)
- **Webserver**: Nginx or Apache
- **Database**: MySQL, or Maria DB

### Docker Compose (recommended for local dev)

The repo ships a `docker-compose.yml` providing PHP 8.4, Node 22 and MySQL, so no local toolchain is required:

```
$ git clone git@github.com:tinchodev/nx6-kanban.git
$ cd nx6-kanban
$ cp .env.example .env
$ docker compose up -d
$ docker compose exec app composer install
$ docker compose exec app npm install
$ docker compose exec app php artisan key:generate
$ docker compose exec app php artisan migrate --seed
$ docker compose exec app npm run dev   # or: npm run build
```

### Manual Git Clone

```
$ git clone git@github.com:tinchodev/nx6-kanban.git
$ cd nx6-kanban
$ composer install
$ npm install && npm run build
```
**Important**: If you have not yet installed composer: [Installation - Linux / Unix / OSX](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)


## Setup

**Important**: If you have not the .env file in root folder, you must copy or rename the .env.example to .env

#### Application URL

.env file

```
APP_URL=http://yourdomain.tld (you must use protocol http or https)
```

#### Language

Options: en | zh | zh_cn | ru | de | es | pt | it | id | fr | hu

.env file

```
APP_LANG=en
```
Can you help us translate a few phrases into different languages? See: https://github.com/GitScrum-Community/laravel-gitscrum/tree/feature/language-pack/resources/lang


#### Database

.env file

```

DB_CONNECTION=mysql
DB_HOST=XXXXXX
DB_PORT=3306
DB_DATABASE=XXXXX
DB_USERNAME=XXXX
DB_PASSWORD=XXXXX
```

**Remember**: Create the database for GitScrum before run artisan command.

```
php artisan migrate
php artisan db:seed --class=SettingSeeder
```

#### Github

You must create a new Github App, visit [GitHub's New OAuth Application page](https://github.com/settings/applications/new), fill out the form, and grab your Client ID and Secret.

```
Application name: gitscrum
Homepage URL: URL (Same as APP_URL at .env)
Application description: gitscrum
Authorization callback URL: http://{URL is the SAME APP_URL}/auth/provider/github/callback
```

.env file

```
GITHUB_CLIENT_ID=XXXXX
GITHUB_CLIENT_SECRET=XXXXXXXXXXXXXXXXXX
```

#### Gitlab

You must create a new Gitlab App, visit [Gitlab new application](https://gitlab.com/profile/applications), fill out the form, and grab your Application ID and Secret.

```
name: gitscrum
Redirect URI: http://{URL is the SAME APP_URL}/auth/provider/gitlab/callback
Scopes: api and read_user
```

.env file

```
GITLAB_KEY=XXXXX -> Application Id
GITLAB_SECRET=XXXXXXXXXXXXXXXXXX
GITLAB_INSTANCE_URI=https://gitlab.com/
```

#### Bitbucket

You must create a new Bitbucket OAuth Consumer, visit [Bitbucket new consumer guide](https://confluence.atlassian.com/bitbucket/integrate-another-application-through-oauth-372605388.html), and make sure you give write permissions when creating the consumer specially on (repositories , issues)

```
name: gitscrum
Callback URL: http://{URL is the SAME APP_URL}/auth/provider/bitbucket/callback
URL: http://{URL is the SAME APP_URL}
Uncheck (This is a private consumer)
```

.env file

```
BITBUCKET_CLIENT_ID=XXXXX -> Bitbucket Key
BITBUCKET_CLIENT_SECRET=XXXXXXXXXXXXXXXXXX Bitbucket Secret
```

#### Proxy

.env file

```
PROXY_PORT=
PROXY_METHOD=
PROXY_SERVER=
PROXY_USER=
PROXY_PASS=
```


## REST API

Issues are exposed via a token-based REST API secured with [Laravel Sanctum](https://laravel.com/docs/sanctum):

- Generate a personal access token at `/account/api-tokens` (session-gated, since the app authenticates exclusively via OAuth).
- Use the token as a Bearer token against `/api/v1/issues`.

## Continuous Integration & Deployment

- **CI**: every push/PR runs lint, asset build, migrations and PHPUnit via [GitHub Actions](.github/workflows/ci.yml).
- **Deploy**: a manually-triggered [GitHub Actions workflow](.github/workflows/deploy.yml) builds the app and deploys it to shared hosting.

## Screens

![Screenshot 0](http://i.imgur.com/jejT8hY.png)
![Screenshot 0](http://i.imgur.com/apcFdv0.png)
![Screenshot 0](http://i.imgur.com/TRzRIpU.png)
![Screenshot 0](http://i.imgur.com/VcpRaNk.png)
![Screenshot 0](http://i.imgur.com/8uMYCLv.png)
![Screenshot 0](http://i.imgur.com/rIwkn7i.png)
![Screenshot 0](http://i.imgur.com/D954dbU.png)

<br>

## Database schema 

![Screenshot 1](http://i.imgur.com/zdrEkkf.png)

<br>

### Do you need help?

Renato Marinho: [Facebook](https://www.facebook.com/renato.marinho) / [LinkedIn](https://pt.linkedin.com/in/renatomarinho13) / Skype: renatomarinho13


## Contributing

Contributions are always welcome! https://github.com/tinchodev/nx6-kanban/graphs/contributors


## License

Laravel GitScrum is licensed under the [MIT license](https://opensource.org/licenses/MIT).


## Thanks

#### Translate Team : [@orionlu0916](https://github.com/orionlu0916) , [@Bebbolus](https://github.com/Bebbolus) , [@dongm2ez](https://github.com/dongm2ez), [@rizalio](https://github.com/rizalio), [@ddmler](https://github.com/ddmler), [@Assada](https://github.com/Assada), [@edbizarro](https://github.com/edbizarro), [@ngabor84](https://github.com/ngabor84), [@MarwanMohamed](https://github.com/MarwanMohamed) and Manuel Ortega

#### Fork maintenance : Martin Arrua ([@tinchodev](https://github.com/tinchodev)) — Laravel 12/PHP 8.4 migration, Vite asset pipeline, Sanctum REST API, GitHub Actions CI, Docker Compose dev environment, and shared-hosting deploy pipeline.

- [Laravel PHP Framework](https://github.com/laravel/laravel)

- [Chart.js](https://github.com/chartjs/Chart.js)

- [Date Range Picker for Bootstrap](https://github.com/dangrossman/bootstrap-daterangepicker)
