## Silverstripe Module ##

Module is not finished yet. Please do not install till finished/complete.

#### Todo 
- Add admin check to scrape builders crack

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
Set your builders crack 
In your mysite/_config.php to Set the full link to the buildersCrack review do the following 
 ```
    BuildersCrack::setUrl("https://builderscrack.co.nz/tradies/befd80s/redefine-renovations-and-construction-ltd/reviews");
 ```
 or you can just set the traders reference id eg : befd80s
  ```
     BuildersCrack::setTrader("befd80s");
  ```
See more [config options](#Config)
Then in your template add the following

- $JobReviews   | this will render the module template with reviews
 ```
<% loop $JobReviews %>
    <ul>
        <li>$title</li>
        <li>$date</li>
        <li>$comment</li>
        <li>$jobNumber</li>
        <li>$href</li>
    </ul>

<% end_loop %>
    ```
    
- $JobReviewsTemplate | Returns the modules current template which is the above.

#### Cron Job 
- To run the builderscrack cron task call as required 
 ```
 $ php framework/cli-script.php /builderscrack/cronjob
  ```
Or if logged as in admin can simply run http://localhost/website/builderscrack/cronjob


#### Config Options
