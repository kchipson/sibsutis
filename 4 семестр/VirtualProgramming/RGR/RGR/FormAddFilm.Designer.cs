namespace RGR
{
    partial class FormAddFilm
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
            this.textBoxAnnotation = new System.Windows.Forms.TextBox();
            this.textBoxActors = new System.Windows.Forms.TextBox();
            this.textBoxGenre = new System.Windows.Forms.TextBox();
            this.textBoxCountry = new System.Windows.Forms.TextBox();
            this.textBoxProducer = new System.Windows.Forms.TextBox();
            this.textBoxYear = new System.Windows.Forms.TextBox();
            this.label8 = new System.Windows.Forms.Label();
            this.label7 = new System.Windows.Forms.Label();
            this.label6 = new System.Windows.Forms.Label();
            this.label5 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.textBoxName = new System.Windows.Forms.TextBox();
            this.label2 = new System.Windows.Forms.Label();
            this.buttonAddFilm = new System.Windows.Forms.Button();
            this.фильмыTableAdapter = new RGR.DatabaseDataSetTableAdapters.ФильмыTableAdapter();
            this.SuspendLayout();
            // 
            // textBoxAnnotation
            // 
            this.textBoxAnnotation.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxAnnotation.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxAnnotation.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxAnnotation.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxAnnotation.Location = new System.Drawing.Point(32, 284);
            this.textBoxAnnotation.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxAnnotation.Multiline = true;
            this.textBoxAnnotation.Name = "textBoxAnnotation";
            this.textBoxAnnotation.Size = new System.Drawing.Size(542, 290);
            this.textBoxAnnotation.TabIndex = 48;
            // 
            // textBoxActors
            // 
            this.textBoxActors.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxActors.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxActors.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxActors.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxActors.Location = new System.Drawing.Point(595, 284);
            this.textBoxActors.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxActors.Multiline = true;
            this.textBoxActors.Name = "textBoxActors";
            this.textBoxActors.Size = new System.Drawing.Size(263, 127);
            this.textBoxActors.TabIndex = 47;
            // 
            // textBoxGenre
            // 
            this.textBoxGenre.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxGenre.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxGenre.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxGenre.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxGenre.Location = new System.Drawing.Point(32, 171);
            this.textBoxGenre.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxGenre.MaxLength = 255;
            this.textBoxGenre.Name = "textBoxGenre";
            this.textBoxGenre.Size = new System.Drawing.Size(263, 36);
            this.textBoxGenre.TabIndex = 46;
            // 
            // textBoxCountry
            // 
            this.textBoxCountry.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxCountry.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxCountry.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxCountry.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxCountry.Location = new System.Drawing.Point(379, 171);
            this.textBoxCountry.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxCountry.MaxLength = 255;
            this.textBoxCountry.Name = "textBoxCountry";
            this.textBoxCountry.Size = new System.Drawing.Size(195, 36);
            this.textBoxCountry.TabIndex = 45;
            // 
            // textBoxProducer
            // 
            this.textBoxProducer.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxProducer.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxProducer.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxProducer.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxProducer.Location = new System.Drawing.Point(543, 70);
            this.textBoxProducer.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxProducer.MaxLength = 255;
            this.textBoxProducer.Name = "textBoxProducer";
            this.textBoxProducer.Size = new System.Drawing.Size(315, 36);
            this.textBoxProducer.TabIndex = 44;
            // 
            // textBoxYear
            // 
            this.textBoxYear.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxYear.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxYear.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxYear.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxYear.Location = new System.Drawing.Point(663, 171);
            this.textBoxYear.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxYear.MaxLength = 255;
            this.textBoxYear.Name = "textBoxYear";
            this.textBoxYear.Size = new System.Drawing.Size(195, 36);
            this.textBoxYear.TabIndex = 43;
            // 
            // label8
            // 
            this.label8.AutoSize = true;
            this.label8.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label8.Location = new System.Drawing.Point(27, 240);
            this.label8.Name = "label8";
            this.label8.Size = new System.Drawing.Size(198, 29);
            this.label8.TabIndex = 42;
            this.label8.Text = "Краткая аннотация";
            // 
            // label7
            // 
            this.label7.AutoSize = true;
            this.label7.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label7.Location = new System.Drawing.Point(590, 240);
            this.label7.Name = "label7";
            this.label7.Size = new System.Drawing.Size(85, 29);
            this.label7.TabIndex = 41;
            this.label7.Text = "Актеры";
            // 
            // label6
            // 
            this.label6.AutoSize = true;
            this.label6.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label6.Location = new System.Drawing.Point(538, 25);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(106, 29);
            this.label6.TabIndex = 40;
            this.label6.Text = "Режиссер";
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label5.Location = new System.Drawing.Point(374, 133);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(80, 29);
            this.label5.TabIndex = 39;
            this.label5.Text = "Страна";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label4.Location = new System.Drawing.Point(658, 128);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(48, 29);
            this.label4.TabIndex = 38;
            this.label4.Text = "Год";
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label3.Location = new System.Drawing.Point(27, 133);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(67, 29);
            this.label3.TabIndex = 37;
            this.label3.Text = "Жанр";
            // 
            // textBoxName
            // 
            this.textBoxName.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxName.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxName.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxName.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxName.Location = new System.Drawing.Point(32, 70);
            this.textBoxName.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxName.MaxLength = 255;
            this.textBoxName.Name = "textBoxName";
            this.textBoxName.Size = new System.Drawing.Size(438, 36);
            this.textBoxName.TabIndex = 36;
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label2.Location = new System.Drawing.Point(27, 25);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(99, 29);
            this.label2.TabIndex = 35;
            this.label2.Text = "Название";
            // 
            // buttonAddFilm
            // 
            this.buttonAddFilm.BackColor = System.Drawing.Color.PaleGreen;
            this.buttonAddFilm.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonAddFilm.Font = new System.Drawing.Font("Neucha", 19.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonAddFilm.Location = new System.Drawing.Point(595, 451);
            this.buttonAddFilm.Name = "buttonAddFilm";
            this.buttonAddFilm.Size = new System.Drawing.Size(263, 123);
            this.buttonAddFilm.TabIndex = 49;
            this.buttonAddFilm.Text = "Добавить";
            this.buttonAddFilm.UseVisualStyleBackColor = false;
            this.buttonAddFilm.Click += new System.EventHandler(this.buttonAddUser_Click);
            // 
            // фильмыTableAdapter
            // 
            this.фильмыTableAdapter.ClearBeforeFill = true;
            // 
            // FormAddFilm
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.PeachPuff;
            this.ClientSize = new System.Drawing.Size(885, 596);
            this.Controls.Add(this.buttonAddFilm);
            this.Controls.Add(this.textBoxAnnotation);
            this.Controls.Add(this.textBoxActors);
            this.Controls.Add(this.textBoxGenre);
            this.Controls.Add(this.textBoxCountry);
            this.Controls.Add(this.textBoxProducer);
            this.Controls.Add(this.textBoxYear);
            this.Controls.Add(this.label8);
            this.Controls.Add(this.label7);
            this.Controls.Add(this.label6);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.textBoxName);
            this.Controls.Add(this.label2);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "FormAddFilm";
            this.RightToLeftLayout = true;
            this.SizeGripStyle = System.Windows.Forms.SizeGripStyle.Hide;
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Добавление фильма";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.TextBox textBoxAnnotation;
        private System.Windows.Forms.TextBox textBoxActors;
        private System.Windows.Forms.TextBox textBoxGenre;
        private System.Windows.Forms.TextBox textBoxCountry;
        private System.Windows.Forms.TextBox textBoxProducer;
        private System.Windows.Forms.TextBox textBoxYear;
        private System.Windows.Forms.Label label8;
        private System.Windows.Forms.Label label7;
        private System.Windows.Forms.Label label6;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.TextBox textBoxName;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Button buttonAddFilm;
        private DatabaseDataSetTableAdapters.ФильмыTableAdapter фильмыTableAdapter;
    }
}