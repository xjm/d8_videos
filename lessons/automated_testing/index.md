
## Outline

1. Benefits of testing
1. Create a functional test
1. Create a unit test
1. Review a PHPUnit test
1. Discuss some additional concepts around testing

## Narrative around intro and functional testing (transitions into less verbose mode later on)

There are numerous benefits to creating tests for Drupal 8 code. The first is that they can automate manual testing, which can be time consuming and error-prone. For example, if you imagine anything you'd test out in the browser, things like submitting a form, or checking if a block is displaying certain content, those same things can be captured in a test that you can run any time to make sure that the critical parts of your application are working properly.

If you're new to writing tests, there's a few key concepts to keep in mind. If you've been programming for a while, you've probably heard some of the terminology around tests, like 'test-driven development', 'regression testing' and 'unit tests', possibly a slew of others. So first, don't get overwhelmed. We're going to focus on two types of tests, functional and unit tests. Most of the other types build on top of these. Writing a test is super simple, and each test is usually a single line code. The structure of files and directories around these tests might seem confusing at first, but after you set them up once, you'll get the hang of it.

Let's start with a simple example of a functional test. In a functional test, Drupal will actually create a whole new Drupal site in the database from scratch, run the tests, and then delete it.

Let's start by creating a simple module that adds a page with some simple text. We'll set up our module from scratch to get some practice with the Drupal 8 file structure, but we won't go into any much detail here.

*Create a folder called 'test me' in /modules*

*Copy 01.testme.info.yml.initial-info-file.step to /modules/testme/testme.info.yml*

Nothing unique here.

*Copy 02.testme.module.initial-module-file.step to /modules/testme/testme.module*

We're adding a single page via hook_menu. Remember that this doesn't actually route the page to the code that creates the page, but it sets a URL for the menu system.

*Copy 03.testme.routing.yml.adding-routing-for-upcoming-controller.step to /modules/testme.routing.yml*

Here's where we actually connect up the code for our page with the URL.

*Copy 04.TestmeController.php.adding-a-page-controller.step to /modules/testme/lib/Drupal/testme/Controller/TestmeController.php*

And this Controller generates the content for the page. Nothing too fancy, just a little whimsical text here. Now let's install the module.

*Click 'Extend' in the UI*

*Check the Testme module and click 'Save configuration'*

*In the browser, go to /testme-page*

Okay, here's our page. Now, this isn't much, but it gives us enough to test. What we can do is make sure that at least a portion of the text that we see here is visible on this /testme-page URL when we install the module. Let's say what spurred this is a little confusion about what the text should actually be, and we want to make sure that the officially sanctioned text stays in. Normally to test this we'd have to open up the browser, navigate over to it and read the text, cross-referencing the official text. Imagine doing this every time you push a new version of the site. Not so much fun. So, we'll add a test for it.

Let's go through the process of setting up our test and then well step back and talk about some important testing concepts being illustrated.

*Create a Tests directory at /modules/testme/lib/Drupal/testme/Tests*

*Copy 05.EnsureImportantTextExistsTest.initial-test.php to /modules/testme/lib/Drupal/testme/Tests/EnsureImportantTextExistsTest.php*

We'll go through this code in a moment, but first let's make sure it's working.

In order to run tests, we have to enable the Testing module.

*Go to Extend, check 'Testing' and click 'Save configuration*

Now, we can find all the tests by going to…

*Go to Configuration > Testing*

This shows tests by group, and typically these are arranged by module. You can click the group to expand it and see the tests in that group.

*Scroll down and expand the Testme group*

Here's our test. Let's just run this one.

*Select the one Testme test and click 'Run tests'*

We can click the results to see that the test ran. Notice how it says that 5 tests ran. 

*Expand the dropdown*

So, this is where there's actually two meanings for the word 'test'. We created a 'test' file, but we actually added two tests purposefully, and then three other tests ran kind of as a side effect. Remember how I said that a test was really a single line. Well, if we look at our test code…

*Go to EnsureImportantTextExistsTest.php in an editor*

I'm switching here to a less verbose mode narrative style to save on time :).

* Explain the existence of the two tests, that the additional tests were run by installing the module and fetching the page.
* Explain the idea of an assertion.
* Break a test to demo it not passing
* Walk through the structure of the test file from top to bottom (mention naming convention for file, class and methods).
* Show how we can look at WebTestBase to review additional assertions and utilities.
* Show how we can look at TestBase for some additional basic assertions.
* Explain that a new Drupal installation occurs with each method.

* Walk through ContactSitewideTest.php as an example of various other assertions, creating a user, submitting a form, etc.

## Unit tests

See one in action:

* Copy 06.testme.module.adding-utility-function.step to module file
* Copy 07.CongratulateUnitTest.php.initial-test.step to test folder
* Run new test (notice it's much faster)
* Walk through new code in both module and test file.

* Explain the idea of a unit test (no dependencies) and why we have psudo-unit tests (Drupal code dependencies) as well in Drupal
* Difference is that the database is not installed or accessible
* Can use UnitTestBase or UnitTestCase ("Use Drupal as a Base, or the other when that's not the Case") (Drupal or PHPUnit)
* UnitTestBase includes access to the code base, not the database. UnitTestCase includes the autoloader, that's it.
* OPP and autoloading make unit tests much more feasible. It reduces dependencies that are hard to avoid with procedural programming. Autoloading allows you to call a class and its dependencies by just creating an instance of a class.

## PHPUnit

* If we wanted to test our utility function, we would need to wrap it in a class so we could use autoloading. If we look at how core handles utilities (look at some examples), we'd find some good examples.
* Not functional currently for contrib modules, but that will be fixed, so look at existing example in core. Review RearrangeFilterTest.php (simple one)

## Notes on testing

* Test-driven design doesn't always mean tests first. Tests are useful in iterations. Tests done right save time.
* Regression testing is creating a test when something messed up, just to make sure it doesn't happen again. Can be functional or unit.
