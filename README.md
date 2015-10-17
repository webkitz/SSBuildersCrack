## Silverstripe Module ##

Module not finished. 


###installation

1. Download the [`composer.phar`](https://getcomposer.org/composer.phar) executable or use the installer.

    ``` sh
    $ curl -sS https://getcomposer.org/installer | php
    ```

2. install with command line 
 ``` sh
    $ composer create-project webkitz/SSBuildersCrack --stability="dev"
    ```

### Setup

In your mysite _config.php to Set the full link to the buildersCrack review do the following 

BuildersCrack::setUrl("https://builderscrack.co.nz/tradies/befd80s/redefine-renovations-and-construction-ltd/reviews");

Then in your template add the following

- $getReviews   | this will render the module template with reviews
