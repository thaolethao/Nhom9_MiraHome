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

            // 👉 Tính tổng số sách nhập (từ bảng chi tiết)
            string sqlTongSach = $@"SELECT SUM(SLNhap) 
                            FROM tblChiTietHDN ct
                            JOIN tblHoaDonNhap hdn ON ct.SoHDN = hdn.SoHDN
                            WHERE hdn.NgayNhap BETWEEN '{tuNgay:yyyy-MM-dd}' AND '{denNgay:yyyy-MM-dd}'";
            object result = DAO.GetFieldValues(sqlTongSach);
            int tongSoSach = 0;
            if (result != DBNull.Value)
            {
                tongSoSach = Convert.ToInt32(result);
            }
            txtTongSoSach.Text = tongSoSach.ToString("N0") + " quyển";
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
            using (Bitmap bmp = new Bitmap(chart.Width * 2, chart.Height * 2))
            {
                chart.DrawToBitmap(bmp, new Rectangle(0, 0, bmp.Width, bmp.Height));
                bmp.Save(path, System.Drawing.Imaging.ImageFormat.Png);
            }
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

            // Tiêu đề chính
            worksheet.Cells[1, 1] = "BÁO CÁO NHẬP HÀNG";
            Excel.Range titleRange = worksheet.Range["A1", "E1"];
            titleRange.Merge();
            titleRange.Font.Size = 16;
            titleRange.Font.Bold = true;
            titleRange.HorizontalAlignment = Excel.XlHAlign.xlHAlignCenter;

            // Thời gian thống kê
            DateTime tuNgay = dtpTuNgay.Value.Date;
            DateTime denNgay = dtpDenNgay.Value.Date;

            worksheet.Cells[2, 1] = $"Thời gian: từ ngày {tuNgay:dd/MM/yyyy} đến ngày {denNgay:dd/MM/yyyy}";
            Excel.Range timeRange = worksheet.Range["A2", "E2"];
            timeRange.Merge();
            timeRange.Font.Italic = true;
            timeRange.HorizontalAlignment = Excel.XlHAlign.xlHAlignLeft;

            worksheet.Cells[3, 1] = "Ngày xuất báo cáo: " + DateTime.Now.ToString("HH:mm dd/MM/yyyy");
            Excel.Range exportTime = worksheet.Range["A3", "E3"];
            exportTime.Merge();
            exportTime.HorizontalAlignment = Excel.XlHAlign.xlHAlignLeft;
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

            int dataEndRow = dgvBCNH.Rows.Count + 4;

            // Tổng tiền
            worksheet.Cells[dataEndRow + 1, 1] = "Tổng tiền:";
            worksheet.Cells[dataEndRow + 1, 2] = txtTTNH.Text;
            worksheet.Range[$"A{dataEndRow + 1}:B{dataEndRow + 1}"].Font.Bold = true;

            // Tổng số sách nhập
            worksheet.Cells[dataEndRow + 2, 1] = "Tổng số sách nhập:";
            worksheet.Cells[dataEndRow + 2, 2] = txtTongSoSach.Text;
            worksheet.Range[$"A{dataEndRow + 2}:B{dataEndRow + 2}"].Font.Bold = true;

            // Lưu biểu đồ thành ảnh rõ nét
            string chart1Path = SaveChartToImage(bdchiphinhap, $"chart_{Guid.NewGuid()}.png");
            string chart2Path = SaveChartToImage(bdNCC, $"chart_{Guid.NewGuid()}.png");

            // Thêm tiêu đề biểu đồ + chèn ảnh
            int chartRowStart = dataEndRow + 4;

            worksheet.Cells[chartRowStart, 1] = "Biểu đồ: Tổng tiền nhập theo tháng";
            worksheet.Range[$"A{chartRowStart}"].Font.Bold = true;
            Excel.Range imgPos1 = worksheet.Cells[chartRowStart + 1, 1];
            worksheet.Shapes.AddPicture(chart1Path,
                Microsoft.Office.Core.MsoTriState.msoFalse,
                Microsoft.Office.Core.MsoTriState.msoCTrue,
                (float)imgPos1.Left, (float)imgPos1.Top, 600, 350);

            worksheet.Cells[chartRowStart + 19, 1] = "Biểu đồ: Top 5 nhà cung cấp";
            worksheet.Range[$"A{chartRowStart + 19}"].Font.Bold = true;
            Excel.Range imgPos2 = worksheet.Cells[chartRowStart + 20, 1];
            worksheet.Shapes.AddPicture(chart2Path,
                Microsoft.Office.Core.MsoTriState.msoFalse,
                Microsoft.Office.Core.MsoTriState.msoCTrue,
                (float)imgPos2.Left, (float)imgPos2.Top, 600, 350);

            // Auto fit cột
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
