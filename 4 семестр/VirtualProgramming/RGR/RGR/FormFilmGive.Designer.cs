namespace RGR
{
    partial class FormFilmGive
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
            System.Windows.Forms.DataGridViewCellStyle dataGridViewCellStyle2 = new System.Windows.Forms.DataGridViewCellStyle();
            this.btnBackFilm = new System.Windows.Forms.Button();
            this.dataGridViewFilm = new System.Windows.Forms.DataGridView();
            this.фильмыBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.databaseDataSet = new RGR.DatabaseDataSet();
            this.panelFilmSearch = new System.Windows.Forms.Panel();
            this.buttonResetFilm = new System.Windows.Forms.Button();
            this.buttonSearchActor = new System.Windows.Forms.Button();
            this.textBoxSearchActor = new System.Windows.Forms.TextBox();
            this.label4 = new System.Windows.Forms.Label();
            this.buttonSearchGenre = new System.Windows.Forms.Button();
            this.textBoxSearchGenre = new System.Windows.Forms.TextBox();
            this.label3 = new System.Windows.Forms.Label();
            this.buttonSearchName = new System.Windows.Forms.Button();
            this.textBoxSearchName = new System.Windows.Forms.TextBox();
            this.label2 = new System.Windows.Forms.Label();
            this.panelFilm = new System.Windows.Forms.Panel();
            this.label1 = new System.Windows.Forms.Label();
            this.panelUser = new System.Windows.Forms.Panel();
            this.label8 = new System.Windows.Forms.Label();
            this.dataGridViewUser = new System.Windows.Forms.DataGridView();
            this.пользователиBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.panel2 = new System.Windows.Forms.Panel();
            this.buttonResetUser = new System.Windows.Forms.Button();
            this.label9 = new System.Windows.Forms.Label();
            this.label6 = new System.Windows.Forms.Label();
            this.label5 = new System.Windows.Forms.Label();
            this.buttonSearchUser = new System.Windows.Forms.Button();
            this.textBoxSearchUserO = new System.Windows.Forms.TextBox();
            this.textBoxSearchUserI = new System.Windows.Forms.TextBox();
            this.textBoxSearchUserF = new System.Windows.Forms.TextBox();
            this.label7 = new System.Windows.Forms.Label();
            this.btnBack2 = new System.Windows.Forms.Button();
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
            this.фильмыTableAdapter = new RGR.DatabaseDataSetTableAdapters.ФильмыTableAdapter();
            this.пользователиTableAdapter = new RGR.DatabaseDataSetTableAdapters.ПользователиTableAdapter();
            this.фамилияDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.имяDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.отчествоDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.адресDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.кодПользователяDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.кодФильмаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.названиеDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.жанрDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.режиссерDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.странаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.годDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.актерыDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.краткаяАннотацияDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.отсутствуетDataGridViewCheckBoxColumn = new System.Windows.Forms.DataGridViewCheckBoxColumn();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewFilm)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.фильмыBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.databaseDataSet)).BeginInit();
            this.panelFilmSearch.SuspendLayout();
            this.panelFilm.SuspendLayout();
            this.panelUser.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewUser)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.пользователиBindingSource)).BeginInit();
            this.panel2.SuspendLayout();
            this.SuspendLayout();
            // 
            // btnBackFilm
            // 
            this.btnBackFilm.BackColor = System.Drawing.Color.Crimson;
            this.btnBackFilm.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnBackFilm.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.btnBackFilm.ForeColor = System.Drawing.SystemColors.ButtonHighlight;
            this.btnBackFilm.Location = new System.Drawing.Point(1265, 689);
            this.btnBackFilm.Name = "btnBackFilm";
            this.btnBackFilm.Size = new System.Drawing.Size(214, 79);
            this.btnBackFilm.TabIndex = 12;
            this.btnBackFilm.Text = "⬅ Назад";
            this.btnBackFilm.UseVisualStyleBackColor = false;
            this.btnBackFilm.Click += new System.EventHandler(this.BtnBack_Click);
            // 
            // dataGridViewFilm
            // 
            this.dataGridViewFilm.AllowUserToAddRows = false;
            this.dataGridViewFilm.AllowUserToDeleteRows = false;
            this.dataGridViewFilm.AllowUserToOrderColumns = true;
            this.dataGridViewFilm.AutoGenerateColumns = false;
            this.dataGridViewFilm.AutoSizeColumnsMode = System.Windows.Forms.DataGridViewAutoSizeColumnsMode.AllCells;
            this.dataGridViewFilm.AutoSizeRowsMode = System.Windows.Forms.DataGridViewAutoSizeRowsMode.AllCells;
            this.dataGridViewFilm.BackgroundColor = System.Drawing.Color.LightYellow;
            this.dataGridViewFilm.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dataGridViewFilm.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.кодФильмаDataGridViewTextBoxColumn,
            this.названиеDataGridViewTextBoxColumn,
            this.жанрDataGridViewTextBoxColumn,
            this.режиссерDataGridViewTextBoxColumn,
            this.странаDataGridViewTextBoxColumn,
            this.годDataGridViewTextBoxColumn,
            this.актерыDataGridViewTextBoxColumn,
            this.краткаяАннотацияDataGridViewTextBoxColumn,
            this.отсутствуетDataGridViewCheckBoxColumn});
            this.dataGridViewFilm.DataSource = this.фильмыBindingSource;
            dataGridViewCellStyle1.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleLeft;
            dataGridViewCellStyle1.BackColor = System.Drawing.Color.LemonChiffon;
            dataGridViewCellStyle1.Font = new System.Drawing.Font("Microsoft Sans Serif", 7.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            dataGridViewCellStyle1.ForeColor = System.Drawing.SystemColors.ControlText;
            dataGridViewCellStyle1.SelectionBackColor = System.Drawing.SystemColors.Highlight;
            dataGridViewCellStyle1.SelectionForeColor = System.Drawing.SystemColors.HighlightText;
            dataGridViewCellStyle1.WrapMode = System.Windows.Forms.DataGridViewTriState.True;
            this.dataGridViewFilm.DefaultCellStyle = dataGridViewCellStyle1;
            this.dataGridViewFilm.Location = new System.Drawing.Point(11, 72);
            this.dataGridViewFilm.Name = "dataGridViewFilm";
            this.dataGridViewFilm.ReadOnly = true;
            this.dataGridViewFilm.RowHeadersWidthSizeMode = System.Windows.Forms.DataGridViewRowHeadersWidthSizeMode.AutoSizeToDisplayedHeaders;
            this.dataGridViewFilm.RowTemplate.Height = 24;
            this.dataGridViewFilm.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.FullRowSelect;
            this.dataGridViewFilm.Size = new System.Drawing.Size(1491, 552);
            this.dataGridViewFilm.TabIndex = 14;
            this.dataGridViewFilm.CellMouseDoubleClick += new System.Windows.Forms.DataGridViewCellMouseEventHandler(this.DataGridViewFilm_CellMouseDoubleClick);
            this.dataGridViewFilm.SelectionChanged += new System.EventHandler(this.DataGridViewFilm_SelectionChanged);
            // 
            // фильмыBindingSource
            // 
            this.фильмыBindingSource.DataMember = "Фильмы";
            this.фильмыBindingSource.DataSource = this.databaseDataSet;
            // 
            // databaseDataSet
            // 
            this.databaseDataSet.DataSetName = "DatabaseDataSet";
            this.databaseDataSet.SchemaSerializationMode = System.Data.SchemaSerializationMode.IncludeSchema;
            // 
            // panelFilmSearch
            // 
            this.panelFilmSearch.Controls.Add(this.buttonResetFilm);
            this.panelFilmSearch.Controls.Add(this.buttonSearchActor);
            this.panelFilmSearch.Controls.Add(this.textBoxSearchActor);
            this.panelFilmSearch.Controls.Add(this.label4);
            this.panelFilmSearch.Controls.Add(this.buttonSearchGenre);
            this.panelFilmSearch.Controls.Add(this.textBoxSearchGenre);
            this.panelFilmSearch.Controls.Add(this.label3);
            this.panelFilmSearch.Controls.Add(this.buttonSearchName);
            this.panelFilmSearch.Controls.Add(this.textBoxSearchName);
            this.panelFilmSearch.Controls.Add(this.label2);
            this.panelFilmSearch.Location = new System.Drawing.Point(11, 642);
            this.panelFilmSearch.Name = "panelFilmSearch";
            this.panelFilmSearch.Size = new System.Drawing.Size(1241, 160);
            this.panelFilmSearch.TabIndex = 20;
            // 
            // buttonResetFilm
            // 
            this.buttonResetFilm.BackColor = System.Drawing.Color.MediumVioletRed;
            this.buttonResetFilm.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonResetFilm.Font = new System.Drawing.Font("Neucha", 16.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonResetFilm.ForeColor = System.Drawing.SystemColors.ButtonHighlight;
            this.buttonResetFilm.Location = new System.Drawing.Point(967, 64);
            this.buttonResetFilm.Name = "buttonResetFilm";
            this.buttonResetFilm.Size = new System.Drawing.Size(156, 56);
            this.buttonResetFilm.TabIndex = 28;
            this.buttonResetFilm.Text = "Сбросить";
            this.buttonResetFilm.UseVisualStyleBackColor = false;
            // 
            // buttonSearchActor
            // 
            this.buttonSearchActor.BackColor = System.Drawing.Color.Pink;
            this.buttonSearchActor.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonSearchActor.Font = new System.Drawing.Font("Neucha", 16.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonSearchActor.Location = new System.Drawing.Point(716, 99);
            this.buttonSearchActor.Name = "buttonSearchActor";
            this.buttonSearchActor.Size = new System.Drawing.Size(225, 49);
            this.buttonSearchActor.TabIndex = 23;
            this.buttonSearchActor.Text = "Поиск";
            this.buttonSearchActor.UseVisualStyleBackColor = false;
            this.buttonSearchActor.Click += new System.EventHandler(this.ButtonSearchFilm_Click);
            // 
            // textBoxSearchActor
            // 
            this.textBoxSearchActor.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxSearchActor.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxSearchActor.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxSearchActor.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxSearchActor.Location = new System.Drawing.Point(716, 47);
            this.textBoxSearchActor.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxSearchActor.Name = "textBoxSearchActor";
            this.textBoxSearchActor.Size = new System.Drawing.Size(226, 36);
            this.textBoxSearchActor.TabIndex = 22;
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label4.Location = new System.Drawing.Point(711, 10);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(174, 29);
            this.label4.TabIndex = 21;
            this.label4.Text = "Поиск по актеру";
            // 
            // buttonSearchGenre
            // 
            this.buttonSearchGenre.BackColor = System.Drawing.Color.Plum;
            this.buttonSearchGenre.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonSearchGenre.Font = new System.Drawing.Font("Neucha", 16.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonSearchGenre.Location = new System.Drawing.Point(452, 99);
            this.buttonSearchGenre.Name = "buttonSearchGenre";
            this.buttonSearchGenre.Size = new System.Drawing.Size(225, 49);
            this.buttonSearchGenre.TabIndex = 20;
            this.buttonSearchGenre.Text = "Поиск";
            this.buttonSearchGenre.UseVisualStyleBackColor = false;
            this.buttonSearchGenre.Click += new System.EventHandler(this.ButtonSearchFilm_Click);
            // 
            // textBoxSearchGenre
            // 
            this.textBoxSearchGenre.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxSearchGenre.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxSearchGenre.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxSearchGenre.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxSearchGenre.Location = new System.Drawing.Point(452, 47);
            this.textBoxSearchGenre.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxSearchGenre.Name = "textBoxSearchGenre";
            this.textBoxSearchGenre.Size = new System.Drawing.Size(226, 36);
            this.textBoxSearchGenre.TabIndex = 19;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label3.Location = new System.Drawing.Point(447, 10);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(167, 29);
            this.label3.TabIndex = 18;
            this.label3.Text = "Поиск по жанру";
            // 
            // buttonSearchName
            // 
            this.buttonSearchName.BackColor = System.Drawing.Color.PaleVioletRed;
            this.buttonSearchName.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonSearchName.Font = new System.Drawing.Font("Neucha", 16.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonSearchName.Location = new System.Drawing.Point(193, 99);
            this.buttonSearchName.Name = "buttonSearchName";
            this.buttonSearchName.Size = new System.Drawing.Size(225, 49);
            this.buttonSearchName.TabIndex = 17;
            this.buttonSearchName.Text = "Поиск";
            this.buttonSearchName.UseVisualStyleBackColor = false;
            this.buttonSearchName.Click += new System.EventHandler(this.ButtonSearchFilm_Click);
            // 
            // textBoxSearchName
            // 
            this.textBoxSearchName.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxSearchName.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxSearchName.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxSearchName.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxSearchName.Location = new System.Drawing.Point(193, 47);
            this.textBoxSearchName.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxSearchName.Name = "textBoxSearchName";
            this.textBoxSearchName.Size = new System.Drawing.Size(226, 36);
            this.textBoxSearchName.TabIndex = 16;
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label2.Location = new System.Drawing.Point(188, 10);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(196, 29);
            this.label2.TabIndex = 15;
            this.label2.Text = "Поиск по названию";
            // 
            // panelFilm
            // 
            this.panelFilm.Controls.Add(this.label1);
            this.panelFilm.Controls.Add(this.dataGridViewFilm);
            this.panelFilm.Controls.Add(this.panelFilmSearch);
            this.panelFilm.Controls.Add(this.btnBackFilm);
            this.panelFilm.Location = new System.Drawing.Point(12, 12);
            this.panelFilm.Name = "panelFilm";
            this.panelFilm.Size = new System.Drawing.Size(1508, 815);
            this.panelFilm.TabIndex = 21;
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Neucha", 24F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label1.ForeColor = System.Drawing.Color.LimeGreen;
            this.label1.Location = new System.Drawing.Point(283, 16);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(871, 49);
            this.label1.TabIndex = 22;
            this.label1.Text = "Нажмите дважды по фильму, который хотите отдать";
            this.label1.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // panelUser
            // 
            this.panelUser.Controls.Add(this.label8);
            this.panelUser.Controls.Add(this.dataGridViewUser);
            this.panelUser.Controls.Add(this.panel2);
            this.panelUser.Controls.Add(this.btnBack2);
            this.panelUser.Location = new System.Drawing.Point(-50, 13);
            this.panelUser.Name = "panelUser";
            this.panelUser.Size = new System.Drawing.Size(1508, 815);
            this.panelUser.TabIndex = 22;
            this.panelUser.Visible = false;
            // 
            // label8
            // 
            this.label8.AutoSize = true;
            this.label8.Font = new System.Drawing.Font("Neucha", 24F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label8.ForeColor = System.Drawing.Color.DeepSkyBlue;
            this.label8.Location = new System.Drawing.Point(168, 16);
            this.label8.Name = "label8";
            this.label8.Size = new System.Drawing.Size(1143, 49);
            this.label8.TabIndex = 23;
            this.label8.Text = "Нажмите дважды по пользователю, которому вы хотите отдать фильм";
            this.label8.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // dataGridViewUser
            // 
            this.dataGridViewUser.AllowUserToAddRows = false;
            this.dataGridViewUser.AllowUserToDeleteRows = false;
            this.dataGridViewUser.AllowUserToOrderColumns = true;
            this.dataGridViewUser.AutoGenerateColumns = false;
            this.dataGridViewUser.AutoSizeColumnsMode = System.Windows.Forms.DataGridViewAutoSizeColumnsMode.AllCells;
            this.dataGridViewUser.AutoSizeRowsMode = System.Windows.Forms.DataGridViewAutoSizeRowsMode.AllCells;
            this.dataGridViewUser.BackgroundColor = System.Drawing.Color.LightYellow;
            this.dataGridViewUser.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dataGridViewUser.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.фамилияDataGridViewTextBoxColumn,
            this.имяDataGridViewTextBoxColumn,
            this.отчествоDataGridViewTextBoxColumn,
            this.адресDataGridViewTextBoxColumn,
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn,
            this.кодПользователяDataGridViewTextBoxColumn});
            this.dataGridViewUser.DataSource = this.пользователиBindingSource;
            dataGridViewCellStyle2.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleLeft;
            dataGridViewCellStyle2.BackColor = System.Drawing.Color.LemonChiffon;
            dataGridViewCellStyle2.Font = new System.Drawing.Font("Microsoft Sans Serif", 7.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            dataGridViewCellStyle2.ForeColor = System.Drawing.SystemColors.ControlText;
            dataGridViewCellStyle2.SelectionBackColor = System.Drawing.SystemColors.Highlight;
            dataGridViewCellStyle2.SelectionForeColor = System.Drawing.SystemColors.HighlightText;
            dataGridViewCellStyle2.WrapMode = System.Windows.Forms.DataGridViewTriState.True;
            this.dataGridViewUser.DefaultCellStyle = dataGridViewCellStyle2;
            this.dataGridViewUser.Location = new System.Drawing.Point(11, 72);
            this.dataGridViewUser.MultiSelect = false;
            this.dataGridViewUser.Name = "dataGridViewUser";
            this.dataGridViewUser.ReadOnly = true;
            this.dataGridViewUser.RowHeadersWidthSizeMode = System.Windows.Forms.DataGridViewRowHeadersWidthSizeMode.AutoSizeToDisplayedHeaders;
            this.dataGridViewUser.RowTemplate.Height = 24;
            this.dataGridViewUser.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.FullRowSelect;
            this.dataGridViewUser.Size = new System.Drawing.Size(1491, 552);
            this.dataGridViewUser.TabIndex = 14;
            this.dataGridViewUser.CellDoubleClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.DataGridViewUser_CellDoubleClick);
            this.dataGridViewUser.RowPrePaint += new System.Windows.Forms.DataGridViewRowPrePaintEventHandler(this.DataGridViewUser_RowPrePaint);
            this.dataGridViewUser.SelectionChanged += new System.EventHandler(this.DataGridViewUser_SelectionChanged);
            // 
            // пользователиBindingSource
            // 
            this.пользователиBindingSource.DataMember = "Пользователи";
            this.пользователиBindingSource.DataSource = this.databaseDataSet;
            // 
            // panel2
            // 
            this.panel2.Controls.Add(this.buttonResetUser);
            this.panel2.Controls.Add(this.label9);
            this.panel2.Controls.Add(this.label6);
            this.panel2.Controls.Add(this.label5);
            this.panel2.Controls.Add(this.buttonSearchUser);
            this.panel2.Controls.Add(this.textBoxSearchUserO);
            this.panel2.Controls.Add(this.textBoxSearchUserI);
            this.panel2.Controls.Add(this.textBoxSearchUserF);
            this.panel2.Controls.Add(this.label7);
            this.panel2.Location = new System.Drawing.Point(13, 624);
            this.panel2.Name = "panel2";
            this.panel2.Size = new System.Drawing.Size(1207, 172);
            this.panel2.TabIndex = 20;
            // 
            // buttonResetUser
            // 
            this.buttonResetUser.BackColor = System.Drawing.Color.MediumVioletRed;
            this.buttonResetUser.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonResetUser.Font = new System.Drawing.Font("Neucha", 16.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonResetUser.ForeColor = System.Drawing.SystemColors.ButtonHighlight;
            this.buttonResetUser.Location = new System.Drawing.Point(682, 56);
            this.buttonResetUser.Name = "buttonResetUser";
            this.buttonResetUser.Size = new System.Drawing.Size(225, 92);
            this.buttonResetUser.TabIndex = 27;
            this.buttonResetUser.Text = "Сбросить";
            this.buttonResetUser.UseVisualStyleBackColor = false;
            this.buttonResetUser.Click += new System.EventHandler(this.ButtonResetSearchUser_Click);
            // 
            // label9
            // 
            this.label9.AutoSize = true;
            this.label9.Font = new System.Drawing.Font("Neucha", 10.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label9.Location = new System.Drawing.Point(57, 139);
            this.label9.Name = "label9";
            this.label9.Size = new System.Drawing.Size(68, 21);
            this.label9.TabIndex = 26;
            this.label9.Text = "Отчество";
            this.label9.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // label6
            // 
            this.label6.AutoSize = true;
            this.label6.Font = new System.Drawing.Font("Neucha", 10.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label6.Location = new System.Drawing.Point(89, 95);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(35, 21);
            this.label6.TabIndex = 25;
            this.label6.Text = "Имя";
            this.label6.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Font = new System.Drawing.Font("Neucha", 10.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label5.Location = new System.Drawing.Point(57, 51);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(67, 21);
            this.label5.TabIndex = 24;
            this.label5.Text = "Фамилия";
            this.label5.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // buttonSearchUser
            // 
            this.buttonSearchUser.BackColor = System.Drawing.Color.Pink;
            this.buttonSearchUser.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonSearchUser.Font = new System.Drawing.Font("Neucha", 16.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonSearchUser.Location = new System.Drawing.Point(428, 56);
            this.buttonSearchUser.Name = "buttonSearchUser";
            this.buttonSearchUser.Size = new System.Drawing.Size(225, 92);
            this.buttonSearchUser.TabIndex = 23;
            this.buttonSearchUser.Text = "Поиск";
            this.buttonSearchUser.UseVisualStyleBackColor = false;
            this.buttonSearchUser.Click += new System.EventHandler(this.ButtonSearchUser_Click);
            // 
            // textBoxSearchUserO
            // 
            this.textBoxSearchUserO.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxSearchUserO.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxSearchUserO.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxSearchUserO.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxSearchUserO.Location = new System.Drawing.Point(131, 132);
            this.textBoxSearchUserO.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxSearchUserO.Name = "textBoxSearchUserO";
            this.textBoxSearchUserO.Size = new System.Drawing.Size(226, 36);
            this.textBoxSearchUserO.TabIndex = 22;
            // 
            // textBoxSearchUserI
            // 
            this.textBoxSearchUserI.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxSearchUserI.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxSearchUserI.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxSearchUserI.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxSearchUserI.Location = new System.Drawing.Point(131, 88);
            this.textBoxSearchUserI.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxSearchUserI.Name = "textBoxSearchUserI";
            this.textBoxSearchUserI.Size = new System.Drawing.Size(226, 36);
            this.textBoxSearchUserI.TabIndex = 19;
            // 
            // textBoxSearchUserF
            // 
            this.textBoxSearchUserF.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxSearchUserF.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxSearchUserF.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxSearchUserF.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxSearchUserF.Location = new System.Drawing.Point(131, 44);
            this.textBoxSearchUserF.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxSearchUserF.Name = "textBoxSearchUserF";
            this.textBoxSearchUserF.Size = new System.Drawing.Size(226, 36);
            this.textBoxSearchUserF.TabIndex = 16;
            // 
            // label7
            // 
            this.label7.AutoSize = true;
            this.label7.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label7.Location = new System.Drawing.Point(13, 11);
            this.label7.Name = "label7";
            this.label7.Size = new System.Drawing.Size(150, 29);
            this.label7.TabIndex = 15;
            this.label7.Text = "Поиск по ФИО";
            // 
            // btnBack2
            // 
            this.btnBack2.BackColor = System.Drawing.Color.Crimson;
            this.btnBack2.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnBack2.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.btnBack2.ForeColor = System.Drawing.SystemColors.ButtonHighlight;
            this.btnBack2.Location = new System.Drawing.Point(1261, 688);
            this.btnBack2.Name = "btnBack2";
            this.btnBack2.Size = new System.Drawing.Size(214, 79);
            this.btnBack2.TabIndex = 12;
            this.btnBack2.Text = "⬅ Назад";
            this.btnBack2.UseVisualStyleBackColor = false;
            this.btnBack2.Click += new System.EventHandler(this.BtnBackStep_Click);
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
            // фильмыTableAdapter
            // 
            this.фильмыTableAdapter.ClearBeforeFill = true;
            // 
            // пользователиTableAdapter
            // 
            this.пользователиTableAdapter.ClearBeforeFill = true;
            // 
            // фамилияDataGridViewTextBoxColumn
            // 
            this.фамилияDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.фамилияDataGridViewTextBoxColumn.DataPropertyName = "Фамилия";
            this.фамилияDataGridViewTextBoxColumn.HeaderText = "Фамилия";
            this.фамилияDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.фамилияDataGridViewTextBoxColumn.Name = "фамилияDataGridViewTextBoxColumn";
            this.фамилияDataGridViewTextBoxColumn.ReadOnly = true;
            this.фамилияDataGridViewTextBoxColumn.Width = 99;
            // 
            // имяDataGridViewTextBoxColumn
            // 
            this.имяDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.имяDataGridViewTextBoxColumn.DataPropertyName = "Имя";
            this.имяDataGridViewTextBoxColumn.HeaderText = "Имя";
            this.имяDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.имяDataGridViewTextBoxColumn.Name = "имяDataGridViewTextBoxColumn";
            this.имяDataGridViewTextBoxColumn.ReadOnly = true;
            this.имяDataGridViewTextBoxColumn.Width = 64;
            // 
            // отчествоDataGridViewTextBoxColumn
            // 
            this.отчествоDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.отчествоDataGridViewTextBoxColumn.DataPropertyName = "Отчество";
            this.отчествоDataGridViewTextBoxColumn.HeaderText = "Отчество";
            this.отчествоDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.отчествоDataGridViewTextBoxColumn.Name = "отчествоDataGridViewTextBoxColumn";
            this.отчествоDataGridViewTextBoxColumn.ReadOnly = true;
            // 
            // адресDataGridViewTextBoxColumn
            // 
            this.адресDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.Fill;
            this.адресDataGridViewTextBoxColumn.DataPropertyName = "Адрес";
            this.адресDataGridViewTextBoxColumn.HeaderText = "Адрес";
            this.адресDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.адресDataGridViewTextBoxColumn.Name = "адресDataGridViewTextBoxColumn";
            this.адресDataGridViewTextBoxColumn.ReadOnly = true;
            // 
            // датаПоследнегоПосещенияDataGridViewTextBoxColumn
            // 
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn.DataPropertyName = "Дата последнего посещения";
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn.HeaderText = "Дата последнего посещения";
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn.Name = "датаПоследнегоПосещенияDataGridViewTextBoxColumn";
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn.ReadOnly = true;
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn.Width = 208;
            // 
            // кодПользователяDataGridViewTextBoxColumn
            // 
            this.кодПользователяDataGridViewTextBoxColumn.DataPropertyName = "Код";
            this.кодПользователяDataGridViewTextBoxColumn.HeaderText = "Код";
            this.кодПользователяDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.кодПользователяDataGridViewTextBoxColumn.Name = "кодПользователяDataGridViewTextBoxColumn";
            this.кодПользователяDataGridViewTextBoxColumn.ReadOnly = true;
            this.кодПользователяDataGridViewTextBoxColumn.Visible = false;
            this.кодПользователяDataGridViewTextBoxColumn.Width = 62;
            // 
            // кодФильмаDataGridViewTextBoxColumn
            // 
            this.кодФильмаDataGridViewTextBoxColumn.DataPropertyName = "Код";
            this.кодФильмаDataGridViewTextBoxColumn.HeaderText = "Код";
            this.кодФильмаDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.кодФильмаDataGridViewTextBoxColumn.Name = "кодФильмаDataGridViewTextBoxColumn";
            this.кодФильмаDataGridViewTextBoxColumn.ReadOnly = true;
            this.кодФильмаDataGridViewTextBoxColumn.Visible = false;
            this.кодФильмаDataGridViewTextBoxColumn.Width = 62;
            // 
            // названиеDataGridViewTextBoxColumn
            // 
            this.названиеDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.названиеDataGridViewTextBoxColumn.DataPropertyName = "Название";
            this.названиеDataGridViewTextBoxColumn.HeaderText = "Название";
            this.названиеDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.названиеDataGridViewTextBoxColumn.Name = "названиеDataGridViewTextBoxColumn";
            this.названиеDataGridViewTextBoxColumn.ReadOnly = true;
            this.названиеDataGridViewTextBoxColumn.Width = 101;
            // 
            // жанрDataGridViewTextBoxColumn
            // 
            this.жанрDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.жанрDataGridViewTextBoxColumn.DataPropertyName = "Жанр";
            this.жанрDataGridViewTextBoxColumn.HeaderText = "Жанр";
            this.жанрDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.жанрDataGridViewTextBoxColumn.Name = "жанрDataGridViewTextBoxColumn";
            this.жанрDataGridViewTextBoxColumn.ReadOnly = true;
            this.жанрDataGridViewTextBoxColumn.Width = 74;
            // 
            // режиссерDataGridViewTextBoxColumn
            // 
            this.режиссерDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.режиссерDataGridViewTextBoxColumn.DataPropertyName = "Режиссер";
            this.режиссерDataGridViewTextBoxColumn.HeaderText = "Режиссер";
            this.режиссерDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.режиссерDataGridViewTextBoxColumn.Name = "режиссерDataGridViewTextBoxColumn";
            this.режиссерDataGridViewTextBoxColumn.ReadOnly = true;
            this.режиссерDataGridViewTextBoxColumn.Width = 101;
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
            // годDataGridViewTextBoxColumn
            // 
            this.годDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.годDataGridViewTextBoxColumn.DataPropertyName = "Год";
            this.годDataGridViewTextBoxColumn.HeaderText = "Год";
            this.годDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.годDataGridViewTextBoxColumn.Name = "годDataGridViewTextBoxColumn";
            this.годDataGridViewTextBoxColumn.ReadOnly = true;
            this.годDataGridViewTextBoxColumn.Width = 61;
            // 
            // актерыDataGridViewTextBoxColumn
            // 
            this.актерыDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.актерыDataGridViewTextBoxColumn.DataPropertyName = "Актеры";
            this.актерыDataGridViewTextBoxColumn.HeaderText = "Актеры";
            this.актерыDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.актерыDataGridViewTextBoxColumn.Name = "актерыDataGridViewTextBoxColumn";
            this.актерыDataGridViewTextBoxColumn.ReadOnly = true;
            this.актерыDataGridViewTextBoxColumn.Width = 86;
            // 
            // краткаяАннотацияDataGridViewTextBoxColumn
            // 
            this.краткаяАннотацияDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.Fill;
            this.краткаяАннотацияDataGridViewTextBoxColumn.DataPropertyName = "Краткая аннотация";
            this.краткаяАннотацияDataGridViewTextBoxColumn.HeaderText = "Краткая аннотация";
            this.краткаяАннотацияDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.краткаяАннотацияDataGridViewTextBoxColumn.Name = "краткаяАннотацияDataGridViewTextBoxColumn";
            this.краткаяАннотацияDataGridViewTextBoxColumn.ReadOnly = true;
            // 
            // отсутствуетDataGridViewCheckBoxColumn
            // 
            this.отсутствуетDataGridViewCheckBoxColumn.DataPropertyName = "Отсутствует";
            this.отсутствуетDataGridViewCheckBoxColumn.HeaderText = "Отсутствует";
            this.отсутствуетDataGridViewCheckBoxColumn.MinimumWidth = 6;
            this.отсутствуетDataGridViewCheckBoxColumn.Name = "отсутствуетDataGridViewCheckBoxColumn";
            this.отсутствуетDataGridViewCheckBoxColumn.ReadOnly = true;
            this.отсутствуетDataGridViewCheckBoxColumn.Visible = false;
            this.отсутствуетDataGridViewCheckBoxColumn.Width = 96;
            // 
            // FormFilmGive
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.PeachPuff;
            this.ClientSize = new System.Drawing.Size(1532, 839);
            this.Controls.Add(this.panelUser);
            this.Controls.Add(this.panelFilm);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "FormFilmGive";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Отдать фильм";
            this.Load += new System.EventHandler(this.FormFilmGive_Load);
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewFilm)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.фильмыBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.databaseDataSet)).EndInit();
            this.panelFilmSearch.ResumeLayout(false);
            this.panelFilmSearch.PerformLayout();
            this.panelFilm.ResumeLayout(false);
            this.panelFilm.PerformLayout();
            this.panelUser.ResumeLayout(false);
            this.panelUser.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewUser)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.пользователиBindingSource)).EndInit();
            this.panel2.ResumeLayout(false);
            this.panel2.PerformLayout();
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.Button btnBackFilm;
        private System.Windows.Forms.DataGridView dataGridViewFilm;
        private DatabaseDataSetTableAdapters.ИсторияTableAdapter историяTableAdapter;
        private System.Windows.Forms.Panel panelFilmSearch;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Button buttonSearchActor;
        private System.Windows.Forms.TextBox textBoxSearchActor;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Button buttonSearchGenre;
        private System.Windows.Forms.TextBox textBoxSearchGenre;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Button buttonSearchName;
        private System.Windows.Forms.TextBox textBoxSearchName;
        private System.Windows.Forms.Panel panelFilm;
        private System.Windows.Forms.Panel panelUser;
        private System.Windows.Forms.DataGridView dataGridViewUser;
        private System.Windows.Forms.Panel panel2;
        private System.Windows.Forms.Label label9;
        private System.Windows.Forms.Label label6;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Button buttonSearchUser;
        private System.Windows.Forms.TextBox textBoxSearchUserO;
        private System.Windows.Forms.TextBox textBoxSearchUserI;
        private System.Windows.Forms.TextBox textBoxSearchUserF;
        private System.Windows.Forms.Label label7;
        private System.Windows.Forms.Button btnBack2;
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
        private System.Windows.Forms.Button buttonResetUser;
        private System.Windows.Forms.Button buttonResetFilm;
        private DatabaseDataSet databaseDataSet;
        private System.Windows.Forms.BindingSource фильмыBindingSource;
        private DatabaseDataSetTableAdapters.ФильмыTableAdapter фильмыTableAdapter;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label8;
        private System.Windows.Forms.BindingSource пользователиBindingSource;
        private DatabaseDataSetTableAdapters.ПользователиTableAdapter пользователиTableAdapter;
        private System.Windows.Forms.DataGridViewTextBoxColumn фамилияDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn имяDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn отчествоDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn адресDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn датаПоследнегоПосещенияDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодПользователяDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодФильмаDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn названиеDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn жанрDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn режиссерDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn странаDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn годDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn актерыDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn краткаяАннотацияDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewCheckBoxColumn отсутствуетDataGridViewCheckBoxColumn;
    }
}