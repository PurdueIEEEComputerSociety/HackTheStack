/**
 * Created by Bobby on 12/2/2016.
 */
import java.io.*;

public class Hash {
    public static void main(String[] args) throws IOException{
        BufferedReader in = null;
        BufferedWriter out = null;

        try {
            in = new BufferedReader(new FileReader(new File("CommonPassword")));
            out = new BufferedWriter(new FileWriter(new File("HashedPassword")));

            String str;
            while ((str = in.readLine()) != null) {
                out.write(Hashing.hashing(str) + "\n");
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
