/**
 * Created by Bobby on 12/2/2016.
 */
import java.io.*;
import java.util.HashSet;

public class Hash {
    public static void main(String[] args) throws IOException{
        BufferedReader in = null;
        BufferedWriter out = null;
        HashSet<String> set = new HashSet<>();
        int count = 0;

        try {
            in = new BufferedReader(new FileReader(new File("CommonPassword")));
            out = new BufferedWriter(new FileWriter(new File("HashedPassword")));

            String str;
            while ((str = in.readLine()) != null) {
                count++;
                String hashed = Hashing.hashing(str);
                out.write(hashed + "\n");
                if (!set.contains(str)) {
                    set.add(str);
                }
            }

            if (set.toArray().length == count) {
                System.out.println("No confliction.");
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
