using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace BTL_Nhom9
{
    public partial class frmTrangChu : Form
    {
        public frmTrangChu()
        {
            InitializeComponent();
        }

        private void LoadUserControl(UserControl uc)
        {
            tlpnlMain.Controls.Clear();
            tlpnlMain.Controls.Add(uc, 1, 1);
        }

        private void btnSach_Click(object sender, EventArgs e)
        {
            
            LoadUserControl(new ucSach());
        }

        private void btnLoaiSach_Click(object sender, EventArgs e)
        {
            
            LoadUserControl(new ucLoaiSach());
        }

        private void btnTacGia_Click(object sender, EventArgs e)
        {
            LoadUserControl(new ucTacGia());
        }

        private void btnNXB_Click(object sender, EventArgs e)
        {
           
            LoadUserControl(new ucNXB());
        }

        private void btnNCC_Click(object sender, EventArgs e)
        {
            
            LoadUserControl(new ucNCC());
        }

        private void btnKhachHang_Click(object sender, EventArgs e)
        {
            LoadUserControl(new ucKhachHang());
        }

        private void btnNhanVien_Click(object sender, EventArgs e)
        {
            LoadUserControl(new ucNhanVien());
        }

        private void btnCongViec_Click(object sender, EventArgs e)
        {
            LoadUserControl(new ucCongViec());
        }

        private void btnMatSach_Click(object sender, EventArgs e)
        {
            
            LoadUserControl(new ucMatSach());
        }

        private void btnHDN_Click(object sender, EventArgs e)
        {
            LoadUserControl(new ucHDN());
        }

        private void btnHDB_Click(object sender, EventArgs e)
        {
            LoadUserControl(new ucHDB());
        }

        private void btnBCKQHDKD_Click(object sender, EventArgs e)
        {
            LoadUserControl(new ucBCKQHDKD());
        }

        private void btnBaoCaoSP_Click(object sender, EventArgs e)
        {
            LoadUserControl(new ucBCSP());
        }

        private void btnBaoCaoNH_Click(object sender, EventArgs e)
        {
            LoadUserControl(new ucBCNH());
        }

        private void btnBaoCaoBH_Click(object sender, EventArgs e)
        {
            LoadUserControl(new ucBCBH());
        }

       
    }
}
