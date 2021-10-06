namespace RGR
{
    partial class FormView
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
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(FormView));
            System.Windows.Forms.DataGridViewCellStyle dataGridViewCellStyle1 = new System.Windows.Forms.DataGridViewCellStyle();
            System.Windows.Forms.DataGridViewCellStyle dataGridViewCellStyle2 = new System.Windows.Forms.DataGridViewCellStyle();
            System.Windows.Forms.DataGridViewCellStyle dataGridViewCellStyle3 = new System.Windows.Forms.DataGridViewCellStyle();
            this.btnBackFilm = new System.Windows.Forms.Button();
            this.toolStrip = new System.Windows.Forms.ToolStrip();
            this.toolStripFilmBtn = new System.Windows.Forms.ToolStripButton();
            this.toolStripUserBtn = new System.Windows.Forms.ToolStripButton();
            this.toolStripSeparator1 = new System.Windows.Forms.ToolStripSeparator();
            this.toolStripHistoryBtn = new System.Windows.Forms.ToolStripButton();
            this.dataGridViewFilm = new System.Windows.Forms.DataGridView();
            this.кодDataGridViewTextBoxColumn1 = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.названиеDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.жанрDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.режиссерDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.странаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.годDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.актерыDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.краткаяАннотацияDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.отсутствуетDataGridViewCheckBoxColumn = new System.Windows.Forms.DataGridViewCheckBoxColumn();
            this.фильмыBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.databaseDataSet = new RGR.DatabaseDataSet();
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
            this.panelUser = new System.Windows.Forms.Panel();
            this.dataGridViewUser = new System.Windows.Forms.DataGridView();
            this.фамилияDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.имяDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.отчествоDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.адресDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.кодDataGridViewTextBoxColumn2 = new System.Windows.Forms.DataGridViewTextBoxColumn();
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
            this.фильмыTableAdapter = new RGR.DatabaseDataSetTableAdapters.ФильмыTableAdapter();
            this.пользователиTableAdapter = new RGR.DatabaseDataSetTableAdapters.ПользователиTableAdapter();
            this.panelHistory = new System.Windows.Forms.Panel();
            this.panel1 = new System.Windows.Forms.Panel();
            this.buttonResetSearch = new System.Windows.Forms.Button();
            this.buttonHistoryFilmSearch = new System.Windows.Forms.Button();
            this.textBoxSearchFilm = new System.Windows.Forms.TextBox();
            this.label10 = new System.Windows.Forms.Label();
            this.buttonHistoryUserSearch = new System.Windows.Forms.Button();
            this.textBoxSearchUser = new System.Windows.Forms.TextBox();
            this.label11 = new System.Windows.Forms.Label();
            this.dataGridViewHistory = new System.Windows.Forms.DataGridView();
            this.пользовательDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.фильмDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.режиссерDataGridViewTextBoxColumn1 = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.годВыходаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.странаDataGridViewTextBoxColumn1 = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.датаВзятияDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.датаВозвратаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.кодDataGridViewTextBoxColumn3 = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.кодПользователяDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.кодФильмаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.историяBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.button3 = new System.Windows.Forms.Button();
            this.Пользователь = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Фильм = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Режиссер = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Страна = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.историяTableAdapter = new RGR.DatabaseDataSetTableAdapters.ИсторияTableAdapter();
            this.toolStrip.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewFilm)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.фильмыBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.databaseDataSet)).BeginInit();
            this.panelFilmView.SuspendLayout();
            this.panelFilmSearch.SuspendLayout();
            this.panelFilm.SuspendLayout();
            this.panelUser.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewUser)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.пользователиBindingSource)).BeginInit();
            this.panel2.SuspendLayout();
            this.panelHistory.SuspendLayout();
            this.panel1.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewHistory)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.историяBindingSource)).BeginInit();
            this.SuspendLayout();
            // 
            // btnBackFilm
            // 
            this.btnBackFilm.BackColor = System.Drawing.Color.Crimson;
            this.btnBackFilm.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnBackFilm.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.btnBackFilm.ForeColor = System.Drawing.SystemColors.ButtonHighlight;
            this.btnBackFilm.Location = new System.Drawing.Point(1229, 637);
            this.btnBackFilm.Name = "btnBackFilm";
            this.btnBackFilm.Size = new System.Drawing.Size(214, 79);
            this.btnBackFilm.TabIndex = 12;
            this.btnBackFilm.Text = "⬅ Назад";
            this.btnBackFilm.UseVisualStyleBackColor = false;
            this.btnBackFilm.Click += new System.EventHandler(this.BtnBack_Click);
            // 
            // toolStrip
            // 
            this.toolStrip.BackColor = System.Drawing.Color.PapayaWhip;
            this.toolStrip.Dock = System.Windows.Forms.DockStyle.Left;
            this.toolStrip.GripStyle = System.Windows.Forms.ToolStripGripStyle.Hidden;
            this.toolStrip.ImageScalingSize = new System.Drawing.Size(20, 20);
            this.toolStrip.Items.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this.toolStripFilmBtn,
            this.toolStripUserBtn,
            this.toolStripSeparator1,
            this.toolStripHistoryBtn});
            this.toolStrip.LayoutStyle = System.Windows.Forms.ToolStripLayoutStyle.VerticalStackWithOverflow;
            this.toolStrip.Location = new System.Drawing.Point(0, 0);
            this.toolStrip.Name = "toolStrip";
            this.toolStrip.Size = new System.Drawing.Size(60, 758);
            this.toolStrip.TabIndex = 13;
            this.toolStrip.Text = "toolStrip";
            // 
            // toolStripFilmBtn
            // 
            this.toolStripFilmBtn.BackColor = System.Drawing.Color.PowderBlue;
            this.toolStripFilmBtn.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Text;
            this.toolStripFilmBtn.Font = new System.Drawing.Font("Bad Script", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.toolStripFilmBtn.Image = ((System.Drawing.Image)(resources.GetObject("toolStripFilmBtn.Image")));
            this.toolStripFilmBtn.ImageTransparentColor = System.Drawing.Color.Magenta;
            this.toolStripFilmBtn.Margin = new System.Windows.Forms.Padding(5, 5, 2, 10);
            this.toolStripFilmBtn.Name = "toolStripFilmBtn";
            this.toolStripFilmBtn.Size = new System.Drawing.Size(50, 118);
            this.toolStripFilmBtn.Text = "Фильмы";
            this.toolStripFilmBtn.TextDirection = System.Windows.Forms.ToolStripTextDirection.Vertical270;
            this.toolStripFilmBtn.ToolTipText = "Открыть базу данных с фильмами";
            this.toolStripFilmBtn.Click += new System.EventHandler(this.ToolStripFilmBtn_Click);
            // 
            // toolStripUserBtn
            // 
            this.toolStripUserBtn.BackColor = System.Drawing.Color.Salmon;
            this.toolStripUserBtn.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Text;
            this.toolStripUserBtn.Font = new System.Drawing.Font("Bad Script", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.toolStripUserBtn.Image = ((System.Drawing.Image)(resources.GetObject("toolStripUserBtn.Image")));
            this.toolStripUserBtn.ImageTransparentColor = System.Drawing.Color.Magenta;
            this.toolStripUserBtn.Margin = new System.Windows.Forms.Padding(5, 10, 2, 10);
            this.toolStripUserBtn.Name = "toolStripUserBtn";
            this.toolStripUserBtn.Size = new System.Drawing.Size(50, 157);
            this.toolStripUserBtn.Text = "Пользователи";
            this.toolStripUserBtn.TextDirection = System.Windows.Forms.ToolStripTextDirection.Vertical270;
            this.toolStripUserBtn.ToolTipText = "Открыть базу данных с пользователями";
            this.toolStripUserBtn.Click += new System.EventHandler(this.ToolStripUserBtn_Click);
            // 
            // toolStripSeparator1
            // 
            this.toolStripSeparator1.Name = "toolStripSeparator1";
            this.toolStripSeparator1.Size = new System.Drawing.Size(57, 6);
            // 
            // toolStripHistoryBtn
            // 
            this.toolStripHistoryBtn.BackColor = System.Drawing.Color.Turquoise;
            this.toolStripHistoryBtn.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Text;
            this.toolStripHistoryBtn.Font = new System.Drawing.Font("Bad Script", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.toolStripHistoryBtn.Image = ((System.Drawing.Image)(resources.GetObject("toolStripHistoryBtn.Image")));
            this.toolStripHistoryBtn.ImageTransparentColor = System.Drawing.Color.Magenta;
            this.toolStripHistoryBtn.Margin = new System.Windows.Forms.Padding(5, 10, 2, 0);
            this.toolStripHistoryBtn.Name = "toolStripHistoryBtn";
            this.toolStripHistoryBtn.Size = new System.Drawing.Size(50, 104);
            this.toolStripHistoryBtn.Text = "История";
            this.toolStripHistoryBtn.TextDirection = System.Windows.Forms.ToolStripTextDirection.Vertical270;
            this.toolStripHistoryBtn.ToolTipText = "Открыть базу данных с историей";
            this.toolStripHistoryBtn.Click += new System.EventHandler(this.ToolStripHistoryBtn_Click);
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
            this.кодDataGridViewTextBoxColumn1,
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
            dataGridViewCellStyle1.SelectionBackColor = System.Drawing.SystemColors.Highlight;
            dataGridViewCellStyle1.SelectionForeColor = System.Drawing.SystemColors.HighlightText;
            dataGridViewCellStyle1.WrapMode = System.Windows.Forms.DataGridViewTriState.True;
            this.dataGridViewFilm.DefaultCellStyle = dataGridViewCellStyle1;
            this.dataGridViewFilm.Location = new System.Drawing.Point(16, 16);
            this.dataGridViewFilm.Name = "dataGridViewFilm";
            this.dataGridViewFilm.ReadOnly = true;
            this.dataGridViewFilm.RowHeadersWidthSizeMode = System.Windows.Forms.DataGridViewRowHeadersWidthSizeMode.AutoSizeToDisplayedHeaders;
            this.dataGridViewFilm.RowTemplate.Height = 24;
            this.dataGridViewFilm.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.FullRowSelect;
            this.dataGridViewFilm.Size = new System.Drawing.Size(1444, 552);
            this.dataGridViewFilm.TabIndex = 14;
            this.dataGridViewFilm.RowPrePaint += new System.Windows.Forms.DataGridViewRowPrePaintEventHandler(this.DataGridViewFilm_RowPrePaint);
            this.dataGridViewFilm.SelectionChanged += new System.EventHandler(this.DataGridViewFilm_SelectionChanged);
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
            this.panelFilmView.Location = new System.Drawing.Point(16, 586);
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
            this.panelFilmSearch.Location = new System.Drawing.Point(237, 586);
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
            this.panelFilm.Controls.Add(this.dataGridViewFilm);
            this.panelFilm.Controls.Add(this.panelFilmSearch);
            this.panelFilm.Controls.Add(this.btnBackFilm);
            this.panelFilm.Controls.Add(this.panelFilmView);
            this.panelFilm.Location = new System.Drawing.Point(79, 8);
            this.panelFilm.Name = "panelFilm";
            this.panelFilm.Size = new System.Drawing.Size(1467, 750);
            this.panelFilm.TabIndex = 21;
            // 
            // panelUser
            // 
            this.panelUser.Controls.Add(this.dataGridViewUser);
            this.panelUser.Controls.Add(this.panel2);
            this.panelUser.Controls.Add(this.btnBack2);
            this.panelUser.Location = new System.Drawing.Point(1510, 0);
            this.panelUser.Name = "panelUser";
            this.panelUser.Size = new System.Drawing.Size(1467, 750);
            this.panelUser.TabIndex = 22;
            this.panelUser.Visible = false;
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
            this.кодDataGridViewTextBoxColumn2});
            this.dataGridViewUser.DataSource = this.пользователиBindingSource;
            dataGridViewCellStyle2.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleLeft;
            dataGridViewCellStyle2.BackColor = System.Drawing.Color.LemonChiffon;
            dataGridViewCellStyle2.Font = new System.Drawing.Font("Microsoft Sans Serif", 7.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            dataGridViewCellStyle2.ForeColor = System.Drawing.SystemColors.ControlText;
            dataGridViewCellStyle2.SelectionBackColor = System.Drawing.SystemColors.Highlight;
            dataGridViewCellStyle2.SelectionForeColor = System.Drawing.SystemColors.HighlightText;
            dataGridViewCellStyle2.WrapMode = System.Windows.Forms.DataGridViewTriState.True;
            this.dataGridViewUser.DefaultCellStyle = dataGridViewCellStyle2;
            this.dataGridViewUser.Location = new System.Drawing.Point(13, 16);
            this.dataGridViewUser.Name = "dataGridViewUser";
            this.dataGridViewUser.ReadOnly = true;
            this.dataGridViewUser.RowHeadersWidthSizeMode = System.Windows.Forms.DataGridViewRowHeadersWidthSizeMode.AutoSizeToDisplayedHeaders;
            this.dataGridViewUser.RowTemplate.Height = 24;
            this.dataGridViewUser.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.FullRowSelect;
            this.dataGridViewUser.Size = new System.Drawing.Size(1444, 552);
            this.dataGridViewUser.TabIndex = 14;
            this.dataGridViewUser.SelectionChanged += new System.EventHandler(this.DataGridViewUser_SelectionChanged);
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
            this.датаПоследнегоПосещенияDataGridViewTextBoxColumn.Width = 142;
            // 
            // кодDataGridViewTextBoxColumn2
            // 
            this.кодDataGridViewTextBoxColumn2.DataPropertyName = "Код";
            this.кодDataGridViewTextBoxColumn2.HeaderText = "Код";
            this.кодDataGridViewTextBoxColumn2.MinimumWidth = 6;
            this.кодDataGridViewTextBoxColumn2.Name = "кодDataGridViewTextBoxColumn2";
            this.кодDataGridViewTextBoxColumn2.ReadOnly = true;
            this.кодDataGridViewTextBoxColumn2.Visible = false;
            this.кодDataGridViewTextBoxColumn2.Width = 62;
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
            this.panel2.Location = new System.Drawing.Point(16, 574);
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
            this.buttonResetUser.Location = new System.Drawing.Point(720, 56);
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
            this.btnBack2.Location = new System.Drawing.Point(1229, 637);
            this.btnBack2.Name = "btnBack2";
            this.btnBack2.Size = new System.Drawing.Size(214, 79);
            this.btnBack2.TabIndex = 12;
            this.btnBack2.Text = "⬅ Назад";
            this.btnBack2.UseVisualStyleBackColor = false;
            this.btnBack2.Click += new System.EventHandler(this.BtnBack_Click);
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
            // фильмыTableAdapter
            // 
            this.фильмыTableAdapter.ClearBeforeFill = true;
            // 
            // пользователиTableAdapter
            // 
            this.пользователиTableAdapter.ClearBeforeFill = true;
            // 
            // panelHistory
            // 
            this.panelHistory.Controls.Add(this.panel1);
            this.panelHistory.Controls.Add(this.dataGridViewHistory);
            this.panelHistory.Controls.Add(this.button3);
            this.panelHistory.Location = new System.Drawing.Point(1442, 3);
            this.panelHistory.Name = "panelHistory";
            this.panelHistory.Size = new System.Drawing.Size(1467, 750);
            this.panelHistory.TabIndex = 23;
            this.panelHistory.Visible = false;
            // 
            // panel1
            // 
            this.panel1.Controls.Add(this.buttonResetSearch);
            this.panel1.Controls.Add(this.buttonHistoryFilmSearch);
            this.panel1.Controls.Add(this.textBoxSearchFilm);
            this.panel1.Controls.Add(this.label10);
            this.panel1.Controls.Add(this.buttonHistoryUserSearch);
            this.panel1.Controls.Add(this.textBoxSearchUser);
            this.panel1.Controls.Add(this.label11);
            this.panel1.Location = new System.Drawing.Point(20, 607);
            this.panel1.Name = "panel1";
            this.panel1.Size = new System.Drawing.Size(1013, 138);
            this.panel1.TabIndex = 21;
            // 
            // buttonResetSearch
            // 
            this.buttonResetSearch.BackColor = System.Drawing.Color.MediumVioletRed;
            this.buttonResetSearch.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonResetSearch.Font = new System.Drawing.Font("Neucha", 16.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonResetSearch.ForeColor = System.Drawing.SystemColors.ButtonHighlight;
            this.buttonResetSearch.Location = new System.Drawing.Point(702, 47);
            this.buttonResetSearch.Name = "buttonResetSearch";
            this.buttonResetSearch.Size = new System.Drawing.Size(215, 63);
            this.buttonResetSearch.TabIndex = 27;
            this.buttonResetSearch.Text = "Сбросить";
            this.buttonResetSearch.UseVisualStyleBackColor = false;
            this.buttonResetSearch.Click += new System.EventHandler(this.ButtonResetSearch_Click);
            // 
            // buttonHistoryFilmSearch
            // 
            this.buttonHistoryFilmSearch.BackColor = System.Drawing.Color.PaleVioletRed;
            this.buttonHistoryFilmSearch.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonHistoryFilmSearch.Font = new System.Drawing.Font("Neucha", 16.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonHistoryFilmSearch.Location = new System.Drawing.Point(352, 83);
            this.buttonHistoryFilmSearch.Name = "buttonHistoryFilmSearch";
            this.buttonHistoryFilmSearch.Size = new System.Drawing.Size(233, 49);
            this.buttonHistoryFilmSearch.TabIndex = 26;
            this.buttonHistoryFilmSearch.Text = "Поиск";
            this.buttonHistoryFilmSearch.UseVisualStyleBackColor = false;
            this.buttonHistoryFilmSearch.Click += new System.EventHandler(this.ButtonHistoryFilmSearch_Click);
            // 
            // textBoxSearchFilm
            // 
            this.textBoxSearchFilm.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxSearchFilm.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxSearchFilm.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxSearchFilm.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxSearchFilm.Location = new System.Drawing.Point(352, 40);
            this.textBoxSearchFilm.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxSearchFilm.Name = "textBoxSearchFilm";
            this.textBoxSearchFilm.Size = new System.Drawing.Size(233, 36);
            this.textBoxSearchFilm.TabIndex = 25;
            // 
            // label10
            // 
            this.label10.AutoSize = true;
            this.label10.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label10.Location = new System.Drawing.Point(347, 7);
            this.label10.Name = "label10";
            this.label10.Size = new System.Drawing.Size(196, 29);
            this.label10.TabIndex = 24;
            this.label10.Text = "Поиск по названию";
            // 
            // buttonHistoryUserSearch
            // 
            this.buttonHistoryUserSearch.BackColor = System.Drawing.Color.Pink;
            this.buttonHistoryUserSearch.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonHistoryUserSearch.Font = new System.Drawing.Font("Neucha", 16.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonHistoryUserSearch.Location = new System.Drawing.Point(23, 83);
            this.buttonHistoryUserSearch.Name = "buttonHistoryUserSearch";
            this.buttonHistoryUserSearch.Size = new System.Drawing.Size(233, 49);
            this.buttonHistoryUserSearch.TabIndex = 23;
            this.buttonHistoryUserSearch.Text = "Поиск";
            this.buttonHistoryUserSearch.UseVisualStyleBackColor = false;
            this.buttonHistoryUserSearch.Click += new System.EventHandler(this.ButtonHistoryUserSearch_Click);
            // 
            // textBoxSearchUser
            // 
            this.textBoxSearchUser.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxSearchUser.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxSearchUser.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxSearchUser.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxSearchUser.Location = new System.Drawing.Point(23, 40);
            this.textBoxSearchUser.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxSearchUser.Name = "textBoxSearchUser";
            this.textBoxSearchUser.Size = new System.Drawing.Size(233, 36);
            this.textBoxSearchUser.TabIndex = 1;
            // 
            // label11
            // 
            this.label11.AutoSize = true;
            this.label11.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label11.Location = new System.Drawing.Point(18, 7);
            this.label11.Name = "label11";
            this.label11.Size = new System.Drawing.Size(238, 29);
            this.label11.TabIndex = 15;
            this.label11.Text = "Поиск по пользователю";
            // 
            // dataGridViewHistory
            // 
            this.dataGridViewHistory.AllowUserToAddRows = false;
            this.dataGridViewHistory.AllowUserToDeleteRows = false;
            this.dataGridViewHistory.AllowUserToOrderColumns = true;
            this.dataGridViewHistory.AutoGenerateColumns = false;
            this.dataGridViewHistory.AutoSizeColumnsMode = System.Windows.Forms.DataGridViewAutoSizeColumnsMode.AllCells;
            this.dataGridViewHistory.AutoSizeRowsMode = System.Windows.Forms.DataGridViewAutoSizeRowsMode.AllCells;
            this.dataGridViewHistory.BackgroundColor = System.Drawing.Color.LightYellow;
            this.dataGridViewHistory.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dataGridViewHistory.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.пользовательDataGridViewTextBoxColumn,
            this.фильмDataGridViewTextBoxColumn,
            this.режиссерDataGridViewTextBoxColumn1,
            this.годВыходаDataGridViewTextBoxColumn,
            this.странаDataGridViewTextBoxColumn1,
            this.датаВзятияDataGridViewTextBoxColumn,
            this.датаВозвратаDataGridViewTextBoxColumn,
            this.кодDataGridViewTextBoxColumn3,
            this.кодПользователяDataGridViewTextBoxColumn,
            this.кодФильмаDataGridViewTextBoxColumn});
            this.dataGridViewHistory.DataSource = this.историяBindingSource;
            dataGridViewCellStyle3.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleLeft;
            dataGridViewCellStyle3.BackColor = System.Drawing.SystemColors.Window;
            dataGridViewCellStyle3.Font = new System.Drawing.Font("Microsoft Sans Serif", 7.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            dataGridViewCellStyle3.ForeColor = System.Drawing.SystemColors.ControlText;
            dataGridViewCellStyle3.SelectionBackColor = System.Drawing.SystemColors.Highlight;
            dataGridViewCellStyle3.SelectionForeColor = System.Drawing.SystemColors.HighlightText;
            dataGridViewCellStyle3.WrapMode = System.Windows.Forms.DataGridViewTriState.True;
            this.dataGridViewHistory.DefaultCellStyle = dataGridViewCellStyle3;
            this.dataGridViewHistory.Location = new System.Drawing.Point(13, 16);
            this.dataGridViewHistory.Name = "dataGridViewHistory";
            this.dataGridViewHistory.ReadOnly = true;
            this.dataGridViewHistory.RowHeadersWidthSizeMode = System.Windows.Forms.DataGridViewRowHeadersWidthSizeMode.AutoSizeToDisplayedHeaders;
            this.dataGridViewHistory.RowTemplate.Height = 24;
            this.dataGridViewHistory.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.FullRowSelect;
            this.dataGridViewHistory.Size = new System.Drawing.Size(1444, 585);
            this.dataGridViewHistory.TabIndex = 14;
            this.dataGridViewHistory.RowPrePaint += new System.Windows.Forms.DataGridViewRowPrePaintEventHandler(this.DataGridViewHistory_RowPrePaint);
            this.dataGridViewHistory.SelectionChanged += new System.EventHandler(this.DataGridViewHistory_SelectionChanged);
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
            // режиссерDataGridViewTextBoxColumn1
            // 
            this.режиссерDataGridViewTextBoxColumn1.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.Fill;
            this.режиссерDataGridViewTextBoxColumn1.DataPropertyName = "Режиссер";
            this.режиссерDataGridViewTextBoxColumn1.HeaderText = "Режиссер";
            this.режиссерDataGridViewTextBoxColumn1.MinimumWidth = 6;
            this.режиссерDataGridViewTextBoxColumn1.Name = "режиссерDataGridViewTextBoxColumn1";
            this.режиссерDataGridViewTextBoxColumn1.ReadOnly = true;
            // 
            // годВыходаDataGridViewTextBoxColumn
            // 
            this.годВыходаDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.годВыходаDataGridViewTextBoxColumn.DataPropertyName = "Год выхода";
            this.годВыходаDataGridViewTextBoxColumn.HeaderText = "Год выхода";
            this.годВыходаDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.годВыходаDataGridViewTextBoxColumn.Name = "годВыходаDataGridViewTextBoxColumn";
            this.годВыходаDataGridViewTextBoxColumn.ReadOnly = true;
            this.годВыходаDataGridViewTextBoxColumn.Width = 103;
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
            // кодDataGridViewTextBoxColumn3
            // 
            this.кодDataGridViewTextBoxColumn3.DataPropertyName = "Код";
            this.кодDataGridViewTextBoxColumn3.HeaderText = "Код";
            this.кодDataGridViewTextBoxColumn3.MinimumWidth = 6;
            this.кодDataGridViewTextBoxColumn3.Name = "кодDataGridViewTextBoxColumn3";
            this.кодDataGridViewTextBoxColumn3.ReadOnly = true;
            this.кодDataGridViewTextBoxColumn3.Visible = false;
            this.кодDataGridViewTextBoxColumn3.Width = 62;
            // 
            // кодПользователяDataGridViewTextBoxColumn
            // 
            this.кодПользователяDataGridViewTextBoxColumn.DataPropertyName = "Код пользователя";
            this.кодПользователяDataGridViewTextBoxColumn.HeaderText = "Код пользователя";
            this.кодПользователяDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.кодПользователяDataGridViewTextBoxColumn.Name = "кодПользователяDataGridViewTextBoxColumn";
            this.кодПользователяDataGridViewTextBoxColumn.ReadOnly = true;
            this.кодПользователяDataGridViewTextBoxColumn.Visible = false;
            this.кодПользователяDataGridViewTextBoxColumn.Width = 145;
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
            // button3
            // 
            this.button3.BackColor = System.Drawing.Color.Crimson;
            this.button3.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.button3.Font = new System.Drawing.Font("Neucha", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.button3.ForeColor = System.Drawing.SystemColors.ButtonHighlight;
            this.button3.Location = new System.Drawing.Point(1239, 655);
            this.button3.Name = "button3";
            this.button3.Size = new System.Drawing.Size(214, 79);
            this.button3.TabIndex = 12;
            this.button3.Text = "⬅ Назад";
            this.button3.UseVisualStyleBackColor = false;
            this.button3.Click += new System.EventHandler(this.BtnBack_Click);
            // 
            // Пользователь
            // 
            this.Пользователь.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.Пользователь.DataPropertyName = "Пользователь";
            this.Пользователь.HeaderText = "Пользователь";
            this.Пользователь.MinimumWidth = 6;
            this.Пользователь.Name = "Пользователь";
            this.Пользователь.Width = 125;
            // 
            // Фильм
            // 
            this.Фильм.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.Фильм.DataPropertyName = "Фильм";
            this.Фильм.HeaderText = "Фильм";
            this.Фильм.MinimumWidth = 6;
            this.Фильм.Name = "Фильм";
            this.Фильм.Width = 125;
            // 
            // Режиссер
            // 
            this.Режиссер.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.Режиссер.DataPropertyName = "Режиссер";
            this.Режиссер.HeaderText = "Режиссер";
            this.Режиссер.MinimumWidth = 6;
            this.Режиссер.Name = "Режиссер";
            this.Режиссер.Width = 125;
            // 
            // Страна
            // 
            this.Страна.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.AllCells;
            this.Страна.DataPropertyName = "Страна";
            this.Страна.HeaderText = "Страна";
            this.Страна.MinimumWidth = 6;
            this.Страна.Name = "Страна";
            this.Страна.Width = 125;
            // 
            // историяTableAdapter
            // 
            this.историяTableAdapter.ClearBeforeFill = true;
            // 
            // FormView
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.PeachPuff;
            this.ClientSize = new System.Drawing.Size(1532, 758);
            this.Controls.Add(this.panelUser);
            this.Controls.Add(this.panelHistory);
            this.Controls.Add(this.panelFilm);
            this.Controls.Add(this.toolStrip);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "FormView";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Просмотр баз";
            this.Load += new System.EventHandler(this.FormView_Load);
            this.toolStrip.ResumeLayout(false);
            this.toolStrip.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewFilm)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.фильмыBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.databaseDataSet)).EndInit();
            this.panelFilmView.ResumeLayout(false);
            this.panelFilmView.PerformLayout();
            this.panelFilmSearch.ResumeLayout(false);
            this.panelFilmSearch.PerformLayout();
            this.panelFilm.ResumeLayout(false);
            this.panelUser.ResumeLayout(false);
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewUser)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.пользователиBindingSource)).EndInit();
            this.panel2.ResumeLayout(false);
            this.panel2.PerformLayout();
            this.panelHistory.ResumeLayout(false);
            this.panel1.ResumeLayout(false);
            this.panel1.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewHistory)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.историяBindingSource)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Button btnBackFilm;
        private System.Windows.Forms.ToolStrip toolStrip;
        private System.Windows.Forms.ToolStripButton toolStripFilmBtn;
        private System.Windows.Forms.ToolStripButton toolStripUserBtn;
        private System.Windows.Forms.ToolStripSeparator toolStripSeparator1;
        private System.Windows.Forms.ToolStripButton toolStripHistoryBtn;
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
        private System.Windows.Forms.DataGridViewTextBoxColumn кодDataGridViewTextBoxColumn1;
        private System.Windows.Forms.DataGridViewTextBoxColumn названиеDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn жанрDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn режиссерDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn странаDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn годDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn актерыDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn краткаяАннотацияDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewCheckBoxColumn отсутствуетDataGridViewCheckBoxColumn;
        private System.Windows.Forms.BindingSource пользователиBindingSource;
        private DatabaseDataSetTableAdapters.ПользователиTableAdapter пользователиTableAdapter;
        private System.Windows.Forms.Panel panelHistory;
        private System.Windows.Forms.DataGridView dataGridViewHistory;
        private System.Windows.Forms.Button button3;
        private System.Windows.Forms.DataGridViewTextBoxColumn Пользователь;
        private System.Windows.Forms.DataGridViewTextBoxColumn Фильм;
        private System.Windows.Forms.DataGridViewTextBoxColumn Режиссер;
        private System.Windows.Forms.DataGridViewTextBoxColumn Страна;
        private System.Windows.Forms.BindingSource историяBindingSource;
        private DatabaseDataSetTableAdapters.ИсторияTableAdapter историяTableAdapter;
        private System.Windows.Forms.DataGridViewTextBoxColumn фамилияDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn имяDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn отчествоDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn адресDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn датаПоследнегоПосещенияDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодDataGridViewTextBoxColumn2;
        private System.Windows.Forms.DataGridViewTextBoxColumn пользовательDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn фильмDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn режиссерDataGridViewTextBoxColumn1;
        private System.Windows.Forms.DataGridViewTextBoxColumn годВыходаDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn странаDataGridViewTextBoxColumn1;
        private System.Windows.Forms.DataGridViewTextBoxColumn датаВзятияDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn датаВозвратаDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодDataGridViewTextBoxColumn3;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодПользователяDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn кодФильмаDataGridViewTextBoxColumn;
        private System.Windows.Forms.Panel panel1;
        private System.Windows.Forms.Button buttonResetSearch;
        private System.Windows.Forms.Button buttonHistoryFilmSearch;
        private System.Windows.Forms.TextBox textBoxSearchFilm;
        private System.Windows.Forms.Label label10;
        private System.Windows.Forms.Button buttonHistoryUserSearch;
        private System.Windows.Forms.TextBox textBoxSearchUser;
        private System.Windows.Forms.Label label11;
    }
}