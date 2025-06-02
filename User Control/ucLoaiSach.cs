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
            btnSua.Enabled = false;
            btnXoa.Enabled = false;
            btnHuy.Enabled = true;
            btnThem.Enabled = false;
            btnLuu.Enabled = true;
            string maMoi= DAO.SinhMaTuDong("LS", "tblLoaiSach","MaLoai");
            txtMaLoaiSach.Text = maMoi;
            txtTenLoaiSach.Clear();
            txtMaLoaiSach.Enabled = false; // Không cho sửa mã
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
                string sqlCheck = $"SELECT MaLoai FROM tblLoaiSach WHERE MaLoai = '{txtMaLoaiSach.Text}'";
                DAO.connect();
                string sqlInsert = $"INSERT INTO tblLoaiSach (MaLoai, TenLoai) VALUES ('{txtMaLoaiSach.Text}', N'{txtTenLoaiSach.Text}')";
                SqlCommand cmd = new SqlCommand(sqlInsert, DAO.conn);
                cmd.ExecuteNonQuery();
                DAO.close();
                MessageBox.Show("Đã thêm mới loại sách");
           
            LoadDataGridView();
            Clear();
            btnLuu.Enabled = false;
        }

        private void btnSua_Click(object sender, EventArgs e)
        {
            if (txtMaLoaiSach.Text == "")
            {
                MessageBox.Show("Bạn chưa chọn loại sách cần sửa");
                return;
            }

            if (txtTenLoaiSach.Text.Trim() == "")
            {
                MessageBox.Show("Bạn phải nhập tên loại sách!");
                txtTenLoaiSach.Focus();
                return;
            }

            // Disable luôn không cho sửa mã loại sách
            txtMaLoaiSach.ReadOnly = true;

            string sql = $"UPDATE tblLoaiSach SET TenLoai = N'{txtTenLoaiSach.Text}' WHERE MaLoai = '{txtMaLoaiSach.Text}'";
            DAO.connect();
            SqlCommand cmd = new SqlCommand(sql, DAO.conn);
            cmd.ExecuteNonQuery();
            DAO.close();
            MessageBox.Show("Đã cập nhật thành công!", "Thông báo", MessageBoxButtons.OK, MessageBoxIcon.Information);
            LoadDataGridView();
            Clear();
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
                Clear();
                MessageBox.Show("Đã xóa");
            }
        }

        private void btnHuy_Click(object sender, EventArgs e)
        {
            Clear();
            btnThem.Enabled = true;
            btnSua.Enabled = true;
            btnXoa.Enabled = true;
            btnLuu.Enabled = false;
            btnHuy.Enabled = false;
        }

        private void btnTimKiem_Click(object sender, EventArgs e)
        {
            string searchValue = txtTimKiem.Text.Trim();

            // Nếu ô tìm kiếm rỗng thì hiển thị cảnh báo
            if (string.IsNullOrEmpty(searchValue))
            {
                MessageBox.Show("Vui lòng nhập từ khóa tìm kiếm.", "Cảnh báo",
                                MessageBoxButtons.OK, MessageBoxIcon.Warning);
                txtTimKiem.Focus(); // Đưa con trỏ về ô tìm kiếm
                return;
            }

            string query = @"SELECT * FROM tblLoaiSach 
                     WHERE TenLoai LIKE @searchValue 
                     OR MaLoai LIKE @searchValue";

            try
            {
                DAO.connect();
                SqlCommand cmd = new SqlCommand(query, DAO.conn);
                cmd.Parameters.AddWithValue("@searchValue", $"%{searchValue}%");

                SqlDataAdapter adapter = new SqlDataAdapter(cmd);
                DataTable dt = new DataTable();
                adapter.Fill(dt);

                dgvLoaiSach.DataSource = dt;

                if (dt.Rows.Count == 0)
                {
                    MessageBox.Show("Không tìm thấy loại sách phù hợp.", "Thông báo",
                                    MessageBoxButtons.OK, MessageBoxIcon.Information);
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show("Lỗi tìm kiếm: " + ex.Message);
            }
            finally
            {
                DAO.close();
            }
        }

        private void txtTimKiem_TextChanged(object sender, EventArgs e)
        {
        
            if (string.IsNullOrWhiteSpace(txtTimKiem.Text))
            {
                LoadDataGridView();
            }
        
        }
        private void btnThoat_Click(object sender, EventArgs e)
        {
            this.Dispose();
        }

        private void Clear()
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
    

