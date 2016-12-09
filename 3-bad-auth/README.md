# HackTheStack - Bad Authentiation
### John Lee (2016)

# For the challengers
This challenge is for you to login as an admin for one of the hottest forum sites to come out since Yahoo! Answers.
In the developers' haste to get the product out, they missed some vital code to keep some nasty ne'er-do-wells from getting access to their site.

However, the creators aren't completely forgetful, there are some roadblocks in the way to do this. Don't be discouraged! Most of them are still insecure if you stretch the limits. (But don't stretch too much, the website might break because of you.)

There's a rumor that one of the admins have been logging in quite often. Login as them and extract a super-secret admin code that they use for everything. Seriously. They never took `ECE 404/CS 426`.

Present the code to one of the hosts to win!

## Some hints *[only show if necessary]*
- It is not SQL injection.
- Use XSS
- Have them look at the 'recent users' area.
- If they are having problems with the max entered size, have them upload a script onto https://gist.github.com/ and use the RAW link as their created user's handle.
- Getting around CORS
  - Try creating an \<img> with the data included as a GET parameter in the `src`.
  
# Hosts Only . . .
  
## Detailed Problem
The website is supposed to emulate a forum. Most forms of auth are secure *except* the `handle` which checks for `<script>` but not `<script src= . . .`. The challenger is supposed to inject some JS that replaces the login function with one that grabs the token or password. 

<s>### Recommendation at this point
My BIGGEST recommendation is to use https://gist.github.com/. Once there they can make something called `c.js` and put some arbituary JS code in it. once there, use the **RAW** link as their handle and voila! Injected JS that they **CAN EDIT ACTIVELY**. This way if they break the site they can just change their code here to revert it.</s>

Just have them inject code like the solution below.

Once grabbed, it will then send it to a page that listens for any request and grabs the parameters. In this case they will send it to `Log.php`. Since it's local they won't need to do anything fancy. Just a jQuery GET request.
the request will look like this `Log.php?data=whateveryouwantittobeandforittolog`.
To get the last GET request, navigate to `Log.php` without the data tag to see it. 

Once received, they emulate that same request on the web page and get the new page, an admin page that contains the number. It only works on verified login, so they can't bypass this any other way. 



# Setup

Import the following SQL to setup
```
# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.46-0ubuntu0.14.04.2)
# Database: challenge
# Generation Time: 2016-12-09 20:33:41 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table login
# ------------------------------------------------------------

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `username` varchar(30) NOT NULL DEFAULT '',
  `password` text NOT NULL,
  `authToken` text NOT NULL,
  `handle` varchar(200) NOT NULL DEFAULT '',
  `created` datetime NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;

INSERT INTO `login` (`username`, `password`, `authToken`, `handle`, `created`)
VALUES
	('thebestadmin','$2y$10$129139293012312093210u1xpEeTfbT5Yeixf3KSdSAv/BgFs4Qsq','7da7e821a5b8ee25e8f42b56d573f0cc','notyourbusiness','2016-12-09 19:36:34');

/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```

There needs to exist a `login` user with password: `Password1` that has the following permissions: `SELECT, INSERT, UPDATE`
to the `login` table, which exists in the `challenge` database.

The above script includes the login credentials so you'll be good.

As for the cron. go to the `cronadmin` folder and npm install. Have the cron run `node index.js` and ensure it works. If it doesn't, login as the admin to get an authtoken logged by going into the website and logging in as `thebestadmin` `securepassword1`. Once there it should create a file named `authTokenStorage.txt` which contains the authToken (I'm lazy, okay?)

# Solution Script
There exists `Log.php` which will aid them in repeating the last get request with a `data` parameter in it. 
```
authTokenLogin = function(authToken) {
  $.get( "log.php?data=" + authToken, function( data ) {
  });
}
```
Using this will replace the authToken login and allow the user to get the data by going to `directory/log.php`

Once that's done, they make the same request that authTokenLogin had previously to login as the admin!
