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
    public partial class ucTacGia : UserControl
    {
        DataTable tblTacGia;
       

        public ucTacGia()
        {
            InitializeComponent();
        }

        private void ucTacGia_Load(object sender, EventArgs e)
        {
            LoadDataGridView();
            LoadComboBoxGioiTinh();
        }

        private void LoadDataGridView()
        {
            DAO.connect();
            string query = "select * from tblTacGia";
            tblTacGia = DAO.GetDataToTable(query);
            dgvTacGia.DataSource = tblTacGia;
            dgvTacGia.Columns[0].HeaderText = "Mã tác giả";
            dgvTacGia.Columns[1].HeaderText = "Tên tác giả";
            dgvTacGia.Columns[2].HeaderText = "Giới tính";
            dgvTacGia.Columns[3].HeaderText = "Năm sinh";
            dgvTacGia.Columns[4].HeaderText = "Quê quán";
            dgvTacGia.AllowUserToAddRows = false;
            dgvTacGia.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill;
            dgvTacGia.EditMode = DataGridViewEditMode.EditProgrammatically;
            DAO.close();
        }
        private void LoadComboBoxGioiTinh()
        {
            cbbGioiTinh.Items.Add("Nam");
            cbbGioiTinh.Items.Add("Nữ");
            cbbGioiTinh.Items.Add("Khác");
            cbbGioiTinh.SelectedIndex = 0;
        }
        private void dgvTacGia_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {
            if (tblTacGia.Rows.Count == 0)
            {
                MessageBox.Show("Không có dữ liệu", "Thông báo", MessageBoxButtons.OK, MessageBoxIcon.Information);
                return;
            }

            txtMaTacGia.Text = dgvTacGia.CurrentRow.Cells["MaTG"].Value.ToString();
            txtTenTacGia.Text = dgvTacGia.CurrentRow.Cells["TenTG"].Value.ToString(); 
            string gioiTinh = dgvTacGia.Rows[e.RowIndex].Cells["GioiTinh"].Value?.ToString() ?? "";
            cbbGioiTinh.SelectedIndex = cbbGioiTinh.Items.IndexOf(gioiTinh);
            if (cbbGioiTinh.SelectedIndex == -1) cbbGioiTinh.SelectedIndex = 0;
            int namSinh = Convert.ToInt32(dgvTacGia.Rows[e.RowIndex].Cells["NamSinh"].Value);
            dtpNamSinh.Value = new DateTime(namSinh, 1, 1);
            txtQueQuan.Text = dgvTacGia.CurrentRow.Cells["QueQuan"].Value.ToString();

            txtMaTacGia.Enabled = false;
            btnSua.Enabled = true;
            btnXoa.Enabled = true;
            btnHuy.Enabled = true;
        }

        private void Clear()
        {
            txtMaTacGia.Clear();
            txtTenTacGia.Clear();
            txtQueQuan.Clear();
        }

        private void btnThem_Click(object sender, EventArgs e)
        {
            btnSua.Enabled = false;
            btnXoa.Enabled = false;
            btnHuy.Enabled = true;
            btnThem.Enabled = false;
            btnLuu.Enabled = true;
            string maMoi = DAO.SinhMaTuDong("TG", "tblTacGia", "MaTG");
            txtMaTacGia.Text = maMoi;
            txtTenTacGia.Clear();
            cbbGioiTinh.SelectedIndex = 0;
            txtQueQuan.Clear();
            txtMaTacGia.Enabled = false;
            txtTenTacGia.Focus();
        }

        private void btnSua_Click(object sender, EventArgs e)
        {
            if (txtMaTacGia.Text == "")
            {
                MessageBox.Show("Bạn chưa chọn tác giả cần sửa");
                return;
            }

            if (txtTenTacGia.Text.Trim() == "")
            {
                MessageBox.Show("Bạn phải nhập tên tác giả!");
                txtTenTacGia.Focus();
                return;
            }
            if (cbbGioiTinh.SelectedIndex == -1)
            {
                MessageBox.Show("Bạn phải chọn giới tính");
                cbbGioiTinh.Focus();
                return;
            }

            int namSinh = dtpNamSinh.Value.Year;
            if (namSinh <= 0 || namSinh > DateTime.Now.Year)
            {
                MessageBox.Show("Năm sinh không hợp lệ");
                dtpNamSinh.Focus();
                return;
            }
            if (txtQueQuan.Text.Trim() == "")
            {
                MessageBox.Show("Bạn phải nhập quê quán của tác giả!");
                txtQueQuan.Focus();
                return;
            }

            string sql = $"UPDATE tblTacGia SET " +
                        $"TenTG = N'{txtTenTacGia.Text}', " +
                        $"GioiTinh = N'{cbbGioiTinh.SelectedItem}', " +
                        $"NamSinh = {namSinh}, " +
                        $"QueQuan = N'{txtQueQuan.Text}' " +
                        $"WHERE MaTG = '{txtMaTacGia.Text}'";

            DAO.connect();
            SqlCommand cmd = new SqlCommand(sql, DAO.conn);
            cmd.ExecuteNonQuery();
            DAO.close();
            MessageBox.Show("Đã cập nhật thành công!", "Thông báo", MessageBoxButtons.OK, MessageBoxIcon.Information);
            LoadDataGridView();
            Clear();
        }

        private void btnLuu_Click(object sender, EventArgs e)
        {
            if (txtTenTacGia.Text.Trim() == "")
            {
                MessageBox.Show("Bạn phải nhập tên tác giả!");
                txtTenTacGia.Focus();
                return;
            }
            if (cbbGioiTinh.SelectedIndex == -1)
            {
                MessageBox.Show("Bạn phải chọn giới tính");
                cbbGioiTinh.Focus();
                return;
            }

            int namSinh = dtpNamSinh.Value.Year;
            if (namSinh <= 0 || namSinh > DateTime.Now.Year)
            {
                MessageBox.Show("Năm sinh không hợp lệ");
                dtpNamSinh.Focus();
                return;
            }
            if (txtQueQuan.Text.Trim() == "")
            {
                MessageBox.Show("Bạn phải nhập quê quán của tác giả!");
                txtQueQuan.Focus();
                return;
            }

            string sqlInsert = $"INSERT INTO tblTacGia (MaTG, TenTG, GioiTinh, NamSinh, QueQuan) " +
                      $"VALUES ('{txtMaTacGia.Text}', N'{txtTenTacGia.Text}', " +
                      $"N'{cbbGioiTinh.SelectedItem}', {namSinh}, N'{txtQueQuan.Text}')";

            DAO.connect();
            SqlCommand cmd = new SqlCommand(sqlInsert, DAO.conn);
            cmd.ExecuteNonQuery();
            DAO.close();
            MessageBox.Show("Đã thêm mới tác giả");
            LoadDataGridView();
            Clear();
            btnLuu.Enabled = false;
        }

        private void btnXoa_Click(object sender, EventArgs e)
        {
            if (txtMaTacGia.Text == "")
            {
                MessageBox.Show("Bạn chưa chọn tác giả để xóa");
                return;
            }

            DialogResult dr = MessageBox.Show("Bạn có chắc muốn xóa tác giả này?", "Xác nhận", MessageBoxButtons.YesNo);
            if (dr == DialogResult.Yes)
            {
                string sqlDelete = $"DELETE FROM tblTacGia WHERE MaTG = '{txtMaTacGia.Text}'";
                DAO.connect();
                SqlCommand cmd = new SqlCommand(sqlDelete, DAO.conn);
                cmd.ExecuteNonQuery();
                DAO.close();

                LoadDataGridView();
                Clear();
                MessageBox.Show("Đã xóa tác giả");
            }
        }

        private void btnTimKiem_Click(object sender, EventArgs e)
        {
            string searchValue = txtTimKiem.Text.Trim();

            if (string.IsNullOrEmpty(searchValue))
            {
                MessageBox.Show("Vui lòng nhập từ khóa tìm kiếm.", "Cảnh báo",
                                MessageBoxButtons.OK, MessageBoxIcon.Warning);
                txtTimKiem.Focus(); 
                return;
            }

            string query = @"SELECT * FROM tblTacGia 
                    WHERE TenTG LIKE @searchValue 
                    OR MaTG LIKE @searchValue 
                    OR QueQuan LIKE @searchValue";

            try
            {
                DAO.connect();
                SqlCommand cmd = new SqlCommand(query, DAO.conn);
                cmd.Parameters.AddWithValue("@searchValue", $"%{searchValue}%");

                SqlDataAdapter adapter = new SqlDataAdapter(cmd);
                DataTable dt = new DataTable();
                adapter.Fill(dt);

                dgvTacGia.DataSource = dt;

                if (dt.Rows.Count == 0)
                {
                    MessageBox.Show("Không tìm thấy tác giả phù hợp", "Thông báo",
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

        private void btnHuy_Click(object sender, EventArgs e)
        {
            Clear();
            btnThem.Enabled = true;
            btnSua.Enabled = true;
            btnXoa.Enabled = true;
            btnLuu.Enabled = false;
            btnHuy.Enabled = false;
        }

        private void btnThoat_Click(object sender, EventArgs e)
        {
            this.Dispose();
        }
    }
}
