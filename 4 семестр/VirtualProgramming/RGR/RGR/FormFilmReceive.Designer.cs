namespace RGR
{
    partial class FormFilmReceive
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
            System.Windows.Forms.DataGridViewCellStyle dataGridViewCellStyle1 = new System.Windows.Forms.DataGridViewCellStyle();
            this.databaseDataSet = new RGR.DatabaseDataSet();
            this.panelUser = new System.Windows.Forms.Panel();
            this.label8 = new System.Windows.Forms.Label();
            this.dataGridView = new System.Windows.Forms.DataGridView();
            this.пользовательDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.фильмDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.режиссерDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.странаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.годВыходаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.датаВзятияDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.датаВозвратаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.кодЗаписиDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.кодПользователяDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.кодФильмаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.историяBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.panel2 = new System.Windows.Forms.Panel();
            this.buttonResetSearch = new System.Windows.Forms.Button();
            this.buttonSearchProducer = new System.Windows.Forms.Button();
            this.textBoxSearchProducer = new System.Windows.Forms.TextBox();
            this.label3 = new System.Windows.Forms.Label();
            this.buttonSearchName = new System.Windows.Forms.Button();
            this.textBoxSearchName = new System.Windows.Forms.TextBox();
            this.label2 = new System.Windows.Forms.Label();
            this.buttonSearchUser = new System.Windows.Forms.Button();
            this.textBoxSearchUser = new System.Windows.Forms.TextBox();
            this.label7 = new System.Windows.Forms.Label();
            this.btnBack = new System.Windows.Forms.Button();
            this.кодDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Фамилия = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Имя = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Отчество = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Адрес = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Код = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.dataGridViewTextBoxColumn1 = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.dataGridViewTextBoxColumn2 = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.dataGridViewTextBoxColumn3 = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.dataGridViewTextBoxColumn4 = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.историяTableAdapter = new RGR.DatabaseDataSetTableAdapters.ИсторияTableAdapter();
            this.пользователиTableAdapter = new RGR.DatabaseDataSetTableAdapters.ПользователиTableAdapter();
            this.фильмыTableAdapter = new RGR.DatabaseDataSetTableAdapters.ФильмыTableAdapter();
            ((System.ComponentModel.ISupportInitialize)(this.databaseDataSet)).BeginInit();
            this.panelUser.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridView)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.историяBindingSource)).BeginInit();
            this.panel2.SuspendLayout();
            this.SuspendLayout();
            // 
            // databaseDataSet
            // 
            this.databaseDataSet.DataSetName = "DatabaseDataSet";
            this.databaseDataSet.SchemaSerializationMode = System.Data.SchemaSerializationMode.IncludeSchema;
            // 
            // panelUser
            // 
            this.panelUser.Controls.Add(this.label8);
            this.panelUser.Controls.Add(this.dataGridView);
            this.panelUser.Controls.Add(this.panel2);
            this.panelUser.Controls.Add(this.btnBack);
            this.panelUser.Location = new System.Drawing.Point(12, 12);
            this.panelUser.Name = "panelUser";
            this.panelUser.Size = new System.Drawing.Size(1508, 815);
            this.panelUser.TabIndex = 22;
            // 
            // label8
            // 
            this.label8.AutoSize = true;
            this.label8.Font = new System.Drawing.Font("Neucha", 24F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label8.ForeColor = System.Drawing.Color.RoyalBlue;
            this.label8.Location = new System.Drawing.Point(248, 10);
            this.label8.Name = "label8";
            this.label8.Size = new System.Drawing.Size(996, 49);
            this.label8.TabIndex = 23;
            this.label8.Text = "Нажмите дважды по фильму, для возврата его в фильмотеку";
            this.label8.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // dataGridView
            // 
            this.dataGridView.AllowUserToAddRows = false;
            this.dataGridView.AllowUserToDeleteRows = false;
            this.dataGridView.AllowUserToOrderColumns = true;
            this.dataGridView.AutoGenerateColumns = false;
            this.dataGridView.AutoSizeColumnsMode = System.Windows.Forms.DataGridViewAutoSizeColumnsMode.AllCells;
            this.dataGridView.AutoSizeRowsMode = System.Windows.Forms.DataGridViewAutoSizeRowsMode.AllCells;
            this.dataGridView.BackgroundColor = System.Drawing.Color.LightYellow;
            this.dataGridView.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dataGridView.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.пользовательDataGridViewTextBoxColumn,
            this.фильмDataGridViewTextBoxColumn,
            this.режиссерDataGridViewTextBoxColumn,
            this.странаDataGridViewTextBoxColumn,
            this.годВыходаDataGridViewTextBoxColumn,
            this.датаВзятияDataGridViewTextBoxColumn,
            this.датаВозвратаDataGridViewTextBoxColumn,
            this.кодЗаписиDataGridViewTextBoxColumn,
            this.кодПользователяDataGridViewTextBoxColumn,
            this.кодФильмаDataGridViewTextBoxColumn});
            this.dataGridView.DataSource = this.историяBindingSource;
            dataGridViewCellStyle1.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleLeft;
            dataGridViewCellStyle1.BackColor = System.Drawing.Color.LemonChiffon;
            dataGridViewCellStyle1.Font = new System.Drawing.Font("Microsoft Sans Serif", 7.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            dataGridViewCellStyle1.ForeColor = System.Drawing.SystemColors.ControlText;
            dataGridViewCellStyle1.SelectionBackColor = System.Drawing.SystemColors.Highlight;
            dataGridViewCellStyle1.SelectionForeColor = System.Drawing.SystemColors.HighlightText;
            dataGridViewCellStyle1.WrapMode = System.Windows.Forms.DataGridViewTriState.True;
            this.dataGridView.DefaultCellStyle = dataGridViewCellStyle1;
            this.dataGridView.Location = new System.Drawing.Point(3, 62);
            this.dataGridView.MultiSelect = false;
            this.dataGridView.Name = "dataGridView";
            this.dataGridView.ReadOnly = true;
            this.dataGridView.RowHeadersWidthSizeMode = System.Windows.Forms.DataGridViewRowHeadersWidthSizeMode.AutoSizeToDisplayedHeaders;
            this.dataGridView.RowTemplate.Height = 24;
            this.dataGridView.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.FullRowSelect;
            this.dataGridView.Size = new System.Drawing.Size(1491, 552);
            this.dataGridView.TabIndex = 14;
            this.dataGridView.CellDoubleClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.DataGridView_CellDoubleClick);
            // 
            // пользовательDataGridViewTextBoxColumn
            // 
            this.пользовательDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.пользовательDataGridViewTextBoxColumn.DataPropertyName = "Пользователь";
            this.пользовательDataGridViewTextBoxColumn.HeaderText = "Пользователь";
            this.пользовательDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.пользовательDataGridViewTextBoxColumn.Name = "пользовательDataGridViewTextBoxColumn";
            this.пользовательDataGridViewTextBoxColumn.ReadOnly = true;
            this.пользовательDataGridViewTextBoxColumn.Width = 130;
            // 
            // фильмDataGridViewTextBoxColumn
            // 
            this.фильмDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.фильмDataGridViewTextBoxColumn.DataPropertyName = "Фильм";
            this.фильмDataGridViewTextBoxColumn.HeaderText = "Фильм";
            this.фильмDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.фильмDataGridViewTextBoxColumn.Name = "фильмDataGridViewTextBoxColumn";
            this.фильмDataGridViewTextBoxColumn.ReadOnly = true;
            this.фильмDataGridViewTextBoxColumn.Width = 82;
            // 
            // режиссерDataGridViewTextBoxColumn
            // 
            this.режиссерDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.Fill;
            this.режиссерDataGridViewTextBoxColumn.DataPropertyName = "Режиссер";
            this.режиссерDataGridViewTextBoxColumn.HeaderText = "Режиссер";
            this.режиссерDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.режиссерDataGridViewTextBoxColumn.Name = "режиссерDataGridViewTextBoxColumn";
            this.режиссерDataGridViewTextBoxColumn.ReadOnly = true;
            // 
            // странаDataGridViewTextBoxColumn
            // 
            this.странаDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.странаDataGridViewTextBoxColumn.DataPropertyName = "Страна";
            this.странаDataGridViewTextBoxColumn.HeaderText = "Страна";
            this.странаDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.странаDataGridViewTextBoxColumn.Name = "странаDataGridViewTextBoxColumn";
            this.странаDataGridViewTextBoxColumn.ReadOnly = true;
            this.странаDataGridViewTextBoxColumn.Width = 85;
            // 
            // годВыходаDataGridViewTextBoxColumn
            // 
            this.годВыходаDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.годВыходаDataGridViewTextBoxColumn.DataPropertyName = "Год выхода";
            this.годВыходаDataGridViewTextBoxColumn.HeaderText = "Год выхода";
            this.годВыходаDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.годВыходаDataGridViewTextBoxColumn.Name = "годВыходаDataGridViewTextBoxColumn";
            this.годВыходаDataGridViewTextBoxColumn.ReadOnly = true;
            this.годВыходаDataGridViewTextBoxColumn.Width = 112;
            // 
            // датаВзятияDataGridViewTextBoxColumn
            // 
            this.датаВзятияDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.датаВзятияDataGridViewTextBoxColumn.DataPropertyName = "Дата взятия";
            this.датаВзятияDataGridViewTextBoxColumn.HeaderText = "Дата взятия";
            this.датаВзятияDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.датаВзятияDataGridViewTextBoxColumn.Name = "датаВзятияDataGridViewTextBoxColumn";
            this.датаВзятияDataGridViewTextBoxColumn.ReadOnly = true;
            this.датаВзятияDataGridViewTextBoxColumn.Width = 120;
            // 
            // датаВозвратаDataGridViewTextBoxColumn
            // 
            this.датаВозвратаDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.датаВозвратаDataGridViewTextBoxColumn.DataPropertyName = "Дата Возврата";
            this.датаВозвратаDataGridViewTextBoxColumn.HeaderText = "Дата Возврата";
            this.датаВозвратаDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.датаВозвратаDataGridViewTextBoxColumn.Name = "датаВозвратаDataGridViewTextBoxColumn";
            this.датаВозвратаDataGridViewTextBoxColumn.ReadOnly = true;
            this.датаВозвратаDataGridViewTextBoxColumn.Visible = false;
            this.датаВозвратаDataGridViewTextBoxColumn.Width = 125;
            // 
            // кодЗаписиDataGridViewTextBoxColumn
            // 
            this.кодЗаписиDataGridViewTextBoxColumn.DataPropertyName = "Код";
            this.кодЗаписиDataGridViewTextBoxColumn.HeaderText = "Код";
            this.кодЗаписиDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.кодЗаписиDataGridViewTextBoxColumn.Name = "кодЗаписиDataGridViewTextBoxColumn";
            this.кодЗаписиDataGridViewTextBoxColumn.ReadOnly = true;
            this.кодЗаписиDataGridViewTextBoxColumn.Visible = false;
            this.кодЗаписиDataGridViewTextBoxColumn.Width = 62;
            // 
            // кодПользователяDataGridViewTextBoxColumn
            // 
            this.кодПользователяDataGridViewTextBoxColumn.DataPropertyName = "Код пользователя";
            this.кодПользователяDataGridViewTextBoxColumn.HeaderText = "Код пользователя";
            this.кодПользователяDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.кодПользователяDataGridViewTextBoxColumn.Name = "кодПользователяDataGridViewTextBoxColumn";
            this.кодПользователяDataGridViewTextBoxColumn.ReadOnly = true;
            this.кодПользователяDataGridViewTextBoxColumn.Visible = false;
            this.кодПользователяDataGridViewTextBoxColumn.Width = 158;
            // 
            // кодФильмаDataGridViewTextBoxColumn
            // 
            this.кодФильмаDataGridViewTextBoxColumn.DataPropertyName = "Код фильма";
            this.кодФильмаDataGridViewTextBoxColumn.HeaderText = "Код фильма";
            this.кодФильмаDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.кодФильмаDataGridViewTextBoxColumn.Name = "кодФильмаDataGridViewTextBoxColumn";
            this.кодФильмаDataGridViewTextBoxColumn.ReadOnly = true;
            this.кодФильмаDataGridViewTextBoxColumn.Visible = false;
            this.кодФильмаDataGridViewTextBoxColumn.Width = 117;
            // 
            // историяBindingSource
            // 
            this.историяBindingSource.DataMember = "История";
            this.историяBindingSource.DataSource = this.databaseDataSet;
            // 
            // panel2
            // 
            this.panel2.Controls.Add(this.buttonResetSearch);
            this.panel2.Controls.Add(this.buttonSearchProducer);
            this.panel2.Controls.Add(this.textBoxSearchProducer);
            this.panel2.Controls.Add(this.label3);
            this.panel2.Controls.Add(this.buttonSearchName);
            this.panel2.Controls.Add(this.textBoxSearchName);
            this.panel2.Controls.Add(this.label2);
            this.panel2.Controls.Add(this.buttonSearchUser);
            this.panel2.Controls.Add(this.textBoxSearchUser);
            this.panel2.Controls.Add(this.label7);
            this.panel2.Location = new System.Drawing.Point(11, 640);
            this.panel2.Name = "panel2";
            this.panel2.Size = new System.Drawing.Size(1244, 172);
            this.panel2.TabIndex = 20;
            // 
            // buttonResetSearch
            // 
            this.buttonResetSearch.BackColor = System.Drawing.Color.MediumVioletRed;
            this.buttonResetSearch.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonResetSearch.Font = new System.Drawing.Font("Neucha", 16.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonResetSearch.ForeColor = System.Drawing.SystemColors.ButtonHighlight;
            this.buttonResetSearch.Location = new System.Drawing.Point(964, 56);
            this.buttonResetSearch.Name = "buttonResetSearch";
            this.buttonResetSearch.Size = new System.Drawing.Size(215, 63);
            this.buttonResetSearch.TabIndex = 27;
            this.buttonResetSearch.Text = "Сбросить";
            this.buttonResetSearch.UseVisualStyleBackColor = false;
            this.buttonResetSearch.Click += new System.EventHandler(this.ButtonResetSearch_Click);
            // 
            // buttonSearchProducer
            // 
            this.buttonSearchProducer.BackColor = System.Drawing.Color.Plum;
            this.buttonSearchProducer.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonSearchProducer.Font = new System.Drawing.Font("Neucha", 16.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonSearchProducer.Location = new System.Drawing.Point(650, 90);
            this.buttonSearchProducer.Name = "buttonSearchProducer";
            this.buttonSearchProducer.Size = new System.Drawing.Size(233, 49);
            this.buttonSearchProducer.TabIndex = 29;
            this.buttonSearchProducer.Text = "Поиск";
            this.buttonSearchProducer.UseVisualStyleBackColor = false;
            this.buttonSearchProducer.Click += new System.EventHandler(this.ButtonSearchProducer_Click);
            // 
            // textBoxSearchProducer
            // 
            this.textBoxSearchProducer.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxSearchProducer.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxSearchProducer.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxSearchProducer.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxSearchProducer.Location = new System.Drawing.Point(650, 47);
            this.textBoxSearchProducer.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxSearchProducer.Name = "textBoxSearchProducer";
            this.textBoxSearchProducer.Size = new System.Drawing.Size(233, 36);
            this.textBoxSearchProducer.TabIndex = 28;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label3.Location = new System.Drawing.Point(646, 14);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(211, 29);
            this.label3.TabIndex = 27;
            this.label3.Text = "Поиск по режиссеру";
            // 
            // buttonSearchName
            // 
            this.buttonSearchName.BackColor = System.Drawing.Color.PaleVioletRed;
            this.buttonSearchName.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonSearchName.Font = new System.Drawing.Font("Neucha", 16.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonSearchName.Location = new System.Drawing.Point(373, 90);
            this.buttonSearchName.Name = "buttonSearchName";
            this.buttonSearchName.Size = new System.Drawing.Size(233, 49);
            this.buttonSearchName.TabIndex = 26;
            this.buttonSearchName.Text = "Поиск";
            this.buttonSearchName.UseVisualStyleBackColor = false;
            this.buttonSearchName.Click += new System.EventHandler(this.ButtonSearchName_Click);
            // 
            // textBoxSearchName
            // 
            this.textBoxSearchName.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxSearchName.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxSearchName.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxSearchName.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxSearchName.Location = new System.Drawing.Point(373, 47);
            this.textBoxSearchName.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxSearchName.Name = "textBoxSearchName";
            this.textBoxSearchName.Size = new System.Drawing.Size(233, 36);
            this.textBoxSearchName.TabIndex = 25;
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label2.Location = new System.Drawing.Point(368, 14);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(196, 29);
            this.label2.TabIndex = 24;
            this.label2.Text = "Поиск по названию";
            // 
            // buttonSearchUser
            // 
            this.buttonSearchUser.BackColor = System.Drawing.Color.Pink;
            this.buttonSearchUser.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonSearchUser.Font = new System.Drawing.Font("Neucha", 16.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonSearchUser.Location = new System.Drawing.Point(44, 90);
            this.buttonSearchUser.Name = "buttonSearchUser";
            this.buttonSearchUser.Size = new System.Drawing.Size(233, 49);
            this.buttonSearchUser.TabIndex = 23;
            this.buttonSearchUser.Text = "Поиск";
            this.buttonSearchUser.UseVisualStyleBackColor = false;
            this.buttonSearchUser.Click += new System.EventHandler(this.ButtonSearchUser_Click);
            // 
            // textBoxSearchUser
            // 
            this.textBoxSearchUser.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxSearchUser.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxSearchUser.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxSearchUser.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxSearchUser.Location = new System.Drawing.Point(44, 47);
            this.textBoxSearchUser.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxSearchUser.Name = "textBoxSearchUser";
            this.textBoxSearchUser.Size = new System.Drawing.Size(233, 36);
            this.textBoxSearchUser.TabIndex = 1;
            // 
            // label7
            // 
            this.label7.AutoSize = true;
            this.label7.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label7.Location = new System.Drawing.Point(39, 14);
            this.label7.Name = "label7";
            this.label7.Size = new System.Drawing.Size(238, 29);
            this.label7.TabIndex = 15;
            this.label7.Text = "Поиск по пользователю";
            // 
            // btnBack
            // 
            this.btnBack.BackColor = System.Drawing.Color.Crimson;
            this.btnBack.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnBack.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.btnBack.ForeColor = System.Drawing.SystemColors.ButtonHighlight;
            this.btnBack.Location = new System.Drawing.Point(1271, 671);
            this.btnBack.Name = "btnBack";
            this.btnBack.Size = new System.Drawing.Size(214, 98);
            this.btnBack.TabIndex = 12;
            this.btnBack.Text = "⬅ Назад";
            this.btnBack.UseVisualStyleBackColor = false;
            this.btnBack.Click += new System.EventHandler(this.BtnBack_Click);
            // 
            // кодDataGridViewTextBoxColumn
            // 
            this.кодDataGridViewTextBoxColumn.DataPropertyName = "Код";
            this.кодDataGridViewTextBoxColumn.HeaderText = "Код";
            this.кодDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.кодDataGridViewTextBoxColumn.Name = "кодDataGridViewTextBoxColumn";
            this.кодDataGridViewTextBoxColumn.Visible = false;
            this.кодDataGridViewTextBoxColumn.Width = 62;
            // 
            // Фамилия
            // 
            this.Фамилия.DataPropertyName = "Фамилия";
            this.Фамилия.HeaderText = "Фамилия";
            this.Фамилия.MinimumWidth = 6;
            this.Фамилия.Name = "Фамилия";
            this.Фамилия.Width = 125;
            // 
            // Имя
            // 
            this.Имя.DataPropertyName = "Имя";
            this.Имя.HeaderText = "Имя";
            this.Имя.MinimumWidth = 6;
            this.Имя.Name = "Имя";
            this.Имя.Width = 125;
            // 
            // Отчество
            // 
            this.Отчество.DataPropertyName = "Отчество";
            this.Отчество.HeaderText = "Отчество";
            this.Отчество.MinimumWidth = 6;
            this.Отчество.Name = "Отчество";
            this.Отчество.Width = 125;
            // 
            // Адрес
            // 
            this.Адрес.DataPropertyName = "Адрес";
            this.Адрес.HeaderText = "Адрес";
            this.Адрес.MinimumWidth = 6;
            this.Адрес.Name = "Адрес";
            this.Адрес.Width = 125;
            // 
            // Код
            // 
            this.Код.DataPropertyName = "Код";
            this.Код.HeaderText = "Код";
            this.Код.MinimumWidth = 6;
            this.Код.Name = "Код";
            this.Код.Width = 125;
            // 
            // dataGridViewTextBoxColumn1
            // 
            this.dataGridViewTextBoxColumn1.DataPropertyName = "Фамилия";
            this.dataGridViewTextBoxColumn1.HeaderText = "Фамилия";
            this.dataGridViewTextBoxColumn1.MinimumWidth = 6;
            this.dataGridViewTextBoxColumn1.Name = "dataGridViewTextBoxColumn1";
            this.dataGridViewTextBoxColumn1.Width = 125;
            // 
            // dataGridViewTextBoxColumn2
            // 
            this.dataGridViewTextBoxColumn2.DataPropertyName = "Имя";
            this.dataGridViewTextBoxColumn2.HeaderText = "Имя";
            this.dataGridViewTextBoxColumn2.MinimumWidth = 6;
            this.dataGridViewTextBoxColumn2.Name = "dataGridViewTextBoxColumn2";
            this.dataGridViewTextBoxColumn2.Width = 125;
            // 
            // dataGridViewTextBoxColumn3
            // 
            this.dataGridViewTextBoxColumn3.DataPropertyName = "Отчество";
            this.dataGridViewTextBoxColumn3.HeaderText = "Отчество";
            this.dataGridViewTextBoxColumn3.MinimumWidth = 6;
            this.dataGridViewTextBoxColumn3.Name = "dataGridViewTextBoxColumn3";
            this.dataGridViewTextBoxColumn3.Width = 125;
            // 
            // dataGridViewTextBoxColumn4
            // 
            this.dataGridViewTextBoxColumn4.DataPropertyName = "Адрес";
            this.dataGridViewTextBoxColumn4.HeaderText = "Адрес";
            this.dataGridViewTextBoxColumn4.MinimumWidth = 6;
            this.dataGridViewTextBoxColumn4.Name = "dataGridViewTextBoxColumn4";
            this.dataGridViewTextBoxColumn4.Width = 125;
            // 
            // историяTableAdapter
            // 
            this.историяTableAdapter.ClearBeforeFill = true;
            // 
            // пользователиTableAdapter
            // 
            this.пользователиTableAdapter.ClearBeforeFill = true;
            // 
            // фильмыTableAdapter
            // 
            this.фильмыTableAdapter.ClearBeforeFill = true;
            // 
            // FormFilmReceive
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.PeachPuff;
            this.ClientSize = new System.Drawing.Size(1532, 839);
            this.Controls.Add(this.panelUser);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "FormFilmReceive";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Вернуть фильм";
            this.Load += new System.EventHandler(this.FormFilmReceive_Load);
            ((System.ComponentModel.ISupportInitialize)(this.databaseDataSet)).EndInit();
            this.panelUser.ResumeLayout(false);
            this.panelUser.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridView)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.историяBindingSource)).EndInit();
            this.panel2.ResumeLayout(false);
            this.panel2.PerformLayout();
            this.ResumeLayout(false);

        }

        #endregion
        private System.Windows.Forms.Panel panelUser;
        private System.Windows.Forms.DataGridView dataGridView;
        private System.Windows.Forms.Panel panel2;
        private System.Windows.Forms.Button buttonSearchUser;
        private System.Windows.Forms.TextBox textBoxSearchUser;
        private System.Windows.Forms.Label label7;
        private System.Windows.Forms.Button btnBack;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn Фамилия;
        private System.Windows.Forms.DataGridViewTextBoxColumn Имя;
        private System.Windows.Forms.DataGridViewTextBoxColumn Отчество;
        private System.Windows.Forms.DataGridViewTextBoxColumn Адрес;
        private System.Windows.Forms.DataGridViewTextBoxColumn Код;
        private System.Windows.Forms.DataGridViewTextBoxColumn dataGridViewTextBoxColumn1;
        private System.Windows.Forms.DataGridViewTextBoxColumn dataGridViewTextBoxColumn2;
        private System.Windows.Forms.DataGridViewTextBoxColumn dataGridViewTextBoxColumn3;
        private System.Windows.Forms.DataGridViewTextBoxColumn dataGridViewTextBoxColumn4;
        private System.Windows.Forms.Button buttonResetSearch;
        private DatabaseDataSet databaseDataSet;
        private System.Windows.Forms.Label label8;
        private System.Windows.Forms.BindingSource историяBindingSource;
        private DatabaseDataSetTableAdapters.ИсторияTableAdapter историяTableAdapter;
        private System.Windows.Forms.Button buttonSearchProducer;
        private System.Windows.Forms.TextBox textBoxSearchProducer;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Button buttonSearchName;
        private System.Windows.Forms.TextBox textBoxSearchName;
        private System.Windows.Forms.Label label2;
        private DatabaseDataSetTableAdapters.ПользователиTableAdapter пользователиTableAdapter;
        private DatabaseDataSetTableAdapters.ФильмыTableAdapter фильмыTableAdapter;
        private System.Windows.Forms.DataGridViewTextBoxColumn пользовательDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn фильмDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn режиссерDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn странаDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn годВыходаDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn датаВзятияDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn датаВозвратаDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодЗаписиDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодПользователяDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодФильмаDataGridViewTextBoxColumn;
    }
}