namespace RGR
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
            this.btnAdd = new System.Windows.Forms.Button();
            this.buttonView = new System.Windows.Forms.Button();
            this.btnPrint = new System.Windows.Forms.Button();
            this.panelMain = new System.Windows.Forms.Panel();
            this.panelControl = new System.Windows.Forms.Panel();
            this.btnBack = new System.Windows.Forms.Button();
            this.btnUserDel = new System.Windows.Forms.Button();
            this.btnUserAdd = new System.Windows.Forms.Button();
            this.btnFilmReceive = new System.Windows.Forms.Button();
            this.btnFilmGive = new System.Windows.Forms.Button();
            this.btnFilmDel = new System.Windows.Forms.Button();
            this.btnFilmAdd = new System.Windows.Forms.Button();
            this.label2 = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.panelMain.SuspendLayout();
            this.panelControl.SuspendLayout();
            this.SuspendLayout();
            // 
            // btnAdd
            // 
            this.btnAdd.Anchor = ((System.Windows.Forms.AnchorStyles)(((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.btnAdd.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnAdd.Font = new System.Drawing.Font("Bad Script", 25.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.btnAdd.ForeColor = System.Drawing.Color.Black;
            this.btnAdd.Location = new System.Drawing.Point(70, 44);
            this.btnAdd.Name = "btnAdd";
            this.btnAdd.Size = new System.Drawing.Size(445, 119);
            this.btnAdd.TabIndex = 0;
            this.btnAdd.Text = "Управление";
            this.btnAdd.UseVisualStyleBackColor = true;
            this.btnAdd.Click += new System.EventHandler(this.btnAdd_Click);
            // 
            // buttonView
            // 
            this.buttonView.Anchor = ((System.Windows.Forms.AnchorStyles)(((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.buttonView.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.buttonView.Font = new System.Drawing.Font("Bad Script", 25.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonView.ForeColor = System.Drawing.Color.Black;
            this.buttonView.Location = new System.Drawing.Point(70, 199);
            this.buttonView.Name = "buttonView";
            this.buttonView.Size = new System.Drawing.Size(445, 119);
            this.buttonView.TabIndex = 1;
            this.buttonView.Text = "Просмотр";
            this.buttonView.UseVisualStyleBackColor = true;
            this.buttonView.Click += new System.EventHandler(this.buttonView_Click);
            // 
            // btnPrint
            // 
            this.btnPrint.Anchor = ((System.Windows.Forms.AnchorStyles)(((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.btnPrint.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnPrint.Font = new System.Drawing.Font("Bad Script", 25.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.btnPrint.ForeColor = System.Drawing.Color.Black;
            this.btnPrint.Location = new System.Drawing.Point(70, 351);
            this.btnPrint.Name = "btnPrint";
            this.btnPrint.Size = new System.Drawing.Size(445, 119);
            this.btnPrint.TabIndex = 2;
            this.btnPrint.Text = "Печать";
            this.btnPrint.UseVisualStyleBackColor = true;
            // 
            // panelMain
            // 
            this.panelMain.Controls.Add(this.btnPrint);
            this.panelMain.Controls.Add(this.buttonView);
            this.panelMain.Controls.Add(this.btnAdd);
            this.panelMain.Location = new System.Drawing.Point(12, 65);
            this.panelMain.Name = "panelMain";
            this.panelMain.Size = new System.Drawing.Size(582, 643);
            this.panelMain.TabIndex = 3;
            // 
            // panelControl
            // 
            this.panelControl.BackColor = System.Drawing.Color.PapayaWhip;
            this.panelControl.Controls.Add(this.btnBack);
            this.panelControl.Controls.Add(this.btnUserDel);
            this.panelControl.Controls.Add(this.btnUserAdd);
            this.panelControl.Controls.Add(this.btnFilmReceive);
            this.panelControl.Controls.Add(this.btnFilmGive);
            this.panelControl.Controls.Add(this.btnFilmDel);
            this.panelControl.Controls.Add(this.btnFilmAdd);
            this.panelControl.Controls.Add(this.label2);
            this.panelControl.Controls.Add(this.label1);
            this.panelControl.Location = new System.Drawing.Point(231, 21);
            this.panelControl.Name = "panelControl";
            this.panelControl.Size = new System.Drawing.Size(582, 643);
            this.panelControl.TabIndex = 4;
            this.panelControl.Visible = false;
            // 
            // btnBack
            // 
            this.btnBack.BackColor = System.Drawing.Color.Crimson;
            this.btnBack.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnBack.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.btnBack.ForeColor = System.Drawing.SystemColors.ButtonHighlight;
            this.btnBack.Location = new System.Drawing.Point(186, 528);
            this.btnBack.Name = "btnBack";
            this.btnBack.Size = new System.Drawing.Size(214, 79);
            this.btnBack.TabIndex = 11;
            this.btnBack.Text = "⬅ Назад";
            this.btnBack.UseVisualStyleBackColor = false;
            this.btnBack.Click += new System.EventHandler(this.btnBack_Click);
            // 
            // btnUserDel
            // 
            this.btnUserDel.BackColor = System.Drawing.Color.LightSalmon;
            this.btnUserDel.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnUserDel.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.btnUserDel.Location = new System.Drawing.Point(308, 403);
            this.btnUserDel.Name = "btnUserDel";
            this.btnUserDel.Size = new System.Drawing.Size(214, 79);
            this.btnUserDel.TabIndex = 10;
            this.btnUserDel.Text = "Удалить пользователя";
            this.btnUserDel.UseVisualStyleBackColor = false;
            // 
            // btnUserAdd
            // 
            this.btnUserAdd.BackColor = System.Drawing.Color.SpringGreen;
            this.btnUserAdd.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnUserAdd.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.btnUserAdd.Location = new System.Drawing.Point(58, 403);
            this.btnUserAdd.Name = "btnUserAdd";
            this.btnUserAdd.Size = new System.Drawing.Size(214, 79);
            this.btnUserAdd.TabIndex = 9;
            this.btnUserAdd.Text = "Добавить пользователя";
            this.btnUserAdd.UseVisualStyleBackColor = false;
            // 
            // btnFilmReceive
            // 
            this.btnFilmReceive.BackColor = System.Drawing.Color.LightCyan;
            this.btnFilmReceive.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnFilmReceive.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.btnFilmReceive.Location = new System.Drawing.Point(308, 160);
            this.btnFilmReceive.Name = "btnFilmReceive";
            this.btnFilmReceive.Size = new System.Drawing.Size(214, 80);
            this.btnFilmReceive.TabIndex = 8;
            this.btnFilmReceive.Text = "Принять фильм";
            this.btnFilmReceive.UseVisualStyleBackColor = false;
            // 
            // btnFilmGive
            // 
            this.btnFilmGive.BackColor = System.Drawing.Color.LightBlue;
            this.btnFilmGive.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnFilmGive.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.btnFilmGive.Location = new System.Drawing.Point(58, 160);
            this.btnFilmGive.Name = "btnFilmGive";
            this.btnFilmGive.Size = new System.Drawing.Size(214, 80);
            this.btnFilmGive.TabIndex = 7;
            this.btnFilmGive.Text = "Отдать фильм";
            this.btnFilmGive.UseVisualStyleBackColor = false;
            // 
            // btnFilmDel
            // 
            this.btnFilmDel.BackColor = System.Drawing.Color.LightSalmon;
            this.btnFilmDel.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnFilmDel.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.btnFilmDel.Location = new System.Drawing.Point(308, 51);
            this.btnFilmDel.Name = "btnFilmDel";
            this.btnFilmDel.Size = new System.Drawing.Size(214, 80);
            this.btnFilmDel.TabIndex = 6;
            this.btnFilmDel.Text = "Удалить фильм";
            this.btnFilmDel.UseVisualStyleBackColor = false;
            // 
            // btnFilmAdd
            // 
            this.btnFilmAdd.BackColor = System.Drawing.Color.SpringGreen;
            this.btnFilmAdd.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnFilmAdd.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.btnFilmAdd.Location = new System.Drawing.Point(58, 51);
            this.btnFilmAdd.Name = "btnFilmAdd";
            this.btnFilmAdd.Size = new System.Drawing.Size(214, 80);
            this.btnFilmAdd.TabIndex = 5;
            this.btnFilmAdd.Text = "Добавить фильм";
            this.btnFilmAdd.UseVisualStyleBackColor = false;
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label2.Location = new System.Drawing.Point(21, 314);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(142, 29);
            this.label2.TabIndex = 4;
            this.label2.Text = "Пользователи";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label1.Location = new System.Drawing.Point(21, 9);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(92, 29);
            this.label1.TabIndex = 3;
            this.label1.Text = "Фильмы";
            // 
            // FormMain
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.PeachPuff;
            this.ClientSize = new System.Drawing.Size(600, 685);
            this.Controls.Add(this.panelControl);
            this.Controls.Add(this.panelMain);
            this.MaximizeBox = false;
            this.MaximumSize = new System.Drawing.Size(600, 685);
            this.MinimumSize = new System.Drawing.Size(600, 685);
            this.Name = "FormMain";
            this.SizeGripStyle = System.Windows.Forms.SizeGripStyle.Hide;
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Расчетно-графическая работа  |  Видеотека";
            this.panelMain.ResumeLayout(false);
            this.panelControl.ResumeLayout(false);
            this.panelControl.PerformLayout();
            this.ResumeLayout(false);

        }

        #endregion

        protected internal System.Windows.Forms.Button btnAdd;
        protected internal System.Windows.Forms.Button buttonView;
        protected internal System.Windows.Forms.Button btnPrint;
        private System.Windows.Forms.Panel panelMain;
        private System.Windows.Forms.Panel panelControl;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Button btnBack;
        private System.Windows.Forms.Button btnUserDel;
        private System.Windows.Forms.Button btnUserAdd;
        private System.Windows.Forms.Button btnFilmReceive;
        private System.Windows.Forms.Button btnFilmGive;
        private System.Windows.Forms.Button btnFilmDel;
        private System.Windows.Forms.Button btnFilmAdd;
    }
}