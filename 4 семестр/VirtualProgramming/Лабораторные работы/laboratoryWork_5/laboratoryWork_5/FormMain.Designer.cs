namespace laboratoryWork_5
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
            this.pictureBox = new System.Windows.Forms.PictureBox();
            this.labelInfo = new System.Windows.Forms.Label();
            this.labelForm = new System.Windows.Forms.Label();
            this.labelView = new System.Windows.Forms.Label();
            ((System.ComponentModel.ISupportInitialize) (this.pictureBox)).BeginInit();
            this.SuspendLayout();
            // 
            // pictureBox
            // 
            this.pictureBox.Dock = System.Windows.Forms.DockStyle.Fill;
            this.pictureBox.Location = new System.Drawing.Point(0, 0);
            this.pictureBox.Name = "pictureBox";
            this.pictureBox.Size = new System.Drawing.Size(809, 451);
            this.pictureBox.TabIndex = 0;
            this.pictureBox.TabStop = false;
            this.pictureBox.Paint += new System.Windows.Forms.PaintEventHandler(this.pictureBox_Paint);
            this.pictureBox.MouseDown += new System.Windows.Forms.MouseEventHandler(this.pictureBox_MouseDown);
            this.pictureBox.MouseMove += new System.Windows.Forms.MouseEventHandler(this.pictureBox_MouseMove);
            this.pictureBox.MouseUp += new System.Windows.Forms.MouseEventHandler(this.pictureBox_MouseUp);
            // 
            // labelInfo
            // 
            this.labelInfo.Anchor = ((System.Windows.Forms.AnchorStyles) ((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Right)));
            this.labelInfo.BackColor = System.Drawing.SystemColors.InactiveCaption;
            this.labelInfo.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.labelInfo.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte) (204)));
            this.labelInfo.Location = new System.Drawing.Point(528, 304);
            this.labelInfo.Name = "labelInfo";
            this.labelInfo.Padding = new System.Windows.Forms.Padding(30, 20, 30, 20);
            this.labelInfo.Size = new System.Drawing.Size(234, 120);
            this.labelInfo.TabIndex = 6;
            this.labelInfo.Text = "Информация";
            this.labelInfo.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // labelForm
            // 
            this.labelForm.Anchor = System.Windows.Forms.AnchorStyles.Bottom;
            this.labelForm.BackColor = System.Drawing.Color.AntiqueWhite;
            this.labelForm.BorderStyle = System.Windows.Forms.BorderStyle.Fixed3D;
            this.labelForm.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.labelForm.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte) (204)));
            this.labelForm.Location = new System.Drawing.Point(312, 332);
            this.labelForm.Name = "labelForm";
            this.labelForm.Padding = new System.Windows.Forms.Padding(30, 20, 30, 20);
            this.labelForm.Size = new System.Drawing.Size(121, 64);
            this.labelForm.TabIndex = 5;
            this.labelForm.Text = "Форма";
            this.labelForm.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // labelView
            // 
            this.labelView.Anchor = ((System.Windows.Forms.AnchorStyles) ((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.labelView.BackColor = System.Drawing.Color.AntiqueWhite;
            this.labelView.BorderStyle = System.Windows.Forms.BorderStyle.Fixed3D;
            this.labelView.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.labelView.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte) (204)));
            this.labelView.Location = new System.Drawing.Point(94, 332);
            this.labelView.Name = "labelView";
            this.labelView.Padding = new System.Windows.Forms.Padding(30, 20, 30, 20);
            this.labelView.Size = new System.Drawing.Size(121, 64);
            this.labelView.TabIndex = 4;
            this.labelView.Text = "Вид";
            this.labelView.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // FormMain
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.AntiqueWhite;
            this.ClientSize = new System.Drawing.Size(809, 451);
            this.Controls.Add(this.labelInfo);
            this.Controls.Add(this.labelForm);
            this.Controls.Add(this.labelView);
            this.Controls.Add(this.pictureBox);
            this.MinimumSize = new System.Drawing.Size(825, 490);
            this.Name = "FormMain";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Лабораторная работа #5";
            ((System.ComponentModel.ISupportInitialize) (this.pictureBox)).EndInit();
            this.ResumeLayout(false);
        }

        private System.Windows.Forms.Label labelForm;
        private System.Windows.Forms.Label labelInfo;
        private System.Windows.Forms.Label labelView;
        private System.Windows.Forms.PictureBox pictureBox;

        #endregion
    }
}