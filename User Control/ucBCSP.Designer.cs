namespace BTL_Nhom9
{
    partial class ucBCSP
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
            System.Windows.Forms.DataVisualization.Charting.ChartArea chartArea3 = new System.Windows.Forms.DataVisualization.Charting.ChartArea();
            System.Windows.Forms.DataVisualization.Charting.Legend legend3 = new System.Windows.Forms.DataVisualization.Charting.Legend();
            System.Windows.Forms.DataVisualization.Charting.Series series3 = new System.Windows.Forms.DataVisualization.Charting.Series();
            this.label1 = new System.Windows.Forms.Label();
            this.l = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.dtpTuNgay = new System.Windows.Forms.DateTimePicker();
            this.dtpDenNgay = new System.Windows.Forms.DateTimePicker();
            this.dgvBCSP = new System.Windows.Forms.DataGridView();
            this.btnThongKe = new System.Windows.Forms.Button();
            this.chart1 = new System.Windows.Forms.DataVisualization.Charting.Chart();
            this.label4 = new System.Windows.Forms.Label();
            this.btnXuatBC = new System.Windows.Forms.Button();
            ((System.ComponentModel.ISupportInitialize)(this.dgvBCSP)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.chart1)).BeginInit();
            this.SuspendLayout();
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Segoe UI", 18F, System.Drawing.FontStyle.Bold);
            this.label1.ForeColor = System.Drawing.Color.ForestGreen;
            this.label1.Location = new System.Drawing.Point(266, 0);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(424, 82);
            this.label1.TabIndex = 9;
            this.label1.Text = "Báo Cáo Sản Phẩm Bán Chạy \r\n\r\n";
            // 
            // l
            // 
            this.l.AutoSize = true;
            this.l.Font = new System.Drawing.Font("Segoe UI", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.l.ForeColor = System.Drawing.Color.ForestGreen;
            this.l.Location = new System.Drawing.Point(76, 71);
            this.l.Name = "l";
            this.l.Size = new System.Drawing.Size(94, 56);
            this.l.TabIndex = 10;
            this.l.Text = "Từ ngày:\r\n\r\n";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Segoe UI", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.ForeColor = System.Drawing.Color.ForestGreen;
            this.label2.Location = new System.Drawing.Point(624, 71);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(107, 56);
            this.label2.TabIndex = 12;
            this.label2.Text = "Đến ngày:\r\n\r\n";
            // 
            // dtpTuNgay
            // 
            this.dtpTuNgay.Location = new System.Drawing.Point(176, 76);
            this.dtpTuNgay.Name = "dtpTuNgay";
            this.dtpTuNgay.Size = new System.Drawing.Size(200, 22);
            this.dtpTuNgay.TabIndex = 13;
            // 
            // dtpDenNgay
            // 
            this.dtpDenNgay.Location = new System.Drawing.Point(737, 76);
            this.dtpDenNgay.Name = "dtpDenNgay";
            this.dtpDenNgay.Size = new System.Drawing.Size(200, 22);
            this.dtpDenNgay.TabIndex = 14;
            // 
            // dgvBCSP
            // 
            this.dgvBCSP.BackgroundColor = System.Drawing.Color.MintCream;
            this.dgvBCSP.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dgvBCSP.Location = new System.Drawing.Point(81, 130);
            this.dgvBCSP.Name = "dgvBCSP";
            this.dgvBCSP.RowHeadersWidth = 51;
            this.dgvBCSP.RowTemplate.Height = 24;
            this.dgvBCSP.Size = new System.Drawing.Size(856, 229);
            this.dgvBCSP.TabIndex = 16;
            // 
            // btnThongKe
            // 
            this.btnThongKe.BackColor = System.Drawing.Color.White;
            this.btnThongKe.Font = new System.Drawing.Font("Segoe UI", 10.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btnThongKe.ForeColor = System.Drawing.Color.ForestGreen;
            this.btnThongKe.Location = new System.Drawing.Point(81, 723);
            this.btnThongKe.Name = "btnThongKe";
            this.btnThongKe.Size = new System.Drawing.Size(124, 34);
            this.btnThongKe.TabIndex = 22;
            this.btnThongKe.Text = "Thống kê";
            this.btnThongKe.UseVisualStyleBackColor = false;
            // 
            // chart1
            // 
            chartArea3.Name = "ChartArea1";
            this.chart1.ChartAreas.Add(chartArea3);
            legend3.Name = "Legend1";
            this.chart1.Legends.Add(legend3);
            this.chart1.Location = new System.Drawing.Point(356, 392);
            this.chart1.Name = "chart1";
            series3.ChartArea = "ChartArea1";
            series3.Legend = "Legend1";
            series3.Name = "Series1";
            this.chart1.Series.Add(series3);
            this.chart1.Size = new System.Drawing.Size(300, 300);
            this.chart1.TabIndex = 23;
            this.chart1.Text = "chart1";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Font = new System.Drawing.Font("Segoe UI", 10.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label4.ForeColor = System.Drawing.Color.ForestGreen;
            this.label4.Location = new System.Drawing.Point(276, 685);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(420, 25);
            this.label4.TabIndex = 26;
            this.label4.Text = "Biểu đồ top 5 sản phẩm bán chạy theo thời gian\r\n";
            // 
            // btnXuatBC
            // 
            this.btnXuatBC.BackColor = System.Drawing.Color.White;
            this.btnXuatBC.Font = new System.Drawing.Font("Segoe UI", 10.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btnXuatBC.ForeColor = System.Drawing.Color.ForestGreen;
            this.btnXuatBC.Location = new System.Drawing.Point(813, 723);
            this.btnXuatBC.Name = "btnXuatBC";
            this.btnXuatBC.Size = new System.Drawing.Size(124, 34);
            this.btnXuatBC.TabIndex = 29;
            this.btnXuatBC.Text = "Xuất báo cáo ";
            this.btnXuatBC.UseVisualStyleBackColor = false;
            // 
            // ucBCSP
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.White;
            this.Controls.Add(this.btnXuatBC);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.chart1);
            this.Controls.Add(this.btnThongKe);
            this.Controls.Add(this.dgvBCSP);
            this.Controls.Add(this.dtpDenNgay);
            this.Controls.Add(this.dtpTuNgay);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.l);
            this.Controls.Add(this.label1);
            this.Name = "ucBCSP";
            this.Size = new System.Drawing.Size(1006, 777);
            ((System.ComponentModel.ISupportInitialize)(this.dgvBCSP)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.chart1)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label l;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.DateTimePicker dtpTuNgay;
        private System.Windows.Forms.DateTimePicker dtpDenNgay;
        private System.Windows.Forms.DataGridView dgvBCSP;
        private System.Windows.Forms.Button btnThongKe;
        private System.Windows.Forms.DataVisualization.Charting.Chart chart1;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Button btnXuatBC;
    }
}
