using System;
using System.Data;
using System.Data.SqlClient;
using System.Windows.Forms;

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
            if (conn.State == ConnectionState.Closed) conn.Open();
        }

        public static void close()
        {
            if (conn.State == ConnectionState.Open) conn.Close();
        }

        public static DataTable GetDataToTable(string sql)
        {
            SqlDataAdapter adapter = new SqlDataAdapter(sql, conn);
            DataTable dt = new DataTable();
            adapter.Fill(dt);
            return dt;
        }

        public static bool checkKey(string sql)
        {
            SqlDataAdapter adapter = new SqlDataAdapter(sql, conn);
            DataTable dt = new DataTable();
            adapter.Fill(dt);
            return dt.Rows.Count > 0;
        }

        public static void RunSql(string sql)
        {
            SqlCommand cmd = new SqlCommand(sql, conn);
            try { cmd.ExecuteNonQuery(); }
            catch (Exception ex) { MessageBox.Show(ex.Message); }
            cmd.Dispose();
        }

        public static void RunSqlDel(string sql)
        {
            SqlCommand cmd = new SqlCommand(sql, conn);
            try { cmd.ExecuteNonQuery(); }
            catch
            {
                MessageBox.Show("Dữ liệu đang được dùng, không thể xóa...", "Thông báo",
                    MessageBoxButtons.OK, MessageBoxIcon.Stop);
            }
            cmd.Dispose();
        }

        public static void FillComboBox(string sql, ComboBox cbo, string valueField, string displayField)
        {
            SqlDataAdapter adapter = new SqlDataAdapter(sql, conn);
            DataTable dt = new DataTable();
            adapter.Fill(dt);
            cbo.DataSource = dt;
            cbo.ValueMember = valueField;
            cbo.DisplayMember = displayField;
        }

        public static string GetFieldValues(string sql)
        {
            SqlCommand cmd = new SqlCommand(sql, conn);
            SqlDataReader reader = cmd.ExecuteReader();
            string value = "";
            if (reader.Read()) value = reader.GetValue(0).ToString();
            reader.Close();
            return value;
        }

        public static string ConvertDateTime(string d)
        {
            string[] parts = d.Split('/');
            return $"{parts[1]}/{parts[0]}/{parts[2]}";
        }

        public static string CreateKeyWithNumber(string prefix, int lastNumber=0)
        {
            return prefix + lastNumber.ToString("D2"); 
        }

        public static bool ktSoNguyen(string input)
        {
            return int.TryParse(input, out _);
        }

        public static bool ktSoThuc(string input)
        {
            return double.TryParse(input, out _);
        }

        public static bool IsDate(string d)
        {
            if (DateTime.TryParse(d, out DateTime temp))
            {
                return temp <= DateTime.Today;
            }
            return false;
        }
    }
}
