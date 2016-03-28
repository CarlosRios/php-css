# PHP CSS
### Create CSS easily with PHP
PHP CSS is a small framework that allows you to easily create uniform and minified CSS using PHP. You can then use that CSS however you please.

## Why PHP CSS?
PHP CSS was created to help with the overall generation of CSS for a PHP application/website. If you've ever had dynamic css that is controlled by php variables or mysql database values then this will help you tremendosly. Instead of writing all of the css in your application, or in the `<head>` of your php file, you simply add it to the object and echo it all at once.

### Getting Started
To use PHP CSS all you need to do is download the framework and include it into your project. Once included you can begin using it by instantiating the class.

```php
	require_once 'path_to_library/class-php-css.php';
	
	use CarlosRios\PHP_CSS;
	$css = new PHP_CSS;
```
### Setting the selector
One of the benefits to using PHP CSS is that it allows you to easily manipulate HTML selectors.

```php
	$css->set_selector( '#content' );
```

### Adding Properties
To add a property you simply use the `add_property` method which requires a property name and value. To add multiple properties you can use the `add_properties` method which requires an array of name and value pairs.

```php
	// Add a single property
	$css->add_property( 'border-color', $border_color_value );

	// Add multiple properties at once
	$css->add_properties( array(
		'background-image'	=> $background_image_url,
		'background-color'	=> $background_color,
		'height'			=> $height,
	) );
```

### Browser Prefixes
PHP CSS comes with a few browser prefixed properties out of the box (I intend to add more over time as they are needed). If you use any of the following properties, PHP CSS will automatically provide the css for them along with the available browser prefixes.

* **border-radius**
* **border-top-left-radius**
* **border-top-right-radius**
* **border-bottom-left-radius**
* **border-bottom-right-radius**
* **box-shadow**
* **transition**
* **transition-delay**
* **transition-duration**
* **transition-property**
* **transition-timing-function**

An example would be like so.
```php
	$css->add_property( 'border-radius', '2px' );
```

Which would create the following css
```css
	border-radius:2px;-webkit-border-radius:2px;-moz-border-radius:2px;
```

### Changing the selector
Once you have a selector set and you've added some properties to it, you can change the selector and begin adding new properties like so:

```php
	$css->change_selector( '#wrapper' );
	$css->add_property( 'max-width', '1200px' );
```

### Final Output
When you are done creating all of your css, all you need to do is echo the contents of the `css_output` method. PHP CSS will write all of the css as a minified string. You can add it to the `<head>` of your page like so.

```php
	<style><?php echo $css->css_output(); ?></style>
```
### Saving the CSS
Or you could save it to a separate css file as I would strongly reccomend, so that it can be cached by the browser and used properly. An example of how you could do that would be as follows.

```php
	file_put_contents( 'style.css', $css->css_output() );
```

### WordPress Usage Example
I created PHP CSS while developing a theme in WordPress. I was able to utilize a great options framework (Redux) to generate options for my clients, and while Redux does provide a neat way to generate css, it still didn't quite meet my needs. For instance if I wanted to check an option that returned an array of values, and then apply css based on those values, I still had to write quite a bit of code. Now with PHP CSS I'm able to do so much more easily. Ex:

```php
	// Gather the options
	$primary_button_type = get_option( 'primary_button_type' );
	$primary_button_border = get_option( 'primary_button_border' );
	$primary_button_bg = get_option( 'primary_button_bg' );
	$primary_button_color = get_option( 'primary_button_color' );

	// Set the selector
	$css->set_selector( '.button-primary' );

	// Apply the styles
	if( $primary_button_type === 'flat' ) {
		
		// Add colors for the normal state
		$css->add_properties( array(
			'border-color'		=> $primary_button_border['regular'],
			'background-color'	=> $primary_button_bg['regular'],
			'color'				=> $primary_button_color['regular'],
		));
		
		// Add colors for the hover state
		$css->add_selector_state( ':hover' );
		$css->add_properties( array(
			'border-color'		=> $primary_button_border['hover'],
			'background-color'	=> $primary_button_bg['hover'],
			'color'				=> $primary_button_color['hover'],
		));
	}
```