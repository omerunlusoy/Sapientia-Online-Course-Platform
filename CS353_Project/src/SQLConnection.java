import java.sql.*;

public class SQLConnection {

    private static Connection connection = null;
    private static Statement statement = null;
    private static ResultSet resultSet = null;
    static String username_local = "root";
    static String password_local = "mermer9950";
    static String jdbc_local = "jdbc:mysql://localhost:3306/cs353_project";
    static String username_dijkstra = "omer.unlusoy";
    static String password_dijkstra = "8cWZ7QRc";
    static String jdbc_dijkstra = "jdbc:mysql://dijkstra.ug.bcc.bilkent.edu.tr/omer_unlusoy";
    static Boolean to_dijkstra = true;


    public static void main (String[] args) throws Exception{

        getConnection(to_dijkstra);
        deletePreviousTables();
//        createTables();
//        insertInitialTuples();

//        float a = 3.2f;
//        String str="2015-03-01";
//        Date d = Date.valueOf(str);//converting string into sql date
//        insertStudent("1", "Omer Unlusoy", d, "Kizilay", "Ankara", "jenior", a, "TR");
//        insertCompany("C112", "turkcell", 12);
//        insertCompany("C113", "meteksan", 1);
//        insertApply("1", "C112");
//        insertApply("1", "C113");
//        getStudentTuples();
//        getCompanyTuples();
//        getApplyTuples();
    }


