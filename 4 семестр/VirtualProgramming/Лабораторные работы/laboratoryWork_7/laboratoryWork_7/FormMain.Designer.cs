namespace laboratoryWork_7
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
            this.dataGridView = new System.Windows.Forms.DataGridView();
            this.страныАмерикиBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.dataBaseDataSet = new laboratoryWork_7.DataBaseDataSet();
            this.страны_АмерикиTableAdapter = new laboratoryWork_7.DataBaseDataSetTableAdapters.Страны_АмерикиTableAdapter();
            this.label1 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.sort_button = new System.Windows.Forms.Button();
            this.NorthAmerica_button = new System.Windows.Forms.Button();
            this.SouthAmerica_button = new System.Windows.Forms.Button();
            this.All_button = new System.Windows.Forms.Button();
            this.startK_button = new System.Windows.Forms.Button();
            this.K_button = new System.Windows.Forms.Button();
            this.textBox = new System.Windows.Forms.TextBox();
            this.label4 = new System.Windows.Forms.Label();
            this.кодDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.названиеСтраныDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.столицаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.континентDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.населениеDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridView)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.страныАмерикиBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.dataBaseDataSet)).BeginInit();
            this.SuspendLayout();
            // 
            // dataGridView
            // 
            this.dataGridView.AllowUserToAddRows = false;
            this.dataGridView.AllowUserToDeleteRows = false;
            this.dataGridView.AllowUserToResizeColumns = false;
            this.dataGridView.AllowUserToResizeRows = false;
            this.dataGridView.Anchor = ((System.Windows.Forms.AnchorStyles)(((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.dataGridView.AutoGenerateColumns = false;
            this.dataGridView.AutoSizeColumnsMode = System.Windows.Forms.DataGridViewAutoSizeColumnsMode.Fill;
            this.dataGridView.AutoSizeRowsMode = System.Windows.Forms.DataGridViewAutoSizeRowsMode.DisplayedCells;
            this.dataGridView.BackgroundColor = System.Drawing.Color.PeachPuff;
            this.dataGridView.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dataGridView.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.кодDataGridViewTextBoxColumn,
            this.названиеСтраныDataGridViewTextBoxColumn,
            this.столицаDataGridViewTextBoxColumn,
            this.континентDataGridViewTextBoxColumn,
            this.населениеDataGridViewTextBoxColumn});
            this.dataGridView.DataSource = this.страныАмерикиBindingSource;
            this.dataGridView.Location = new System.Drawing.Point(11, 192);
            this.dataGridView.Name = "dataGridView";
            this.dataGridView.ReadOnly = true;
            this.dataGridView.Size = new System.Drawing.Size(576, 428);
            this.dataGridView.TabIndex = 0;
            // 
            // страныАмерикиBindingSource
            // 
            this.страныАмерикиBindingSource.DataMember = "Страны Америки";
            this.страныАмерикиBindingSource.DataSource = this.dataBaseDataSet;
            // 
            // dataBaseDataSet
            // 
            this.dataBaseDataSet.DataSetName = "DataBaseDataSet";
            this.dataBaseDataSet.SchemaSerializationMode = System.Data.SchemaSerializationMode.IncludeSchema;
            // 
            // страны_АмерикиTableAdapter
            // 
            this.страны_АмерикиTableAdapter.ClearBeforeFill = true;
            // 
            // label1
            // 
            this.label1.Font = new System.Drawing.Font("Microsoft Sans Serif", 11.25F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label1.Location = new System.Drawing.Point(12, 14);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(139, 28);
            this.label1.TabIndex = 1;
            this.label1.Text = "Название";
            this.label1.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // label2
            // 
            this.label2.Anchor = System.Windows.Forms.AnchorStyles.Top;
            this.label2.Font = new System.Drawing.Font("Microsoft Sans Serif", 11.25F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label2.Location = new System.Drawing.Point(241, 14);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(139, 28);
            this.label2.TabIndex = 2;
            this.label2.Text = "Континент";
            this.label2.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // label3
            // 
            this.label3.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Right)));
            this.label3.Font = new System.Drawing.Font("Microsoft Sans Serif", 11.25F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label3.Location = new System.Drawing.Point(449, 14);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(139, 28);
            this.label3.TabIndex = 3;
            this.label3.Text = "Население";
            this.label3.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // sort_button
            // 
            this.sort_button.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Right)));
            this.sort_button.BackColor = System.Drawing.Color.PeachPuff;
            this.sort_button.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.sort_button.Location = new System.Drawing.Point(449, 58);
            this.sort_button.Name = "sort_button";
            this.sort_button.Size = new System.Drawing.Size(138, 30);
            this.sort_button.TabIndex = 4;
            this.sort_button.Text = "Сортировать";
            this.sort_button.UseVisualStyleBackColor = false;
            this.sort_button.Click += new System.EventHandler(this.sort_button_Click);
            // 
            // NorthAmerica_button
            // 
            this.NorthAmerica_button.Anchor = System.Windows.Forms.AnchorStyles.Top;
            this.NorthAmerica_button.BackColor = System.Drawing.Color.PeachPuff;
            this.NorthAmerica_button.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.NorthAmerica_button.Location = new System.Drawing.Point(241, 58);
            this.NorthAmerica_button.Name = "NorthAmerica_button";
            this.NorthAmerica_button.Size = new System.Drawing.Size(139, 30);
            this.NorthAmerica_button.TabIndex = 5;
            this.NorthAmerica_button.Text = "Северная Америка";
            this.NorthAmerica_button.UseVisualStyleBackColor = false;
            this.NorthAmerica_button.Click += new System.EventHandler(this.NorthAmerica_button_Click);
            // 
            // SouthAmerica_button
            // 
            this.SouthAmerica_button.Anchor = System.Windows.Forms.AnchorStyles.Top;
            this.SouthAmerica_button.BackColor = System.Drawing.Color.PeachPuff;
            this.SouthAmerica_button.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.SouthAmerica_button.Location = new System.Drawing.Point(241, 94);
            this.SouthAmerica_button.Name = "SouthAmerica_button";
            this.SouthAmerica_button.Size = new System.Drawing.Size(139, 30);
            this.SouthAmerica_button.TabIndex = 6;
            this.SouthAmerica_button.Text = "Южная Америка";
            this.SouthAmerica_button.UseVisualStyleBackColor = false;
            this.SouthAmerica_button.Click += new System.EventHandler(this.SouthAmerica_button_Click);
            // 
            // All_button
            // 
            this.All_button.BackColor = System.Drawing.Color.PeachPuff;
            this.All_button.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.All_button.Location = new System.Drawing.Point(12, 58);
            this.All_button.Name = "All_button";
            this.All_button.Size = new System.Drawing.Size(139, 30);
            this.All_button.TabIndex = 7;
            this.All_button.Text = "Все";
            this.All_button.UseVisualStyleBackColor = false;
            this.All_button.Click += new System.EventHandler(this.All_button_Click);
            // 
            // startK_button
            // 
            this.startK_button.BackColor = System.Drawing.Color.PeachPuff;
            this.startK_button.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.startK_button.Location = new System.Drawing.Point(12, 94);
            this.startK_button.Name = "startK_button";
            this.startK_button.Size = new System.Drawing.Size(139, 30);
            this.startK_button.TabIndex = 8;
            this.startK_button.Text = "Ничинаются с \"К\"";
            this.startK_button.UseVisualStyleBackColor = false;
            this.startK_button.Click += new System.EventHandler(this.startK_button_Click);
            // 
            // K_button
            // 
            this.K_button.BackColor = System.Drawing.Color.PeachPuff;
            this.K_button.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.K_button.Location = new System.Drawing.Point(12, 130);
            this.K_button.Name = "K_button";
            this.K_button.Size = new System.Drawing.Size(139, 30);
            this.K_button.TabIndex = 9;
            this.K_button.Text = "Сожержат \"К\"";
            this.K_button.UseVisualStyleBackColor = false;
            this.K_button.Click += new System.EventHandler(this.K_button_Click);
            // 
            // textBox
            // 
            this.textBox.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBox.BackColor = System.Drawing.Color.PeachPuff;
            this.textBox.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBox.Font = new System.Drawing.Font("Microsoft Sans Serif", 12F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBox.Location = new System.Drawing.Point(12, 649);
            this.textBox.Name = "textBox";
            this.textBox.Size = new System.Drawing.Size(170, 26);
            this.textBox.TabIndex = 10;
            this.textBox.TextChanged += new System.EventHandler(this.textBox_TextChanged);
            // 
            // label4
            // 
            this.label4.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.label4.Font = new System.Drawing.Font("Microsoft Sans Serif", 9F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label4.Location = new System.Drawing.Point(12, 623);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(100, 23);
            this.label4.TabIndex = 11;
            this.label4.Text = "Поиск";
            this.label4.TextAlign = System.Drawing.ContentAlignment.MiddleLeft;
            // 
            // кодDataGridViewTextBoxColumn
            // 
            this.кодDataGridViewTextBoxColumn.DataPropertyName = "Код";
            this.кодDataGridViewTextBoxColumn.HeaderText = "Код";
            this.кодDataGridViewTextBoxColumn.Name = "кодDataGridViewTextBoxColumn";
            this.кодDataGridViewTextBoxColumn.ReadOnly = true;
            this.кодDataGridViewTextBoxColumn.Visible = false;
            // 
            // названиеСтраныDataGridViewTextBoxColumn
            // 
            this.названиеСтраныDataGridViewTextBoxColumn.DataPropertyName = "Название страны";
            this.названиеСтраныDataGridViewTextBoxColumn.HeaderText = "Название страны";
            this.названиеСтраныDataGridViewTextBoxColumn.Name = "названиеСтраныDataGridViewTextBoxColumn";
            this.названиеСтраныDataGridViewTextBoxColumn.ReadOnly = true;
            // 
            // столицаDataGridViewTextBoxColumn
            // 
            this.столицаDataGridViewTextBoxColumn.DataPropertyName = "Столица";
            this.столицаDataGridViewTextBoxColumn.HeaderText = "Столица";
            this.столицаDataGridViewTextBoxColumn.Name = "столицаDataGridViewTextBoxColumn";
            this.столицаDataGridViewTextBoxColumn.ReadOnly = true;
            // 
            // континентDataGridViewTextBoxColumn
            // 
            this.континентDataGridViewTextBoxColumn.DataPropertyName = "Континент";
            this.континентDataGridViewTextBoxColumn.HeaderText = "Континент";
            this.континентDataGridViewTextBoxColumn.Name = "континентDataGridViewTextBoxColumn";
            this.континентDataGridViewTextBoxColumn.ReadOnly = true;
            // 
            // населениеDataGridViewTextBoxColumn
            // 
            this.населениеDataGridViewTextBoxColumn.DataPropertyName = "Население";
            this.населениеDataGridViewTextBoxColumn.HeaderText = "Население";
            this.населениеDataGridViewTextBoxColumn.Name = "населениеDataGridViewTextBoxColumn";
            this.населениеDataGridViewTextBoxColumn.ReadOnly = true;
            // 
            // FormMain
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.PapayaWhip;
            this.ClientSize = new System.Drawing.Size(600, 687);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.textBox);
            this.Controls.Add(this.K_button);
            this.Controls.Add(this.startK_button);
            this.Controls.Add(this.All_button);
            this.Controls.Add(this.SouthAmerica_button);
            this.Controls.Add(this.NorthAmerica_button);
            this.Controls.Add(this.sort_button);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.dataGridView);
            this.MinimumSize = new System.Drawing.Size(600, 726);
            this.Name = "FormMain";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Базы данных #2  |  Лабораторная работа #7";
            this.Load += new System.EventHandler(this.FormMain_Load);
            ((System.ComponentModel.ISupportInitialize)(this.dataGridView)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.страныАмерикиBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.dataBaseDataSet)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        private System.Windows.Forms.Button All_button;
        private laboratoryWork_7.DataBaseDataSet dataBaseDataSet;
        private System.Windows.Forms.DataGridView dataGridView;
        private System.Windows.Forms.Button K_button;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Button NorthAmerica_button;
        private System.Windows.Forms.Button sort_button;
        private System.Windows.Forms.Button SouthAmerica_button;
        private System.Windows.Forms.Button startK_button;
        private System.Windows.Forms.TextBox textBox;
        private laboratoryWork_7.DataBaseDataSetTableAdapters.Страны_АмерикиTableAdapter страны_АмерикиTableAdapter;
        private System.Windows.Forms.BindingSource страныАмерикиBindingSource;

        #endregion

        private System.Windows.Forms.DataGridViewTextBoxColumn кодDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn названиеСтраныDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn столицаDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn континентDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn населениеDataGridViewTextBoxColumn;
    }
}