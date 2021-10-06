namespace laboratoryWork_1
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
            System.Windows.Forms.DataGridViewCellStyle dataGridViewCellStyle1 =
                new System.Windows.Forms.DataGridViewCellStyle();
            System.Windows.Forms.DataGridViewCellStyle dataGridViewCellStyle2 =
                new System.Windows.Forms.DataGridViewCellStyle();
            this.startButton = new System.Windows.Forms.Button();
            this.maxButton = new System.Windows.Forms.Button();
            this.numericUpDownN = new System.Windows.Forms.NumericUpDown();
            this.numericUpDownM = new System.Windows.Forms.NumericUpDown();
            this.label1 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.dataGridViewMatrix = new System.Windows.Forms.DataGridView();
            this.dataGridViewRes = new System.Windows.Forms.DataGridView();
            this.label3 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.menuStrip1 = new System.Windows.Forms.MenuStrip();
            this.startToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.maxToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.sizeToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.aboutToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.panel1 = new System.Windows.Forms.Panel();
            this.panel2 = new System.Windows.Forms.Panel();
            ((System.ComponentModel.ISupportInitialize) (this.numericUpDownN)).BeginInit();
            ((System.ComponentModel.ISupportInitialize) (this.numericUpDownM)).BeginInit();
            ((System.ComponentModel.ISupportInitialize) (this.dataGridViewMatrix)).BeginInit();
            ((System.ComponentModel.ISupportInitialize) (this.dataGridViewRes)).BeginInit();
            this.menuStrip1.SuspendLayout();
            this.panel2.SuspendLayout();
            this.SuspendLayout();
            // 
            // startButton
            // 
            this.startButton.Cursor = System.Windows.Forms.Cursors.Hand;
            this.startButton.Location = new System.Drawing.Point(490, 27);
            this.startButton.Name = "startButton";
            this.startButton.Size = new System.Drawing.Size(85, 28);
            this.startButton.TabIndex = 0;
            this.startButton.Text = "Start";
            this.startButton.UseVisualStyleBackColor = true;
            this.startButton.Click += new System.EventHandler(this.startButton_Click);
            // 
            // maxButton
            // 
            this.maxButton.Cursor = System.Windows.Forms.Cursors.Hand;
            this.maxButton.Enabled = false;
            this.maxButton.Location = new System.Drawing.Point(490, 57);
            this.maxButton.Name = "maxButton";
            this.maxButton.Size = new System.Drawing.Size(85, 28);
            this.maxButton.TabIndex = 3;
            this.maxButton.Text = "Max";
            this.maxButton.UseVisualStyleBackColor = true;
            this.maxButton.Click += new System.EventHandler(this.maxButton_Click);
            // 
            // numericUpDownN
            // 
            this.numericUpDownN.Location = new System.Drawing.Point(185, 43);
            this.numericUpDownN.Name = "numericUpDownN";
            this.numericUpDownN.Size = new System.Drawing.Size(120, 23);
            this.numericUpDownN.TabIndex = 4;
            this.numericUpDownN.Value = new decimal(new int[] {12, 0, 0, 0});
            // 
            // numericUpDownM
            // 
            this.numericUpDownM.Location = new System.Drawing.Point(350, 43);
            this.numericUpDownM.Name = "numericUpDownM";
            this.numericUpDownM.Size = new System.Drawing.Size(120, 23);
            this.numericUpDownM.TabIndex = 5;
            this.numericUpDownM.Value = new decimal(new int[] {12, 0, 0, 0});
            // 
            // label1
            // 
            this.label1.Location = new System.Drawing.Point(154, 43);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(24, 23);
            this.label1.TabIndex = 6;
            this.label1.Text = "N:";
            this.label1.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // label2
            // 
            this.label2.Location = new System.Drawing.Point(318, 43);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(24, 23);
            this.label2.TabIndex = 7;
            this.label2.Text = "M:";
            this.label2.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // dataGridViewMatrix
            // 
            this.dataGridViewMatrix.AllowUserToAddRows = false;
            this.dataGridViewMatrix.AllowUserToDeleteRows = false;
            this.dataGridViewMatrix.AllowUserToResizeColumns = false;
            this.dataGridViewMatrix.AllowUserToResizeRows = false;
            this.dataGridViewMatrix.AutoSizeColumnsMode = System.Windows.Forms.DataGridViewAutoSizeColumnsMode.AllCells;
            this.dataGridViewMatrix.AutoSizeRowsMode = System.Windows.Forms.DataGridViewAutoSizeRowsMode.AllCells;
            this.dataGridViewMatrix.BackgroundColor = System.Drawing.Color.Moccasin;
            this.dataGridViewMatrix.BorderStyle = System.Windows.Forms.BorderStyle.None;
            this.dataGridViewMatrix.ClipboardCopyMode = System.Windows.Forms.DataGridViewClipboardCopyMode.Disable;
            this.dataGridViewMatrix.ColumnHeadersHeightSizeMode =
                System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dataGridViewMatrix.ColumnHeadersVisible = false;
            dataGridViewCellStyle1.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleLeft;
            dataGridViewCellStyle1.BackColor = System.Drawing.SystemColors.Window;
            dataGridViewCellStyle1.Font = new System.Drawing.Font("Segoe UI", 9F);
            dataGridViewCellStyle1.ForeColor = System.Drawing.Color.FromArgb(((int) (((byte) (0)))),
                ((int) (((byte) (0)))), ((int) (((byte) (0)))));
            dataGridViewCellStyle1.Format = "N0";
            dataGridViewCellStyle1.NullValue = null;
            dataGridViewCellStyle1.Padding = new System.Windows.Forms.Padding(3);
            dataGridViewCellStyle1.SelectionBackColor = System.Drawing.SystemColors.Window;
            dataGridViewCellStyle1.SelectionForeColor = System.Drawing.Color.Black;
            dataGridViewCellStyle1.WrapMode = System.Windows.Forms.DataGridViewTriState.False;
            this.dataGridViewMatrix.DefaultCellStyle = dataGridViewCellStyle1;
            this.dataGridViewMatrix.ImeMode = System.Windows.Forms.ImeMode.Off;
            this.dataGridViewMatrix.Location = new System.Drawing.Point(71, 132);
            this.dataGridViewMatrix.MultiSelect = false;
            this.dataGridViewMatrix.Name = "dataGridViewMatrix";
            this.dataGridViewMatrix.ReadOnly = true;
            this.dataGridViewMatrix.RowHeadersVisible = false;
            this.dataGridViewMatrix.RowHeadersWidthSizeMode =
                System.Windows.Forms.DataGridViewRowHeadersWidthSizeMode.DisableResizing;
            this.dataGridViewMatrix.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.CellSelect;
            this.dataGridViewMatrix.ShowCellErrors = false;
            this.dataGridViewMatrix.ShowCellToolTips = false;
            this.dataGridViewMatrix.ShowEditingIcon = false;
            this.dataGridViewMatrix.ShowRowErrors = false;
            this.dataGridViewMatrix.Size = new System.Drawing.Size(531, 362);
            this.dataGridViewMatrix.TabIndex = 8;
            this.dataGridViewMatrix.TabStop = false;
            this.dataGridViewMatrix.SelectionChanged +=
                new System.EventHandler(this.dataGridViewMatrix_SelectionChanged);
            // 
            // dataGridViewRes
            // 
            this.dataGridViewRes.AllowUserToAddRows = false;
            this.dataGridViewRes.AllowUserToDeleteRows = false;
            this.dataGridViewRes.AllowUserToResizeColumns = false;
            this.dataGridViewRes.AllowUserToResizeRows = false;
            this.dataGridViewRes.AutoSizeColumnsMode = System.Windows.Forms.DataGridViewAutoSizeColumnsMode.AllCells;
            this.dataGridViewRes.AutoSizeRowsMode = System.Windows.Forms.DataGridViewAutoSizeRowsMode.AllCells;
            this.dataGridViewRes.BackgroundColor = System.Drawing.Color.Moccasin;
            this.dataGridViewRes.BorderStyle = System.Windows.Forms.BorderStyle.None;
            this.dataGridViewRes.ClipboardCopyMode = System.Windows.Forms.DataGridViewClipboardCopyMode.Disable;
            this.dataGridViewRes.ColumnHeadersHeightSizeMode =
                System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dataGridViewRes.ColumnHeadersVisible = false;
            dataGridViewCellStyle2.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleLeft;
            dataGridViewCellStyle2.BackColor = System.Drawing.SystemColors.Window;
            dataGridViewCellStyle2.Font = new System.Drawing.Font("Segoe UI", 9F);
            dataGridViewCellStyle2.ForeColor = System.Drawing.Color.FromArgb(((int) (((byte) (0)))),
                ((int) (((byte) (0)))), ((int) (((byte) (0)))));
            dataGridViewCellStyle2.Format = "N0";
            dataGridViewCellStyle2.NullValue = null;
            dataGridViewCellStyle2.Padding = new System.Windows.Forms.Padding(3);
            dataGridViewCellStyle2.SelectionBackColor = System.Drawing.SystemColors.Window;
            dataGridViewCellStyle2.SelectionForeColor = System.Drawing.Color.Black;
            dataGridViewCellStyle2.WrapMode = System.Windows.Forms.DataGridViewTriState.False;
            this.dataGridViewRes.DefaultCellStyle = dataGridViewCellStyle2;
            this.dataGridViewRes.ImeMode = System.Windows.Forms.ImeMode.Off;
            this.dataGridViewRes.Location = new System.Drawing.Point(15, 15);
            this.dataGridViewRes.MultiSelect = false;
            this.dataGridViewRes.Name = "dataGridViewRes";
            this.dataGridViewRes.ReadOnly = true;
            this.dataGridViewRes.RowHeadersVisible = false;
            this.dataGridViewRes.RowHeadersWidthSizeMode =
                System.Windows.Forms.DataGridViewRowHeadersWidthSizeMode.DisableResizing;
            this.dataGridViewRes.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.CellSelect;
            this.dataGridViewRes.ShowCellErrors = false;
            this.dataGridViewRes.ShowCellToolTips = false;
            this.dataGridViewRes.ShowEditingIcon = false;
            this.dataGridViewRes.ShowRowErrors = false;
            this.dataGridViewRes.Size = new System.Drawing.Size(192, 362);
            this.dataGridViewRes.TabIndex = 9;
            this.dataGridViewRes.TabStop = false;
            this.dataGridViewRes.SelectionChanged += new System.EventHandler(this.dataGridViewRes_SelectionChanged);
            // 
            // label3
            // 
            this.label3.Location = new System.Drawing.Point(56, 91);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(153, 23);
            this.label3.TabIndex = 10;
            this.label3.Text = "Исходная матрица:";
            // 
            // label4
            // 
            this.label4.Location = new System.Drawing.Point(673, 91);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(223, 23);
            this.label4.TabIndex = 11;
            this.label4.Text = "Массив наибольших чисел в строке: ";
            // 
            // menuStrip1
            // 
            this.menuStrip1.Items.AddRange(new System.Windows.Forms.ToolStripItem[]
            {
                this.startToolStripMenuItem, this.maxToolStripMenuItem, this.sizeToolStripMenuItem,
                this.aboutToolStripMenuItem
            });
            this.menuStrip1.Location = new System.Drawing.Point(0, 0);
            this.menuStrip1.Name = "menuStrip1";
            this.menuStrip1.Size = new System.Drawing.Size(934, 24);
            this.menuStrip1.TabIndex = 12;
            this.menuStrip1.Text = "menuStrip1";
            // 
            // startToolStripMenuItem
            // 
            this.startToolStripMenuItem.Name = "startToolStripMenuItem";
            this.startToolStripMenuItem.Size = new System.Drawing.Size(43, 20);
            this.startToolStripMenuItem.Text = "Start";
            this.startToolStripMenuItem.Click += new System.EventHandler(this.startToolStripMenuItem_Click);
            // 
            // maxToolStripMenuItem
            // 
            this.maxToolStripMenuItem.Enabled = false;
            this.maxToolStripMenuItem.Name = "maxToolStripMenuItem";
            this.maxToolStripMenuItem.Size = new System.Drawing.Size(41, 20);
            this.maxToolStripMenuItem.Text = "Max";
            this.maxToolStripMenuItem.Click += new System.EventHandler(this.maxToolStripMenuItem_Click);
            // 
            // sizeToolStripMenuItem
            // 
            this.sizeToolStripMenuItem.Name = "sizeToolStripMenuItem";
            this.sizeToolStripMenuItem.Size = new System.Drawing.Size(39, 20);
            this.sizeToolStripMenuItem.Text = "Size";
            this.sizeToolStripMenuItem.Click += new System.EventHandler(this.sizeToolStripMenuItem_Click);
            // 
            // aboutToolStripMenuItem
            // 
            this.aboutToolStripMenuItem.Name = "aboutToolStripMenuItem";
            this.aboutToolStripMenuItem.Size = new System.Drawing.Size(52, 20);
            this.aboutToolStripMenuItem.Text = "About";
            this.aboutToolStripMenuItem.Click += new System.EventHandler(this.aboutToolStripMenuItem_Click);
            // 
            // panel1
            // 
            this.panel1.AutoSize = true;
            this.panel1.BackColor = System.Drawing.Color.Moccasin;
            this.panel1.Location = new System.Drawing.Point(56, 117);
            this.panel1.Name = "panel1";
            this.panel1.Size = new System.Drawing.Size(562, 393);
            this.panel1.TabIndex = 13;
            // 
            // panel2
            // 
            this.panel2.AutoSize = true;
            this.panel2.BackColor = System.Drawing.Color.Moccasin;
            this.panel2.Controls.Add(this.dataGridViewRes);
            this.panel2.Location = new System.Drawing.Point(673, 117);
            this.panel2.Name = "panel2";
            this.panel2.Size = new System.Drawing.Size(223, 393);
            this.panel2.TabIndex = 14;
            // 
            // Form1
            // 
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.None;
            this.BackColor = System.Drawing.Color.PapayaWhip;
            this.BackgroundImageLayout = System.Windows.Forms.ImageLayout.None;
            this.ClientSize = new System.Drawing.Size(934, 522);
            this.Controls.Add(this.panel2);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.dataGridViewMatrix);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.numericUpDownM);
            this.Controls.Add(this.numericUpDownN);
            this.Controls.Add(this.maxButton);
            this.Controls.Add(this.startButton);
            this.Controls.Add(this.menuStrip1);
            this.Controls.Add(this.panel1);
            this.MainMenuStrip = this.menuStrip1;
            this.MaximizeBox = false;
            this.MaximumSize = new System.Drawing.Size(950, 561);
            this.MinimumSize = new System.Drawing.Size(950, 561);
            this.Name = "FormMain";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Лабораторная работа #1";
            ((System.ComponentModel.ISupportInitialize) (this.numericUpDownN)).EndInit();
            ((System.ComponentModel.ISupportInitialize) (this.numericUpDownM)).EndInit();
            ((System.ComponentModel.ISupportInitialize) (this.dataGridViewMatrix)).EndInit();
            ((System.ComponentModel.ISupportInitialize) (this.dataGridViewRes)).EndInit();
            this.menuStrip1.ResumeLayout(false);
            this.menuStrip1.PerformLayout();
            this.panel2.ResumeLayout(false);
            this.ResumeLayout(false);
            this.PerformLayout();
        }

        #endregion

        private System.Windows.Forms.Button startButton;
        private System.Windows.Forms.Button maxButton;
        private System.Windows.Forms.NumericUpDown numericUpDownM;
        private System.Windows.Forms.NumericUpDown numericUpDownN;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.DataGridView dataGridViewMatrix;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.DataGridView dataGridViewRes;
        private System.Windows.Forms.MenuStrip menuStrip1;
        private System.Windows.Forms.ToolStripMenuItem aboutToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem sizeToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem maxToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem startToolStripMenuItem;
        private System.Windows.Forms.Panel panel1;
        private System.Windows.Forms.Panel panel2;
    }
}