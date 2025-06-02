namespace BTL_Nhom9
{
    partial class ucBCNH
    {
        /// <summary> 
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary> 
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Component Designer generated code

        /// <summary> 
        /// Required method for Designer support - do not modify 
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            System.Windows.Forms.DataVisualization.Charting.ChartArea chartArea1 = new System.Windows.Forms.DataVisualization.Charting.ChartArea();
            System.Windows.Forms.DataVisualization.Charting.Legend legend1 = new System.Windows.Forms.DataVisualization.Charting.Legend();
            System.Windows.Forms.DataVisualization.Charting.Series series1 = new System.Windows.Forms.DataVisualization.Charting.Series();
            System.Windows.Forms.DataVisualization.Charting.ChartArea chartArea2 = new System.Windows.Forms.DataVisualization.Charting.ChartArea();
            System.Windows.Forms.DataVisualization.Charting.Legend legend2 = new System.Windows.Forms.DataVisualization.Charting.Legend();
            System.Windows.Forms.DataVisualization.Charting.Series series2 = new System.Windows.Forms.DataVisualization.Charting.Series();
            this.label1 = new System.Windows.Forms.Label();
            this.l = new System.Windows.Forms.Label();
            this.dtpTuNgay = new System.Windows.Forms.DateTimePicker();
            this.label2 = new System.Windows.Forms.Label();
            this.dtpDenNgay = new System.Windows.Forms.DateTimePicker();
            this.label3 = new System.Windows.Forms.Label();
            this.dgvBCNH = new System.Windows.Forms.DataGridView();
            this.txtTTNH = new System.Windows.Forms.TextBox();
            this.bdchiphinhap = new System.Windows.Forms.DataVisualization.Charting.Chart();
            this.bdNCC = new System.Windows.Forms.DataVisualization.Charting.Chart();
            this.btnLapBaoCao = new System.Windows.Forms.Button();
            this.label4 = new System.Windows.Forms.Label();
            this.label5 = new System.Windows.Forms.Label();
            this.btnXuatBC = new System.Windows.Forms.Button();
            this.label6 = new System.Windows.Forms.Label();
            this.txtTongSoSach = new System.Windows.Forms.TextBox();
            ((System.ComponentModel.ISupportInitialize)(this.dgvBCNH)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.bdchiphinhap)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.bdNCC)).BeginInit();
            this.SuspendLayout();
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Segoe UI", 18F, System.Drawing.FontStyle.Bold);
            this.label1.ForeColor = System.Drawing.Color.LightCoral;
            this.label1.Location = new System.Drawing.Point(367, 15);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(301, 82);
            this.label1.TabIndex = 7;
            this.label1.Text = "Báo Cáo Nhập Hàng\r\n\r\n";
            this.label1.Click += new System.EventHandler(this.label1_Click);
            // 
            // l
            // 
            this.l.AutoSize = true;
            this.l.Font = new System.Drawing.Font("Segoe UI", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.l.ForeColor = System.Drawing.Color.LightCoral;
            this.l.Location = new System.Drawing.Point(50, 70);
            this.l.Name = "l";
            this.l.Size = new System.Drawing.Size(94, 56);
            this.l.TabIndex = 8;
            this.l.Text = "Từ ngày:\r\n\r\n";
            // 
            // dtpTuNgay
            // 
            this.dtpTuNgay.Location = new System.Drawing.Point(161, 75);
            this.dtpTuNgay.Name = "dtpTuNgay";
            this.dtpTuNgay.Size = new System.Drawing.Size(226, 22);
            this.dtpTuNgay.TabIndex = 9;
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Segoe UI", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.ForeColor = System.Drawing.Color.LightCoral;
            this.label2.Location = new System.Drawing.Point(634, 70);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(107, 56);
            this.label2.TabIndex = 10;
            this.label2.Text = "Đến ngày:\r\n\r\n";
            // 
            // dtpDenNgay
            // 
            this.dtpDenNgay.Location = new System.Drawing.Point(758, 75);
            this.dtpDenNgay.Name = "dtpDenNgay";
            this.dtpDenNgay.Size = new System.Drawing.Size(230, 22);
            this.dtpDenNgay.TabIndex = 11;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Segoe UI", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label3.ForeColor = System.Drawing.Color.LightCoral;
            this.label3.Location = new System.Drawing.Point(50, 351);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(214, 56);
            this.label3.TabIndex = 12;
            this.label3.Text = "Tổng tiền nhập hàng:\r\n\r\n";
            // 
            // dgvBCNH
            // 
            this.dgvBCNH.BackgroundColor = System.Drawing.Color.Snow;
            this.dgvBCNH.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dgvBCNH.Location = new System.Drawing.Point(55, 111);
            this.dgvBCNH.Name = "dgvBCNH";
            this.dgvBCNH.RowHeadersWidth = 51;
            this.dgvBCNH.RowTemplate.Height = 24;
            this.dgvBCNH.Size = new System.Drawing.Size(933, 229);
            this.dgvBCNH.TabIndex = 14;
            // 
            // txtTTNH
            // 
            this.txtTTNH.Font = new System.Drawing.Font("Segoe UI Semibold", 10F, System.Drawing.FontStyle.Bold);
            this.txtTTNH.ForeColor = System.Drawing.Color.LightCoral;
            this.txtTTNH.Location = new System.Drawing.Point(270, 353);
            this.txtTTNH.Name = "txtTTNH";
            this.txtTTNH.Size = new System.Drawing.Size(172, 30);
            this.txtTTNH.TabIndex = 17;
            // 
            // bdchiphinhap
            // 
            this.bdchiphinhap.AntiAliasing = System.Windows.Forms.DataVisualization.Charting.AntiAliasingStyles.Graphics;
            chartArea1.Name = "ChartArea1";
            this.bdchiphinhap.ChartAreas.Add(chartArea1);
            legend1.Name = "Legend1";
            this.bdchiphinhap.Legends.Add(legend1);
            this.bdchiphinhap.Location = new System.Drawing.Point(107, 410);
            this.bdchiphinhap.Name = "bdchiphinhap";
            this.bdchiphinhap.Palette = System.Windows.Forms.DataVisualization.Charting.ChartColorPalette.Pastel;
            series1.ChartArea = "ChartArea1";
            series1.Legend = "Legend1";
            series1.Name = "Series1";
            this.bdchiphinhap.Series.Add(series1);
            this.bdchiphinhap.Size = new System.Drawing.Size(300, 300);
            this.bdchiphinhap.TabIndex = 18;
            this.bdchiphinhap.Text = "Chi phí nhập hàng ";
            // 
            // bdNCC
            // 
            chartArea2.Name = "ChartArea1";
            this.bdNCC.ChartAreas.Add(chartArea2);
            legend2.Name = "Legend1";
            this.bdNCC.Legends.Add(legend2);
            this.bdNCC.Location = new System.Drawing.Point(666, 410);
            this.bdNCC.Name = "bdNCC";
            series2.ChartArea = "ChartArea1";
            series2.Legend = "Legend1";
            series2.Name = "Series1";
            this.bdNCC.Series.Add(series2);
            this.bdNCC.Size = new System.Drawing.Size(300, 300);
            this.bdNCC.TabIndex = 19;
            this.bdNCC.Text = "Nhà Cung Cấp";
            // 
            // btnLapBaoCao
            // 
            this.btnLapBaoCao.BackColor = System.Drawing.Color.White;
            this.btnLapBaoCao.Font = new System.Drawing.Font("Segoe UI", 10.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btnLapBaoCao.ForeColor = System.Drawing.Color.LightCoral;
            this.btnLapBaoCao.Location = new System.Drawing.Point(55, 753);
            this.btnLapBaoCao.Name = "btnLapBaoCao";
            this.btnLapBaoCao.Size = new System.Drawing.Size(124, 34);
            this.btnLapBaoCao.TabIndex = 20;
            this.btnLapBaoCao.Text = "Lập báo cáo";
            this.btnLapBaoCao.UseVisualStyleBackColor = false;
            this.btnLapBaoCao.Click += new System.EventHandler(this.btnThongKe_Click);
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Font = new System.Drawing.Font("Segoe UI", 10.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label4.ForeColor = System.Drawing.Color.LightCoral;
            this.label4.Location = new System.Drawing.Point(50, 713);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(381, 25);
            this.label4.TabIndex = 21;
            this.label4.Text = "Biểu đồ tổng tiền nhập hàng theo thời gian";
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Font = new System.Drawing.Font("Segoe UI", 10.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label5.ForeColor = System.Drawing.Color.LightCoral;
            this.label5.Location = new System.Drawing.Point(595, 713);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(375, 25);
            this.label5.TabIndex = 22;
            this.label5.Text = "Biểu đồ top 5 nhà cung cấp theo thời gian \r\n";
            // 
            // btnXuatBC
            // 
            this.btnXuatBC.BackColor = System.Drawing.Color.White;
            this.btnXuatBC.Font = new System.Drawing.Font("Segoe UI", 10.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btnXuatBC.ForeColor = System.Drawing.Color.LightCoral;
            this.btnXuatBC.Location = new System.Drawing.Point(971, 762);
            this.btnXuatBC.Name = "btnXuatBC";
            this.btnXuatBC.Size = new System.Drawing.Size(124, 34);
            this.btnXuatBC.TabIndex = 23;
            this.btnXuatBC.Text = "Xuất báo cáo ";
            this.btnXuatBC.UseVisualStyleBackColor = false;
            this.btnXuatBC.Click += new System.EventHandler(this.btnXuatBC_Click);
            // 
            // label6
            // 
            this.label6.AutoSize = true;
            this.label6.Font = new System.Drawing.Font("Segoe UI", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label6.ForeColor = System.Drawing.Color.LightCoral;
            this.label6.Location = new System.Drawing.Point(496, 353);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(223, 28);
            this.label6.TabIndex = 24;
            this.label6.Text = "Tổng số sách đã nhập:\r\n";
            // 
            // txtTongSoSach
            // 
            this.txtTongSoSach.Font = new System.Drawing.Font("Segoe UI Semibold", 10F, System.Drawing.FontStyle.Bold);
            this.txtTongSoSach.ForeColor = System.Drawing.Color.LightCoral;
            this.txtTongSoSach.Location = new System.Drawing.Point(725, 351);
            this.txtTongSoSach.Name = "txtTongSoSach";
            this.txtTongSoSach.Size = new System.Drawing.Size(172, 30);
            this.txtTongSoSach.TabIndex = 25;
            // 
            // ucBCNH
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.AutoScroll = true;
            this.AutoSize = true;
            this.BackColor = System.Drawing.Color.White;
            this.Controls.Add(this.txtTongSoSach);
            this.Controls.Add(this.label6);
            this.Controls.Add(this.btnXuatBC);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.btnLapBaoCao);
            this.Controls.Add(this.bdNCC);
            this.Controls.Add(this.bdchiphinhap);
            this.Controls.Add(this.txtTTNH);
            this.Controls.Add(this.dgvBCNH);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.dtpDenNgay);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.dtpTuNgay);
            this.Controls.Add(this.l);
            this.Controls.Add(this.label1);
            this.Name = "ucBCNH";
            this.Size = new System.Drawing.Size(1111, 818);
            this.Load += new System.EventHandler(this.ucBCNH_Load);
            ((System.ComponentModel.ISupportInitialize)(this.dgvBCNH)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.bdchiphinhap)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.bdNCC)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label l;
        private System.Windows.Forms.DateTimePicker dtpTuNgay;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.DateTimePicker dtpDenNgay;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.DataGridView dgvBCNH;
        private System.Windows.Forms.TextBox txtTTNH;
        private System.Windows.Forms.DataVisualization.Charting.Chart bdchiphinhap;
        private System.Windows.Forms.DataVisualization.Charting.Chart bdNCC;
        private System.Windows.Forms.Button btnLapBaoCao;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Button btnXuatBC;
        private System.Windows.Forms.Label label6;
        private System.Windows.Forms.TextBox txtTongSoSach;
    }
}
