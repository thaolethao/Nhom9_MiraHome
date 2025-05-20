using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BTL_Nhom9
{
    internal class DAO
    {
        public static SqlConnection conn = new SqlConnection();
        public static string sqlConnectionString = "Data Source=mmmmm;" +
                                                    "Initial Catalog=QLCuaHangSach;" +
                                                    "Integrated Security=True;" +
                                                    "Encrypt=False";
        public static void connect()
        {
            conn.ConnectionString = sqlConnectionString;
            if (conn.State == ConnectionState.Closed) { conn.Open(); }
        }

        public static void close()
        {
            if (conn.State == ConnectionState.Open)
                conn.Close();
        }

        public static bool checkKey(string sql)
        {
            bool result = false;
            SqlDataAdapter adapter = new SqlDataAdapter(sql, conn);
            DataTable dt = new DataTable();
            adapter.Fill(dt);
            if (dt.Rows.Count > 0) { result = true; }
            return result;
        }
    }
}
