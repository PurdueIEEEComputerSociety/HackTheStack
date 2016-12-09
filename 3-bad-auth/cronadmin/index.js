const Browser = require('zombie');
var assert = require("assert");  

const browser = new Browser();
var token = '';
fs = require('fs')
fs.readFile('../authTokenStorage.txt', 'utf8', function (err,data) {
    if (err) {
        return console.log(err);
    }
    token = data;
});

browser.visit("http://192.168.33.10/HackTheStack/3-bad-auth/index.html", function () {    
    assert.ok(browser.success);
    browser.evaluate('authTokenLogin("' + token + '")');
    // append script tag
    browser.wait().then(function() {
        // just dump some debug data to see if we're on the right page
        browser.assert.url(new RegExp('^.*(/adminsecretpage\.php).*$'));
        console.log('Successfully logged in as admin');
    });
});