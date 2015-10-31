## Builderscrack Silverstripe Module ##

Silverstripe module for pulling down data/review from builderscrack.co.nz

Module is still being developed 

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
In your mysite/_config.php add the following (where the link is to your builders review) 
 ```
    BuildersCrack::setUrl("https://builderscrack.co.nz/tradies/efd80s/");
 ```
 or you can just set the traders reference id eg : efd80s
  ```
     BuildersCrack::setTrader("efd80s");
  ```
- Build with dev/build?flush=1 

See more mysite/_config.php [config options](#config-options)

In your template add the following 

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
    OR
    
- $JobReviewsTemplate | Returns the modules current template which is the above.

- After building template you will need to either setup a cronjob to pulldown reviews or logged in as admin simply run http://localhost/website/builderscrack/ 
this will download new reviews. 

- You can modify the reviews in the admin section

#### Cron Job 
- To run the builderscrack cron task call as required 
 ```
 $ php framework/cli-script.php /builderscrack/cronjob
  ```
Run standard cron job as admin simply run http://localhost/website/builderscrack/cronjob


#### Config Options
- setTrader | This allowes you to set the unique traders ID this is commonly found in there review link eg `efd80s` is the traders in https://builderscrack.co.nz/tradies/efd80s/
 ```
     BuildersCrack::setTrader("efd80s");
  ```
- setUrl   | You can set the full link to the review if you want.
```
    BuildersCrack::setUrl("https://builderscrack.co.nz/tradies/efd80s/");
```
- set_sandbox | Sets module into sandbox mode this will render a local sandbox.html file instead of retrieving from builderscrack site. File needs to be in the root of silverstripe folder 
```
    BuildersCrack::set_sandbox(true);
```