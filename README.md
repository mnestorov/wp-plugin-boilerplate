<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/github/explore/80688e429a7d4ef2fca1e82350fe8e3517d3494d/topics/wordpress/wordpress.png" width="100" alt="Laravel Logo"></a></p>

# WordPress Plugin Boilerplate

[![Licence](https://img.shields.io/github/license/Ileriayo/markdown-badges?style=for-the-badge)](./LICENSE)


## Overview

A standardized, organized, object-oriented foundation for building WordPress Plugins.

## Contents

The WordPress Plugin Boilerplate includes the following files:

- **.gitignore** - used to exclude certain files from the repository.
- **CHANGELOG.md** - the list of changes to the core project.
- **README.md** - the file that you’re currently reading.
- **my-plugin-name** - directory that contains the source code

## Features

- The WordPress Plugin Boilerplate is based on the [Plugin API](http://codex.wordpress.org/Plugin_API), [Coding Standards](https://developer.wordpress.org/coding-standards/), and [Documentation Standards](https://developer.wordpress.org/coding-standards/inline-documentation-standards/php/).
- All classes, functions, and variables are documented so that you know what you need to change.
- The WordPress Plugin Boilerplate uses a strict file organization scheme and that makes it easy to organize the files that compose the plugin.
- The plugin includes a **'.pot'** file as a starting point for internationalization.

## Installation

The WordPress Plugin Boilerplate can be installed directly into your plugins folder "as-is". You will want to rename it and the classes inside of it to fit your needs. 

Terms like **'plugin-name'** and other variations are spread all throughout the file contents as well. You can use VS Code, Sublime Text, Atom.io or other capable text editors to mass-replace within multiple files. 

**Note:** *Here is a list of what you should replace (make sure to do case-sensitive search-replaces).*

For example, if your plugin is named **'my-example-plugin'** then:

- rename files from **my-plugin-name** to **my-example-plugin**
- **my-plugin-name** should become **my-example-plugin**
- **My_Plugin_Name** should become **My_Example_Plugin**
- **MY_PLUGIN_NAME_** should become **MY_EXAMPLE_PLUGIN_**

It's safe to activate the plugin at this point. Because the WordPress Plugin Boilerplate has no real functionality there will be no menu items, meta boxes, or custom post types added until you write the code.

## Recommended Tools

### i18n Tools

The WordPress Plugin Boilerplate uses a variable to store the text domain used when internationalizing strings throughout the Boilerplate. To take advantage of this method, there are tools that are recommended for providing correct, translatable files:

- [Poedit](http://www.poedit.net/)
- [i18n](https://codex.wordpress.org/I18n_for_WordPress_Developers)

Any of the above tools should provide you with the proper tooling to internationalize the plugin.

## Important Notes

### Includes

Note that if you include your own classes, or third-party libraries, there are four locations in which said files may go:

- **my-plugin-name/includes/functions.php** is where general functions, shortcodes, etc. of the site reside
- **my-plugin-name/includes/classes** is where functionality shared between the admin area and the public area parts of the site reside
- **my-plugin-name/assets/src/admin** is for all admin-specific scripts and styles
- **my-plugin-name/assets/src/public** is for all public-specific scripts and styles

**Note:** *We have the **Loader** class for registering the hooks.*

### The 'Loader' class

The goal of this class is to encapsulate the registration of hooks and then execute both actions and filters at the appropriate time when the plugin is loaded.

#### How to you use the 'Loader' class to hook actions and filters

In order to understand how to use the loader, we should look at the source for the core plugin class, **Plugin_Name** in **class-plugin-name.php**.

The first block of code in this class declares the private container `$loader`:

```php
protected $loader;
```

Next, we see within the `__construct()` method that the functions `load_dependencies()` and `define_public_hooks()` are called:

```php
public function __construct() {
	if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
		$this->version = PLUGIN_NAME_VERSION;
	} else {
		$this->version = '1.0.0';
	}

	$this->plugin_name = 'plugin-name';
	$this->load_dependencies();
	$this->set_locale();
	$this->define_admin_hooks();
	$this->define_public_hooks();
}
```

Following the construct, we see the function `load_dependencies()` defined. Here is where the resource files for classes used by the plugin are called. The first class resource file we see being required here is `class-plugin-name-loader.php`.

```php
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-plugin-name-loader.php';
```

**Example**

If we have defined a class called **Plugin_Name_CPT** in the file **class-plugin-name-cpt.php** located in the includes directory of the plugin, we require it by adding this line to `load_dependencies()`:

```php
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-plugin-name-cpt.php';
```

**Note:** *Require any additional class files the plugin relies on within the `load_dependencies()` function*.

So now, the first step is done.

---

Continuing our examination, we see that at the end of this function, our earlier declared container called `$loader` is now defined as a **new object** of the class **Plugin_Name_Loader**, which it can do now because it was just required earlier in this function:

```php
$this->loader = new Plugin_Name_Loader();
```

Now let's skip down and take a look at `define_public_hooks()`. This is another function that was called from the `__construct()` method earlier. This is a great place to organize hooks used by the plugin. Here's how it looks:

```php
private function define_public_hooks() {
    // Instantiates a new object of the class Plugin_Name_Public.
    $plugin_public = new Plugin_Name_Public( $this->get_plugin_name(), $this->get_version() );
    // This is where the loader's add_action() hooks the callback function of the class object. 
    $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
    // Another action is passed to the class object.
    $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
}
```

**You can see two important things going on here:**

- An object of a class is instantiated.

- The loader custom version of add_action() is performed which accepts the object as an argument.

This is where the loader becomes useful for us. Instead of passing just the hook and callback function to `add_action()`, the loader uses it's own custom `add_action()` and `add_filter()` functions which allow us to pass three arguments: *hook*, *class*, and *callback* function. This way it knows how to find the function in your class.

For reference, here are [all of the arguments](https://github.com/mnestorov/my-plugin-boilerplate/blob/main/my-plugin-name/includes/classes/class-plugin-name-loader.php) accepted by the loader's version of `add_action()`:

```php
public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
	$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
}
```

So now, the second step is done.

---

While there are ways to pass a class function to the WordPress `add_action()` or `add_filter()`, this is how we do it through the boilerplate's loader.

**Example**

Within the function `define_public_hooks()`, we will repeat the two steps we just examined above. 

Remember, we can only do this because earlier we required our class file for **Plugin_Name_CPT**.

1. Instantiate an object of our class:

```php
$plugin_cpt = new Plugin_Name_CPT();
```

2. Use the loader's `add_action()` to hook a function of `$plugin_cpt`:

```php
$this->loader->add_action( 'init', $plugin_cpt, 'my_cpt_alert_function' );
```

That's all. 

---

Here is a final checklist to make sure we've done everything we need to:

1. Create our class. In the above example it was defined as **Plugin_Name_CPT** at **includes/class-plugin-name-cpt.php**. Here is a very simple class we can use for testing which we'll use to display an message every time WordPress initializes our CPT class:

```php
<?php
class Plugin_Name_CPT {
    public function my_cpt_alert_function() { ?> 
        <script>alert("CPT IS WORKING!");</script> <?php
    }
}
```

2. Require our class within the `load_dependencies()` method in the **class-plugin-name.php**. 


```php
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-plugin-name-cpt.php';
```

3. Instantiate an object of our class within the method `define_public_hooks()` in the **class-plugin-name.php**.

```php
$plugin_cpt = new Plugin_Name_CPT();
```

4. Lastly, hook the method from our class to an action or filter. We do this within `define_public_hooks()` in the **class-plugin-name.php**.

```php
$this->loader->add_action( 'init', $plugin_cpt, 'my_cpt_alert_function' );
```

---

**Note:** In retrospect of all of the above, this `Loader` class helps to easily manage hooks throughout the plugin as we're working on our code, and we can trust that everything will be registered with WordPress just as we would expect.**

---

## License


This project is licensed under the MIT License.
