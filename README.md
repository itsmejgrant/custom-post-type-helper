# Custom Post Type Helper

A super simple abstraction to make creating a Custom Post Types in WordPress a *breeze.*

## Installation

You can either a) install with composer or b) copy the main the file and require it your functions file.

### Composer

In your terminal, in the directory where your composer.json is (usually the theme directory).

`composer require itsmejgrant/custom-post-type-helper`

Then, in your `function.php` file: 

`use Itsmejgrant\CustomPostTypeHelper\CustomPostType`

That's it, you're ready to go!

### Manual installation

Copy the contents of the `CustomPostType.php` file and put it whereever makes sense in your theme directory.

Require it whereever you will be using it with:

`require 'path/to/your/file.php';`

## Usage

To use the helper, assign a new instance to a variable and manipulate as required. The only required argument is the name of the post type, however it's recommended to also pass a second argument to display a custom menu icon.

Example:

```php
// Includes optional menu icon argument
$books = new CustomPostType('Books', 'dashicons-book');
```