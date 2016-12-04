/**
 * Created by Bobby on 12/2/2016.
 */
import java.io.*;
import java.util.HashSet;

public class Hash {
    public static void main(String[] args) throws IOException{
        if (args.length != 2) {
            System.err.println("Usage: $ java Hash <OutputFilename> <Expansion Method (1 for harder, 2 for easier)>");
            System.exit(1);
        }

        BufferedReader in = null;
        BufferedWriter out = null;
        HashSet<String> set = new HashSet<>();
        int expansion = Integer.parseInt(args[1]);
        int count = 0;

        try {
            in = new BufferedReader(new FileReader(new File("CommonPassword")));
            out = new BufferedWriter(new FileWriter(new File(args[0])));

            String str;
            String hashed;
            while ((str = in.readLine()) != null) {
                count++;
                hashed = Hashing.hashing(str, expansion);
                out.write(hashed + "\n");
                if (!set.contains(hashed)) {
                    set.add(hashed);
                }
            }

            if (set.toArray().length == count) {
                System.out.println("No confliction.");
            } else {
                System.out.printf("Number of confliction: %d\n", count-set.toArray().length);
            }
        } finally {
            if (in != null) {
                in.close();
            }
            if (out != null) {
                out.close();
            }
        }
    }
}
