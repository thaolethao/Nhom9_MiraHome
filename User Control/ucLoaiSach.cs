using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Data.SqlClient;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace BTL_Nhom9
{
    public partial class ucLoaiSach : UserControl
    {
        DataTable tblLoaiSach;
        bool isThem = false;
        public ucLoaiSach()
        {
            InitializeComponent();
        }

        private void ucLoaiSach_Load(object sender, EventArgs e)
        {
            LoadDataGridView();
        }

        private void LoadDataGridView()
        {
            DAO.connect();
            string sql = "SELECT * FROM tblLoaiSach";
            SqlDataAdapter da = new SqlDataAdapter(sql, DAO.conn);
            tblLoaiSach = new DataTable();
            da.Fill(tblLoaiSach);
            dgvLoaiSach.DataSource = tblLoaiSach;
            DAO.close();
        }


        private void dgvLoaiSach_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex >= 0 && e.RowIndex < dgvLoaiSach.Rows.Count)
            {
                txtMaLoaiSach.Text = dgvLoaiSach.CurrentRow.Cells[0].Value.ToString();
                txtTenLoaiSach.Text = dgvLoaiSach.CurrentRow.Cells[1].Value.ToString();
            }
        }

        private void btnThem_Click(object sender, EventArgs e)
        {
            isThem = true;
            txtMaLoaiSach.Text = DAO.CreateKeyWithNumber("LS");
            txtTenLoaiSach.Clear();
            txtTenLoaiSach.Focus();

            btnLuu.Enabled = true;
        }

        private void btnLuu_Click(object sender, EventArgs e)
        {
            if (txtTenLoaiSach.Text.Trim() == "")
            {
                MessageBox.Show("Bạn phải nhập tên loại sách");
                txtTenLoaiSach.Focus();
                return;
            }

            if (isThem)
            {
                string sqlCheck = $"SELECT MaLoai FROM tblLoaiSach WHERE MaLoai = '{txtMaLoaiSach.Text}'";
                DAO.connect();
                if (DAO.checkKey(sqlCheck))
                {
                    MessageBox.Show("Mã loại sách đã tồn tại!");
                    DAO.close();
                    return;
                }

                string sqlInsert = $"INSERT INTO tblLoaiSach (MaLoai, TenLoai) VALUES ('{txtMaLoaiSach.Text}', N'{txtTenLoaiSach.Text}')";
                SqlCommand cmd = new SqlCommand(sqlInsert, DAO.conn);
                cmd.ExecuteNonQuery();
                DAO.close();
                MessageBox.Show("Đã thêm mới");
            }
            else
            {
                string sqlUpdate = $"UPDATE tblLoaiSach SET TenLoai = N'{txtTenLoaiSach.Text}' WHERE MaLoai = '{txtMaLoaiSach.Text}'";
                DAO.connect();
                SqlCommand cmd = new SqlCommand(sqlUpdate, DAO.conn);
                cmd.ExecuteNonQuery();
                DAO.close();
                MessageBox.Show("Đã cập nhật");
            }

            LoadDataGridView();
            ResetValues();
            btnLuu.Enabled = false;
        }

        private void btnSua_Click(object sender, EventArgs e)
        {
            if (txtMaLoaiSach.Text == "")
            {
                MessageBox.Show("Bạn chưa chọn loại sách cần sửa");
                return;
            }

            isThem = false;
            btnLuu.Enabled = true;
        }

        private void btnXoa_Click(object sender, EventArgs e)
        {
            if (txtMaLoaiSach.Text == "")
            {
                MessageBox.Show("Bạn chưa chọn loại sách để xóa");
                return;
            }

            DialogResult dr = MessageBox.Show("Bạn có chắc muốn xóa?", "Xác nhận", MessageBoxButtons.YesNo);
            if (dr == DialogResult.Yes)
            {
                string sqlDelete = $"DELETE FROM tblLoaiSach WHERE MaLoai = '{txtMaLoaiSach.Text}'";
                DAO.connect();
                SqlCommand cmd = new SqlCommand(sqlDelete, DAO.conn);
                cmd.ExecuteNonQuery();
                DAO.close();

                LoadDataGridView();
                ResetValues();
                MessageBox.Show("Đã xóa");
            }
        }

        private void btnHuy_Click(object sender, EventArgs e)
        {
            ResetValues();
            btnLuu.Enabled = false;
        }

        private void btnThoat_Click(object sender, EventArgs e)
        {
            this.Dispose();
        }

        private void ResetValues()
        {
            txtMaLoaiSach.Clear();
            txtTenLoaiSach.Clear();
        }
    }
}
    

