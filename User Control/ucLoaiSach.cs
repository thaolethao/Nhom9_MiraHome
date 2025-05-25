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
            string query = "select * from tblLoaiSach";
            tblLoaiSach = DAO.GetDataToTable(query);
            dgvLoaiSach.DataSource = tblLoaiSach;
            dgvLoaiSach.Columns[0].HeaderText = "Mã loại sách";
            dgvLoaiSach.Columns[1].HeaderText = "Tên loại sách";
            dgvLoaiSach.AllowUserToAddRows = false;
            dgvLoaiSach.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill;
            dgvLoaiSach.EditMode = DataGridViewEditMode.EditProgrammatically;
            DAO.close();
        }

        private void btnThem_Click(object sender, EventArgs e)
        {
            isThem = true;
            List<string> existingCodes = DAO.GetAllCodes("tblLoaiSach","MaLoai"); // Lấy danh sách mã hiện có
            txtMaLoaiSach.Text = DAO.CreateKeyWithNumber("LS", existingCodes);
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

        private void dgvLoaiSach_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {
            
            if (tblLoaiSach.Rows.Count == 0)
            {
                MessageBox.Show("Không có dữ liệu", "Thông báo", MessageBoxButtons.OK, MessageBoxIcon.Information);
                return;
            }

            txtMaLoaiSach.Text = dgvLoaiSach.CurrentRow.Cells["maloai"].Value.ToString();
            txtTenLoaiSach.Text = dgvLoaiSach.CurrentRow.Cells["tenloai"].Value.ToString();
            txtMaLoaiSach.Enabled = false;
            btnSua.Enabled = true;
            btnXoa.Enabled = true;
            btnHuy.Enabled = true;
        }
    }
}
    

