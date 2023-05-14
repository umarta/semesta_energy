## SEMESTA ENERGY TECHNICAL TEST

#### setup environment
- install docker
- clone project
- run project


### build project
```shell
make build
```
### migrate
after build project done next run this script to migrate the database & seeder, make sure build process is done 

```shell
make migrate
```
### api documentation
to access api documentation visit this link
```
https://documenter.getpostman.com/view/2679695/2s93eePU5b
```
### hostname and port
```
base_url = localhost:1234
```

### do unit test
to run unit test
```shell
make test 
```
#### Why using laravel
Laravel is a popular open-source PHP web framework used for developing web applications. It is highly valued by developers because it provides a variety of features and tools that make web development faster, more efficient, and more secure.

Here are some reasons why developers choose Laravel for their web development projects:

- MVC Architecture: Laravel follows the Model-View-Controller (MVC) architectural pattern, which provides a clear separation of concerns between the application's logic, user interface, and data storage. This separation makes it easier to maintain and update the application code, and allows developers to work on different parts of the application simultaneously.
- Elegant Syntax: Laravel has a clean, simple, and expressive syntax that makes it easy to read and write code. It uses modern PHP features like anonymous functions, closures, and namespaces, which help developers write more efficient and maintainable code.
- Rich Ecosystem: Laravel has a vast ecosystem of tools and libraries that help developers build web applications quickly and efficiently. For example, it has built-in support for popular front-end frameworks like Vue.js and React, and integrates with various databases, caching systems, and message brokers.
- Testing: Laravel makes it easy to write automated tests for web applications. It comes with a testing suite called PHPUnit, which allows developers to write unit, feature, and integration tests for their application code.
- Security: Laravel provides various security features out of the box, such as encryption, hashing, and CSRF protection. It also has built-in tools for authentication and authorization, making it easy to implement secure login and access control for web applications.

Overall, Laravel is a powerful and flexible web framework that simplifies web development and provides developers with a range of useful tools and features to create robust and scalable web applications.

#### Why i choose RDBMS

Relational Database Management Systems (RDBMS) are widely used in modern applications because they provide a reliable, consistent, and efficient way to store, organize, and retrieve data. Here are some of the key reasons why RDBMS are used:

- Structured Data: RDBMS are designed to store data in a structured manner, using tables with columns and rows that can be easily queried and sorted. This makes it easy to organize and analyze large amounts of data, and ensures that data is consistent and accurate.
- Data Integrity: RDBMS provide mechanisms for ensuring data integrity, such as constraints and triggers, which can prevent invalid data from being entered into the database. This helps to maintain data consistency and accuracy, which is critical in many applications.
- Querying and Reporting: RDBMS provide powerful querying and reporting capabilities, which allow users to extract data from the database and perform complex analysis. SQL, the standard language for querying RDBMS, is widely used and well understood by developers and analysts.
- Scalability: RDBMS are highly scalable, and can handle large amounts of data and high transaction volumes. They provide mechanisms for managing concurrency, locking, and transaction management, which ensure that data remains consistent and accurate even under high load.
- Integration with Applications: RDBMS provide easy integration with applications, and many modern applications are built with RDBMS as the primary data store. This makes it easy to build applications that can handle large amounts of data, and provides a standard way for applications to interact with data.

In summary, RDBMS are used because they provide a reliable and efficient way to store, organize, and retrieve data. They are widely used in modern applications because they provide data integrity, powerful querying and reporting capabilities, scalability, and easy integration with applications.

##### what is concept of load balancer

Load balancing is the process of efficiently distributing network traffic or traffic into a group of servers, also known as a server pool or server farm. Load balancing is useful to ensure that one server of a website that receives a lot of traffic does not experience overload.

Load balancers are used in many types of applications, including web servers, application servers, and database servers. They are critical for maintaining high availability and scalability, as they can quickly and automatically route traffic to healthy servers if any servers fail or become overloaded.

### Visual of load balancer
![](load_balancer.jpg)


### ERD

![](erd.png)

### Flowchart

#### Login
![](login.jpg)

#### Register
![](register.jpg)