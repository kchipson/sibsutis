namespace laboratoryWork_4
{
    partial class FormMain
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

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.components = new System.ComponentModel.Container();
            this.panel_top = new System.Windows.Forms.Panel();
            this.checkBox1 = new System.Windows.Forms.CheckBox();
            this.label1 = new System.Windows.Forms.Label();
            this.driveListBox = new Microsoft.VisualBasic.Compatibility.VB6.DriveListBox();
            this.type_comboBox = new System.Windows.Forms.ComboBox();
            this.label2 = new System.Windows.Forms.Label();
            this.panel_main = new System.Windows.Forms.Panel();
            this.splitContainer1 = new System.Windows.Forms.SplitContainer();
            this.dirListBox = new Microsoft.VisualBasic.Compatibility.VB6.DirListBox();
            this.pictureBox = new System.Windows.Forms.PictureBox();
            this.fileListBox = new Microsoft.VisualBasic.Compatibility.VB6.FileListBox();
            this.panel1 = new System.Windows.Forms.Panel();
            this.panel3 = new System.Windows.Forms.Panel();
            this.time_label = new System.Windows.Forms.Label();
            this.panel2 = new System.Windows.Forms.Panel();
            this.file_label = new System.Windows.Forms.Label();
            this.path_panel = new System.Windows.Forms.Panel();
            this.path_label = new System.Windows.Forms.Label();
            this.timer = new System.Windows.Forms.Timer(this.components);
            this.panel_top.SuspendLayout();
            this.panel_main.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize) (this.splitContainer1)).BeginInit();
            this.splitContainer1.Panel1.SuspendLayout();
            this.splitContainer1.Panel2.SuspendLayout();
            this.splitContainer1.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize) (this.pictureBox)).BeginInit();
            this.panel1.SuspendLayout();
            this.panel3.SuspendLayout();
            this.panel2.SuspendLayout();
            this.path_panel.SuspendLayout();
            this.SuspendLayout();
            // 
            // panel_top
            // 
            this.panel_top.Anchor = ((System.Windows.Forms.AnchorStyles) (((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Left) | System.Windows.Forms.AnchorStyles.Right)));
            this.panel_top.Controls.Add(this.checkBox1);
            this.panel_top.Controls.Add(this.label1);
            this.panel_top.Controls.Add(this.driveListBox);
            this.panel_top.Controls.Add(this.type_comboBox);
            this.panel_top.Controls.Add(this.label2);
            this.panel_top.Location = new System.Drawing.Point(0, 0);
            this.panel_top.Margin = new System.Windows.Forms.Padding(4);
            this.panel_top.Name = "panel_top";
            this.panel_top.Size = new System.Drawing.Size(1069, 44);
            this.panel_top.TabIndex = 3;
            // 
            // checkBox1
            // 
            this.checkBox1.Anchor = ((System.Windows.Forms.AnchorStyles) ((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Right)));
            this.checkBox1.Appearance = System.Windows.Forms.Appearance.Button;
            this.checkBox1.AutoSize = true;
            this.checkBox1.CheckAlign = System.Drawing.ContentAlignment.MiddleCenter;
            this.checkBox1.Checked = true;
            this.checkBox1.CheckState = System.Windows.Forms.CheckState.Checked;
            this.checkBox1.Cursor = System.Windows.Forms.Cursors.Hand;
            this.checkBox1.FlatAppearance.BorderColor = System.Drawing.Color.White;
            this.checkBox1.FlatAppearance.CheckedBackColor = System.Drawing.SystemColors.GradientInactiveCaption;
            this.checkBox1.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.checkBox1.Location = new System.Drawing.Point(1047, 4);
            this.checkBox1.Margin = new System.Windows.Forms.Padding(4);
            this.checkBox1.Name = "checkBox1";
            this.checkBox1.Size = new System.Drawing.Size(6, 6);
            this.checkBox1.TabIndex = 6;
            this.checkBox1.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            this.checkBox1.UseVisualStyleBackColor = true;
            this.checkBox1.CheckedChanged += new System.EventHandler(this.checkBox1_CheckedChanged);
            // 
            // label1
            // 
            this.label1.ImageAlign = System.Drawing.ContentAlignment.MiddleLeft;
            this.label1.Location = new System.Drawing.Point(11, 0);
            this.label1.Margin = new System.Windows.Forms.Padding(4, 0, 4, 0);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(71, 37);
            this.label1.TabIndex = 3;
            this.label1.Text = "Диск:";
            this.label1.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // driveListBox
            // 
            this.driveListBox.Anchor = ((System.Windows.Forms.AnchorStyles) (((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) | System.Windows.Forms.AnchorStyles.Left)));
            this.driveListBox.FormattingEnabled = true;
            this.driveListBox.Location = new System.Drawing.Point(96, 6);
            this.driveListBox.Margin = new System.Windows.Forms.Padding(4);
            this.driveListBox.Name = "driveListBox";
            this.driveListBox.Size = new System.Drawing.Size(212, 23);
            this.driveListBox.TabIndex = 0;
            this.driveListBox.SelectionChangeCommitted += new System.EventHandler(this.driveListBox_SelectionChangeCommitted);
            // 
            // type_comboBox
            // 
            this.type_comboBox.Anchor = ((System.Windows.Forms.AnchorStyles) ((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom)));
            this.type_comboBox.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            this.type_comboBox.FormattingEnabled = true;
            this.type_comboBox.Items.AddRange(new object[] {"Все файлы  (*.*)", "JPEG Image  (*.jpg)", "itmap Image  (*.bmp)", "GIF image  (*.gif)", "PNG Image  (*.png)", "Все файлы  (*.*)", "JPEG Image  (*.jpg)", "itmap Image  (*.bmp)", "GIF image  (*.gif)", "PNG Image  (*.png)"});
            this.type_comboBox.Location = new System.Drawing.Point(432, 7);
            this.type_comboBox.Margin = new System.Windows.Forms.Padding(4);
            this.type_comboBox.Name = "type_comboBox";
            this.type_comboBox.Size = new System.Drawing.Size(163, 24);
            this.type_comboBox.TabIndex = 1;
            this.type_comboBox.SelectionChangeCommitted += new System.EventHandler(this.type_comboBox_SelectionChangeCommitted);
            // 
            // label2
            // 
            this.label2.Anchor = ((System.Windows.Forms.AnchorStyles) ((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom)));
            this.label2.Location = new System.Drawing.Point(328, 0);
            this.label2.Margin = new System.Windows.Forms.Padding(4, 0, 4, 0);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(96, 44);
            this.label2.TabIndex = 2;
            this.label2.Text = "Тип файлов:";
            this.label2.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // panel_main
            // 
            this.panel_main.Anchor = ((System.Windows.Forms.AnchorStyles) ((((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) | System.Windows.Forms.AnchorStyles.Left) | System.Windows.Forms.AnchorStyles.Right)));
            this.panel_main.BackColor = System.Drawing.Color.PeachPuff;
            this.panel_main.Controls.Add(this.splitContainer1);
            this.panel_main.Location = new System.Drawing.Point(0, 43);
            this.panel_main.Margin = new System.Windows.Forms.Padding(4);
            this.panel_main.Name = "panel_main";
            this.panel_main.Size = new System.Drawing.Size(1069, 529);
            this.panel_main.TabIndex = 1;
            // 
            // splitContainer1
            // 
            this.splitContainer1.Dock = System.Windows.Forms.DockStyle.Fill;
            this.splitContainer1.Location = new System.Drawing.Point(0, 0);
            this.splitContainer1.Margin = new System.Windows.Forms.Padding(4);
            this.splitContainer1.Name = "splitContainer1";
            // 
            // splitContainer1.Panel1
            // 
            this.splitContainer1.Panel1.Controls.Add(this.dirListBox);
            // 
            // splitContainer1.Panel2
            // 
            this.splitContainer1.Panel2.Controls.Add(this.pictureBox);
            this.splitContainer1.Panel2.Controls.Add(this.fileListBox);
            this.splitContainer1.Size = new System.Drawing.Size(1069, 529);
            this.splitContainer1.SplitterDistance = 378;
            this.splitContainer1.SplitterWidth = 5;
            this.splitContainer1.TabIndex = 4;
            // 
            // dirListBox
            // 
            this.dirListBox.Anchor = ((System.Windows.Forms.AnchorStyles) ((((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) | System.Windows.Forms.AnchorStyles.Left) | System.Windows.Forms.AnchorStyles.Right)));
            this.dirListBox.Cursor = System.Windows.Forms.Cursors.Default;
            this.dirListBox.FormattingEnabled = true;
            this.dirListBox.IntegralHeight = false;
            this.dirListBox.Location = new System.Drawing.Point(16, 9);
            this.dirListBox.Margin = new System.Windows.Forms.Padding(4);
            this.dirListBox.Name = "dirListBox";
            this.dirListBox.Size = new System.Drawing.Size(348, 499);
            this.dirListBox.TabIndex = 3;
            this.dirListBox.MouseDoubleClick += new System.Windows.Forms.MouseEventHandler(this.dirListBox_MouseDoubleClick);
            // 
            // pictureBox
            // 
            this.pictureBox.Anchor = ((System.Windows.Forms.AnchorStyles) ((((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) | System.Windows.Forms.AnchorStyles.Left) | System.Windows.Forms.AnchorStyles.Right)));
            this.pictureBox.ErrorImage = null;
            this.pictureBox.Location = new System.Drawing.Point(340, 165);
            this.pictureBox.Margin = new System.Windows.Forms.Padding(4);
            this.pictureBox.Name = "pictureBox";
            this.pictureBox.Size = new System.Drawing.Size(328, 177);
            this.pictureBox.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage;
            this.pictureBox.TabIndex = 1;
            this.pictureBox.TabStop = false;
            // 
            // fileListBox
            // 
            this.fileListBox.Anchor = ((System.Windows.Forms.AnchorStyles) (((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) | System.Windows.Forms.AnchorStyles.Left)));
            this.fileListBox.FormattingEnabled = true;
            this.fileListBox.Location = new System.Drawing.Point(4, 9);
            this.fileListBox.Margin = new System.Windows.Forms.Padding(4);
            this.fileListBox.Name = "fileListBox";
            this.fileListBox.Pattern = "*.*";
            this.fileListBox.Size = new System.Drawing.Size(327, 500);
            this.fileListBox.TabIndex = 5;
            this.fileListBox.SelectedValueChanged += new System.EventHandler(this.fileListBox_SelectedValueChanged);
            // 
            // panel1
            // 
            this.panel1.Anchor = ((System.Windows.Forms.AnchorStyles) (((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left) | System.Windows.Forms.AnchorStyles.Right)));
            this.panel1.Controls.Add(this.panel3);
            this.panel1.Controls.Add(this.panel2);
            this.panel1.Controls.Add(this.path_panel);
            this.panel1.Location = new System.Drawing.Point(0, 580);
            this.panel1.Margin = new System.Windows.Forms.Padding(4);
            this.panel1.Name = "panel1";
            this.panel1.Size = new System.Drawing.Size(1069, 46);
            this.panel1.TabIndex = 2;
            // 
            // panel3
            // 
            this.panel3.Anchor = ((System.Windows.Forms.AnchorStyles) (((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) | System.Windows.Forms.AnchorStyles.Right)));
            this.panel3.AutoScroll = true;
            this.panel3.Controls.Add(this.time_label);
            this.panel3.Location = new System.Drawing.Point(803, 0);
            this.panel3.Margin = new System.Windows.Forms.Padding(4);
            this.panel3.Name = "panel3";
            this.panel3.Size = new System.Drawing.Size(263, 46);
            this.panel3.TabIndex = 2;
            // 
            // time_label
            // 
            this.time_label.Anchor = ((System.Windows.Forms.AnchorStyles) (((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) | System.Windows.Forms.AnchorStyles.Right)));
            this.time_label.AutoEllipsis = true;
            this.time_label.Location = new System.Drawing.Point(75, 0);
            this.time_label.Margin = new System.Windows.Forms.Padding(13, 0, 7, 0);
            this.time_label.Name = "time_label";
            this.time_label.Size = new System.Drawing.Size(176, 46);
            this.time_label.TabIndex = 0;
            this.time_label.Text = "Время:";
            this.time_label.TextAlign = System.Drawing.ContentAlignment.MiddleLeft;
            // 
            // panel2
            // 
            this.panel2.Anchor = ((System.Windows.Forms.AnchorStyles) (((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) | System.Windows.Forms.AnchorStyles.Right)));
            this.panel2.AutoScroll = true;
            this.panel2.Controls.Add(this.file_label);
            this.panel2.Location = new System.Drawing.Point(460, 0);
            this.panel2.Margin = new System.Windows.Forms.Padding(4);
            this.panel2.Name = "panel2";
            this.panel2.Size = new System.Drawing.Size(263, 46);
            this.panel2.TabIndex = 1;
            // 
            // file_label
            // 
            this.file_label.AutoEllipsis = true;
            this.file_label.Dock = System.Windows.Forms.DockStyle.Fill;
            this.file_label.Location = new System.Drawing.Point(0, 0);
            this.file_label.Margin = new System.Windows.Forms.Padding(13, 0, 7, 0);
            this.file_label.Name = "file_label";
            this.file_label.Size = new System.Drawing.Size(263, 46);
            this.file_label.TabIndex = 0;
            this.file_label.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // path_panel
            // 
            this.path_panel.Anchor = ((System.Windows.Forms.AnchorStyles) ((((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) | System.Windows.Forms.AnchorStyles.Left) | System.Windows.Forms.AnchorStyles.Right)));
            this.path_panel.AutoScroll = true;
            this.path_panel.Controls.Add(this.path_label);
            this.path_panel.Location = new System.Drawing.Point(0, 0);
            this.path_panel.Margin = new System.Windows.Forms.Padding(4);
            this.path_panel.Name = "path_panel";
            this.path_panel.Size = new System.Drawing.Size(424, 46);
            this.path_panel.TabIndex = 0;
            // 
            // path_label
            // 
            this.path_label.AutoEllipsis = true;
            this.path_label.Dock = System.Windows.Forms.DockStyle.Fill;
            this.path_label.Location = new System.Drawing.Point(0, 0);
            this.path_label.Margin = new System.Windows.Forms.Padding(13, 0, 7, 0);
            this.path_label.Name = "path_label";
            this.path_label.Size = new System.Drawing.Size(424, 46);
            this.path_label.TabIndex = 0;
            this.path_label.Text = "Путь";
            this.path_label.TextAlign = System.Drawing.ContentAlignment.MiddleLeft;
            // 
            // timer
            // 
            this.timer.Enabled = true;
            this.timer.Interval = 1000;
            this.timer.Tick += new System.EventHandler(this.timer_Tick);
            // 
            // FormMain
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.AntiqueWhite;
            this.ClientSize = new System.Drawing.Size(1067, 623);
            this.Controls.Add(this.panel1);
            this.Controls.Add(this.panel_main);
            this.Controls.Add(this.panel_top);
            this.Location = new System.Drawing.Point(15, 15);
            this.Margin = new System.Windows.Forms.Padding(4);
            this.MinimumSize = new System.Drawing.Size(1082, 661);
            this.Name = "FormMain";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Лабораторная работа #4";
            this.WindowState = System.Windows.Forms.FormWindowState.Maximized;
            this.Load += new System.EventHandler(this.FormMain_Load);
            this.panel_top.ResumeLayout(false);
            this.panel_top.PerformLayout();
            this.panel_main.ResumeLayout(false);
            this.splitContainer1.Panel1.ResumeLayout(false);
            this.splitContainer1.Panel2.ResumeLayout(false);
            ((System.ComponentModel.ISupportInitialize) (this.splitContainer1)).EndInit();
            this.splitContainer1.ResumeLayout(false);
            ((System.ComponentModel.ISupportInitialize) (this.pictureBox)).EndInit();
            this.panel1.ResumeLayout(false);
            this.panel3.ResumeLayout(false);
            this.panel2.ResumeLayout(false);
            this.path_panel.ResumeLayout(false);
            this.ResumeLayout(false);
        }

        private System.Windows.Forms.CheckBox checkBox1;
        private Microsoft.VisualBasic.Compatibility.VB6.DirListBox dirListBox;
        private Microsoft.VisualBasic.Compatibility.VB6.DriveListBox driveListBox;
        private System.Windows.Forms.Label file_label;
        private Microsoft.VisualBasic.Compatibility.VB6.FileListBox fileListBox;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Panel panel_main;
        private System.Windows.Forms.Panel panel_top;
        private System.Windows.Forms.Panel panel1;
        private System.Windows.Forms.Panel panel2;
        private System.Windows.Forms.Panel panel3;
        private System.Windows.Forms.Label path_label;
        private System.Windows.Forms.Panel path_panel;
        private System.Windows.Forms.PictureBox pictureBox;
        private System.Windows.Forms.SplitContainer splitContainer1;
        private System.Windows.Forms.Label time_label;
        private System.Windows.Forms.Timer timer;
        private System.Windows.Forms.ComboBox type_comboBox;

        #endregion
    }
}