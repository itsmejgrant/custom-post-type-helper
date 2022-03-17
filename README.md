# Custom Post Type Helper

A super simple abstraction to make creating a Custom Post Types in WordPress a *breeze.*

## Installation

You can either a) install with composer or b) copy the main the file and require it your functions file.

### Composer

In your terminal, in the directory where your composer.json is (usually the theme directory):

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
function my_custom_function() {
  // Includes optional menu icon argument
  $books = new CustomPostType('Books', 'dashicons-book');
}
add_action('init', 'my_custom_function');
```

By default, labels are based of the name passed as the first argument. You can override any of them using the `set_labels()` method. For example, we could the singular name if it doesn't make sense. The default for this is the name argument without the 's'.

```php
function my_custom_function() {
  $people = new CustomPostType('People');
  $people->set_labels([
    'singular_name' => 'Person'
  ]);
}
add_action('init', 'my_custom_function');
```

The `set_labels()` method an array of labels for this post type. Please see [here for a list of supported labels](https://developer.wordpress.org/reference/functions/get_post_type_labels/)

Similarly, the `set_args()` method allows us to override the default arguments. 

```php
function my_custom_function() {
  $sandwiches = new CustomPostType('Sandwich');
  $sandwiches->set_args([
    'menu_icon' => 'dashicon_sandwich'
  ]);
}
add_action('init', 'my_custom_function');
```

[See here for a list of supported arguments](https://developer.wordpress.org/reference/functions/register_post_type/)
