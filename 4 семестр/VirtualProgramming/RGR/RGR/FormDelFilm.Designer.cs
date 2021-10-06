namespace RGR
{
    partial class FormDelFilm
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
            this.label1 = new System.Windows.Forms.Label();
            this.radioBtnFilmAll = new System.Windows.Forms.RadioButton();
            this.panelFilmView = new System.Windows.Forms.Panel();
            this.radioBtnFilmAbsent = new System.Windows.Forms.RadioButton();
            this.radioBtnFilmPresent = new System.Windows.Forms.RadioButton();
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
            this.label5 = new System.Windows.Forms.Label();
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
            this.dataGridViewDel = new System.Windows.Forms.DataGridView();
            this.историяBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.databaseDataSet = new RGR.DatabaseDataSet();
            this.фильмыBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.фильмыTableAdapter = new RGR.DatabaseDataSetTableAdapters.ФильмыTableAdapter();
            this.историяTableAdapter = new RGR.DatabaseDataSetTableAdapters.ИсторияTableAdapter();
            this.кодФильма = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.названиеDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.жанрDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.режиссерDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.странаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.годDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.актерыDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.краткаяАннотацияDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.отсутствуетDataGridViewCheckBoxColumn = new System.Windows.Forms.DataGridViewCheckBoxColumn();
            this.dataGridViewTextBoxColumn5 = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Пользователь = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.dataGridViewTextBoxColumn8 = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.dataGridViewTextBoxColumn9 = new System.Windows.Forms.DataGridViewTextBoxColumn();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewFilm)).BeginInit();
            this.panelFilmView.SuspendLayout();
            this.panelFilmSearch.SuspendLayout();
            this.panelFilm.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewDel)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.историяBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.databaseDataSet)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.фильмыBindingSource)).BeginInit();
            this.SuspendLayout();
            // 
            // btnBackFilm
            // 
            this.btnBackFilm.BackColor = System.Drawing.Color.Crimson;
            this.btnBackFilm.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnBackFilm.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.btnBackFilm.ForeColor = System.Drawing.SystemColors.ButtonHighlight;
            this.btnBackFilm.Location = new System.Drawing.Point(1246, 682);
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
            this.кодФильма,
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
            dataGridViewCellStyle1.BackColor = System.Drawing.SystemColors.Window;
            dataGridViewCellStyle1.Font = new System.Drawing.Font("Microsoft Sans Serif", 7.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            dataGridViewCellStyle1.ForeColor = System.Drawing.SystemColors.ControlText;
            dataGridViewCellStyle1.SelectionBackColor = System.Drawing.Color.IndianRed;
            dataGridViewCellStyle1.SelectionForeColor = System.Drawing.SystemColors.HighlightText;
            dataGridViewCellStyle1.WrapMode = System.Windows.Forms.DataGridViewTriState.True;
            this.dataGridViewFilm.DefaultCellStyle = dataGridViewCellStyle1;
            this.dataGridViewFilm.Location = new System.Drawing.Point(16, 79);
            this.dataGridViewFilm.MultiSelect = false;
            this.dataGridViewFilm.Name = "dataGridViewFilm";
            this.dataGridViewFilm.ReadOnly = true;
            this.dataGridViewFilm.RowHeadersWidthSizeMode = System.Windows.Forms.DataGridViewRowHeadersWidthSizeMode.AutoSizeToDisplayedHeaders;
            this.dataGridViewFilm.RowTemplate.Height = 24;
            this.dataGridViewFilm.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.FullRowSelect;
            this.dataGridViewFilm.Size = new System.Drawing.Size(1444, 552);
            this.dataGridViewFilm.TabIndex = 14;
            this.dataGridViewFilm.CellMouseDoubleClick += new System.Windows.Forms.DataGridViewCellMouseEventHandler(this.DataGridViewFilm_CellMouseDoubleClick);
            this.dataGridViewFilm.RowPrePaint += new System.Windows.Forms.DataGridViewRowPrePaintEventHandler(this.DataGridViewFilm_RowPrePaint);
            this.dataGridViewFilm.SelectionChanged += new System.EventHandler(this.dataGridViewFilm_SelectionChanged);
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label1.Location = new System.Drawing.Point(16, 14);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(130, 29);
            this.label1.TabIndex = 15;
            this.label1.Text = "Отобразить:";
            // 
            // radioBtnFilmAll
            // 
            this.radioBtnFilmAll.AutoSize = true;
            this.radioBtnFilmAll.Checked = true;
            this.radioBtnFilmAll.Font = new System.Drawing.Font("Neucha", 10.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.radioBtnFilmAll.Location = new System.Drawing.Point(48, 56);
            this.radioBtnFilmAll.Name = "radioBtnFilmAll";
            this.radioBtnFilmAll.Size = new System.Drawing.Size(55, 25);
            this.radioBtnFilmAll.TabIndex = 16;
            this.radioBtnFilmAll.TabStop = true;
            this.radioBtnFilmAll.Text = "Все";
            this.radioBtnFilmAll.UseVisualStyleBackColor = true;
            this.radioBtnFilmAll.CheckedChanged += new System.EventHandler(this.RadioBtnFilm_CheckedChanged);
            // 
            // panelFilmView
            // 
            this.panelFilmView.Controls.Add(this.radioBtnFilmAbsent);
            this.panelFilmView.Controls.Add(this.radioBtnFilmPresent);
            this.panelFilmView.Controls.Add(this.radioBtnFilmAll);
            this.panelFilmView.Controls.Add(this.label1);
            this.panelFilmView.Location = new System.Drawing.Point(16, 637);
            this.panelFilmView.Name = "panelFilmView";
            this.panelFilmView.Size = new System.Drawing.Size(205, 160);
            this.panelFilmView.TabIndex = 19;
            // 
            // radioBtnFilmAbsent
            // 
            this.radioBtnFilmAbsent.AutoSize = true;
            this.radioBtnFilmAbsent.Font = new System.Drawing.Font("Neucha", 10.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.radioBtnFilmAbsent.Location = new System.Drawing.Point(48, 118);
            this.radioBtnFilmAbsent.Name = "radioBtnFilmAbsent";
            this.radioBtnFilmAbsent.Size = new System.Drawing.Size(146, 25);
            this.radioBtnFilmAbsent.TabIndex = 18;
            this.radioBtnFilmAbsent.Text = "Отсутствующие";
            this.radioBtnFilmAbsent.UseVisualStyleBackColor = true;
            this.radioBtnFilmAbsent.CheckedChanged += new System.EventHandler(this.RadioBtnFilm_CheckedChanged);
            // 
            // radioBtnFilmPresent
            // 
            this.radioBtnFilmPresent.AutoSize = true;
            this.radioBtnFilmPresent.Font = new System.Drawing.Font("Neucha", 10.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.radioBtnFilmPresent.Location = new System.Drawing.Point(48, 87);
            this.radioBtnFilmPresent.Name = "radioBtnFilmPresent";
            this.radioBtnFilmPresent.Size = new System.Drawing.Size(154, 25);
            this.radioBtnFilmPresent.TabIndex = 17;
            this.radioBtnFilmPresent.Text = "Присутствующие";
            this.radioBtnFilmPresent.UseVisualStyleBackColor = true;
            this.radioBtnFilmPresent.CheckedChanged += new System.EventHandler(this.RadioBtnFilm_CheckedChanged);
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
            this.panelFilmSearch.Location = new System.Drawing.Point(231, 637);
            this.panelFilmSearch.Name = "panelFilmSearch";
            this.panelFilmSearch.Size = new System.Drawing.Size(986, 160);
            this.panelFilmSearch.TabIndex = 20;
            // 
            // buttonResetFilm
            // 
            this.buttonResetFilm.BackColor = System.Drawing.Color.MediumVioletRed;
            this.buttonResetFilm.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonResetFilm.Font = new System.Drawing.Font("Neucha", 16.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonResetFilm.ForeColor = System.Drawing.SystemColors.ButtonHighlight;
            this.buttonResetFilm.Location = new System.Drawing.Point(795, 68);
            this.buttonResetFilm.Name = "buttonResetFilm";
            this.buttonResetFilm.Size = new System.Drawing.Size(156, 56);
            this.buttonResetFilm.TabIndex = 28;
            this.buttonResetFilm.Text = "Сбросить";
            this.buttonResetFilm.UseVisualStyleBackColor = false;
            this.buttonResetFilm.Click += new System.EventHandler(this.RadioBtnFilm_CheckedChanged);
            // 
            // buttonSearchActor
            // 
            this.buttonSearchActor.BackColor = System.Drawing.Color.Pink;
            this.buttonSearchActor.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonSearchActor.Font = new System.Drawing.Font("Neucha", 16.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonSearchActor.Location = new System.Drawing.Point(544, 103);
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
            this.textBoxSearchActor.Location = new System.Drawing.Point(544, 51);
            this.textBoxSearchActor.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxSearchActor.Name = "textBoxSearchActor";
            this.textBoxSearchActor.Size = new System.Drawing.Size(226, 36);
            this.textBoxSearchActor.TabIndex = 22;
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label4.Location = new System.Drawing.Point(539, 14);
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
            this.buttonSearchGenre.Location = new System.Drawing.Point(280, 103);
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
            this.textBoxSearchGenre.Location = new System.Drawing.Point(280, 51);
            this.textBoxSearchGenre.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxSearchGenre.Name = "textBoxSearchGenre";
            this.textBoxSearchGenre.Size = new System.Drawing.Size(226, 36);
            this.textBoxSearchGenre.TabIndex = 19;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label3.Location = new System.Drawing.Point(275, 14);
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
            this.buttonSearchName.Location = new System.Drawing.Point(21, 103);
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
            this.textBoxSearchName.Location = new System.Drawing.Point(21, 51);
            this.textBoxSearchName.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxSearchName.Name = "textBoxSearchName";
            this.textBoxSearchName.Size = new System.Drawing.Size(226, 36);
            this.textBoxSearchName.TabIndex = 16;
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label2.Location = new System.Drawing.Point(16, 14);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(196, 29);
            this.label2.TabIndex = 15;
            this.label2.Text = "Поиск по названию";
            // 
            // panelFilm
            // 
            this.panelFilm.Controls.Add(this.dataGridViewDel);
            this.panelFilm.Controls.Add(this.label5);
            this.panelFilm.Controls.Add(this.dataGridViewFilm);
            this.panelFilm.Controls.Add(this.panelFilmSearch);
            this.panelFilm.Controls.Add(this.btnBackFilm);
            this.panelFilm.Controls.Add(this.panelFilmView);
            this.panelFilm.Location = new System.Drawing.Point(12, 12);
            this.panelFilm.Name = "panelFilm";
            this.panelFilm.Size = new System.Drawing.Size(1472, 807);
            this.panelFilm.TabIndex = 21;
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Font = new System.Drawing.Font("Neucha", 24F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label5.ForeColor = System.Drawing.Color.IndianRed;
            this.label5.Location = new System.Drawing.Point(248, 13);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(969, 49);
            this.label5.TabIndex = 21;
            this.label5.Text = "Нажмите дважды по фильму, который необходимо удалить";
            this.label5.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
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
            // dataGridViewDel
            // 
            this.dataGridViewDel.AllowUserToAddRows = false;
            this.dataGridViewDel.AllowUserToDeleteRows = false;
            this.dataGridViewDel.AllowUserToOrderColumns = true;
            this.dataGridViewDel.AutoGenerateColumns = false;
            this.dataGridViewDel.AutoSizeColumnsMode = System.Windows.Forms.DataGridViewAutoSizeColumnsMode.AllCells;
            this.dataGridViewDel.AutoSizeRowsMode = System.Windows.Forms.DataGridViewAutoSizeRowsMode.AllCells;
            this.dataGridViewDel.BackgroundColor = System.Drawing.Color.LightYellow;
            this.dataGridViewDel.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dataGridViewDel.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.dataGridViewTextBoxColumn5,
            this.Пользователь,
            this.dataGridViewTextBoxColumn8,
            this.dataGridViewTextBoxColumn9});
            this.dataGridViewDel.DataSource = this.историяBindingSource;
            dataGridViewCellStyle2.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleLeft;
            dataGridViewCellStyle2.BackColor = System.Drawing.SystemColors.Window;
            dataGridViewCellStyle2.Font = new System.Drawing.Font("Microsoft Sans Serif", 7.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            dataGridViewCellStyle2.ForeColor = System.Drawing.SystemColors.ControlText;
            dataGridViewCellStyle2.SelectionBackColor = System.Drawing.Color.IndianRed;
            dataGridViewCellStyle2.SelectionForeColor = System.Drawing.SystemColors.HighlightText;
            dataGridViewCellStyle2.WrapMode = System.Windows.Forms.DataGridViewTriState.True;
            this.dataGridViewDel.DefaultCellStyle = dataGridViewCellStyle2;
            this.dataGridViewDel.Location = new System.Drawing.Point(25, 24);
            this.dataGridViewDel.MultiSelect = false;
            this.dataGridViewDel.Name = "dataGridViewDel";
            this.dataGridViewDel.ReadOnly = true;
            this.dataGridViewDel.RowHeadersWidthSizeMode = System.Windows.Forms.DataGridViewRowHeadersWidthSizeMode.AutoSizeToDisplayedHeaders;
            this.dataGridViewDel.RowTemplate.Height = 24;
            this.dataGridViewDel.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.FullRowSelect;
            this.dataGridViewDel.Size = new System.Drawing.Size(23, 22);
            this.dataGridViewDel.TabIndex = 22;
            this.dataGridViewDel.Visible = false;
            // 
            // историяBindingSource
            // 
            this.историяBindingSource.DataMember = "История";
            this.историяBindingSource.DataSource = this.databaseDataSet;
            // 
            // databaseDataSet
            // 
            this.databaseDataSet.DataSetName = "DatabaseDataSet";
            this.databaseDataSet.SchemaSerializationMode = System.Data.SchemaSerializationMode.IncludeSchema;
            // 
            // фильмыBindingSource
            // 
            this.фильмыBindingSource.DataMember = "Фильмы";
            this.фильмыBindingSource.DataSource = this.databaseDataSet;
            // 
            // фильмыTableAdapter
            // 
            this.фильмыTableAdapter.ClearBeforeFill = true;
            // 
            // историяTableAdapter
            // 
            this.историяTableAdapter.ClearBeforeFill = true;
            // 
            // кодФильма
            // 
            this.кодФильма.DataPropertyName = "Код";
            this.кодФильма.HeaderText = "Код";
            this.кодФильма.MinimumWidth = 6;
            this.кодФильма.Name = "кодФильма";
            this.кодФильма.ReadOnly = true;
            this.кодФильма.Visible = false;
            this.кодФильма.Width = 62;
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
            // dataGridViewTextBoxColumn5
            // 
            this.dataGridViewTextBoxColumn5.DataPropertyName = "Код";
            this.dataGridViewTextBoxColumn5.HeaderText = "Код";
            this.dataGridViewTextBoxColumn5.MinimumWidth = 6;
            this.dataGridViewTextBoxColumn5.Name = "dataGridViewTextBoxColumn5";
            this.dataGridViewTextBoxColumn5.ReadOnly = true;
            this.dataGridViewTextBoxColumn5.Visible = false;
            this.dataGridViewTextBoxColumn5.Width = 62;
            // 
            // Пользователь
            // 
            this.Пользователь.DataPropertyName = "Пользователь";
            this.Пользователь.HeaderText = "Пользователь";
            this.Пользователь.MinimumWidth = 6;
            this.Пользователь.Name = "Пользователь";
            this.Пользователь.ReadOnly = true;
            this.Пользователь.Width = 130;
            // 
            // dataGridViewTextBoxColumn8
            // 
            this.dataGridViewTextBoxColumn8.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.dataGridViewTextBoxColumn8.DataPropertyName = "Режиссер";
            this.dataGridViewTextBoxColumn8.HeaderText = "Режиссер";
            this.dataGridViewTextBoxColumn8.MinimumWidth = 6;
            this.dataGridViewTextBoxColumn8.Name = "dataGridViewTextBoxColumn8";
            this.dataGridViewTextBoxColumn8.ReadOnly = true;
            this.dataGridViewTextBoxColumn8.Width = 101;
            // 
            // dataGridViewTextBoxColumn9
            // 
            this.dataGridViewTextBoxColumn9.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.dataGridViewTextBoxColumn9.DataPropertyName = "Страна";
            this.dataGridViewTextBoxColumn9.HeaderText = "Страна";
            this.dataGridViewTextBoxColumn9.MinimumWidth = 6;
            this.dataGridViewTextBoxColumn9.Name = "dataGridViewTextBoxColumn9";
            this.dataGridViewTextBoxColumn9.ReadOnly = true;
            this.dataGridViewTextBoxColumn9.Width = 85;
            // 
            // FormDelFilm
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.PeachPuff;
            this.ClientSize = new System.Drawing.Size(1496, 821);
            this.Controls.Add(this.panelFilm);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "FormDelFilm";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Удаление фильма";
            this.Load += new System.EventHandler(this.FormDelFilm_Load);
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewFilm)).EndInit();
            this.panelFilmView.ResumeLayout(false);
            this.panelFilmView.PerformLayout();
            this.panelFilmSearch.ResumeLayout(false);
            this.panelFilmSearch.PerformLayout();
            this.panelFilm.ResumeLayout(false);
            this.panelFilm.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewDel)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.историяBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.databaseDataSet)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.фильмыBindingSource)).EndInit();
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.Button btnBackFilm;
        private System.Windows.Forms.DataGridView dataGridViewFilm;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.RadioButton radioBtnFilmAll;
        private System.Windows.Forms.Panel panelFilmView;
        private System.Windows.Forms.RadioButton radioBtnFilmAbsent;
        private System.Windows.Forms.RadioButton radioBtnFilmPresent;
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
        private System.Windows.Forms.Button buttonResetFilm;
        private System.Windows.Forms.Label label5;
        private DatabaseDataSet databaseDataSet;
        private System.Windows.Forms.BindingSource фильмыBindingSource;
        private DatabaseDataSetTableAdapters.ФильмыTableAdapter фильмыTableAdapter;
        private System.Windows.Forms.DataGridView dataGridViewDel;
        private System.Windows.Forms.BindingSource историяBindingSource;
        private DatabaseDataSetTableAdapters.ИсторияTableAdapter историяTableAdapter;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодФильма;
        private System.Windows.Forms.DataGridViewTextBoxColumn названиеDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn жанрDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn режиссерDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn странаDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn годDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn актерыDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn краткаяАннотацияDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewCheckBoxColumn отсутствуетDataGridViewCheckBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn dataGridViewTextBoxColumn5;
        private System.Windows.Forms.DataGridViewTextBoxColumn Пользователь;
        private System.Windows.Forms.DataGridViewTextBoxColumn dataGridViewTextBoxColumn8;
        private System.Windows.Forms.DataGridViewTextBoxColumn dataGridViewTextBoxColumn9;
    }
}