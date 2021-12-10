# DX Plugin Boilerplate

A standardized, organized, object-oriented foundation for building DX Plugins.

## Contents

The DX Plugin Boilerplate includes the following files:

* `.gitignore` - used to exclude certain files from the repository.
* `CHANGELOG.md` - the list of changes to the core project.
* `README.md` - the file that you’re currently reading.
* A `plugin-name` - directory that contains the source code

## Features

* The DX Plugin Boilerplate is based on the [Plugin API](http://codex.wordpress.org/Plugin_API), [Coding Standards](https://developer.wordpress.org/coding-standards/), and [Documentation Standards](https://developer.wordpress.org/coding-standards/inline-documentation-standards/php/).
* All classes, functions, and variables are documented so that you know what you need to change.
* The DX Plugin Boilerplate uses a strict file organization scheme and that makes it easy to organize the files that compose the plugin.
* The plugin includes a `.pot` file as a starting point for internationalization.

## Installation

The DX Plugin Boilerplate can be installed directly into your plugins folder "as-is". You will want to rename it and the classes inside of it to fit your needs. For example, if your plugin is named 'dx-example-plugin' then:

* rename files from `plugin-name` to `dx-example-plugin`
* change `plugin_name` to `dx-example-plugin`
* change `plugin-name` to `dx-example-plugin`
* change `Plugin_Name` to `Dx_Example_Plugin`
* change `PLUGIN_NAME_` to `DX_EXAMPLE_PLUGIN_`

It's safe to activate the plugin at this point. Because the DX Plugin Boilerplate has no real functionality there will be no menu items, meta boxes, or custom post types added until you write the code.

## Recommended Tools

### i18n Tools

The DX Plugin Boilerplate uses a variable to store the text domain used when internationalizing strings throughout the Boilerplate. To take advantage of this method, there are tools that are recommended for providing correct, translatable files:

* [Poedit](http://www.poedit.net/)
* [i18n](https://codex.wordpress.org/I18n_for_WordPress_Developers)

Any of the above tools should provide you with the proper tooling to internationalize the plugin.

## Important Notes

### Licensing

// TODO

### Includes

Note that if you include your own classes, or third-party libraries, there are three locations in which said files may go:

* `plugin-name/includes/functions.php` is where general functions, shortcodes, etc. of the site reside
* `plugin-name/includes/classes` is where functionality shared between the admin area and the public area parts of the site reside
* `plugin-name/assets/src/admin` is for all admin-specific scripts and styles
* `plugin-name/assets/src/public` is for all public scripts and styles

**Note:** We have the `Loader` class for registering the hooks.