# PHP-Login

Simple, easy-to-use, and database-free login system.
* database feature is being added
## How it works

* The system is coded 100% in PHP (although a minimal knowledge of HTML is required).
* (No longer used in this repo)The visual framework used is [Bootstrap](http://getbootstrap.com).
* There are four main pages: `login.php` shows the login form, `index.php` the default password-protected area, `logout.php` simply ends the session and `includes/dbh.inc.php` stores the user's information.

## How to use it

1. Download the source files to your computer.
2. Open `config.php` with your favorite text editor (I suggest you use [Atom](https://atom.io)) and find the variables `$Username` and `$Password`.
3. Change the username and password (note that you have to use the salted version of your password.
4. Save the files, upload them to your webserver and give it a try.

###### EXTRA:

* If you want to password-protect any page, just add this snippet of code at the beginning of it:
###### NEW:
```php
<?php
  session_start(); /* Starts the session */
  if( (isset($_SESSION['Active']) ? $_SESSION['Active'] == false : header("location:login.php") )){ /* Redirects user to Login.php if not logged in */
    header("location:login.php");
          exit;
  }

```
###### ORIGINAL Not supported in php 8
```php
<?php
  session_start(); /* Starts the session */
  if($_SESSION['Active'] == false){ /* Redirects user to login.php if not logged in */
    header("location:login.php");
    exit;
  }
?>
```

## Original Authors

* **Mario Font** - *Whole project* - [GitHub](https://github.com/mariofont)
* **Calebrw** - *Security fixes* - [GitHub](https://github.com/Calebrw)
