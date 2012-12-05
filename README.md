SilverStripe Simple Facebook Like Button
========================================

There are several other Facebook integration modules out there but I didn't find any
that were just a really simple like button. This should be super easy to use and it
integrates with the OpenGraph module: <https://github.com/tractorcow/silverstripe-opengraph>.

## Requirements
Silverstripe 3.0+

## Maintainer
Mark Guinn - markguinn@gmail.com
Pull requests welcome.

## Installation
Download this module into a folder in the root of your project. Does not require /dev/build.

## Usage
The simplest case is to add this to _config.php:

```php
Object::add_extension('Page', 'FBLikeButtonExtension');
```

Then add $FacebookJSSDK to your main template right after the body tag. Then just add
$LikeButton anywhere you want one. If you're using the OpenGraph module the app ID will
be pulled from that, otherwise you'll need to set:

```php
FBLikeButtonExtension::$application_id = 'appidhere';
```

Application ID's can be attained here: <https://developers.facebook.com/apps>
Any changes to the default configuration can be made as follows:

```php
FBLikeButtonExtension::$default_button_config['layout'] = 'button_count';
```

Using the same attributes found here: <http://developers.facebook.com/docs/reference/plugins/like/>

Any Page class or subclass can also implement a getFBLikeButtonConfig method to override
the default configuration.

