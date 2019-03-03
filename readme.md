## Brighte Senior Developer Test

#### Instructions
Design and implement a domain service that will process these three delivery orders
(JSON on 2nd page) and return appropriate types of objects based on the delivery type with
the following specifications:

- Each delivery type can have a different workflow.
- Delivery with “enterpriseDelivery” type needs to be sent off to a 3rd party API for validation of the enterprise.
- Delivery order coming from an email campaign needs to communicate with a
separate marketing service indicating the success of the given email campaign.

#### Notes
Questions are welcome.

Demonstrate the use of SOLID principles, design patterns and domain driven design.
Indicate and showcase what sort of automated testing procedure would you recommend
to use for such a service.
- The code does not have to be 100% functional, the purpose of this test is to get
insight into your problem solving process and your understanding of the OOP.
- We are looking for encapsulation, inheritance/abstraction and polymorphism.
- Provide readme.md to explain your thought process.
- Please deliver the code via a public version control repository.

## Method

I decided to take a DDD approach to keep the logic that processes the request completely 
separate from the application. The "Domain" does not know or need to know anything about the
application. This approach allows the Delivery Order Service to be run from anywhere as long as the
appropriate objects are parsed into the Delivery Order Service.

## API Workflow

**Prerequisites** 

Have a web server setup with an endpoint to perform this action.
1. Receive HTTP Request
2. Validate JSON
3. Create a Delivery Order Request Type (In this case JsonDeliveryOrderRequest)
4. Create a Delivery Order Service using the DeliveryOrderRequest