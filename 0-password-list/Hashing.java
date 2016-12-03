/**
 * Created by Bobby on 12/2/2016.
 *
 * The algorithm for this hashing function is as follow;
 * 1. Add the salt at the beginning of the String
 * 2. Obtain a seed number in order to generate pseudorandom number by using the salted String
 * 3. Expand the salted String polynomial expansion, with the pseudorandom numbers as coefficients
 * 4. Scale it by multiply a prime number and make sure it is 8 digits
 * 5. Hash the scaled result
 * 6. Iterate step 3,4,5 for 4 times to get 16-byte hashed string
 */

import java.util.Random;

public class Hashing {
    final static String SALT = "pie";
    final static String DICT = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

    //get seed to generate random based on the key
    public static int getRandomSeed(String key){
        int seed = 0;
        for (int i = 0; i < key.length(); i++) {
            seed += (int)(key.charAt(i));
        }
        return seed % 37;
    }

    //expand the key by polynomial expansion
    public static int expansion(String key, int power){
        int sum = 0;
        int seed = getRandomSeed(key);
        Random rand = new Random(seed);

        for (int i = 0; i < key.length(); i++) {
            int val = (int)key.charAt(i);
            for (int j = power; j <= 4; j++) {
                sum += (int)((rand.nextInt() % 13) * Math.pow(val, 4-j));
            }
        }
        return sum;
    }

    // Scale it
    public static int scale(int src){
        int dest = Math.abs(src * 251 % 100000000);
        if (dest < 10000000) {
            dest += 70000000;
        }
        return dest;
    }

    //Change to String
    public static String hashIt(int val){
        String hashed = "";
        while (val > 0) {
            int temp = val % 100;
            hashed = DICT.charAt(temp % DICT.length()) + hashed;
            val /= 100;
        }
        return hashed;
    }

    public static String hashing(String key){
        String after = "";
        for (int i = 1; i <= 4; i++) {
            after += hashIt(scale(expansion(SALT + key, i)));
        }
        return after;
    }
}
