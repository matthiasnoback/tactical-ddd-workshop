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

## Entities

- Identity
    - User provided
    - Application generated
    - Persistence mechanism generated
    - Repository encapsulates identity generation
    - Surrogate identity
- Mutability & individuality
- Validation & consistency

### Checklist

- [ ] Does the object need to be retrieved from a repository by its unique identity?
- [ ] Does the object need to track changes?
- [ ] Are two instances equivalent if they have the same identity?

## Value objects

- Characteristics:
    - Descriptive
    - Immutable
    - Often composite, a conceptual whole
    - Replaceable
    - Comparable
    - Side-effect free behaviors

- [ ] Is it irrelevant which exact instance of the object is used?
- [ ] Can the object be replaced instead of modified?
- [ ] Are two objects of the same type equal if their properties contain equal values?

## Aggregates

- Consistency boundary
- Transactional consistency
- Eventual consistency

      When examining the use case (or story), ask whether it's the job of the user executing the use case to make the data consistent.

- Rules of thumb
    - Small aggregates
    - Reference aggregates by identity
    - Use eventual consistency
- Implementation
    - Root entity with unique identity
    - Favor value object parts
    - Use *Law of Demeter* and *Tell, Don't Ask*
    - Optimistic concurrency
    - Avoid dependency injection

## Repositories

- Collection or persistence oriented
- Persistence implementations
    - Unit of Work, changeset calculation
    - Event-sourcing
- Reconstitution
- Querying

## Domain events

- Immutable
- Relation with commands
- Authoritative
- Sufficient data
