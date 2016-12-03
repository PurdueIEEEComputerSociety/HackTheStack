import java.io.*;
import java.util.HashSet;

/**
 * Created by Bobby on 12/3/2016.
 */
public class Check {
    public static void main(String[] args) throws IOException {
        BufferedReader in = null;
        HashSet<String> set = new HashSet<>();

        try {
            in = new BufferedReader(new FileReader(new File("CommonPassword")));

            String str;
            while ((str = in.readLine()) != null) {
                if (!set.contains(str)) {
                    set.add(str);
                }
            }

            System.out.println(set.toArray().length);
        } finally {
            if (in != null) {
                in.close();
            }
        }
    }
}
