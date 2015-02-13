# tickets
Ticket thingy


## Generic app architecture workflow (for all actions)

 1. http request hits the application (application layer)
 2. zf2 runs the respective controller (application layer)
 3. controller validates data (application layer)
 4. controller creates command (domain layer)
 5. controller pushes command to command bus (infrastructure)
 6. command handler works with data from the command (domain + infrastructure layer)
 7. command handler returns an event on success (domain event)
 8. controller uses domain event to determine what to do next (application layer, usually redirect or page refresh)
