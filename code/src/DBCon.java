import java.sql.*;
public class DBCon {
    public static void main(String[] args)
    {
        try
        {
            Class.forName("com.mysql.cj.jdbc.Driver");
        }
        catch(ClassNotFoundException e)
        {
            System.out.println("JDBC Driver NOT FOUND!");
            //e.printStackTrace();
        }

        final String URL = "jdbc:mysql://dijkstra.ug.bcc.bilkent.edu.tr/irem_tekin";
        final String user = "irem.tekin";
        final String pass = "WF9cpRT5";

        Connection con = null;
        Statement stmt = null;

        try
        {
            con = DriverManager.getConnection(URL,user,pass);
            if(con != null)
            {
                System.out.println("SUCCESFUL CONNECTION");
            }
            else
            {
                System.out.println("CANNOT CONNECT");
            }
        }
        catch(SQLException e)
        {
            System.out.println("CANNOT CONNECT");
            //e.printStackTrace();
        }

        //SQL Part
        try
        {
            stmt = con.createStatement();

            //drop tables
            String  sql = "DROP TABLE IF EXISTS apply";
            stmt.executeUpdate(sql);
            System.out.println("apply table is deleted!");
            sql = "DROP TABLE IF EXISTS student";
            stmt.executeUpdate(sql);
            System.out.println("student table is deleted!");
            sql = "DROP TABLE IF EXISTS company";
            stmt.executeUpdate(sql);
            System.out.println("company table is deleted!");


            //create tables
            sql = "CREATE TABLE student " +
                    "(sid CHAR(12), " +
                    " sname VARCHAR(50), " +
                    " bdate DATE, " +
                    " adress VARCHAR(50), " +
                    " scity VARCHAR(20), " +
                    " year CHAR(20), " +
                    " gpa FLOAT, " +
                    " nationality VARCHAR(20), " +
                    " PRIMARY KEY ( sid ))" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("student table created!");

            sql = "CREATE TABLE company " +
                    "(cid CHAR(8), " +
                    " cname VARCHAR(20), " +
                    " quota INT, " +
                    " PRIMARY KEY ( cid ))" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("company table created!");

            sql = "CREATE TABLE apply " +
                    "(sid CHAR(12), " +
                    " cid CHAR(8), " +
                    " PRIMARY KEY ( cid, sid )," +
                    " FOREIGN KEY (sid) REFERENCES student(sid), " +
                    " FOREIGN KEY (cid) REFERENCES company(cid))" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("apply table created!");


            //insert tuples to student
            sql = "INSERT INTO student " +
                    "VALUES ('21000001', 'John', '1999/05/14', 'Windy','Chicago'," +
                    "'senior', 2.33, 'US')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO student " +
                    "VALUES ('21000002', 'Ali', '2001/09/30', 'Nisantasi','Istanbul'," +
                    "'junior', 3.26, 'TC')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO student " +
                    "VALUES ('21000003', 'Veli', '2003/02/25', 'Nisantasi','Istanbul'," +
                    "'freshman', 2.41, 'TC')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO student " +
                    "VALUES ('21000004', 'Ayse', '2003/01/15', 'Tunali','Ankara'," +
                    "'freshman', 2.55, 'TC')";
            stmt.executeUpdate(sql);

            //insert tuples to company
            sql = "INSERT INTO company " +
                    "VALUES ('C101', 'microsoft',2)";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO company " +
                    "VALUES ('C102', 'merkez bankasi',5)";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO company " +
                    "VALUES ('C103', 'tai',3)";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO company " +
                    "VALUES ('C104', 'tubitak',5)";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO company " +
                    "VALUES ('C105', 'aselsan',3)";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO company " +
                    "VALUES ('C106', 'havelsan',4)";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO company " +
                    "VALUES ('C107', 'milsoft',2)";
            stmt.executeUpdate(sql);

            //insert tuples to apply
            sql = "INSERT INTO apply " +
                    "VALUES ('21000001', 'C101')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO apply " +
                    "VALUES ('21000001', 'C102')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO apply " +
                    "VALUES ('21000001', 'C103')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO apply " +
                    "VALUES ('21000002', 'C101')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO apply " +
                    "VALUES ('21000002', 'C105')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO apply " +
                    "VALUES ('21000003', 'C104')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO apply " +
                    "VALUES ('21000003', 'C105')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO apply " +
                    "VALUES ('21000004', 'C107')";
            stmt.executeUpdate(sql);

            System.out.println("Values inserted to the tables!");

            //print table
            sql = "SELECT * FROM student";
            ResultSet rs = stmt.executeQuery(sql);

            while(rs.next()){
                String sid  = rs.getString("sid");
                String sname = rs.getString("sname");
                Date bdate = rs.getDate("bdate");
                String adress = rs.getString("adress");
                String scity = rs.getString("scity");
                String year = rs.getString("year");
                Float gpa = rs.getFloat("gpa");
                String nationality = rs.getString("nationality");

                //Print
                System.out.print("sid: " + sid);
                System.out.print(", sname: " + sname);
                System.out.print(", bdate: " + bdate);
                System.out.print(", adress: " + adress);
                System.out.print(", scity: " + scity);
                System.out.print(", year: " + year);
                System.out.print(", gpa: " + gpa);
                System.out.println(", nationality: " + nationality);
            }
            rs.close();

        }catch(SQLException e)
        {
            System.out.println("SQL Exception Happened:" + e.getMessage());
            //e.printStackTrace();
        }









    }

}
