SilverStripe Simple Facebook Like Button
========================================

There are several other Facebook integration modules out there but I didn't find any
that were just a really simple like button. This should be super easy to use and it
integrates with the OpenGraph module: <https://github.com/tractorcow/silverstripe-opengraph>.

Requirements
------------
Silverstripe 3.0+

Maintainer
----------
Mark Guinn - markguinn@gmail.com
Pull requests welcome.

Installation
------------
Download this module into a folder in the root of your project. Does not require /dev/build.

Usage
-----
The simplest case is to add this to _config/config.yml:

```
Page:
  extensions:
    - FBLikeButtonExtension
```

Then add `$FacebookJSSDK` to your main template right after the body tag. Then just add
`$LikeButton` anywhere you want one. If you're using the OpenGraph module the app ID will
be pulled from that, otherwise you'll need to set:

```php
FBLikeButtonExtension:
  application_id: YOURAPPIDHERE
```

Application ID's can be attained here: <https://developers.facebook.com/apps>
Any changes to the default configuration can be made as follows:

```php
FBLikeButtonExtension:
  application_id: YOURAPPIDHERE
  default_button_config:
    layout: button_count
```

Using the same attributes found here: <http://developers.facebook.com/docs/reference/plugins/like/>

Any Page class or subclass can also implement a getFBLikeButtonConfig method to override
the default configuration.

Bonus Twitter Support
---------------------
Twitter support is so easy it doesn't really need it's own module. But you get if for free with
this one. Just add `$TwitterShareButton` anywhere in a Page context. It will also work fine
in a list of pages (like a blog or search list).

LICENSE (MIT):
--------------
Copyright (c) 2013 Mark Guinn

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the
Software, and to permit persons to whom the Software is furnished to do so, subject
to the following conditions:

The above copyright notice and this permission notice shall be included in all copies
or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE
FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
DEALINGS IN THE SOFTWARE.