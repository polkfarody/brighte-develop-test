# Application Walkthrough
This application does not have a UI, however because of the way it was built it could easily be adapted to have one. 
It's main purpose is to show separation of concern when it comes to minor services being introduced to larger applications
or application independent services.


#### src/

The **src/** directory is split up into 3 sections. 
- **Controller/**: This is used to accept a HTTP POST requests through URI "/delivery/process" with a JSON payload) .
- **Delivery**: This is the Use Case and the bridge between the application (controller) and the domain (service).
- **Domain**: This is the service that does all of the heavy lifting, this processes the deliveries and returns invoices

#### src/Controller/DeliveryController.php

- **__construct**: Symfony has automatic dependency injection, so pass in the container factory and it instantiates all of it's 
required dependencies.

- **process**: The process method is the API endpoint. This does some basic data validation to make sure we have 
received JSON and then creates a delivery collection. The delivery collection is then used to make the delivery order 
request. The last part of this code sends back the generated JSON data (invoices) to the end user (whoever that is)

#### src/Delivery/Factory/DeliveryOrderContainerFactory.php

 - **__construct**: Because there are different types of delivery orders the first param is a delivery order mapper. (Enterprise/Personal)
The notifier factory works out if any notifications need to be sent once the delivery order has been processed.
The strategy is the "Workflow" what steps are going to be followed to process the delivery order (based on delivery type)
Lastly the validator works out if any validation is required in order to process the delivery.

- **create**: The create method builds a delivery array collection with all of the required classes for each delivery 
order received.

#### src/Delivery/Notifier/EmailCampaignNotifier.php

This requires a Campaign and an API object. All notifiers must implement the NotifierInterface and  have a 
notifyObservers method. In this case it sends a message to an email campaign server with the result of the delivery order.

#### src/Delivery/Request/DeliveryOrderRequest.php

This is separate to the httpRequest. This class is used to communicate with the Domain Service and holds the delivery 
collections. It must implement DeliveryOrderRequestInterface

#### src/Delivery/Response/JsonDeliveryOrderResponse.php

Again this is different to the httpResponse. In this case we want to throw JSON back to the user. This is done in the
UseCase because the resulting data may vary depending on how the application is run. This must implement DeliveryOrderResponseInterface 

#### src/Delivery/Stub/*

These two files don't do anything except stand in for functionality that doesn't exist. They both implement the ApiProviderInterface 
so they are faking API calls to third party recipients.

#### src/Delivery/Validate/EnterpriseOrderValidator.php

This class uses the EnterpriseDeliveryApiStub to fake sending a message that validates an enterprise.

#### src/Domain/Collection/*

The collections work similar to Arrays except they throw an InvalidArgumentException if an object inside the Array being
passed into the collection does not match the required type. This allows us to have confidence that a list of objects 
passed into the service are the required type.

#### src/Domain/Container/DeliveryOrderContainer.php

The delivery order container holds all the required objects to process a delivery.

#### src/Domain/Entity/*

Each entity holds specific data only related to itself. Some of the entities implement other interfaces like NotifierObjectInterface 
ValidatableInterface. These require that these objects contain isValid and isNotified respectfully.	

#### src/Domain/Exception/*

A few Domain specific exceptions that are thrown during the delivery order process.

#### src/Domain/Factory/*

The factories main purpose in the domain is to differentiate deliveryOrder types and return the required class.

#### src/Domain/Mapper/*

The mappers role is to turn an object into an array and vice versa. These classes must implement the MapperInterface which
requires they have a toArray and toObject method. The main purpose for mapping classes in the service is to turn the 
delivery orders back into arrays so they can be JSON encoded. 

#### src/Domain/Util/ArrayKeyValues.php

This class takes an associative array of keys =\> types and validates a specified array. It can call a user specified 
function on each successful iteration. This class is used in loadable entities to ensure the correct data array and types
are being loaded.

#### src/Domain/Notifier/\*, src/Domain/Request/\*, src/Domain/Response/\*, src/Domain/Validate/\*

These four directories do not contain any instantiable classes. This is because they need to be created in the UseCase. 
Each directory contains Interfaces that must be implemented.

#### src/Domain/Strategy/*

The strategy is what we want the service to do. In this case we want to generate an invoice using the DeliveryOrderStrategyInterface.

#### src/Domain/Service/ProcessDeliveryOrderService.php

This is the processor. This class runs through all of the ingredients in the delivery order factory and processes each 
one and creates an invoice. (Keep in mind this is a very simple example.)

#### src/Domain/ValueObject/\*

The two ValueObjects are used to extend simple values and allow the service to call functions relating to the value provided.
For example the DeliveryType object takes a delivery type string and can then determine if the delivery is an express delivery
and what type of delivery it is (Enterprise/Personal).


#### framework_independent_test.php

This example script shows the DeliveryOrder Domain service running without using a http request. This script builds all
of the dependencies required and processes the delivery (It uses JSON found in a class called DummyJson). Obviously in 
real world you would pass in a JSON file or a URL that had the required JSON in it.

#### tests/\*
The DeliveryControllerTest runs the entire process from httpRequest through to httpResponse and validates the response 
invoice. The rest of the test cases only validate their own functionality. This application has about 97% test coverage.


 















