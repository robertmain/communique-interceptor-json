#JSON Interceptor for Communique
Provides a JSON inteceptor for Communique REST client. You can find the documentation for Communique [here](http://robertmain.github.io/communique).

##Installation
The easiest way to install is using composer:  
`composer install communique-interceptor-json`

###Typical Usage
In order to be loaded and considered valid, all inteceptors must implement the [\Communique\Interceptor](http://robertmain.github.io/communique/classes/Communique.Interceptor.html) Interface.

To use the JSON interceptor with Communique, you can do the following:
```php
<?php
    //Create a new instance of communique. Pass the interceptor in an array as the second argument to the constructor
     $rest = new \Communique\Communique('http://api.company.com/', array(new \Communique\Interceptors\JSON()));

     //Make a request
     $response = $rest->get('users/1');

     //The response will be a nested array, so we can do something like this:
     echo $response->payload[0]['forename']; //Returns user 0's forename.
?>
```

##Licensing
Licensed under the GPL - please see the file called LICENSE for more info.

##Contacts
- If you want to submit a bug report or issue, please do so using the issue tracker on GitHub

##Documentation
The documentation can be found [here](http://robertmain.github.io/communique-interceptor-json)
