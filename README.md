# VacationModule

This is only a basic overview of architectural solution for VacationModule task.

Steps to run:

- Import DB model and initial data from sql/vacation_module.sql

- You can try the application by executing index.php from the command line.

TODO:
- Exception handling
There should be some Exception classes and try/catch blocks in the app.

- Tests
Test classes should also be written so that the code is covered at least by Unit tests.

- Possible usage of ValueObjects
Value objects could be used so that validation of model objects would be done before they are instantiated.
Also we would provide immutability in order to be certain about the data we are passing through the app.

- Mapping of db result to models
I am not happy how mapping to models works at the moment. I would probably try to introduce some sort of DataMapper in between.
Especially since at the moment mapping is being used in the DbAdapter, and db adapters should not be aware of mapping.

- Validation
Also there should be additional db fields and validation in the code to check wheter approval of the vacation request
could be approved by checking available days for the User.