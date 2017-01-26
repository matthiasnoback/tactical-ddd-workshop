# Tactical DDD workshop

## Getting started

You don't need much to run the code in this project: just PHP 7 and composer. This project comes with a set up for Vagrant using Ansible for provisioning, so if you don't want to or can't install these dependencies on your machine, just run:

    vagrant up
    vagrant ssh
    cd /vagrant

Run the unit tests:

    vendor/bin/phpunit

Or run the sandbox script:

    php sandbox.php

### Setup debugging with XDebug in PHPStorm

- Go to "Preferences" - "PHP".
- Select PHP language level: 7.
- Edit the list of available interpreters.
- Add a "Remote" interpreter.
- Select "Vagrant".
- Wait until everything looks okay.
- Select "OK" to close all dialogs.
- Set a breakpoint, e.g. in `sandbox.php`, right-click on the file and select "Debug ...".
