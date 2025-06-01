using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Windows.Forms.DataVisualization.Charting;
using Excel = Microsoft.Office.Interop.Excel;
using Office = Microsoft.Office.Core;

namespace BTL_Nhom9
{
    public partial class ucBCNH : UserControl
    {
        public ucBCNH()
        {
            InitializeComponent();
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void btnThongKe_Click(object sender, EventArgs e)
        {
            DateTime tuNgay = dtpTuNgay.Value.Date;
            DateTime denNgay = dtpDenNgay.Value.Date;

            if (tuNgay > denNgay)
            {
                MessageBox.Show("Từ ngày không được lớn hơn đến ngày!");
                return;
            }

            HienThiDuLieuHoaDonNhap(tuNgay, denNgay);
            VeBieuDoTongTienNhap(tuNgay, denNgay);
            VeBieuDoTopNhaCungCap(tuNgay, denNgay);
        }

        private void HienThiDuLieuHoaDonNhap(DateTime tuNgay, DateTime denNgay)
        {
            DAO.connect();
            string sql = $"SELECT SoHDN, MaNV, NgayNhap, MaNCC, TongTien " +
                         $"FROM tblHoaDonNhap " +
                         $"WHERE NgayNhap BETWEEN '{tuNgay:yyyy-MM-dd}' AND '{denNgay:yyyy-MM-dd}'";

            DataTable dt = DAO.GetDataToTable(sql);
            dgvBCNH.DataSource = dt;

            // Tính tổng tiền
            double tongTien = dt.AsEnumerable().Sum(row => Convert.ToDouble(row["TongTien"]));
            txtTTNH.Text = tongTien.ToString("N0") + " VNĐ";
            DAO.close();
        }

        private void VeBieuDoTongTienNhap(DateTime tuNgay, DateTime denNgay)
        {
            bdchiphinhap.Series.Clear();
            Series series = new Series("Tổng tiền theo tháng");
            series.ChartType = SeriesChartType.Column;

            DAO.connect();
            string sql = $@"SELECT MONTH(NgayNhap) AS Thang, SUM(TongTien) AS Tong
                    FROM tblHoaDonNhap
                    WHERE NgayNhap BETWEEN '{tuNgay:yyyy-MM-dd}' AND '{denNgay:yyyy-MM-dd}'
                    GROUP BY MONTH(NgayNhap)
                    ORDER BY Thang";

            DataTable dt = DAO.GetDataToTable(sql);
            foreach (DataRow row in dt.Rows)
            {
                series.Points.AddXY("Tháng " + row["Thang"], row["Tong"]);
            }

            bdchiphinhap.Series.Add(series);
            DAO.close();
        }

        private void VeBieuDoTopNhaCungCap(DateTime tuNgay, DateTime denNgay)
        {
            bdNCC.Series.Clear();
            Series series = new Series("Top 5 nhà cung cấp");
            series.ChartType = SeriesChartType.Column;
            DAO.connect();
            string sql = $@"SELECT TOP 5 ncc.TenNCC, SUM(hdn.TongTien) AS Tong
                            FROM tblHoaDonNhap hdn
                            JOIN tblNhaCungCap ncc ON hdn.MaNCC = ncc.MaNCC
                            WHERE hdn.NgayNhap BETWEEN '{tuNgay:yyyy-MM-dd}' AND '{denNgay:yyyy-MM-dd}'
                            GROUP BY ncc.TenNCC
                            ORDER BY Tong DESC";

            DataTable dt = DAO.GetDataToTable(sql);
            foreach (DataRow row in dt.Rows)
            {
                series.Points.AddXY(row["TenNCC"], row["Tong"]);
            }

            bdNCC.Series.Add(series);
            DAO.close();
        }

        private string SaveChartToImage(Chart chart, string fileName)
        {
            string path = Path.Combine(Path.GetTempPath(), fileName);
            chart.SaveImage(path, ChartImageFormat.Png);
            return path;
        }
        private void btnXuatBC_Click(object sender, EventArgs e)
        {
            if (dgvBCNH.Rows.Count == 0)
            {
                MessageBox.Show("Không có dữ liệu để xuất!");
                return;
            }

            Excel.Application excelApp = new Excel.Application();
            if (excelApp == null)
            {
                MessageBox.Show("Không thể khởi tạo Excel. Vui lòng kiểm tra cài đặt Office.");
                return;
            }

            Excel.Workbook workbook = excelApp.Workbooks.Add();
            Excel._Worksheet worksheet = workbook.Sheets[1];
            worksheet.Name = "Báo cáo nhập hàng";

            // Tiêu đề
            worksheet.Cells[1, 1] = "BÁO CÁO NHẬP HÀNG";
            Excel.Range titleRange = worksheet.Range["A1", "E1"];
            titleRange.Merge();
            titleRange.Font.Size = 16;
            titleRange.Font.Bold = true;
            titleRange.HorizontalAlignment = Excel.XlHAlign.xlHAlignCenter;

            // Header
            for (int i = 0; i < dgvBCNH.Columns.Count; i++)
            {
                worksheet.Cells[3, i + 1] = dgvBCNH.Columns[i].HeaderText;
            }

            // Dữ liệu
            for (int i = 0; i < dgvBCNH.Rows.Count; i++)
            {
                for (int j = 0; j < dgvBCNH.Columns.Count; j++)
                {
                    worksheet.Cells[i + 4, j + 1] = dgvBCNH.Rows[i].Cells[j].Value?.ToString();
                }
            }

            // Tổng tiền
            worksheet.Cells[dgvBCNH.Rows.Count + 5, 1] = "Tổng tiền:";
            worksheet.Cells[dgvBCNH.Rows.Count + 5, 2] = txtTTNH.Text;
            worksheet.Range[$"A{dgvBCNH.Rows.Count + 5}:B{dgvBCNH.Rows.Count + 5}"].Font.Bold = true;

            // Lưu biểu đồ thành ảnh
            string chart1Path = SaveChartToImage(bdchiphinhap, "chart1.png");
            string chart2Path = SaveChartToImage(bdNCC, "chart2.png");

            // Thêm biểu đồ Tổng tiền theo tháng
            Excel.Range imgPosition1 = worksheet.Cells[dgvBCNH.Rows.Count + 7, 1];
            worksheet.Shapes.AddPicture(chart1Path,
                Microsoft.Office.Core.MsoTriState.msoFalse,
                Microsoft.Office.Core.MsoTriState.msoCTrue,
                (float)imgPosition1.Left, (float)imgPosition1.Top, 500, 300);

            // Thêm biểu đồ Top nhà cung cấp
            Excel.Range imgPosition2 = worksheet.Cells[dgvBCNH.Rows.Count + 25, 1];
            worksheet.Shapes.AddPicture(chart2Path,
                Microsoft.Office.Core.MsoTriState.msoFalse,
                Microsoft.Office.Core.MsoTriState.msoCTrue,
                (float)imgPosition2.Left, (float)imgPosition2.Top, 500, 300);

            // Auto fit
            worksheet.Columns.AutoFit();

            // Lưu file
            SaveFileDialog sfd = new SaveFileDialog();
            sfd.Filter = "Excel Workbook|*.xlsx";
            sfd.FileName = "BaoCaoNhapHang.xlsx";

            if (sfd.ShowDialog() == DialogResult.OK)
            {
                try
                {
                    workbook.SaveAs(sfd.FileName);
                    MessageBox.Show("Xuất báo cáo thành công!");
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Lỗi khi lưu file: " + ex.Message);
                }
            }

            // Cleanup
            workbook.Close(false);
            excelApp.Quit();
            System.Runtime.InteropServices.Marshal.ReleaseComObject(worksheet);
            System.Runtime.InteropServices.Marshal.ReleaseComObject(workbook);
            System.Runtime.InteropServices.Marshal.ReleaseComObject(excelApp);
        }

        private void ucBCNH_Load(object sender, EventArgs e)
        {

        }
    }

        
}
