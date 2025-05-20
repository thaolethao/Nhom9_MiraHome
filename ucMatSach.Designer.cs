namespace BTL_Nhom9
{
    partial class ucMatSach
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
            this.label1 = new System.Windows.Forms.Label();
            this.l = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.dgvMatSach = new System.Windows.Forms.DataGridView();
            this.txtMaLanMat = new System.Windows.Forms.TextBox();
            this.cbbMaSach = new System.Windows.Forms.ComboBox();
            this.dtpNgayMat = new System.Windows.Forms.DateTimePicker();
            this.txtSoLuongMat = new System.Windows.Forms.TextBox();
            this.btnThem = new System.Windows.Forms.Button();
            this.btnSua = new System.Windows.Forms.Button();
            this.btnLuu = new System.Windows.Forms.Button();
            this.btnXoa = new System.Windows.Forms.Button();
            this.btnHuy = new System.Windows.Forms.Button();
            this.btnThoat = new System.Windows.Forms.Button();
            ((System.ComponentModel.ISupportInitialize)(this.dgvMatSach)).BeginInit();
            this.SuspendLayout();
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Segoe UI", 18F, System.Drawing.FontStyle.Bold);
            this.label1.ForeColor = System.Drawing.Color.DimGray;
            this.label1.Location = new System.Drawing.Point(222, 0);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(269, 41);
            this.label1.TabIndex = 5;
            this.label1.Text = "Quản Lý Mất Sách\r\n";
            // 
            // l
            // 
            this.l.AutoSize = true;
            this.l.Font = new System.Drawing.Font("Segoe UI", 10.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.l.ForeColor = System.Drawing.Color.DimGray;
            this.l.Location = new System.Drawing.Point(63, 57);
            this.l.Name = "l";
            this.l.Size = new System.Drawing.Size(111, 23);
            this.l.TabIndex = 6;
            this.l.Text = "Mã lần mất :\r\n";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Segoe UI", 10.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.ForeColor = System.Drawing.Color.DimGray;
            this.label2.Location = new System.Drawing.Point(63, 98);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(84, 23);
            this.label2.TabIndex = 17;
            this.label2.Text = "Mã sách :\r\n";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Font = new System.Drawing.Font("Segoe UI", 10.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label4.ForeColor = System.Drawing.Color.DimGray;
            this.label4.Location = new System.Drawing.Point(63, 138);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(99, 23);
            this.label4.TabIndex = 20;
            this.label4.Text = "Ngày mất :\r\n";
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Segoe UI", 10.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label3.ForeColor = System.Drawing.Color.DimGray;
            this.label3.Location = new System.Drawing.Point(63, 175);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(130, 23);
            this.label3.TabIndex = 21;
            this.label3.Text = "Số lượng mất :\r\n";
            // 
            // dgvMatSach
            // 
            this.dgvMatSach.BackgroundColor = System.Drawing.SystemColors.ButtonFace;
            this.dgvMatSach.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dgvMatSach.Location = new System.Drawing.Point(67, 218);
            this.dgvMatSach.Name = "dgvMatSach";
            this.dgvMatSach.RowHeadersWidth = 51;
            this.dgvMatSach.RowTemplate.Height = 24;
            this.dgvMatSach.Size = new System.Drawing.Size(621, 150);
            this.dgvMatSach.TabIndex = 23;
            // 
            // txtMaLanMat
            // 
            this.txtMaLanMat.Font = new System.Drawing.Font("Segoe UI Semibold", 9F, System.Drawing.FontStyle.Bold);
            this.txtMaLanMat.ForeColor = System.Drawing.Color.DimGray;
            this.txtMaLanMat.Location = new System.Drawing.Point(212, 53);
            this.txtMaLanMat.Name = "txtMaLanMat";
            this.txtMaLanMat.Size = new System.Drawing.Size(190, 27);
            this.txtMaLanMat.TabIndex = 24;
            // 
            // cbbMaSach
            // 
            this.cbbMaSach.Font = new System.Drawing.Font("Segoe UI Semibold", 9F, System.Drawing.FontStyle.Bold);
            this.cbbMaSach.ForeColor = System.Drawing.Color.DimGray;
            this.cbbMaSach.FormattingEnabled = true;
            this.cbbMaSach.Items.AddRange(new object[] {
            "Nam",
            "Nữ"});
            this.cbbMaSach.Location = new System.Drawing.Point(212, 93);
            this.cbbMaSach.Name = "cbbMaSach";
            this.cbbMaSach.Size = new System.Drawing.Size(190, 28);
            this.cbbMaSach.TabIndex = 25;
            // 
            // dtpNgayMat
            // 
            this.dtpNgayMat.CalendarFont = new System.Drawing.Font("Segoe UI Semibold", 7.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.dtpNgayMat.CalendarForeColor = System.Drawing.Color.DimGray;
            this.dtpNgayMat.CalendarTitleForeColor = System.Drawing.Color.DimGray;
            this.dtpNgayMat.Location = new System.Drawing.Point(212, 138);
            this.dtpNgayMat.Name = "dtpNgayMat";
            this.dtpNgayMat.Size = new System.Drawing.Size(279, 22);
            this.dtpNgayMat.TabIndex = 26;
            // 
            // txtSoLuongMat
            // 
            this.txtSoLuongMat.Font = new System.Drawing.Font("Segoe UI Semibold", 9F, System.Drawing.FontStyle.Bold);
            this.txtSoLuongMat.ForeColor = System.Drawing.Color.DimGray;
            this.txtSoLuongMat.Location = new System.Drawing.Point(212, 174);
            this.txtSoLuongMat.Name = "txtSoLuongMat";
            this.txtSoLuongMat.Size = new System.Drawing.Size(190, 27);
            this.txtSoLuongMat.TabIndex = 27;
            // 
            // btnThem
            // 
            this.btnThem.BackColor = System.Drawing.Color.White;
            this.btnThem.Font = new System.Drawing.Font("Segoe UI", 10.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btnThem.ForeColor = System.Drawing.Color.DimGray;
            this.btnThem.Location = new System.Drawing.Point(67, 395);
            this.btnThem.Name = "btnThem";
            this.btnThem.Size = new System.Drawing.Size(80, 33);
            this.btnThem.TabIndex = 28;
            this.btnThem.Text = "Thêm";
            this.btnThem.UseVisualStyleBackColor = false;
            // 
            // btnSua
            // 
            this.btnSua.BackColor = System.Drawing.Color.White;
            this.btnSua.Font = new System.Drawing.Font("Segoe UI", 10.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btnSua.ForeColor = System.Drawing.Color.DimGray;
            this.btnSua.Location = new System.Drawing.Point(176, 395);
            this.btnSua.Name = "btnSua";
            this.btnSua.Size = new System.Drawing.Size(80, 33);
            this.btnSua.TabIndex = 29;
            this.btnSua.Text = "Sửa";
            this.btnSua.UseVisualStyleBackColor = false;
            // 
            // btnLuu
            // 
            this.btnLuu.BackColor = System.Drawing.Color.White;
            this.btnLuu.Font = new System.Drawing.Font("Segoe UI", 10.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btnLuu.ForeColor = System.Drawing.Color.DimGray;
            this.btnLuu.Location = new System.Drawing.Point(287, 395);
            this.btnLuu.Name = "btnLuu";
            this.btnLuu.Size = new System.Drawing.Size(80, 33);
            this.btnLuu.TabIndex = 30;
            this.btnLuu.Text = "Lưu";
            this.btnLuu.UseVisualStyleBackColor = false;
            // 
            // btnXoa
            // 
            this.btnXoa.BackColor = System.Drawing.Color.White;
            this.btnXoa.Font = new System.Drawing.Font("Segoe UI", 10.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btnXoa.ForeColor = System.Drawing.Color.DimGray;
            this.btnXoa.Location = new System.Drawing.Point(396, 395);
            this.btnXoa.Name = "btnXoa";
            this.btnXoa.Size = new System.Drawing.Size(80, 33);
            this.btnXoa.TabIndex = 31;
            this.btnXoa.Text = "Xóa";
            this.btnXoa.UseVisualStyleBackColor = false;
            // 
            // btnHuy
            // 
            this.btnHuy.BackColor = System.Drawing.Color.White;
            this.btnHuy.Font = new System.Drawing.Font("Segoe UI", 10.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btnHuy.ForeColor = System.Drawing.Color.DimGray;
            this.btnHuy.Location = new System.Drawing.Point(504, 395);
            this.btnHuy.Name = "btnHuy";
            this.btnHuy.Size = new System.Drawing.Size(80, 33);
            this.btnHuy.TabIndex = 32;
            this.btnHuy.Text = "Hủy";
            this.btnHuy.UseVisualStyleBackColor = false;
            // 
            // btnThoat
            // 
            this.btnThoat.BackColor = System.Drawing.Color.White;
            this.btnThoat.Font = new System.Drawing.Font("Segoe UI", 10.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btnThoat.ForeColor = System.Drawing.Color.DimGray;
            this.btnThoat.Location = new System.Drawing.Point(608, 395);
            this.btnThoat.Name = "btnThoat";
            this.btnThoat.Size = new System.Drawing.Size(80, 33);
            this.btnThoat.TabIndex = 33;
            this.btnThoat.Text = "Thoát";
            this.btnThoat.UseVisualStyleBackColor = false;
            // 
            // ucMatSach
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.White;
            this.Controls.Add(this.btnThoat);
            this.Controls.Add(this.btnHuy);
            this.Controls.Add(this.btnXoa);
            this.Controls.Add(this.btnLuu);
            this.Controls.Add(this.btnSua);
            this.Controls.Add(this.btnThem);
            this.Controls.Add(this.txtSoLuongMat);
            this.Controls.Add(this.dtpNgayMat);
            this.Controls.Add(this.cbbMaSach);
            this.Controls.Add(this.txtMaLanMat);
            this.Controls.Add(this.dgvMatSach);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.l);
            this.Controls.Add(this.label1);
            this.Name = "ucMatSach";
            this.Size = new System.Drawing.Size(738, 514);
            this.Load += new System.EventHandler(this.ucMatSach_Load);
            ((System.ComponentModel.ISupportInitialize)(this.dgvMatSach)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label l;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.DataGridView dgvMatSach;
        private System.Windows.Forms.TextBox txtMaLanMat;
        private System.Windows.Forms.ComboBox cbbMaSach;
        private System.Windows.Forms.DateTimePicker dtpNgayMat;
        private System.Windows.Forms.TextBox txtSoLuongMat;
        private System.Windows.Forms.Button btnThem;
        private System.Windows.Forms.Button btnSua;
        private System.Windows.Forms.Button btnLuu;
        private System.Windows.Forms.Button btnXoa;
        private System.Windows.Forms.Button btnHuy;
        private System.Windows.Forms.Button btnThoat;
    }
}
