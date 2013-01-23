WELCOME TO ZOUNDATION!
------------------------------

Zoundation is a starter theme that integrates Foundation, responsive front-end framework authored by Zurb.
http://foundation.zurb.com/

This HTML5 responsive theme is built to support any device with any resolution and is built using a 12-column flexible grid.

Foundation provides many reusable UI elements such as button styles, form styles, tabs styles, alerts, accordion panels, inline lists and table styles.

For a complete listing of components, view the Foundation Docs.
http://foundation.zurb.com/docs/



ZOUNDATION SUPPORT MODULE
------------------------------

We have also built the Zoundation Support module: http://drupal.org/project/zoundation_support 

This module provides Orbit responsive image slider integration, custom built menu blocks for topbar and nav-bar, placeholder elements and a few minor UI fixes difficult to do from the theme.

Foundation requires the use of at least jQuery 1.7. 
Zoundation requires the use of the jquery_update module 7.x-2.3-alpha1 to allow for this requirement: http://drupal.org/project/jquery_update

After installing jquery_update go to admin/config/development/jquery_update and chose jQuery Version: 1.7

The Zoundation Support module checks to ensure that jquery_update >= 2.3 is installed and configured to use at least jquery 1.7. This is required for proper functioning of Foundation's javascript add-ons.



USING COMPASS IN ZOUNDATION
------------------------------

To use Zoundation, you will need to install Compass http://compass-style.org/install/ 
or use a GUI tool such as CodeKit Project: http://incident57.com/codekit/index.php

Foundation does not work well with LiveReload and has some configuration issues with Compass.app

From Foundation Docs - http://foundation.zurb.com/docs/compass.php - Bottom of the page.

      LiveReload
      While LiveReload works great within CodeKit, it doesn't work well on its own because you can't update it to use your system Sass and Compass directories. Do not use this application to compile Foundation.

      Compass.app
      You can get Compass.app to work with Foundation, but it isn't that easy. Read documentation on how to get Foundation working with this app, here: https://github.com/handlino/CompassApp/wiki/Use-Compass-Extensions.


After Compass is installed, install the zurb-foundation Compass gem.

These docs will step you through how to install:
http://foundation.zurb.com/docs/compass.php


