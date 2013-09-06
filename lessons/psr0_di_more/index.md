Learning Drupal 8 - OOP In Drupal 8.md

# Lesson Title (lesson N)

## Summary

Now that we've got a grasp on OOP in PHP in this lesson we're going to take a look at some of the Drupal specific impelementations of these OOP practices. We'll talk about using the PSR-0 standard to ensure our classes are discoverable, and also about Drupal's class naming conventions. Then we'll take a look at the use of typed objects instead of stdClass throughout Drupal 8 and talk about what it means to module developers. Finally, we'll take a look at Drupal 8's service container and talk about the dependency injection pattern being applied, why it's a good thing, and how it'll affect the code you write.

## What should I know first?

* Be familiar with basic Drupal 7 module development.
* Understand the basics OOP in PHP.

## Learning Objectives

After watching this video viewers should:

- Understand the use of the PSR-0 naming convention for class autoloading.
- Namespace conventions in Drupal as they relate to PSR-0
- Object naming conventions and type hinting standards
- Understand the concepts of dependency injection and have a high level understanding of the injection container and it's role.
- Know where to find examples of the above in core.

## Lesson

**PSR-0 & Auto loading**

(Open core/modules/)

At it's most basic PSR-0 is just a naming convention that's become a standard in the PHP community. The primary goal is discoverability of code, in this class specifically the code that defines a particular class so that it can be automaticaly loadded on an as needed basis.

This solves the same problem that the `files[]` line in a module's info file solved in D7. However this method is inline with the PHP community, adopting the standard for Drupal 8 has made it much easier for core (and contrib) to include other external PHP libraries like Symfony or Twig that also adhere to the PSR-0 convention.

@todo: does this mean that code written for D8 w/ PSR-0 could in theory be integrated into another project that also supports PSR-0?

*Implement a simple class, use PSR-0, then use/ and do something with it in a .module file to demonstrate that autoloading works*

@todo: write some example code for this.

**Naming conventions**

- Module naming conventions? Has this changed at all?
- Naming conventions for your classes - @todo: figure out what these are and talk about them here.

**Goodbye stdClass hello Interface**

In D7 almost anytime we encounter an object it's of the type stdClass. A bare, no frills PHP object. Pretty much just a glorified array. Examples of this include $node, $user, $term , etc. In D8 however we've got actual classes that represent the strucuture of each of our 'datatypes' and $node is no longer just a stdClass object but in instance of the Node class which as an extension of the NodeInterface. Complete with methods we can call to do things like retrieve a node's ID or get it's title in a consistent manner.

*Take a look at some of the types that people are most likely to use*

@TODO - figure out what these are and make a list

**Type hinting**

Type hinting is a way of declaring that the variables passed in to a function or method must be of a specfic type. Array, stdClass, and NodeInterface are all types.

*open node.module and take a look at a few examples of type hinting in action*

Why type hint? You're ensuring that the data being passed to your code is of the format that you expect it to be. Consider this example:

```php
<?php
function feedCat(Cat $cat, CatFood $food) {
  return "Thanks for feeding " . $cat->name  " " . $food->type . "!";
}
?>
```

By type hinting and telling PHP excatly what kind of objects the feedCat function expects we're able to ensure that cats are only being fed cat food, and not accidently given dog food, or ice-cream. In addition we don't have to worry about elephants showing up and eating all the cat food.

Some additional notes about type hinting:

Always hint by interface whenever possible, ensuring that the object can be swapped for another that implements the same interface.

Do hint arrays, and stdClass objects.

Things like objects and arrays are hinted, scalar's and primitives like 'int' are not.

Related, if you've asked for an object that implements a specific interface it's bad juju to call a method on that object that is not a part of the interface spec. You're preventing your code from workign with swapped out object that doesn't also implement this non-standard method.


**What is Dependency Injection?**

Decoupled, clutter free, and easy to test.

Often reffered to as inversion of control.

*Concstructor Injection* is what's used throughout most of Drupal core. Providing an object with it's instance variables via the constructor. "I need X do to my job, so you're goign to have to provide those when you instantiate me."

*Setter Injection* uses a setter method on the object to pass in the required dependencies

Okay I got it. I understand dependency injection but where/when/how does it happen?

Rather than requiring you to manually inject all the appropriate objects into all the appropriate places at the right time which can be quite combersome for something with a class library as large as Drupal's Drupal 8 uses a *Dependency Injection Container*. The container assumes responsibility for instantiating classes and their dependencies based on environment configuration.

Keep in mind that a container works well for constructing services like  a cache or mailing service, but isn't used for data objects like a node or a user.

If you need a service, you request it from the $container, which will instantiate it for you with the appropriate dependencies.

Container is compiled so you don't need to parse config every time you request something. (provided by symfony)

Examples of things you might request from the container include

- A DB object for querying the DB
- An http request object for understanding context of the current request
- The module_handler class for invoking "hooks" on other modules

Ways you can access services from the container.

Drupal::service('service_name'), works in procedural code but you need to know the name of the service. Which isn't ideal because we don't want to hard code service names in our own code.

You can also write OO code and "get wired into" the container.

Event Subscriber Services

- Implement the EventSubscriberInterface and declare which events you want to be notified about.
- Write the service definition and add the 'event_subscriber' tag.

Controllers. The Drupal way is to implement an interface that has a factory method which accepts the container. Rather than make them services since we would end up with a lot of bloat in our container for glue code. (Check out book module in core)

Things to look at

core/lib/Drupal/Core/DrupalKernel.php
core/core.services.yml

If you want to add a service, mymodule/mymodule.services.yml

Compiler passes are classes that allow you to make changes to the container during compilation. Useful for doing something like switching out a DB dependency for Memcache. (Maybe not worth going over in an intro video) It's like alter hooks for the Container.

**DI for module developers**

Now that we know what dependency injection is, lets talk about when and how you'll encounter it as a module developer.

@todo: write some example code that demonstrates a controller using the ControllerInterface or whatever it ends up being named.

Writing our own services for use with the container is outside the scope of this video, but there's some good information about it here: http://titancloudworks.com/captains_log/post/drupal-services-at-your-service

**Examples & Resources**

This section should cover a bunch of different examples in core that show the best practices from above in action.

@todo: figure out if this is even necessary.

- List of resources?

## What's next?
*

## References
* [Dependency Injecdtion in Drupal 8](https://portland2013.drupal.org/session/dependency-injection-drupal-8) - presentation from DrupalCon Portland.
* https://drupal.org/node/1539454
* [WSCII Conversion Guide](https://drupal.org/node/1953346)
* http://katbailey.github.io/2013/05/11/dependency-injection/
* More information about type hinting: http://www.sitepoint.com/type-hinting-in-php/

