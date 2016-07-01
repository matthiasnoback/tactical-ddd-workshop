# Tactical DDD

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
- Rules of thumb
    - Small aggregates
    - Reference aggregates by identity
    - Use eventual consistency
- Implementation
    - Root entity with unique identity
    - Favor value object parts
    - Use Law of Demeter and Tell, Don't Ask
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
