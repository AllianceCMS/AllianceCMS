#Naming Conventions

**Retrieval**

get(Descriptor) = Retrieve element(s), descriptor is optional

    getOne = Retrieve single element
    getSet = Retrieve a defined collection of elements
    getAll = Retrieve all elements

find = Find resource/element
search = Search resource(s)/element(s)
count = Retrieve number of items in element(s)

**Modification**

add = Add new element(s)
set = Assign a value to element(s)
update = Modify existing element(s)
alter = Modify the structure of element(s)
remove = Delete element(s)

**Multi-Step Creation**

setup = Setup/initialize element(s) by defining environment values
init = Setup/initialize element(s) based upon existing environment values
make = Create an element

**Testing**

has = Test that an element meets requirements, i.e. hasPermission
is = Test that an element is 'something', i.e. isLoggedIn
valid = Test that an element is valid based on defined criteria

**Comparison**

contains = Test that an element contains 'something'
equals = Test for equality

**Assignment**

send = Explicitly send one element to another element/source
retrieve = Explicitly retrieve element from external element/source
provide = Offer element(s) to another element
request = Request an external source for an element

**Viewing/Displaying**

render = Display result to standard output (web client, cli, webservice, etc...)

**Execution**

exec = Execute predefined procedure(s)


References: http://solarphp.com/manual/appendix-standards.naming.methods