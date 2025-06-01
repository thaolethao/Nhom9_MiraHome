using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using Excel = Microsoft.Office.Interop.Excel;


namespace BTL_Nhom9
{
    public partial class ucBCKQHDKD : UserControl
    {
        public ucBCKQHDKD()
        {
            InitializeComponent();
        }


        private void btnLapBC_Click(object sender, EventArgs e)
        {
            DateTime tuNgay = dtpTuNgay.Value.Date;
            DateTime denNgay = dtpDenNgay.Value.Date;

            if (tuNgay > denNgay)
            {
                MessageBox.Show("Từ ngày không được lớn hơn Đến ngày!", "Cảnh báo", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                return;
            }

            // Tính toán và hiển thị số liệu
            TinhVaHienThiSoLieu(tuNgay, denNgay);
        }

        private void TinhVaHienThiSoLieu(DateTime tuNgay, DateTime denNgay)
        {
            // 1. Doanh thu bán hàng (tổng ThanhTien từ chi tiết HDB)
            string sqlDoanhThu = $@"SELECT ISNULL(SUM(CT.ThanhTien),0) 
                                    FROM tblChiTietHDB CT
                                    JOIN tblHoaDonBan HDB ON CT.SoHDB = HDB.SoHDB
                                    WHERE HDB.NgayBan BETWEEN '{tuNgay:yyyy-MM-dd}' AND '{denNgay:yyyy-MM-dd}'";
            string strDoanhThu = DAO.GetFieldValues(sqlDoanhThu);
            decimal doanhThuBan = Convert.ToDecimal(strDoanhThu);

            // 2. Giảm trừ doanh thu (SUM KhuyenMai từ chi tiết HDB)
            string sqlGiamTru = $@"SELECT ISNULL(SUM(CT.KhuyenMai),0) 
                                   FROM tblChiTietHDB CT
                                   JOIN tblHoaDonBan HDB ON CT.SoHDB = HDB.SoHDB
                                   WHERE HDB.NgayBan BETWEEN '{tuNgay:yyyy-MM-dd}' AND '{denNgay:yyyy-MM-dd}'";
            string strGiamTru = DAO.GetFieldValues(sqlGiamTru);
            decimal giamTru = Convert.ToDecimal(strGiamTru);

            // 3. Doanh thu thuần = Doanh thu bán - Giảm trừ
            decimal doanhThuThuan = doanhThuBan - giamTru;

            // 4. Chi phí nhập hàng (SUM ThanhTien từ chi tiết HDN)
            string sqlChiPhiNhap = $@"SELECT ISNULL(SUM(CT.ThanhTien),0)
                                      FROM tblChiTietHDN CT
                                      JOIN tblHoaDonNhap HDN ON CT.SoHDN = HDN.SoHDN
                                      WHERE HDN.NgayNhap BETWEEN '{tuNgay:yyyy-MM-dd}' AND '{denNgay:yyyy-MM-dd}'";
            string strChiPhiNhap = DAO.GetFieldValues(sqlChiPhiNhap);
            decimal chiPhiNhap = Convert.ToDecimal(strChiPhiNhap);

            // 5. Lợi nhuận trước thuế = Doanh thu thuần - Chi phí nhập
            decimal loiNhuanTruocThue = doanhThuThuan - chiPhiNhap;

            // 6. Thuế GTGT 20% (nếu lợi nhuận trước thuế > 0, ngược lại = 0):
            decimal thueGTGT = loiNhuanTruocThue > 0? Math.Round(loiNhuanTruocThue * 20m / 100m, 0) : 0m;

            // 7. Lợi nhuận sau thuế = Lợi nhuận trước thuế - Thuế
            decimal loiNhuanSauThue = loiNhuanTruocThue - thueGTGT;

            // Hiển thị lên TextBox (định dạng số với N0 để có dấu phân cách hàng nghìn)
            txtDTBH.Text = doanhThuBan.ToString("N0");
            txtGTDT.Text = giamTru.ToString("N0");
            txtDTT.Text = doanhThuThuan.ToString("N0");
            txtCPNH.Text = chiPhiNhap.ToString("N0");
            txtLNTT.Text = loiNhuanTruocThue.ToString("N0");
            txtThue.Text = thueGTGT.ToString("N0");
            txtLNST.Text = loiNhuanSauThue.ToString("N0");
        }


        private void XuatExcel()
        {
            Excel.Application xlApp = new Excel.Application();
            if (xlApp == null)
            {
                MessageBox.Show("Không khởi tạo được Excel.");
                return;
            }

            Excel.Workbook xlWorkBook = xlApp.Workbooks.Add();
            Excel.Worksheet xlWorkSheet = (Excel.Worksheet)xlWorkBook.Sheets[1];
            xlWorkSheet.Name = "Báo cáo KD";

            // 1. Tiêu đề
            xlWorkSheet.Range["A1", "C1"].Merge();
            xlWorkSheet.Cells[1, 1] = "BÁO CÁO KẾT QUẢ HOẠT ĐỘNG KINH DOANH";
            xlWorkSheet.Range["A1", "C1"].Font.Size = 16;
            xlWorkSheet.Range["A1", "C1"].Font.Bold = true;
            xlWorkSheet.Range["A1", "C1"].HorizontalAlignment = Excel.XlHAlign.xlHAlignCenter;

            // 2. Thời gian báo cáo
            xlWorkSheet.Cells[2, 1] = "Từ ngày:";
            xlWorkSheet.Cells[2, 2] = dtpTuNgay.Value.ToShortDateString();
            xlWorkSheet.Cells[3, 1] = "Đến ngày:";
            xlWorkSheet.Cells[3, 2] = dtpDenNgay.Value.ToShortDateString();

            // 3. Lấy lại giá trị đã tính (đã hiển thị trong các TextBox)
            string sDoanhThuBan = txtDTBH.Text;
            string sGiamTru = txtGTDT.Text;
            string sDoanhThuThuan = txtDTT.Text;
            string sChiPhiNhap = txtCPNH.Text;
            string sLoiNhuanTruocThue = txtLNTT.Text;
            string sThueGTGT = txtThue.Text;
            string sLoiNhuanSauThue = txtLNST.Text;

            // 4. Ghi các chỉ tiêu vào Excel
            int rowStart = 5; // bắt đầu từ dòng 5
            xlWorkSheet.Cells[rowStart + 0, 1] = "1. Doanh thu bán hàng";
            xlWorkSheet.Cells[rowStart + 0, 2] = sDoanhThuBan;

            xlWorkSheet.Cells[rowStart + 1, 1] = "2. Các khoản giảm trừ doanh thu";
            xlWorkSheet.Cells[rowStart + 1, 2] = sGiamTru;

            xlWorkSheet.Cells[rowStart + 2, 1] = "3. Doanh thu thuần";
            xlWorkSheet.Cells[rowStart + 2, 2] = sDoanhThuThuan;

            xlWorkSheet.Cells[rowStart + 3, 1] = "4. Chi phí nhập hàng";
            xlWorkSheet.Cells[rowStart + 3, 2] = sChiPhiNhap;

            xlWorkSheet.Cells[rowStart + 4, 1] = "5. Lợi nhuận trước thuế";
            xlWorkSheet.Cells[rowStart + 4, 2] = sLoiNhuanTruocThue;

            xlWorkSheet.Cells[rowStart + 5, 1] = "6. Thuế GTGT (20%)";
            xlWorkSheet.Cells[rowStart + 5, 2] = sThueGTGT;

            xlWorkSheet.Cells[rowStart + 6, 1] = "7. Lợi nhuận sau thuế";
            xlWorkSheet.Cells[rowStart + 6, 2] = sLoiNhuanSauThue;

            // 5. Định dạng chung
            Excel.Range usedRange = xlWorkSheet.UsedRange;
            usedRange.Columns.AutoFit();
            usedRange.Font.Name = "Times New Roman";
            usedRange.Font.Size = 12;

            // 6. Lưu file
            SaveFileDialog sfd = new SaveFileDialog();
            sfd.Filter = "Excel Workbook|*.xlsx";
            sfd.Title = "Lưu báo cáo kết quả KD";
            sfd.FileName = "BaoCaoKQKD.xlsx";
            if (sfd.ShowDialog() == DialogResult.OK)
            {
                xlWorkBook.SaveAs(sfd.FileName);
                MessageBox.Show("Xuất Excel thành công!", "Thông báo", MessageBoxButtons.OK, MessageBoxIcon.Information);
            }

            // 7. Đóng và giải phóng
            xlWorkBook.Close(false);
            xlApp.Quit();

            System.Runtime.InteropServices.Marshal.ReleaseComObject(xlWorkSheet);
            System.Runtime.InteropServices.Marshal.ReleaseComObject(xlWorkBook);
            System.Runtime.InteropServices.Marshal.ReleaseComObject(xlApp);
        }

        private void btnXuatExcel_Click(object sender, EventArgs e)
        {
            XuatExcel();
        }
    }
}
