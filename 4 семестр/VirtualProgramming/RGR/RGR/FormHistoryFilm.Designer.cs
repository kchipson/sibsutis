namespace RGR
{
    partial class FormHistoryFilm
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
            this.btnBackStep = new System.Windows.Forms.Button();
            this.dataGridViewHistory = new System.Windows.Forms.DataGridView();
            this.кодПользователяDataGridViewTextBoxColumn1 = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.пользовательDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.фильмDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.странаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.годВыходаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.режиссерDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.датаВзятияDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.датаВозвратаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.кодDataGridViewTextBoxColumn1 = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.кодФильмаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.историяBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.databaseDataSet = new RGR.DatabaseDataSet();
            this.panelHistory = new System.Windows.Forms.Panel();
            this.labelUser = new System.Windows.Forms.Label();
            this.buttonPrint = new System.Windows.Forms.Button();
            this.panelFilm = new System.Windows.Forms.Panel();
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
            this.panelFilmView = new System.Windows.Forms.Panel();
            this.radioBtnFilmAbsent = new System.Windows.Forms.RadioButton();
            this.radioBtnFilmPresent = new System.Windows.Forms.RadioButton();
            this.radioBtnFilmAll = new System.Windows.Forms.RadioButton();
            this.label1 = new System.Windows.Forms.Label();
            this.label8 = new System.Windows.Forms.Label();
            this.dataGridViewFilm = new System.Windows.Forms.DataGridView();
            this.названиеDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.жанрDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.годDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.странаDataGridViewTextBoxColumn1 = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.режиссерDataGridViewTextBoxColumn1 = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.актерыDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.краткаяАннотацияDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.кодЗаписиDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.отсутствуетDataGridViewCheckBoxColumn = new System.Windows.Forms.DataGridViewCheckBoxColumn();
            this.фильмыBindingSource = new System.Windows.Forms.BindingSource(this.components);
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
            this.фильмыTableAdapter = new RGR.DatabaseDataSetTableAdapters.ФильмыTableAdapter();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewHistory)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.историяBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.databaseDataSet)).BeginInit();
            this.panelHistory.SuspendLayout();
            this.panelFilm.SuspendLayout();
            this.panelFilmSearch.SuspendLayout();
            this.panelFilmView.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewFilm)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.фильмыBindingSource)).BeginInit();
            this.SuspendLayout();
            // 
            // btnBackStep
            // 
            this.btnBackStep.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Right)));
            this.btnBackStep.BackColor = System.Drawing.Color.Crimson;
            this.btnBackStep.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnBackStep.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.btnBackStep.ForeColor = System.Drawing.SystemColors.ButtonHighlight;
            this.btnBackStep.Location = new System.Drawing.Point(1288, 713);
            this.btnBackStep.Name = "btnBackStep";
            this.btnBackStep.Size = new System.Drawing.Size(214, 79);
            this.btnBackStep.TabIndex = 12;
            this.btnBackStep.Text = "⬅ Назад";
            this.btnBackStep.UseVisualStyleBackColor = false;
            this.btnBackStep.Click += new System.EventHandler(this.BtnBackStep_Click);
            // 
            // dataGridViewHistory
            // 
            this.dataGridViewHistory.AllowUserToAddRows = false;
            this.dataGridViewHistory.AllowUserToDeleteRows = false;
            this.dataGridViewHistory.AllowUserToOrderColumns = true;
            this.dataGridViewHistory.Anchor = ((System.Windows.Forms.AnchorStyles)((((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) 
            | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.dataGridViewHistory.AutoGenerateColumns = false;
            this.dataGridViewHistory.AutoSizeColumnsMode = System.Windows.Forms.DataGridViewAutoSizeColumnsMode.AllCells;
            this.dataGridViewHistory.AutoSizeRowsMode = System.Windows.Forms.DataGridViewAutoSizeRowsMode.AllCells;
            this.dataGridViewHistory.BackgroundColor = System.Drawing.Color.LightYellow;
            this.dataGridViewHistory.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dataGridViewHistory.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.кодПользователяDataGridViewTextBoxColumn1,
            this.пользовательDataGridViewTextBoxColumn,
            this.фильмDataGridViewTextBoxColumn,
            this.странаDataGridViewTextBoxColumn,
            this.годВыходаDataGridViewTextBoxColumn,
            this.режиссерDataGridViewTextBoxColumn,
            this.датаВзятияDataGridViewTextBoxColumn,
            this.датаВозвратаDataGridViewTextBoxColumn,
            this.кодDataGridViewTextBoxColumn1,
            this.кодФильмаDataGridViewTextBoxColumn});
            this.dataGridViewHistory.DataSource = this.историяBindingSource;
            dataGridViewCellStyle1.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleLeft;
            dataGridViewCellStyle1.BackColor = System.Drawing.Color.LemonChiffon;
            dataGridViewCellStyle1.Font = new System.Drawing.Font("Microsoft Sans Serif", 7.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            dataGridViewCellStyle1.ForeColor = System.Drawing.SystemColors.ControlText;
            dataGridViewCellStyle1.SelectionBackColor = System.Drawing.SystemColors.Highlight;
            dataGridViewCellStyle1.SelectionForeColor = System.Drawing.SystemColors.HighlightText;
            dataGridViewCellStyle1.WrapMode = System.Windows.Forms.DataGridViewTriState.True;
            this.dataGridViewHistory.DefaultCellStyle = dataGridViewCellStyle1;
            this.dataGridViewHistory.Location = new System.Drawing.Point(11, 72);
            this.dataGridViewHistory.Name = "dataGridViewHistory";
            this.dataGridViewHistory.ReadOnly = true;
            this.dataGridViewHistory.RowHeadersWidthSizeMode = System.Windows.Forms.DataGridViewRowHeadersWidthSizeMode.AutoSizeToDisplayedHeaders;
            this.dataGridViewHistory.RowTemplate.Height = 24;
            this.dataGridViewHistory.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.FullRowSelect;
            this.dataGridViewHistory.Size = new System.Drawing.Size(1491, 619);
            this.dataGridViewHistory.TabIndex = 14;
            this.dataGridViewHistory.SelectionChanged += new System.EventHandler(this.DataGridViewHistory_SelectionChanged);
            // 
            // кодПользователяDataGridViewTextBoxColumn1
            // 
            this.кодПользователяDataGridViewTextBoxColumn1.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.кодПользователяDataGridViewTextBoxColumn1.DataPropertyName = "Код пользователя";
            this.кодПользователяDataGridViewTextBoxColumn1.HeaderText = "Код пользователя";
            this.кодПользователяDataGridViewTextBoxColumn1.MinimumWidth = 6;
            this.кодПользователяDataGridViewTextBoxColumn1.Name = "кодПользователяDataGridViewTextBoxColumn1";
            this.кодПользователяDataGridViewTextBoxColumn1.ReadOnly = true;
            this.кодПользователяDataGridViewTextBoxColumn1.Width = 145;
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
            this.фильмDataGridViewTextBoxColumn.Visible = false;
            this.фильмDataGridViewTextBoxColumn.Width = 125;
            // 
            // странаDataGridViewTextBoxColumn
            // 
            this.странаDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.странаDataGridViewTextBoxColumn.DataPropertyName = "Страна";
            this.странаDataGridViewTextBoxColumn.HeaderText = "Страна";
            this.странаDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.странаDataGridViewTextBoxColumn.Name = "странаDataGridViewTextBoxColumn";
            this.странаDataGridViewTextBoxColumn.ReadOnly = true;
            this.странаDataGridViewTextBoxColumn.Visible = false;
            this.странаDataGridViewTextBoxColumn.Width = 125;
            // 
            // годВыходаDataGridViewTextBoxColumn
            // 
            this.годВыходаDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.годВыходаDataGridViewTextBoxColumn.DataPropertyName = "Год выхода";
            this.годВыходаDataGridViewTextBoxColumn.HeaderText = "Год выхода";
            this.годВыходаDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.годВыходаDataGridViewTextBoxColumn.Name = "годВыходаDataGridViewTextBoxColumn";
            this.годВыходаDataGridViewTextBoxColumn.ReadOnly = true;
            this.годВыходаDataGridViewTextBoxColumn.Visible = false;
            this.годВыходаDataGridViewTextBoxColumn.Width = 125;
            // 
            // режиссерDataGridViewTextBoxColumn
            // 
            this.режиссерDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.Fill;
            this.режиссерDataGridViewTextBoxColumn.DataPropertyName = "Режиссер";
            this.режиссерDataGridViewTextBoxColumn.HeaderText = "Режиссер";
            this.режиссерDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.режиссерDataGridViewTextBoxColumn.Name = "режиссерDataGridViewTextBoxColumn";
            this.режиссерDataGridViewTextBoxColumn.ReadOnly = true;
            this.режиссерDataGridViewTextBoxColumn.Visible = false;
            // 
            // датаВзятияDataGridViewTextBoxColumn
            // 
            this.датаВзятияDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.датаВзятияDataGridViewTextBoxColumn.DataPropertyName = "Дата взятия";
            this.датаВзятияDataGridViewTextBoxColumn.HeaderText = "Дата взятия";
            this.датаВзятияDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.датаВзятияDataGridViewTextBoxColumn.Name = "датаВзятияDataGridViewTextBoxColumn";
            this.датаВзятияDataGridViewTextBoxColumn.ReadOnly = true;
            this.датаВзятияDataGridViewTextBoxColumn.Width = 110;
            // 
            // датаВозвратаDataGridViewTextBoxColumn
            // 
            this.датаВозвратаDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.датаВозвратаDataGridViewTextBoxColumn.DataPropertyName = "Дата Возврата";
            this.датаВозвратаDataGridViewTextBoxColumn.HeaderText = "Дата Возврата";
            this.датаВозвратаDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.датаВозвратаDataGridViewTextBoxColumn.Name = "датаВозвратаDataGridViewTextBoxColumn";
            this.датаВозвратаDataGridViewTextBoxColumn.ReadOnly = true;
            this.датаВозвратаDataGridViewTextBoxColumn.Width = 126;
            // 
            // кодDataGridViewTextBoxColumn1
            // 
            this.кодDataGridViewTextBoxColumn1.DataPropertyName = "Код";
            this.кодDataGridViewTextBoxColumn1.HeaderText = "Код";
            this.кодDataGridViewTextBoxColumn1.MinimumWidth = 6;
            this.кодDataGridViewTextBoxColumn1.Name = "кодDataGridViewTextBoxColumn1";
            this.кодDataGridViewTextBoxColumn1.ReadOnly = true;
            this.кодDataGridViewTextBoxColumn1.Visible = false;
            this.кодDataGridViewTextBoxColumn1.Width = 62;
            // 
            // кодФильмаDataGridViewTextBoxColumn
            // 
            this.кодФильмаDataGridViewTextBoxColumn.DataPropertyName = "Код фильма";
            this.кодФильмаDataGridViewTextBoxColumn.HeaderText = "Код фильма";
            this.кодФильмаDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.кодФильмаDataGridViewTextBoxColumn.Name = "кодФильмаDataGridViewTextBoxColumn";
            this.кодФильмаDataGridViewTextBoxColumn.ReadOnly = true;
            this.кодФильмаDataGridViewTextBoxColumn.Visible = false;
            this.кодФильмаDataGridViewTextBoxColumn.Width = 108;
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
            // panelHistory
            // 
            this.panelHistory.Controls.Add(this.labelUser);
            this.panelHistory.Controls.Add(this.buttonPrint);
            this.panelHistory.Controls.Add(this.dataGridViewHistory);
            this.panelHistory.Controls.Add(this.btnBackStep);
            this.panelHistory.Location = new System.Drawing.Point(12, 12);
            this.panelHistory.Name = "panelHistory";
            this.panelHistory.Size = new System.Drawing.Size(1508, 815);
            this.panelHistory.TabIndex = 21;
            this.panelHistory.Visible = false;
            // 
            // labelUser
            // 
            this.labelUser.AutoSize = true;
            this.labelUser.Font = new System.Drawing.Font("Neucha", 24F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.labelUser.ForeColor = System.Drawing.Color.Crimson;
            this.labelUser.Location = new System.Drawing.Point(16, 11);
            this.labelUser.Name = "labelUser";
            this.labelUser.Size = new System.Drawing.Size(91, 49);
            this.labelUser.TabIndex = 25;
            this.labelUser.Text = "Text";
            this.labelUser.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // buttonPrint
            // 
            this.buttonPrint.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.buttonPrint.BackColor = System.Drawing.Color.Beige;
            this.buttonPrint.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonPrint.Font = new System.Drawing.Font("Neucha", 25.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonPrint.Location = new System.Drawing.Point(11, 713);
            this.buttonPrint.Name = "buttonPrint";
            this.buttonPrint.Size = new System.Drawing.Size(1271, 78);
            this.buttonPrint.TabIndex = 24;
            this.buttonPrint.Text = "Распечатать";
            this.buttonPrint.UseVisualStyleBackColor = false;
            this.buttonPrint.Click += new System.EventHandler(this.ButtonPrint_Click);
            // 
            // panelFilm
            // 
            this.panelFilm.Controls.Add(this.panelFilmSearch);
            this.panelFilm.Controls.Add(this.panelFilmView);
            this.panelFilm.Controls.Add(this.label8);
            this.panelFilm.Controls.Add(this.dataGridViewFilm);
            this.panelFilm.Controls.Add(this.btnBack);
            this.panelFilm.Location = new System.Drawing.Point(125, 9);
            this.panelFilm.Name = "panelFilm";
            this.panelFilm.Size = new System.Drawing.Size(1508, 815);
            this.panelFilm.TabIndex = 22;
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
            this.panelFilmSearch.Location = new System.Drawing.Point(226, 645);
            this.panelFilmSearch.Name = "panelFilmSearch";
            this.panelFilmSearch.Size = new System.Drawing.Size(986, 160);
            this.panelFilmSearch.TabIndex = 25;
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
            // panelFilmView
            // 
            this.panelFilmView.Controls.Add(this.radioBtnFilmAbsent);
            this.panelFilmView.Controls.Add(this.radioBtnFilmPresent);
            this.panelFilmView.Controls.Add(this.radioBtnFilmAll);
            this.panelFilmView.Controls.Add(this.label1);
            this.panelFilmView.Location = new System.Drawing.Point(11, 645);
            this.panelFilmView.Name = "panelFilmView";
            this.panelFilmView.Size = new System.Drawing.Size(205, 160);
            this.panelFilmView.TabIndex = 24;
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
            // label8
            // 
            this.label8.Anchor = System.Windows.Forms.AnchorStyles.Top;
            this.label8.Font = new System.Drawing.Font("Neucha", 19.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label8.ForeColor = System.Drawing.Color.DeepSkyBlue;
            this.label8.Location = new System.Drawing.Point(20, 23);
            this.label8.Name = "label8";
            this.label8.Size = new System.Drawing.Size(1449, 49);
            this.label8.TabIndex = 23;
            this.label8.Text = "Нажмите дважды по фильму, для получения сведений о том, кто и когда брал данный ф" +
    "ильм";
            this.label8.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // dataGridViewFilm
            // 
            this.dataGridViewFilm.AllowUserToAddRows = false;
            this.dataGridViewFilm.AllowUserToDeleteRows = false;
            this.dataGridViewFilm.AllowUserToOrderColumns = true;
            this.dataGridViewFilm.Anchor = ((System.Windows.Forms.AnchorStyles)(((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.dataGridViewFilm.AutoGenerateColumns = false;
            this.dataGridViewFilm.AutoSizeColumnsMode = System.Windows.Forms.DataGridViewAutoSizeColumnsMode.AllCells;
            this.dataGridViewFilm.AutoSizeRowsMode = System.Windows.Forms.DataGridViewAutoSizeRowsMode.AllCells;
            this.dataGridViewFilm.BackgroundColor = System.Drawing.Color.LightYellow;
            this.dataGridViewFilm.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dataGridViewFilm.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.названиеDataGridViewTextBoxColumn,
            this.жанрDataGridViewTextBoxColumn,
            this.годDataGridViewTextBoxColumn,
            this.странаDataGridViewTextBoxColumn1,
            this.режиссерDataGridViewTextBoxColumn1,
            this.актерыDataGridViewTextBoxColumn,
            this.краткаяАннотацияDataGridViewTextBoxColumn,
            this.кодЗаписиDataGridViewTextBoxColumn,
            this.отсутствуетDataGridViewCheckBoxColumn});
            this.dataGridViewFilm.DataSource = this.фильмыBindingSource;
            dataGridViewCellStyle2.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleLeft;
            dataGridViewCellStyle2.BackColor = System.Drawing.Color.LemonChiffon;
            dataGridViewCellStyle2.Font = new System.Drawing.Font("Microsoft Sans Serif", 7.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            dataGridViewCellStyle2.ForeColor = System.Drawing.SystemColors.ControlText;
            dataGridViewCellStyle2.SelectionBackColor = System.Drawing.SystemColors.Highlight;
            dataGridViewCellStyle2.SelectionForeColor = System.Drawing.SystemColors.HighlightText;
            dataGridViewCellStyle2.WrapMode = System.Windows.Forms.DataGridViewTriState.True;
            this.dataGridViewFilm.DefaultCellStyle = dataGridViewCellStyle2;
            this.dataGridViewFilm.Location = new System.Drawing.Point(11, 87);
            this.dataGridViewFilm.MultiSelect = false;
            this.dataGridViewFilm.Name = "dataGridViewFilm";
            this.dataGridViewFilm.ReadOnly = true;
            this.dataGridViewFilm.RowHeadersWidthSizeMode = System.Windows.Forms.DataGridViewRowHeadersWidthSizeMode.AutoSizeToDisplayedHeaders;
            this.dataGridViewFilm.RowTemplate.Height = 24;
            this.dataGridViewFilm.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.FullRowSelect;
            this.dataGridViewFilm.Size = new System.Drawing.Size(1491, 552);
            this.dataGridViewFilm.TabIndex = 14;
            this.dataGridViewFilm.CellDoubleClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.DataGridViewUser_CellDoubleClick);
            this.dataGridViewFilm.SelectionChanged += new System.EventHandler(this.DataGridViewUser_SelectionChanged);
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
            // странаDataGridViewTextBoxColumn1
            // 
            this.странаDataGridViewTextBoxColumn1.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.странаDataGridViewTextBoxColumn1.DataPropertyName = "Страна";
            this.странаDataGridViewTextBoxColumn1.HeaderText = "Страна";
            this.странаDataGridViewTextBoxColumn1.MinimumWidth = 6;
            this.странаDataGridViewTextBoxColumn1.Name = "странаDataGridViewTextBoxColumn1";
            this.странаDataGridViewTextBoxColumn1.ReadOnly = true;
            this.странаDataGridViewTextBoxColumn1.Width = 85;
            // 
            // режиссерDataGridViewTextBoxColumn1
            // 
            this.режиссерDataGridViewTextBoxColumn1.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.режиссерDataGridViewTextBoxColumn1.DataPropertyName = "Режиссер";
            this.режиссерDataGridViewTextBoxColumn1.HeaderText = "Режиссер";
            this.режиссерDataGridViewTextBoxColumn1.MinimumWidth = 6;
            this.режиссерDataGridViewTextBoxColumn1.Name = "режиссерDataGridViewTextBoxColumn1";
            this.режиссерDataGridViewTextBoxColumn1.ReadOnly = true;
            this.режиссерDataGridViewTextBoxColumn1.Width = 101;
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
            // фильмыBindingSource
            // 
            this.фильмыBindingSource.DataMember = "Фильмы";
            this.фильмыBindingSource.DataSource = this.databaseDataSet;
            // 
            // btnBack
            // 
            this.btnBack.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Right)));
            this.btnBack.BackColor = System.Drawing.Color.Crimson;
            this.btnBack.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnBack.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.btnBack.ForeColor = System.Drawing.SystemColors.ButtonHighlight;
            this.btnBack.Location = new System.Drawing.Point(1261, 688);
            this.btnBack.Name = "btnBack";
            this.btnBack.Size = new System.Drawing.Size(214, 79);
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
            // фильмыTableAdapter
            // 
            this.фильмыTableAdapter.ClearBeforeFill = true;
            // 
            // FormHistoryFilm
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.PeachPuff;
            this.ClientSize = new System.Drawing.Size(1532, 839);
            this.Controls.Add(this.panelFilm);
            this.Controls.Add(this.panelHistory);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "FormHistoryFilm";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "История взятия фильма";
            this.Load += new System.EventHandler(this.FormHistoryFilm_Load);
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewHistory)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.историяBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.databaseDataSet)).EndInit();
            this.panelHistory.ResumeLayout(false);
            this.panelHistory.PerformLayout();
            this.panelFilm.ResumeLayout(false);
            this.panelFilmSearch.ResumeLayout(false);
            this.panelFilmSearch.PerformLayout();
            this.panelFilmView.ResumeLayout(false);
            this.panelFilmView.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewFilm)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.фильмыBindingSource)).EndInit();
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.Button btnBackStep;
        private System.Windows.Forms.DataGridView dataGridViewHistory;
        private DatabaseDataSetTableAdapters.ИсторияTableAdapter историяTableAdapter;
        private System.Windows.Forms.Panel panelHistory;
        private System.Windows.Forms.Panel panelFilm;
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
        private DatabaseDataSet databaseDataSet;
        private System.Windows.Forms.Label label8;
        private System.Windows.Forms.Button buttonPrint;
        private System.Windows.Forms.Label labelUser;
        private System.Windows.Forms.BindingSource историяBindingSource;
        private System.Windows.Forms.DataGridView dataGridViewFilm;
        private System.Windows.Forms.Panel panelFilmSearch;
        private System.Windows.Forms.Button buttonResetFilm;
        private System.Windows.Forms.Button buttonSearchActor;
        private System.Windows.Forms.TextBox textBoxSearchActor;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Button buttonSearchGenre;
        private System.Windows.Forms.TextBox textBoxSearchGenre;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Button buttonSearchName;
        private System.Windows.Forms.TextBox textBoxSearchName;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Panel panelFilmView;
        private System.Windows.Forms.RadioButton radioBtnFilmAbsent;
        private System.Windows.Forms.RadioButton radioBtnFilmPresent;
        private System.Windows.Forms.RadioButton radioBtnFilmAll;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.BindingSource фильмыBindingSource;
        private DatabaseDataSetTableAdapters.ФильмыTableAdapter фильмыTableAdapter;
        private System.Windows.Forms.DataGridViewTextBoxColumn названиеDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn жанрDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn годDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn странаDataGridViewTextBoxColumn1;
        private System.Windows.Forms.DataGridViewTextBoxColumn режиссерDataGridViewTextBoxColumn1;
        private System.Windows.Forms.DataGridViewTextBoxColumn актерыDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn краткаяАннотацияDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодЗаписиDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewCheckBoxColumn отсутствуетDataGridViewCheckBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодПользователяDataGridViewTextBoxColumn1;
        private System.Windows.Forms.DataGridViewTextBoxColumn пользовательDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn фильмDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn странаDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn годВыходаDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn режиссерDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn датаВзятияDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn датаВозвратаDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодDataGridViewTextBoxColumn1;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодФильмаDataGridViewTextBoxColumn;
    }
}