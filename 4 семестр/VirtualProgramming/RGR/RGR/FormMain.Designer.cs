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
            this.components = new System.ComponentModel.Container();
            this.btnControl = new System.Windows.Forms.Button();
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
            this.panelPrint = new System.Windows.Forms.Panel();
            this.label3 = new System.Windows.Forms.Label();
            this.buttonLettersDebtors = new System.Windows.Forms.Button();
            this.buttonLettersMissing = new System.Windows.Forms.Button();
            this.buttonBack = new System.Windows.Forms.Button();
            this.buttonDebtors = new System.Windows.Forms.Button();
            this.buttonFilmStory = new System.Windows.Forms.Button();
            this.buttonMissingFilms = new System.Windows.Forms.Button();
            this.buttonUserStory = new System.Windows.Forms.Button();
            this.panelLettersMissing = new System.Windows.Forms.Panel();
            this.dataGridViewUser = new System.Windows.Forms.DataGridView();
            this.кодDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.фамилияDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.имяDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.отчествоDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.адресDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.пользователиBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.databaseDataSet = new RGR.DatabaseDataSet();
            this.buttonComposeMissing = new System.Windows.Forms.Button();
            this.label4 = new System.Windows.Forms.Label();
            this.dateTimePicker1 = new System.Windows.Forms.DateTimePicker();
            this.buttonBackStep = new System.Windows.Forms.Button();
            this.panelLettersDebtors = new System.Windows.Forms.Panel();
            this.dataGridViewHistory = new System.Windows.Forms.DataGridView();
            this.кодDataGridViewTextBoxColumn1 = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.кодПользователяDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.кодФильмаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.пользовательDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.фильмDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.режиссерDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.странаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.годВыходаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.датаВзятияDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.датаВозвратаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.историяBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.label6 = new System.Windows.Forms.Label();
            this.dateTimePicker3 = new System.Windows.Forms.DateTimePicker();
            this.buttonComposeLettersDebtors = new System.Windows.Forms.Button();
            this.label5 = new System.Windows.Forms.Label();
            this.dateTimePicker2 = new System.Windows.Forms.DateTimePicker();
            this.button3 = new System.Windows.Forms.Button();
            this.пользователиTableAdapter = new RGR.DatabaseDataSetTableAdapters.ПользователиTableAdapter();
            this.историяTableAdapter = new RGR.DatabaseDataSetTableAdapters.ИсторияTableAdapter();
            this.panelMain.SuspendLayout();
            this.panelControl.SuspendLayout();
            this.panelPrint.SuspendLayout();
            this.panelLettersMissing.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewUser)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.пользователиBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.databaseDataSet)).BeginInit();
            this.panelLettersDebtors.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewHistory)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.историяBindingSource)).BeginInit();
            this.SuspendLayout();
            // 
            // btnControl
            // 
            this.btnControl.Anchor = ((System.Windows.Forms.AnchorStyles)(((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.btnControl.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnControl.Font = new System.Drawing.Font("Bad Script", 25.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.btnControl.ForeColor = System.Drawing.Color.Black;
            this.btnControl.Location = new System.Drawing.Point(70, 44);
            this.btnControl.Name = "btnControl";
            this.btnControl.Size = new System.Drawing.Size(445, 119);
            this.btnControl.TabIndex = 0;
            this.btnControl.Text = "Управление";
            this.btnControl.UseVisualStyleBackColor = true;
            this.btnControl.Click += new System.EventHandler(this.BtnControl_Click);
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
            this.buttonView.Click += new System.EventHandler(this.ButtonView_Click);
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
            this.btnPrint.Click += new System.EventHandler(this.BtnPrint_Click);
            // 
            // panelMain
            // 
            this.panelMain.Controls.Add(this.btnPrint);
            this.panelMain.Controls.Add(this.buttonView);
            this.panelMain.Controls.Add(this.btnControl);
            this.panelMain.Location = new System.Drawing.Point(421, 597);
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
            this.panelControl.Location = new System.Drawing.Point(455, 556);
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
            this.btnBack.Click += new System.EventHandler(this.BtnBack_Click);
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
            this.btnUserDel.Click += new System.EventHandler(this.BtnUserDel_Click);
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
            this.btnUserAdd.Click += new System.EventHandler(this.BtnUserAdd_Click);
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
            this.btnFilmReceive.Click += new System.EventHandler(this.BtnFilmReceive_Click);
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
            this.btnFilmGive.Click += new System.EventHandler(this.BtnFilmGive_Click);
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
            this.btnFilmDel.Click += new System.EventHandler(this.BtnFilmDel_Click);
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
            this.btnFilmAdd.Click += new System.EventHandler(this.BtnFilmAdd_Click);
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
            // panelPrint
            // 
            this.panelPrint.BackColor = System.Drawing.Color.PapayaWhip;
            this.panelPrint.Controls.Add(this.label3);
            this.panelPrint.Controls.Add(this.buttonLettersDebtors);
            this.panelPrint.Controls.Add(this.buttonLettersMissing);
            this.panelPrint.Controls.Add(this.buttonBack);
            this.panelPrint.Controls.Add(this.buttonDebtors);
            this.panelPrint.Controls.Add(this.buttonFilmStory);
            this.panelPrint.Controls.Add(this.buttonMissingFilms);
            this.panelPrint.Controls.Add(this.buttonUserStory);
            this.panelPrint.Location = new System.Drawing.Point(388, 630);
            this.panelPrint.Name = "panelPrint";
            this.panelPrint.Size = new System.Drawing.Size(582, 643);
            this.panelPrint.TabIndex = 5;
            this.panelPrint.Visible = false;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label3.Location = new System.Drawing.Point(68, 367);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(83, 29);
            this.label3.TabIndex = 14;
            this.label3.Text = "Письма";
            // 
            // buttonLettersDebtors
            // 
            this.buttonLettersDebtors.BackColor = System.Drawing.Color.LightSalmon;
            this.buttonLettersDebtors.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.buttonLettersDebtors.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonLettersDebtors.Location = new System.Drawing.Point(72, 404);
            this.buttonLettersDebtors.Name = "buttonLettersDebtors";
            this.buttonLettersDebtors.Size = new System.Drawing.Size(448, 60);
            this.buttonLettersDebtors.TabIndex = 13;
            this.buttonLettersDebtors.Text = "Письма должникам";
            this.buttonLettersDebtors.UseVisualStyleBackColor = false;
            this.buttonLettersDebtors.Click += new System.EventHandler(this.ButtonLettersDebtors_Click);
            // 
            // buttonLettersMissing
            // 
            this.buttonLettersMissing.BackColor = System.Drawing.Color.LightCyan;
            this.buttonLettersMissing.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.buttonLettersMissing.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonLettersMissing.Location = new System.Drawing.Point(72, 482);
            this.buttonLettersMissing.Name = "buttonLettersMissing";
            this.buttonLettersMissing.Size = new System.Drawing.Size(448, 60);
            this.buttonLettersMissing.TabIndex = 12;
            this.buttonLettersMissing.Text = "Письма давно не посещавшим пользователям";
            this.buttonLettersMissing.UseVisualStyleBackColor = false;
            this.buttonLettersMissing.Click += new System.EventHandler(this.ButtonLettersMissing_Click);
            // 
            // buttonBack
            // 
            this.buttonBack.BackColor = System.Drawing.Color.Crimson;
            this.buttonBack.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.buttonBack.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonBack.ForeColor = System.Drawing.SystemColors.ButtonHighlight;
            this.buttonBack.Location = new System.Drawing.Point(200, 577);
            this.buttonBack.Name = "buttonBack";
            this.buttonBack.Size = new System.Drawing.Size(214, 54);
            this.buttonBack.TabIndex = 11;
            this.buttonBack.Text = "⬅ Назад";
            this.buttonBack.UseVisualStyleBackColor = false;
            this.buttonBack.Click += new System.EventHandler(this.BtnBack_Click);
            // 
            // buttonDebtors
            // 
            this.buttonDebtors.BackColor = System.Drawing.Color.LightCyan;
            this.buttonDebtors.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.buttonDebtors.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonDebtors.Location = new System.Drawing.Point(72, 173);
            this.buttonDebtors.Name = "buttonDebtors";
            this.buttonDebtors.Size = new System.Drawing.Size(448, 60);
            this.buttonDebtors.TabIndex = 8;
            this.buttonDebtors.Text = "Должники";
            this.buttonDebtors.UseVisualStyleBackColor = false;
            this.buttonDebtors.Click += new System.EventHandler(this.ButtonDebtors_Click);
            // 
            // buttonFilmStory
            // 
            this.buttonFilmStory.BackColor = System.Drawing.Color.LightBlue;
            this.buttonFilmStory.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.buttonFilmStory.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonFilmStory.Location = new System.Drawing.Point(72, 97);
            this.buttonFilmStory.Name = "buttonFilmStory";
            this.buttonFilmStory.Size = new System.Drawing.Size(448, 60);
            this.buttonFilmStory.TabIndex = 7;
            this.buttonFilmStory.Text = "История фильма";
            this.buttonFilmStory.UseVisualStyleBackColor = false;
            this.buttonFilmStory.Click += new System.EventHandler(this.ButtonFilmStory_Click);
            // 
            // buttonMissingFilms
            // 
            this.buttonMissingFilms.BackColor = System.Drawing.Color.LightSalmon;
            this.buttonMissingFilms.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.buttonMissingFilms.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonMissingFilms.Location = new System.Drawing.Point(72, 254);
            this.buttonMissingFilms.Name = "buttonMissingFilms";
            this.buttonMissingFilms.Size = new System.Drawing.Size(448, 60);
            this.buttonMissingFilms.TabIndex = 6;
            this.buttonMissingFilms.Text = "Отсутствующие фильмы";
            this.buttonMissingFilms.UseVisualStyleBackColor = false;
            this.buttonMissingFilms.Click += new System.EventHandler(this.ButtonMissingFilms_Click);
            // 
            // buttonUserStory
            // 
            this.buttonUserStory.BackColor = System.Drawing.Color.SpringGreen;
            this.buttonUserStory.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.buttonUserStory.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonUserStory.Location = new System.Drawing.Point(72, 16);
            this.buttonUserStory.Name = "buttonUserStory";
            this.buttonUserStory.Size = new System.Drawing.Size(448, 60);
            this.buttonUserStory.TabIndex = 5;
            this.buttonUserStory.Text = "История пользователя";
            this.buttonUserStory.UseVisualStyleBackColor = false;
            this.buttonUserStory.Click += new System.EventHandler(this.ButtonUserStory_Click);
            // 
            // panelLettersMissing
            // 
            this.panelLettersMissing.BackColor = System.Drawing.Color.PapayaWhip;
            this.panelLettersMissing.Controls.Add(this.dataGridViewUser);
            this.panelLettersMissing.Controls.Add(this.buttonComposeMissing);
            this.panelLettersMissing.Controls.Add(this.label4);
            this.panelLettersMissing.Controls.Add(this.dateTimePicker1);
            this.panelLettersMissing.Controls.Add(this.buttonBackStep);
            this.panelLettersMissing.Location = new System.Drawing.Point(513, 520);
            this.panelLettersMissing.Name = "panelLettersMissing";
            this.panelLettersMissing.Size = new System.Drawing.Size(582, 643);
            this.panelLettersMissing.TabIndex = 15;
            this.panelLettersMissing.Visible = false;
            // 
            // dataGridViewUser
            // 
            this.dataGridViewUser.AllowUserToAddRows = false;
            this.dataGridViewUser.AllowUserToDeleteRows = false;
            this.dataGridViewUser.AutoGenerateColumns = false;
            this.dataGridViewUser.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dataGridViewUser.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.кодDataGridViewTextBoxColumn,
            this.фамилияDataGridViewTextBoxColumn,
            this.имяDataGridViewTextBoxColumn,
            this.отчествоDataGridViewTextBoxColumn,
            this.адресDataGridViewTextBoxColumn,
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn});
            this.dataGridViewUser.DataSource = this.пользователиBindingSource;
            this.dataGridViewUser.Location = new System.Drawing.Point(391, 261);
            this.dataGridViewUser.Name = "dataGridViewUser";
            this.dataGridViewUser.ReadOnly = true;
            this.dataGridViewUser.RowHeadersWidth = 51;
            this.dataGridViewUser.RowTemplate.Height = 24;
            this.dataGridViewUser.Size = new System.Drawing.Size(10, 12);
            this.dataGridViewUser.TabIndex = 17;
            this.dataGridViewUser.Visible = false;
            // 
            // кодDataGridViewTextBoxColumn
            // 
            this.кодDataGridViewTextBoxColumn.DataPropertyName = "Код";
            this.кодDataGridViewTextBoxColumn.HeaderText = "Код";
            this.кодDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.кодDataGridViewTextBoxColumn.Name = "кодDataGridViewTextBoxColumn";
            this.кодDataGridViewTextBoxColumn.ReadOnly = true;
            this.кодDataGridViewTextBoxColumn.Width = 125;
            // 
            // фамилияDataGridViewTextBoxColumn
            // 
            this.фамилияDataGridViewTextBoxColumn.DataPropertyName = "Фамилия";
            this.фамилияDataGridViewTextBoxColumn.HeaderText = "Фамилия";
            this.фамилияDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.фамилияDataGridViewTextBoxColumn.Name = "фамилияDataGridViewTextBoxColumn";
            this.фамилияDataGridViewTextBoxColumn.ReadOnly = true;
            this.фамилияDataGridViewTextBoxColumn.Width = 125;
            // 
            // имяDataGridViewTextBoxColumn
            // 
            this.имяDataGridViewTextBoxColumn.DataPropertyName = "Имя";
            this.имяDataGridViewTextBoxColumn.HeaderText = "Имя";
            this.имяDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.имяDataGridViewTextBoxColumn.Name = "имяDataGridViewTextBoxColumn";
            this.имяDataGridViewTextBoxColumn.ReadOnly = true;
            this.имяDataGridViewTextBoxColumn.Width = 125;
            // 
            // отчествоDataGridViewTextBoxColumn
            // 
            this.отчествоDataGridViewTextBoxColumn.DataPropertyName = "Отчество";
            this.отчествоDataGridViewTextBoxColumn.HeaderText = "Отчество";
            this.отчествоDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.отчествоDataGridViewTextBoxColumn.Name = "отчествоDataGridViewTextBoxColumn";
            this.отчествоDataGridViewTextBoxColumn.ReadOnly = true;
            this.отчествоDataGridViewTextBoxColumn.Width = 125;
            // 
            // адресDataGridViewTextBoxColumn
            // 
            this.адресDataGridViewTextBoxColumn.DataPropertyName = "Адрес";
            this.адресDataGridViewTextBoxColumn.HeaderText = "Адрес";
            this.адресDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.адресDataGridViewTextBoxColumn.Name = "адресDataGridViewTextBoxColumn";
            this.адресDataGridViewTextBoxColumn.ReadOnly = true;
            this.адресDataGridViewTextBoxColumn.Width = 125;
            // 
            // датаПоследнегоПосещенияDataGridViewTextBoxColumn
            // 
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn.DataPropertyName = "Дата последнего посещения";
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn.HeaderText = "Дата последнего посещения";
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn.Name = "датаПоследнегоПосещенияDataGridViewTextBoxColumn";
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn.ReadOnly = true;
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn.Width = 125;
            // 
            // пользователиBindingSource
            // 
            this.пользователиBindingSource.DataMember = "Пользователи";
            this.пользователиBindingSource.DataSource = this.databaseDataSet;
            // 
            // databaseDataSet
            // 
            this.databaseDataSet.DataSetName = "DatabaseDataSet";
            this.databaseDataSet.SchemaSerializationMode = System.Data.SchemaSerializationMode.IncludeSchema;
            // 
            // buttonComposeMissing
            // 
            this.buttonComposeMissing.BackColor = System.Drawing.Color.LightCyan;
            this.buttonComposeMissing.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.buttonComposeMissing.Font = new System.Drawing.Font("Neucha", 18F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonComposeMissing.ForeColor = System.Drawing.Color.DarkCyan;
            this.buttonComposeMissing.Location = new System.Drawing.Point(108, 434);
            this.buttonComposeMissing.Name = "buttonComposeMissing";
            this.buttonComposeMissing.Size = new System.Drawing.Size(368, 107);
            this.buttonComposeMissing.TabIndex = 16;
            this.buttonComposeMissing.Text = "Составить";
            this.buttonComposeMissing.UseVisualStyleBackColor = false;
            this.buttonComposeMissing.Click += new System.EventHandler(this.ButtonComposeMissing_Click);
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label4.ForeColor = System.Drawing.SystemColors.MenuHighlight;
            this.label4.Location = new System.Drawing.Point(81, 47);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(414, 87);
            this.label4.TabIndex = 15;
            this.label4.Text = "Составить письма пользователям \r\nпосещавшим видеотеку в последний раз\r\n ранее чем" +
    ":";
            this.label4.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // dateTimePicker1
            // 
            this.dateTimePicker1.CalendarFont = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.dateTimePicker1.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.dateTimePicker1.Location = new System.Drawing.Point(108, 163);
            this.dateTimePicker1.MaxDate = new System.DateTime(2020, 8, 15, 0, 0, 0, 0);
            this.dateTimePicker1.MinDate = new System.DateTime(2020, 1, 1, 0, 0, 0, 0);
            this.dateTimePicker1.Name = "dateTimePicker1";
            this.dateTimePicker1.Size = new System.Drawing.Size(368, 32);
            this.dateTimePicker1.TabIndex = 12;
            this.dateTimePicker1.Value = new System.DateTime(2020, 8, 15, 0, 0, 0, 0);
            // 
            // buttonBackStep
            // 
            this.buttonBackStep.BackColor = System.Drawing.Color.Crimson;
            this.buttonBackStep.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.buttonBackStep.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonBackStep.ForeColor = System.Drawing.SystemColors.ButtonHighlight;
            this.buttonBackStep.Location = new System.Drawing.Point(188, 581);
            this.buttonBackStep.Name = "buttonBackStep";
            this.buttonBackStep.Size = new System.Drawing.Size(214, 54);
            this.buttonBackStep.TabIndex = 11;
            this.buttonBackStep.Text = "⬅ Назад";
            this.buttonBackStep.UseVisualStyleBackColor = false;
            this.buttonBackStep.Click += new System.EventHandler(this.ButtonBackStep_Click);
            // 
            // panelLettersDebtors
            // 
            this.panelLettersDebtors.BackColor = System.Drawing.Color.PapayaWhip;
            this.panelLettersDebtors.Controls.Add(this.dataGridViewHistory);
            this.panelLettersDebtors.Controls.Add(this.label6);
            this.panelLettersDebtors.Controls.Add(this.dateTimePicker3);
            this.panelLettersDebtors.Controls.Add(this.buttonComposeLettersDebtors);
            this.panelLettersDebtors.Controls.Add(this.label5);
            this.panelLettersDebtors.Controls.Add(this.dateTimePicker2);
            this.panelLettersDebtors.Controls.Add(this.button3);
            this.panelLettersDebtors.Location = new System.Drawing.Point(6, -3);
            this.panelLettersDebtors.Name = "panelLettersDebtors";
            this.panelLettersDebtors.Size = new System.Drawing.Size(582, 643);
            this.panelLettersDebtors.TabIndex = 16;
            this.panelLettersDebtors.Visible = false;
            // 
            // dataGridViewHistory
            // 
            this.dataGridViewHistory.AllowUserToAddRows = false;
            this.dataGridViewHistory.AllowUserToDeleteRows = false;
            this.dataGridViewHistory.AutoGenerateColumns = false;
            this.dataGridViewHistory.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dataGridViewHistory.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.кодDataGridViewTextBoxColumn1,
            this.кодПользователяDataGridViewTextBoxColumn,
            this.кодФильмаDataGridViewTextBoxColumn,
            this.пользовательDataGridViewTextBoxColumn,
            this.фильмDataGridViewTextBoxColumn,
            this.режиссерDataGridViewTextBoxColumn,
            this.странаDataGridViewTextBoxColumn,
            this.годВыходаDataGridViewTextBoxColumn,
            this.датаВзятияDataGridViewTextBoxColumn,
            this.датаВозвратаDataGridViewTextBoxColumn});
            this.dataGridViewHistory.DataSource = this.историяBindingSource;
            this.dataGridViewHistory.Location = new System.Drawing.Point(551, 26);
            this.dataGridViewHistory.Name = "dataGridViewHistory";
            this.dataGridViewHistory.ReadOnly = true;
            this.dataGridViewHistory.RowHeadersWidth = 51;
            this.dataGridViewHistory.RowTemplate.Height = 24;
            this.dataGridViewHistory.Size = new System.Drawing.Size(13, 15);
            this.dataGridViewHistory.TabIndex = 19;
            this.dataGridViewHistory.Visible = false;
            // 
            // кодDataGridViewTextBoxColumn1
            // 
            this.кодDataGridViewTextBoxColumn1.DataPropertyName = "Код";
            this.кодDataGridViewTextBoxColumn1.HeaderText = "Код";
            this.кодDataGridViewTextBoxColumn1.MinimumWidth = 6;
            this.кодDataGridViewTextBoxColumn1.Name = "кодDataGridViewTextBoxColumn1";
            this.кодDataGridViewTextBoxColumn1.ReadOnly = true;
            this.кодDataGridViewTextBoxColumn1.Width = 125;
            // 
            // кодПользователяDataGridViewTextBoxColumn
            // 
            this.кодПользователяDataGridViewTextBoxColumn.DataPropertyName = "Код пользователя";
            this.кодПользователяDataGridViewTextBoxColumn.HeaderText = "Код пользователя";
            this.кодПользователяDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.кодПользователяDataGridViewTextBoxColumn.Name = "кодПользователяDataGridViewTextBoxColumn";
            this.кодПользователяDataGridViewTextBoxColumn.ReadOnly = true;
            this.кодПользователяDataGridViewTextBoxColumn.Width = 125;
            // 
            // кодФильмаDataGridViewTextBoxColumn
            // 
            this.кодФильмаDataGridViewTextBoxColumn.DataPropertyName = "Код фильма";
            this.кодФильмаDataGridViewTextBoxColumn.HeaderText = "Код фильма";
            this.кодФильмаDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.кодФильмаDataGridViewTextBoxColumn.Name = "кодФильмаDataGridViewTextBoxColumn";
            this.кодФильмаDataGridViewTextBoxColumn.ReadOnly = true;
            this.кодФильмаDataGridViewTextBoxColumn.Width = 125;
            // 
            // пользовательDataGridViewTextBoxColumn
            // 
            this.пользовательDataGridViewTextBoxColumn.DataPropertyName = "Пользователь";
            this.пользовательDataGridViewTextBoxColumn.HeaderText = "Пользователь";
            this.пользовательDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.пользовательDataGridViewTextBoxColumn.Name = "пользовательDataGridViewTextBoxColumn";
            this.пользовательDataGridViewTextBoxColumn.ReadOnly = true;
            this.пользовательDataGridViewTextBoxColumn.Width = 125;
            // 
            // фильмDataGridViewTextBoxColumn
            // 
            this.фильмDataGridViewTextBoxColumn.DataPropertyName = "Фильм";
            this.фильмDataGridViewTextBoxColumn.HeaderText = "Фильм";
            this.фильмDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.фильмDataGridViewTextBoxColumn.Name = "фильмDataGridViewTextBoxColumn";
            this.фильмDataGridViewTextBoxColumn.ReadOnly = true;
            this.фильмDataGridViewTextBoxColumn.Width = 125;
            // 
            // режиссерDataGridViewTextBoxColumn
            // 
            this.режиссерDataGridViewTextBoxColumn.DataPropertyName = "Режиссер";
            this.режиссерDataGridViewTextBoxColumn.HeaderText = "Режиссер";
            this.режиссерDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.режиссерDataGridViewTextBoxColumn.Name = "режиссерDataGridViewTextBoxColumn";
            this.режиссерDataGridViewTextBoxColumn.ReadOnly = true;
            this.режиссерDataGridViewTextBoxColumn.Width = 125;
            // 
            // странаDataGridViewTextBoxColumn
            // 
            this.странаDataGridViewTextBoxColumn.DataPropertyName = "Страна";
            this.странаDataGridViewTextBoxColumn.HeaderText = "Страна";
            this.странаDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.странаDataGridViewTextBoxColumn.Name = "странаDataGridViewTextBoxColumn";
            this.странаDataGridViewTextBoxColumn.ReadOnly = true;
            this.странаDataGridViewTextBoxColumn.Width = 125;
            // 
            // годВыходаDataGridViewTextBoxColumn
            // 
            this.годВыходаDataGridViewTextBoxColumn.DataPropertyName = "Год выхода";
            this.годВыходаDataGridViewTextBoxColumn.HeaderText = "Год выхода";
            this.годВыходаDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.годВыходаDataGridViewTextBoxColumn.Name = "годВыходаDataGridViewTextBoxColumn";
            this.годВыходаDataGridViewTextBoxColumn.ReadOnly = true;
            this.годВыходаDataGridViewTextBoxColumn.Width = 125;
            // 
            // датаВзятияDataGridViewTextBoxColumn
            // 
            this.датаВзятияDataGridViewTextBoxColumn.DataPropertyName = "Дата взятия";
            this.датаВзятияDataGridViewTextBoxColumn.HeaderText = "Дата взятия";
            this.датаВзятияDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.датаВзятияDataGridViewTextBoxColumn.Name = "датаВзятияDataGridViewTextBoxColumn";
            this.датаВзятияDataGridViewTextBoxColumn.ReadOnly = true;
            this.датаВзятияDataGridViewTextBoxColumn.Width = 125;
            // 
            // датаВозвратаDataGridViewTextBoxColumn
            // 
            this.датаВозвратаDataGridViewTextBoxColumn.DataPropertyName = "Дата Возврата";
            this.датаВозвратаDataGridViewTextBoxColumn.HeaderText = "Дата Возврата";
            this.датаВозвратаDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.датаВозвратаDataGridViewTextBoxColumn.Name = "датаВозвратаDataGridViewTextBoxColumn";
            this.датаВозвратаDataGridViewTextBoxColumn.ReadOnly = true;
            this.датаВозвратаDataGridViewTextBoxColumn.Width = 125;
            // 
            // историяBindingSource
            // 
            this.историяBindingSource.DataMember = "История";
            this.историяBindingSource.DataSource = this.databaseDataSet;
            // 
            // label6
            // 
            this.label6.AutoSize = true;
            this.label6.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label6.ForeColor = System.Drawing.SystemColors.MenuHighlight;
            this.label6.Location = new System.Drawing.Point(120, 270);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(361, 29);
            this.label6.TabIndex = 18;
            this.label6.Text = "Рекомендуемая дата возвращения:";
            this.label6.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // dateTimePicker3
            // 
            this.dateTimePicker3.CalendarFont = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.dateTimePicker3.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.dateTimePicker3.Location = new System.Drawing.Point(113, 313);
            this.dateTimePicker3.MaxDate = new System.DateTime(2100, 12, 31, 0, 0, 0, 0);
            this.dateTimePicker3.MinDate = new System.DateTime(2020, 1, 1, 0, 0, 0, 0);
            this.dateTimePicker3.Name = "dateTimePicker3";
            this.dateTimePicker3.Size = new System.Drawing.Size(368, 32);
            this.dateTimePicker3.TabIndex = 17;
            this.dateTimePicker3.Value = new System.DateTime(2100, 12, 31, 0, 0, 0, 0);
            // 
            // buttonComposeLettersDebtors
            // 
            this.buttonComposeLettersDebtors.BackColor = System.Drawing.Color.LightCyan;
            this.buttonComposeLettersDebtors.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.buttonComposeLettersDebtors.Font = new System.Drawing.Font("Neucha", 18F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonComposeLettersDebtors.ForeColor = System.Drawing.Color.DarkCyan;
            this.buttonComposeLettersDebtors.Location = new System.Drawing.Point(113, 431);
            this.buttonComposeLettersDebtors.Name = "buttonComposeLettersDebtors";
            this.buttonComposeLettersDebtors.Size = new System.Drawing.Size(368, 107);
            this.buttonComposeLettersDebtors.TabIndex = 16;
            this.buttonComposeLettersDebtors.Text = "Составить";
            this.buttonComposeLettersDebtors.UseVisualStyleBackColor = false;
            this.buttonComposeLettersDebtors.Click += new System.EventHandler(this.ButtonComposeLettersDebtors_Click);
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label5.ForeColor = System.Drawing.SystemColors.MenuHighlight;
            this.label5.Location = new System.Drawing.Point(86, 44);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(444, 58);
            this.label5.TabIndex = 15;
            this.label5.Text = "Составить письма пользователям, которые \r\nбрали фильмы ранее чем:";
            this.label5.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // dateTimePicker2
            // 
            this.dateTimePicker2.CalendarFont = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.dateTimePicker2.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.dateTimePicker2.Location = new System.Drawing.Point(113, 160);
            this.dateTimePicker2.MaxDate = new System.DateTime(2099, 1, 1, 0, 0, 0, 0);
            this.dateTimePicker2.MinDate = new System.DateTime(2020, 1, 1, 0, 0, 0, 0);
            this.dateTimePicker2.Name = "dateTimePicker2";
            this.dateTimePicker2.Size = new System.Drawing.Size(368, 32);
            this.dateTimePicker2.TabIndex = 12;
            this.dateTimePicker2.Value = new System.DateTime(2099, 1, 1, 0, 0, 0, 0);
            // 
            // button3
            // 
            this.button3.BackColor = System.Drawing.Color.Crimson;
            this.button3.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.button3.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.button3.ForeColor = System.Drawing.SystemColors.ButtonHighlight;
            this.button3.Location = new System.Drawing.Point(193, 578);
            this.button3.Name = "button3";
            this.button3.Size = new System.Drawing.Size(214, 54);
            this.button3.TabIndex = 11;
            this.button3.Text = "⬅ Назад";
            this.button3.UseVisualStyleBackColor = false;
            this.button3.Click += new System.EventHandler(this.ButtonBackStep_Click);
            // 
            // пользователиTableAdapter
            // 
            this.пользователиTableAdapter.ClearBeforeFill = true;
            // 
            // историяTableAdapter
            // 
            this.историяTableAdapter.ClearBeforeFill = true;
            // 
            // FormMain
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.PeachPuff;
            this.ClientSize = new System.Drawing.Size(582, 643);
            this.Controls.Add(this.panelLettersDebtors);
            this.Controls.Add(this.panelLettersMissing);
            this.Controls.Add(this.panelPrint);
            this.Controls.Add(this.panelControl);
            this.Controls.Add(this.panelMain);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.MaximizeBox = false;
            this.MaximumSize = new System.Drawing.Size(600, 685);
            this.MinimumSize = new System.Drawing.Size(600, 685);
            this.Name = "FormMain";
            this.SizeGripStyle = System.Windows.Forms.SizeGripStyle.Hide;
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Расчетно-графическая работа  |  Видеотека";
            this.Load += new System.EventHandler(this.FormMain_Load);
            this.panelMain.ResumeLayout(false);
            this.panelControl.ResumeLayout(false);
            this.panelControl.PerformLayout();
            this.panelPrint.ResumeLayout(false);
            this.panelPrint.PerformLayout();
            this.panelLettersMissing.ResumeLayout(false);
            this.panelLettersMissing.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewUser)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.пользователиBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.databaseDataSet)).EndInit();
            this.panelLettersDebtors.ResumeLayout(false);
            this.panelLettersDebtors.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewHistory)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.историяBindingSource)).EndInit();
            this.ResumeLayout(false);

        }

        #endregion

        protected internal System.Windows.Forms.Button btnControl;
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
        private System.Windows.Forms.Panel panelPrint;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Button buttonLettersDebtors;
        private System.Windows.Forms.Button buttonLettersMissing;
        private System.Windows.Forms.Button buttonBack;
        private System.Windows.Forms.Button buttonDebtors;
        private System.Windows.Forms.Button buttonFilmStory;
        private System.Windows.Forms.Button buttonMissingFilms;
        private System.Windows.Forms.Button buttonUserStory;
        private System.Windows.Forms.Panel panelLettersMissing;
        private System.Windows.Forms.DateTimePicker dateTimePicker1;
        private System.Windows.Forms.Button buttonBackStep;
        private System.Windows.Forms.Button buttonComposeMissing;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Panel panelLettersDebtors;
        private System.Windows.Forms.Button buttonComposeLettersDebtors;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.DateTimePicker dateTimePicker2;
        private System.Windows.Forms.Button button3;
        private System.Windows.Forms.Label label6;
        private System.Windows.Forms.DateTimePicker dateTimePicker3;
        private DatabaseDataSetTableAdapters.ПользователиTableAdapter пользователиTableAdapter;
        private DatabaseDataSet databaseDataSet;
        private System.Windows.Forms.DataGridView dataGridViewUser;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn фамилияDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn имяDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn отчествоDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn адресDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn датаПоследнегоПосещенияDataGridViewTextBoxColumn;
        private System.Windows.Forms.BindingSource пользователиBindingSource;
        private System.Windows.Forms.BindingSource историяBindingSource;
        private DatabaseDataSetTableAdapters.ИсторияTableAdapter историяTableAdapter;
        private System.Windows.Forms.DataGridView dataGridViewHistory;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодDataGridViewTextBoxColumn1;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодПользователяDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодФильмаDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn пользовательDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn фильмDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn режиссерDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn странаDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn годВыходаDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn датаВзятияDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn датаВозвратаDataGridViewTextBoxColumn;
    }
}