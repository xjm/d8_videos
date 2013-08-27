## Object Oriented Programming Basics for PHP

## To-dos

1. Cover type-hinting
1. Cover inheretance
1. Cover creating an interface
1. Switch to camelCasing for method names

This is a narrative walking thorugh what will eventually be covered in video form. We'll be walking through the following concepts:

1. Side-by-side comparison of proceedural and object-oriented code
1. How methods and properties work
1. What conceptually makes OOP a more rational model for development work
1. How constructors work
1. Basic conventions for file structure in OO applications
1. Working with 'private' and 'static' methods
1. How to use namespaces

This lesson assumes that you have worked with PHP code before and that you have little OOP experience.

We will be working through some example code which is packaged with this lesson. You will need a working web server with PHP 5.3 or above installed. You can use [Acquia's Dev Desktop](http://www.acquia.com/products-services/dev-desktop) to get an enviornment running quick.

## Resources

* [Object-oriented code conventions on drupal.org](https://drupal.org/node/608152)

## Outline and narrative
 
For those of us developers who have been working primarily in Drupal over the last several years, we may not have had the chance to work with object oriented code much. In Drupal 8, there's been some major overhauls to take advantage of object oriented principles and patterns. This both will allow Drupal to be more sustainable going into the future, and also presents a huge opportunity for us to upgrade our skills as well. 

If you're new to OO programming, the first OO code you see could look a little frightening, but after wrapping your mind around a few basics, you'll start to understand how leveraging OO principles will make your own code more sane and efficient.

To start with, let's look at how some procedural code might work, convert it to OO.

Keep in mind that everything that we're doing here requires that you have PHP 5.3 or higher enabled. If you don't have this available, you can install Dev Desktop to get a fully functioning development environment set up with PHP 5.3 in either Mac or Windows.

To get set up with this example, we're using code from the /examples/oop folder.

*Copy over 01.index.php.proceedural-code.step to index.php and open in an editor*

The goal of this code is to give us some functions to roll virtual dice and display the result. The code is simple and the structure - using functions and calling them - should be pretty familiar to you as a PHP developer. Let's look trough the code and give it a quick demo in the browser.

*Walk through code, then open in a  browser to see it in action*

Nothing too complied. Now, this style of coding is called 'procedural', because it gives an order for things to be done. First, we define how many dice we want. Next, we roll the dice. Then we format it and finally we print it to the page. The functions that we built are procedures that can be part of of this step-by-step process. 

This style of coding makes sense, but using objects give us even greater flexibility. Let's look at this same code, but structured as a class.

*Copy over 02.index.php.dice-class.step to index.php*

This code uses a new type of structure called a 'class'. Down here at the bottom we're doing something called 'instantiating' the class using the 'new' keyword and the name of the class. The result of instantiating the class is that we now have an object-type variable. Whereas before, we were passing some data to a function and getting some data out, and that was it. Now what we do is call 'methods', which are just functions that belong to a class - you see the 'roll' and 'format_roll' methods defined here. Variables that belong inside of the object are called 'properties'.

Once of the benefits to using properties is that they persist in the object. If you've ever defined a variable as 'static' in a function to keep it around for multiple function calls, properties work the same way, except they're available to all the functions in a class. So, when we define a property using $this->last_roll in the roll() function, we can then use it in format_roll() later without having to pass it to the function.

*The benefits of OOP structure*

There's a few things to note about this new structure. First, we were able to use very simple function names, without worrying about conflicting with other function names outside of this class. We can even define functions in a class that have the same name as PHP functions you use every day, like strpos(). This means we can name our functions based on their role (no pun intended) they're going to have, not based off of whatever other functions we have to worry about.

Secondly, the code is a bit more clear. Once you get used to the new syntax that objects have, the code is actually more readable and kind of documents itself. We would need fewer comments to explain the relationship between the different functions, because they're all associated with each other in a class.

But these two benefits are really just the start. Object oriented programming is really presents a different way of thinking about code. Objects actually tend to model what we do with our code more accurately than simple variables and functions do, and as a result, OOP code is easier to maintain over time, and allows for easier collaboration in a team.

*Explain how OOP makes relationships explicit*

For example, when we look at the functions in our first example, there is actually a real relationship between the first and second function, but that relationship isn't defined in code. It's up to the coder to draw the relationship between the two functions, pass the right data between them and come up with a  solution. This totally works as long as a developer is familiar with their own code, but as soon as other developers start to work on a project, or the application becomes more complicated, it will become more and more likely that the assumptions are made at the beginning start to take their toll and become harder and harder to work with.

With the class structure, on the other hand, we draw an explicit relationship between our two functions. They both belong to a class called 'Dice', which more clearly models what we'd find in the real world. We have dice objects, and what can we do with them? We can roll them, for one, so that's a method that works with the Dice object. We can also - for example - record the results, and that's what the format_roll() method prepares us for.

Something that structuring OO code allows is for unit testing of particular components of an application. Procedural code is much more difficult to test, meaning that it's more likely that code will break in unpredictable ways that are hard to track down. You've probably heard of 'test-driven development', and while you not fully embrace the idea for smaller projects, it is only made possible through OOP. One important reason that Drupal has moved to using more OO code is due to the need to reliably test itself as it moves forward and continues to increase in complexity.

*Explain the constructor*

One thing we haven't talked about is this 'Dice' function in the 'Dice' class. This is called a 'constructor'. Whenever we instantiate a new object, a function with the same name as the class will be called - if it exists - with whatever parameters we pass to it. In this case, our constructor takes the number of dice as well as a low and high number.

In our constructor we can also define any variables we want available to use for other function calls, so we're defining a default separator and initializing our last_roll property. This constructor also serves as documentation regarding what properties (i.e. variables) we're likely to be using throughout the class.

*Separate the class into a separate file*

What you're going to see in Drupal as well as most modern applications is that classes live in their own files and that the files have the same name as the class. One obvious reason for this is consistency and predictability, but it will also come into play in the next set of videos when we talk about PSR-0 and autoloading.

So, let's separate this out into a structure we'd normally see, with the class in its own file.

*Copy 03.Dice.php.moving-the-cass-into-its-own-file.step to /classes/Dice.php*

*Copy 04.index.php.without-the-class.step to index.php*

*Open both in an editor*

Okay, you see how we've got this separated out. Let's make sure it works.

*Refresh the browser*

Okay, great. It's going to take a while to understand the full implication of using objects, but you're off to a good start.

Now, one thing we can do with a class that we can't do with functions it make it clear if the methods are intended to be used just within the class, or outside of a class. The full range of methods that can be used by other parts of the application is called the class's 'interface'. For our Dice class, the entire class presents *is* the interface. 

Having all of a classes methods available to the public isn't always the best idea. Sometimes the method is subject to change in the future, or the creator of the class doesn't want to be responsible for other code using it and then breaking if they change it. In cases like that, you can define a function as 'private', meaning that instances of the class can't use it. Let's look at an example:

*Copy 05.Dice.php.adding-private-method.step to /classes/Dice.php and open in editor*

So, we've refactored this code to include a new method called 'random_number_in_range', which we use when we loop through the dice in roll(). It has the private keyword attached, so we can't use it from an instance, but let's try anyway.

*Copy 06.index.php.calling-private-method.step to index.php and open in editor*

See our call to the private function here?

*Refresh editor*

Okay, it doesn't work as expected. Now, Drupal's way is to not use Private at all, meaning in any Drupal classes, all the methods are fair game.

One more thing we can do here is make our methods usable on their own, without instantiating a class. This could be a nice addition to our interface, if some of the methods really do stand on their own. The way that we define a function this way is by using the 'static' keyword next to the function name.

*Copy 07.Dice.php.adding-static-method.step to /classes/Dice.php and open in editor*

So, we've added an additional method here called wrap_in_brackets, and we're now using it as the default formatting method for our format_roll() function.

*Copy 08.index.php.calling-static-method.step to index.php and open in editor*

Here we're using a new syntax to call a method of a class without instantiating it. I've commented out our previous code so you know it doesn't have any effect on our output here.

*Refresh browser*

Okay, looks like we can use it. If we removed the static method, however…

*Remove 'static' from wrap_in_brackets function and refresh in browser*

Our code still runs but we get an error. This error can be turned off using a PHP variable, but it gives us an indicator that we're violating the intention of the interface, and that we should find another way to approach this.

One last thing I'd like to cover before we talk about autoloading is namespacing. If you've used previous versions of Drupal or have worked with PHP code in general for any length of time, you're familiar with the idea of prefixing function and variable names so that they don't conflict with other function or variable names. Sometimes this ends up in really long names, like my_app_some_component_my_function(). One thing namespacing does is allow you to use your own function names without worrying about a conflict, which makes the function names more readable. This ultimately makes it much easier to work with third party code as well, which is one of the big payoffs for Drupal 8.

Let's see namespacing in action.

*Copy 09.Dice.php.adding-namespace.step to /classes/Dice.php and open in browser*

The only line we added here was the namespace. In essence, this serves as a kind of prefix to the functions and classes we use in this file. If we load up our index page now…

*Refresh the browser*

We get an error because we now need the full namespace to use our function. We can get to our function by using something called a 'fully qualified name', or we can simply utilize a 'use' statement.

*Copy 10.index.php.using-namespace.step to index.php and refresh browser (see, it works now), then open in editor*

By using the 'use' statement, we can then use the class names exactly the way we would without the namespace.

We can use whatever namespaces we'd like, but the most common convention is to start with a 'vendor', which is likely the company or organization that's producing the code, followed by some meaningful sub-namespaces. In Drupal, these sub-namespaces line up with sub-folders for reasons we'll talk about in upcoming videos.

When we use the 'use' keyword, we also add in the name of the class to the end of the namespace. In a sense, our class extends our namespace.

In this example case, our namespace seems like more work than it's worth, and as you start working with custom Drupal modules, you're probably going to have some similar feelings. But, namespacing gives us some additional benefits that really payoff when it comes to autoloaders - which will discuss in the next set of videos - and in working on a complicated application with lots of different classes and functions. Over time, once the syntax becomes familiar, you'll start to understand the benefits and namespacing will become second nature.

This covers some of the most important technical concepts when it comes to working with OOP. There's a lot more that you'll uncover the more you work with mature PHP projects and develop your own applications. For now, though, we're going to come back to Drupal 8 and talk about what these OO concepts look like when applied to Drupal 8.
