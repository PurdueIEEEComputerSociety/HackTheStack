# HackTheStack

## Bobby's Hashing Function
1. Add the salt at the beginning of the string
2. Obtain a seed number to generate pseudorandom number by using the salted string (can be optional)
3. Expand the salted string using polynomial expansion, with the pseudorandom numbers as coefficients
4. Scale it by multiplying a prime number and make it 8 digits
5. Convert the scaled number to alphanumeric character
6. Iterate step 3,4,5 for 4 times to get 16-byte hashed string