    /*
        Creates connection with Dijkstra MySQL server
        and initializes the statement object.
    */
    public static void getConnection(Boolean to_dijkstra) throws Exception{
        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            if (to_dijkstra){
                connection = DriverManager.getConnection(jdbc_dijkstra, username_dijkstra, password_dijkstra);
            }
            else {
                connection = DriverManager.getConnection(jdbc_local, username_local, password_local);
            }

            statement = connection.createStatement();
            System.out.println("connected to the database.");

        } catch (Exception e){
            System.out.println("Error during connection...");
            System.out.println(e);
        }
    }

    /*
        Deletes previous tables.
    */
    public static void deletePreviousTables() throws Exception{
        try {
            String deleteStudentString = "DROP TABLE IF EXISTS student";
            String deleteCompanyString = "DROP TABLE IF EXISTS company";
            String deleteApplyString = "DROP TABLE IF EXISTS apply";

            statement.execute(deleteApplyString);
            statement.execute(deleteCompanyString);
            statement.execute(deleteStudentString);
            System.out.println("previous tables removed.");

        } catch (Exception e){
            System.out.println("Error during deletion of previous tables...");
            System.out.println(e);
        }
    }

    /*
        Creates tables.
        Warning: In case of error: check the following lines;
        "ENGINE=InnoDB CHARACTER SET utf8";
        utf8 can create errors.
    */
    public static void createTables() throws Exception{
        try {

            String studentTableString = "CREATE TABLE student "         +
                    "(sid CHAR(12),"            +
                    "sname VARCHAR(50),"        +
                    "bdate DATE,"               +
                    "address VARCHAR(50),"      +
                    "scity VARCHAR(20),"        +
                    "year CHAR(20),"            +
                    "gpa FLOAT(2),"             +
                    "nationality VARCHAR(20),"  +
                    "PRIMARY KEY(sid)) "        +
                    "ENGINE=InnoDB CHARACTER SET utf8";

            String companyTableString = "CREATE TABLE company "         +
                    "(cid CHAR(8), "            +
                    "cname VARCHAR(20), "       +
                    "quota INT,"                +
                    "PRIMARY KEY(cid)) "        +
                    "ENGINE=InnoDB CHARACTER SET utf8";

            String applyTableString = "CREATE TABLE apply "             +
                    "(sid CHAR(12), "           +
                    "cid CHAR(8),"              +
                    "PRIMARY KEY(sid,cid),"     +
                    "FOREIGN KEY (sid) REFERENCES student(sid),"   +
                    "FOREIGN KEY (cid) REFERENCES company(cid)) "  +
                    "ENGINE=InnoDB CHARACTER SET utf8";

            statement.execute(studentTableString);
            statement.execute(companyTableString);
            statement.execute(applyTableString);
            System.out.println("student, company, and apply tables are created.");

        } catch (Exception e){
            System.out.println("Error during table creation...");
            System.out.println(e);
        }
    }

    /*
        Inserts initial tuples.
    */
    public static void insertInitialTuples() throws Exception{
        try {

            String studentTuples = "INSERT INTO student VALUES"                                              +
                    "('21000001', 'John', '1999-05-14', 'Windy', 'Chicago', 'senior', 2.33, 'US'),"          +
                    "('21000002', 'Ali', '2001-09-30', 'Nisantasi', 'Istanbul', 'junior', 3.26, 'TC'),"      +
                    "('21000003', 'Veli', '2003-02-25', 'Nisantasi', 'Istanbul', 'freshman', 2.41, 'TC'),"   +
                    "('21000004', 'Ayse', '2003-01-15', 'Tunali', 'Ankara', 'freshman', 2.55, 'TC');";

            String companyTuples = "INSERT INTO company VALUES" +
                    "('C101', 'microsoft', 2),"                 +
                    "('C102', 'merkez bankasi', 5),"            +
                    "('C103', 'tai', 3),"                       +
                    "('C104', 'tubitak', 5),"                   +
                    "('C105', 'aselsan', 3),"                   +
                    "('C106', 'havelsan', 4),"                  +
                    "('C107', 'milsoft', 2);";

            String applyTuples = "INSERT INTO apply VALUES" +
                    "('21000001', 'C101'),"                   +
                    "('21000001', 'C102'),"                   +
                    "('21000001', 'C103'),"                   +
                    "('21000002', 'C101'),"                   +
                    "('21000002', 'C105'),"                   +
                    "('21000003', 'C104'),"                   +
                    "('21000003', 'C105'),"                   +
                    "('21000004', 'C107');";

            statement.execute(studentTuples);
            statement.execute(companyTuples);
            statement.execute(applyTuples);
            System.out.println("student, company, and apply tables are initialized.");

        } catch (Exception e){
            System.out.println("Error during tuple insertion...");
            System.out.println(e);
        }
    }

    /*
        Gets student tuples.
        Warning: Print format uses 12 characters currently.
        To increase character number, increase the following line:
        String columnFormat = "%-15.15s";
    */
    public static ResultSet getStudentTuples() throws Exception{
        try {

            String sid, sname, bdate, address, scity, year, nationality;
            float gpa;
            String studentQuery = "SELECT * FROM student";
            resultSet = statement.executeQuery(studentQuery);
            System.out.println("\nstudent query executed.");
            System.out.println("printing student tuples...");

            // fixed size 12 characters, left aligned
            String columnFormat = "%-15.15s";
            String formatInfo = columnFormat + " " + columnFormat + " " + columnFormat  + " " + columnFormat
                    + " " + columnFormat  + " " + columnFormat + " " + columnFormat + " " + columnFormat;

            System.out.println("\nstudent table:");
            System.out.format(formatInfo, "sid", "sname", "bdate", "address", "scity", "year", "gpa", "nationality");
            System.out.println();

            while (resultSet.next()) {
                sid = resultSet.getString("sid");
                sname =resultSet.getString("sname");
                bdate = resultSet.getString("bdate");
                address = resultSet.getString("address");
                scity = resultSet.getString("scity");
                year =resultSet.getString("year");
                gpa =resultSet.getFloat("gpa");
                nationality =resultSet.getString("nationality");

                System.out.format(formatInfo, sid, sname, bdate, address, scity, year, gpa, nationality);
                System.out.println();
            }
            return resultSet;

        } catch (Exception e){
            System.out.println("Error during getting student tuples...");
            System.out.println(e);
            return null;
        }
    }

    /*
        Gets company tuples.
        Warning: Print format uses 12 characters currently.
        To increase character number, increase the following line:
        String columnFormat = "%-18.18s";
    */
    public static ResultSet getCompanyTuples() throws Exception{
        try {

            String cid, cname;
            int quota;
            String companyQuery = "SELECT * FROM company";
            resultSet = statement.executeQuery(companyQuery);
            System.out.println("\ncompany query executed.");
            System.out.println("printing company tuples...");

            // fixed size 12 characters, left aligned
            String columnFormat = "%-18.18s";
            String formatInfo = columnFormat + " " + columnFormat + " " + columnFormat;

            System.out.println("\ncompany table:");
            System.out.format(formatInfo, "cid", "cname", "quota");
            System.out.println();

            while (resultSet.next()) {
                cid = resultSet.getString("cid");
                cname =resultSet.getString("cname");
                quota = resultSet.getInt("quota");

                System.out.format(formatInfo, cid, cname, quota);
                System.out.println();
            }
            return resultSet;

        } catch (Exception e){
            System.out.println("Error during getting company tuples...");
            System.out.println(e);
            return null;
        }
    }

    /*
        Gets student tuples.
        Warning: Print format uses 12 characters currently.
        To increase character number, increase the following line:
        String columnFormat = "%-18.18s";
    */
    public static ResultSet getApplyTuples() throws Exception{
        try {

            String sid, cid;
            String applyQuery = "SELECT * FROM apply";
            resultSet = statement.executeQuery(applyQuery);
            System.out.println("\napply query executed.");
            System.out.println("printing apply tuples...");

            // fixed size 12 characters, left aligned
            String columnFormat = "%-18.18s";
            String formatInfo = columnFormat + " " + columnFormat;

            System.out.println("\napply table:");
            System.out.format(formatInfo, "sid", "cid");
            System.out.println();

            while (resultSet.next()) {
                sid = resultSet.getString("sid");
                cid =resultSet.getString("cid");

                System.out.format(formatInfo, sid, cid);
                System.out.println();
            }
            return resultSet;

        } catch (Exception e){
            System.out.println("Error during getting apply tuples...");
            System.out.println(e);
            return null;
        }
    }

    /*
        Inserts student tuple.
        Usage:
        float a = 3.2f;
        String str="2015-03-01";
        Date d = Date.valueOf(str);//converting string into sql date
        insertStudent("21000008", "omer", d, "Kizilay", "Ankara", "jenior", a, "TR");
    */
    public static void insertStudent(String sid, String sname, Date date, String address, String scity, String year, float gpa, String nationality) throws Exception{
        try {

            String studentTuples = "INSERT INTO student(sid, sname, bdate, address, scity, year, gpa, nationality) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
            PreparedStatement pstmt = connection.prepareStatement(studentTuples);
            pstmt.setString(1, sid);
            pstmt.setString(2, sname);
            pstmt.setDate(3, date);
            pstmt.setString(4, address);
            pstmt.setString(5, scity);
            pstmt.setString(6, year);
            pstmt.setFloat(7, gpa);
            pstmt.setString(8, nationality);
            pstmt.executeUpdate();

        } catch (Exception e){
            System.out.println("Error during tuple insertion...");
            System.out.println(e);
        }
    }

    /*
        Inserts company tuple.
        Usage:
        insertCompany("C112", "aaa", 12);
    */
    public static void insertCompany(String cid, String cname, int quota) throws Exception{
        try {

            String companyTuples = "INSERT INTO company(cid, cname, quota) VALUES(?, ?, ?)";
            PreparedStatement pstmt = connection.prepareStatement(companyTuples);
            pstmt.setString(1, cid);
            pstmt.setString(2, cname);
            pstmt.setInt(3, quota);
            pstmt.executeUpdate();

        } catch (Exception e){
            System.out.println("Error during tuple insertion...");
            System.out.println(e);
        }
    }

    /*
        Inserts apply tuple.
        Usage:
        insertApply("21000008", "C112");
    */
    public static void insertApply(String sid, String cid) throws Exception{
        try {

            String applyTuples = "INSERT INTO apply(sid, cid) VALUES(?, ?)";
            PreparedStatement pstmt = connection.prepareStatement(applyTuples);
            pstmt.setString(1, sid);
            pstmt.setString(2, cid);
            pstmt.executeUpdate();

        } catch (Exception e){
            System.out.println("Error during tuple insertion...");
            System.out.println(e);
        }
    }
}
