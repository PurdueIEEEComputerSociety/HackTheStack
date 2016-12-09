/**
 * Created by Bobby on 12/2/2016.
 *
 * The algorithm for this hashing function is as follows (Step 2 can be omit):
 * 1. Add the salt at the beginning of the string
 * 2. Obtain a seed number to generate pseudorandom number by using the salted string
 * 3. Expand the salted sring using polynomial expansion
 * 4. Scale it by multiplying a prime number and make it 8 digits
 * 5. Convert the scaled number to alphanumeric character
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

    //expand the key by polynomial expansion, version 0.1
    //0 confliction for CommonPassword
    public static int expansion1(String key, int power){
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

    //expand the key by polynomial expansion, version 0.2
    //50 conflictions for CommonPassword
    public static int expansion2(String key, int power){
        int sum = 0;
        int[] prime = {11,7,5,3};

        for (int i = 0; i < key.length(); i++) {
            int val = (int)key.charAt(i);
            for (int j = power; j <= 4; j++) {
                //sum += prime[j-1] * Math.pow(val, 4-j);
                sum += Math.pow(val, 4-j);
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

    public static String hashing(String key, int method){
        String after = "";
        if (method == 1) {
            for (int i = 1; i <= 4; i++) {
                after += hashIt(scale(expansion1(SALT + key, i)));
            }
        } else if (method == 2) {
            for (int i = 1; i <= 4; i++) {
                after += hashIt(scale(expansion2(SALT + key, i)));
            }
        }
        return after;
    }
}
