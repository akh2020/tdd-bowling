The famous bowling game to learn TDD
===========

## Techs
* php: php5, composer for autoloading and codeception for tests
* git: [strategy](http://nvie.com/img/2009/12/Screen-shot-2009-12-24-at-11.32.03.png), only TRUE merges and useful pushed commits

### Set up
* install composer : `curl -sS https://getcomposer.org/installer | php`
* run composer to install required packages : `composer install`

### Tools
* run codeception to run tests : `./bin/codecept run`
* run codeception to run tests  and generate coverage : `./bin/codecept run --coverage`
* run php-cs-fixer to check code style and show incorrect files and problems they have: `./bin/php-cs-fixer fix --level all . --dry-run -vvv`
* run php-cs-fixer to fix code style (use with caution) : `./bin/php-cs-fixer fix --level all .`


## Aim

Coding is a two players game. Each player has to wrote the minimal code possible to pass test and he must not care of what could be needed later.

This Bowling is a one player game. The master will contains the application fully tested, at this end.

BowlingGame has only two public methods :
* int score() which return the current score
* roll(int pins) which set how many pins where hit

## How to play

Foo has played and created new branch feature/abc , it is now Bar's turn.

1. Review code from Foo's Pull Request by commenting code on "Files changed" tab
  * if it is not good, then wrote it in the PR and wait Foo's correction
  * otherwise, pull it locally and make a true merge into develop
2. Rebase branch feature/abc and jump on it
  * make the application's code to answer Foo's new test in this branch
  * check code style
  * add files to git index
  * check if staged files are correctly formed with `git diff --cached --check` and correct them if necessary
3. Jump to a new branch feature/xyz (beware: of the git's stategy)
  * write a new test
  * check code style
  * add files to git index
  * check if staged files are correctly formed with `git diff --cached --check` and correct them if necessary
4. Make the PR for feature/abc and publish feature/xyz
5. It's now Foo's turn.
