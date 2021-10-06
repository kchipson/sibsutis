# Orbit Fox

[Home](../README.md)

## Module developing guidelines

### File Structure

All modules reside inside a folder called `obfx_modules`. Inside this folder, each module 
resides in a folder with the same name as the module slug.

The module folder can have the following structure:
```$bash
module_slug/
   |-- css/
   |    |_ ...  # files that contain the css for the module
   |    
   |-- js/
   |    |_ ...  # files that contain the js for the module
   |    
   |-- views/
   |    |_ ...  # files that contain the display for the module
   |    
   |_ init.php  # entry point to plugin
```
In addition you can extend and add to this structure as need, but this is the minimum required 
file structure for a module to be considered by Orbit Fox.

The entry point `init.php` must define a class that respects the following namespace pattern 
`Module_Slug_OBFX_Module` and must extend `Orbit_Fox_Module_Abstract`.

### Required Methods

By extending the `Orbit_Fox_Module_Abstract` class you benefit from Orbit Fox’s automagic 
methods that make it easy for you to write modules also enforces the required methods for 
the module to work.

The methods need for the module to work are as follows:

 - `enable_module()` - This method should return true or false and its purpose is to signal 
 to Orbit Fox if this method should be listed or not. Is applicable to the current install 
 or not. (**Eg.** *A specific theme or plugin exists, needed for the module to be valid.*)
 
 - `load()` - This method contains logic needed for the module to load. A hook is registered 
 with WordPress for the init action that calls for this method. Use it as needed. No return 
 type is specified.
 
 - `hooks()` - This method is invoked to register actions and filters defined here via 
 the `$this->loader` class variable inherited from the abstract class `Orbit_Fox_Module_Abstract`. 
 An example would be:
 ```$php
 public function hooks() {
    ...
    $this->loader->add_action( 'wordpress_action_name', $this, 'module_public_method' );
    $this->loader->add_filter( 'wordpress_filter_name', $this, 'module_public_method', 10, 2 );
    ...
 }
```

 - `public_enqueue()` and `admin_enqueue()` - This methods are similar, they both return an array 
 of resources that Orbit Fox should enqueue. The difference is that one is used for the front end 
 and the latter is used for the admin. Example of the returned array:
 ```$php
array(
     'js' => array(
	    'vendor/lib' => array( 'jquery' ),  // ../js/vendor/lib.js
	    'script' => array( 'jquery' ),      // ../js/script.js
	),
	'css' => array(
	    'style' => false,                   // ../css/style.css
	),
);
```

 - `options()` - This method returns an array of options needed by the module. Options defined here 
 also build form elements inside Orbit Fox Admin area for setting defined Module Options. 
 Example of returned array:
 ```$php
array(
     ...
     array(
          'id' => 'option_id',                              // id for the input element
          'name' => 'option_name',                          // the name to store in DB
          'title' => 'Mod Option Title',                    // title for the form element
          'description' => 'Mod Option Description ...',    // Description
          'type' => 'text',                                 // type of element: (text, textarea, select, radio etc.)
          'default' => '',                                  // a default value if needed
          'placeholder' => 'Add some text',                 // placeholder (* optional)
    ),
    ...
);
```

In addition you can assign values inside the `__construct()` method to the predefined class vars:

 - `$name` - The name of the module. Is displayed inside Orbit Fox Modules.
 - `$description` - A short description for the module. Is displayed inside Orbit Fox Modules.
 - `$auto` - Flag for autoloading Module.
 
 **NOTE:** Remember to also have a call to `parent::__construct();` so that you can inherit 
 required functionality from the base model.
 
 ## Registering the module
 
 **If your module is part of the core deployment of Orbit Fox** just add the module slug inside 
 the Global Settings **$modules** array.
 
 **If your module is third party**, you need to register a filter  `obfx_modules`  to append your 
 module slug to the Global Settings **$modules** array.
 
 