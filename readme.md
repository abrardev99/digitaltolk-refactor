## Thoughts about this code:
Here are my thoughts about this code. 
* Code is lack of single responsibility principle. `BookingController` is handling a lot of 
  logic related to booking, jobs, and notifications. 
* There are a lot of `if` conditions being used which can be avoided.
* converting `requests` to `array` and then check if a parameter set is bad, we can avoid this suitation using request build in functioins like `filled`.
* There are a lot of temporary veriables being used which can be avoided too by using `early return` pattern. 
* Use of built in Laravel `Authorization and Gate` system is missing. 
* Use of built in Laravel `validation` system is missing. 
* Use of built in Laravel `Notification` system is missing. 
* We can use `service` classes of extra business logic which polluting our repository class.
* Direct use of `.env` variable is dangerous. Avoid env calls outside of your config files. This can break your code with config caching. Once the configuration has been cached, the .env file will not be loaded and all calls to the env function will return null.
* And finally I don't think we need repository pattern here. I think we can use models to make controller skinny and can use service classes for business logic. I don't know app actual context but if we often need to change database repository pattern is good.


## What is good code in Laravel? 
* A good code in Laravel is the code which follow all the laravel recommended practices. 
* Practice SOLID principles, specially Single responsibility principe.
* Use service class for extra business logic.
* Use of Laravel notification system for notification. 

## What I format/change in this code.
* I made separate controller for similar functionality and convert a single fat controller to four controllers.
* Early return in a lot of methods to avoid extra temporary variables. 
* Removed direct `.env` calls.
* Used `Gate` for an admin and super admin access instead checking manually. 
* Wish to use Laravel `validation` and `notification` system for validate requests and sending notifications.
* Repository must need a refactor but I can not as I don't know business logic. 

