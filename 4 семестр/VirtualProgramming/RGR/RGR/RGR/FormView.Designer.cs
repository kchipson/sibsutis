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
            System.Windows.Forms.DataGridViewCellStyle dataGridViewCellStyle6 = new System.Windows.Forms.DataGridViewCellStyle();
            System.Windows.Forms.DataGridViewCellStyle dataGridViewCellStyle1 = new System.Windows.Forms.DataGridViewCellStyle();
            System.Windows.Forms.DataGridViewCellStyle dataGridViewCellStyle2 = new System.Windows.Forms.DataGridViewCellStyle();
            System.Windows.Forms.DataGridViewCellStyle dataGridViewCellStyle3 = new System.Windows.Forms.DataGridViewCellStyle();
            System.Windows.Forms.DataGridViewCellStyle dataGridViewCellStyle4 = new System.Windows.Forms.DataGridViewCellStyle();
            System.Windows.Forms.DataGridViewCellStyle dataGridViewCellStyle5 = new System.Windows.Forms.DataGridViewCellStyle();
            this.btnBackFilm = new System.Windows.Forms.Button();
            this.toolStrip = new System.Windows.Forms.ToolStrip();
            this.toolStripButton1 = new System.Windows.Forms.ToolStripButton();
            this.toolStripButton2 = new System.Windows.Forms.ToolStripButton();
            this.toolStripSeparator1 = new System.Windows.Forms.ToolStripSeparator();
            this.toolStripButton3 = new System.Windows.Forms.ToolStripButton();
            this.dataGridViewFilm = new System.Windows.Forms.DataGridView();
            this.label1 = new System.Windows.Forms.Label();
            this.radioBtnFilmAll = new System.Windows.Forms.RadioButton();
            this.panelFilmView = new System.Windows.Forms.Panel();
            this.radioBtnFilmAbsent = new System.Windows.Forms.RadioButton();
            this.radioBtnFilmPresent = new System.Windows.Forms.RadioButton();
            this.panelFilmSearch = new System.Windows.Forms.Panel();
            this.buttonSearchActor = new System.Windows.Forms.Button();
            this.textBoxSearchActor = new System.Windows.Forms.TextBox();
            this.label4 = new System.Windows.Forms.Label();
            this.buttonSearchGenre = new System.Windows.Forms.Button();
            this.textBoxSearchGenre = new System.Windows.Forms.TextBox();
            this.label3 = new System.Windows.Forms.Label();
            this.buttonSearchFilm = new System.Windows.Forms.Button();
            this.textBoxSearchName = new System.Windows.Forms.TextBox();
            this.label2 = new System.Windows.Forms.Label();
            this.названиеDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.жанрDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.годDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.странаDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.режисерDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.краткаяАннотацияDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.актерыDataGridViewTextBoxColumn = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.отсутствуетDataGridViewCheckBoxColumn = new System.Windows.Forms.DataGridViewCheckBoxColumn();
            this.фильмыBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.databaseDataSet = new RGR.DatabaseDataSet();
            this.фильмыTableAdapter = new RGR.DatabaseDataSetTableAdapters.ФильмыTableAdapter();
            this.пользователиBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.пользователиTableAdapter = new RGR.DatabaseDataSetTableAdapters.ПользователиTableAdapter();
            this.историяBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.историяTableAdapter = new RGR.DatabaseDataSetTableAdapters.ИсторияTableAdapter();
            this.databaseDataSet1 = new RGR.DatabaseDataSet();
            this.panelFilm = new System.Windows.Forms.Panel();
            this.toolStrip.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewFilm)).BeginInit();
            this.panelFilmView.SuspendLayout();
            this.panelFilmSearch.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.фильмыBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.databaseDataSet)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.пользователиBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.историяBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.databaseDataSet1)).BeginInit();
            this.panelFilm.SuspendLayout();
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
            this.btnBackFilm.Click += new System.EventHandler(this.btnBack_Click);
            // 
            // toolStrip
            // 
            this.toolStrip.BackColor = System.Drawing.Color.PapayaWhip;
            this.toolStrip.Dock = System.Windows.Forms.DockStyle.Left;
            this.toolStrip.GripStyle = System.Windows.Forms.ToolStripGripStyle.Hidden;
            this.toolStrip.ImageScalingSize = new System.Drawing.Size(20, 20);
            this.toolStrip.Items.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this.toolStripButton1,
            this.toolStripButton2,
            this.toolStripSeparator1,
            this.toolStripButton3});
            this.toolStrip.LayoutStyle = System.Windows.Forms.ToolStripLayoutStyle.VerticalStackWithOverflow;
            this.toolStrip.Location = new System.Drawing.Point(0, 0);
            this.toolStrip.Name = "toolStrip";
            this.toolStrip.Size = new System.Drawing.Size(60, 758);
            this.toolStrip.TabIndex = 13;
            this.toolStrip.Text = "toolStrip";
            // 
            // toolStripButton1
            // 
            this.toolStripButton1.BackColor = System.Drawing.Color.PowderBlue;
            this.toolStripButton1.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Text;
            this.toolStripButton1.Font = new System.Drawing.Font("Bad Script", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.toolStripButton1.Image = ((System.Drawing.Image)(resources.GetObject("toolStripButton1.Image")));
            this.toolStripButton1.ImageTransparentColor = System.Drawing.Color.Magenta;
            this.toolStripButton1.Margin = new System.Windows.Forms.Padding(5, 5, 2, 10);
            this.toolStripButton1.Name = "toolStripButton1";
            this.toolStripButton1.Size = new System.Drawing.Size(50, 118);
            this.toolStripButton1.Text = "Фильмы";
            this.toolStripButton1.TextDirection = System.Windows.Forms.ToolStripTextDirection.Vertical270;
            this.toolStripButton1.ToolTipText = "Открыть базу данных с фильмами";
            // 
            // toolStripButton2
            // 
            this.toolStripButton2.BackColor = System.Drawing.Color.Salmon;
            this.toolStripButton2.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Text;
            this.toolStripButton2.Font = new System.Drawing.Font("Bad Script", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.toolStripButton2.Image = ((System.Drawing.Image)(resources.GetObject("toolStripButton2.Image")));
            this.toolStripButton2.ImageTransparentColor = System.Drawing.Color.Magenta;
            this.toolStripButton2.Margin = new System.Windows.Forms.Padding(5, 10, 2, 10);
            this.toolStripButton2.Name = "toolStripButton2";
            this.toolStripButton2.Size = new System.Drawing.Size(50, 157);
            this.toolStripButton2.Text = "Пользователи";
            this.toolStripButton2.TextDirection = System.Windows.Forms.ToolStripTextDirection.Vertical270;
            this.toolStripButton2.ToolTipText = "Открыть базу данных с пользователями";
            // 
            // toolStripSeparator1
            // 
            this.toolStripSeparator1.Name = "toolStripSeparator1";
            this.toolStripSeparator1.Size = new System.Drawing.Size(57, 6);
            // 
            // toolStripButton3
            // 
            this.toolStripButton3.BackColor = System.Drawing.Color.Turquoise;
            this.toolStripButton3.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Text;
            this.toolStripButton3.Font = new System.Drawing.Font("Bad Script", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.toolStripButton3.Image = ((System.Drawing.Image)(resources.GetObject("toolStripButton3.Image")));
            this.toolStripButton3.ImageTransparentColor = System.Drawing.Color.Magenta;
            this.toolStripButton3.Margin = new System.Windows.Forms.Padding(5, 10, 2, 0);
            this.toolStripButton3.Name = "toolStripButton3";
            this.toolStripButton3.Size = new System.Drawing.Size(50, 104);
            this.toolStripButton3.Text = "История";
            this.toolStripButton3.TextDirection = System.Windows.Forms.ToolStripTextDirection.Vertical270;
            this.toolStripButton3.ToolTipText = "Открыть базу данных с историей";
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
            this.названиеDataGridViewTextBoxColumn,
            this.жанрDataGridViewTextBoxColumn,
            this.годDataGridViewTextBoxColumn,
            this.странаDataGridViewTextBoxColumn,
            this.режисерDataGridViewTextBoxColumn,
            this.краткаяАннотацияDataGridViewTextBoxColumn,
            this.актерыDataGridViewTextBoxColumn,
            this.отсутствуетDataGridViewCheckBoxColumn});
            this.dataGridViewFilm.DataSource = this.фильмыBindingSource;
            dataGridViewCellStyle6.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleLeft;
            dataGridViewCellStyle6.BackColor = System.Drawing.SystemColors.Window;
            dataGridViewCellStyle6.Font = new System.Drawing.Font("Microsoft Sans Serif", 7.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            dataGridViewCellStyle6.ForeColor = System.Drawing.SystemColors.ControlText;
            dataGridViewCellStyle6.SelectionBackColor = System.Drawing.SystemColors.Highlight;
            dataGridViewCellStyle6.SelectionForeColor = System.Drawing.SystemColors.HighlightText;
            dataGridViewCellStyle6.WrapMode = System.Windows.Forms.DataGridViewTriState.True;
            this.dataGridViewFilm.DefaultCellStyle = dataGridViewCellStyle6;
            this.dataGridViewFilm.Location = new System.Drawing.Point(16, 16);
            this.dataGridViewFilm.Name = "dataGridViewFilm";
            this.dataGridViewFilm.ReadOnly = true;
            this.dataGridViewFilm.RowHeadersWidthSizeMode = System.Windows.Forms.DataGridViewRowHeadersWidthSizeMode.AutoSizeToDisplayedHeaders;
            this.dataGridViewFilm.RowTemplate.Height = 24;
            this.dataGridViewFilm.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.FullRowSelect;
            this.dataGridViewFilm.Size = new System.Drawing.Size(1444, 552);
            this.dataGridViewFilm.TabIndex = 14;
            this.dataGridViewFilm.RowPrePaint += new System.Windows.Forms.DataGridViewRowPrePaintEventHandler(this.dataGridViewFilm_RowPrePaint);
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
            this.radioBtnFilmAll.CheckedChanged += new System.EventHandler(this.radioBtnFilmAll_CheckedChanged);
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
            this.radioBtnFilmAbsent.CheckedChanged += new System.EventHandler(this.radioBtnFilmAbsent_CheckedChanged);
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
            this.radioBtnFilmPresent.CheckedChanged += new System.EventHandler(this.radioBtnFilmPresent_CheckedChanged);
            // 
            // panelFilmSearch
            // 
            this.panelFilmSearch.Controls.Add(this.buttonSearchActor);
            this.panelFilmSearch.Controls.Add(this.textBoxSearchActor);
            this.panelFilmSearch.Controls.Add(this.label4);
            this.panelFilmSearch.Controls.Add(this.buttonSearchGenre);
            this.panelFilmSearch.Controls.Add(this.textBoxSearchGenre);
            this.panelFilmSearch.Controls.Add(this.label3);
            this.panelFilmSearch.Controls.Add(this.buttonSearchFilm);
            this.panelFilmSearch.Controls.Add(this.textBoxSearchName);
            this.panelFilmSearch.Controls.Add(this.label2);
            this.panelFilmSearch.Location = new System.Drawing.Point(291, 586);
            this.panelFilmSearch.Name = "panelFilmSearch";
            this.panelFilmSearch.Size = new System.Drawing.Size(932, 160);
            this.panelFilmSearch.TabIndex = 20;
            // 
            // buttonSearchActor
            // 
            this.buttonSearchActor.BackColor = System.Drawing.Color.Pink;
            this.buttonSearchActor.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonSearchActor.Font = new System.Drawing.Font("Neucha", 16.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonSearchActor.Location = new System.Drawing.Point(608, 103);
            this.buttonSearchActor.Name = "buttonSearchActor";
            this.buttonSearchActor.Size = new System.Drawing.Size(225, 49);
            this.buttonSearchActor.TabIndex = 23;
            this.buttonSearchActor.Text = "Поиск";
            this.buttonSearchActor.UseVisualStyleBackColor = false;
            this.buttonSearchActor.Click += new System.EventHandler(this.buttonSearchActor_Click);
            // 
            // textBoxSearchActor
            // 
            this.textBoxSearchActor.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxSearchActor.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxSearchActor.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxSearchActor.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxSearchActor.Location = new System.Drawing.Point(608, 51);
            this.textBoxSearchActor.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxSearchActor.Name = "textBoxSearchActor";
            this.textBoxSearchActor.Size = new System.Drawing.Size(226, 36);
            this.textBoxSearchActor.TabIndex = 22;
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label4.Location = new System.Drawing.Point(603, 14);
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
            this.buttonSearchGenre.Location = new System.Drawing.Point(314, 103);
            this.buttonSearchGenre.Name = "buttonSearchGenre";
            this.buttonSearchGenre.Size = new System.Drawing.Size(225, 49);
            this.buttonSearchGenre.TabIndex = 20;
            this.buttonSearchGenre.Text = "Поиск";
            this.buttonSearchGenre.UseVisualStyleBackColor = false;
            this.buttonSearchGenre.Click += new System.EventHandler(this.buttonSearchGenre_Click);
            // 
            // textBoxSearchGenre
            // 
            this.textBoxSearchGenre.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left)));
            this.textBoxSearchGenre.BackColor = System.Drawing.Color.PapayaWhip;
            this.textBoxSearchGenre.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.textBoxSearchGenre.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.textBoxSearchGenre.Location = new System.Drawing.Point(314, 51);
            this.textBoxSearchGenre.Margin = new System.Windows.Forms.Padding(4);
            this.textBoxSearchGenre.Name = "textBoxSearchGenre";
            this.textBoxSearchGenre.Size = new System.Drawing.Size(226, 36);
            this.textBoxSearchGenre.TabIndex = 19;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Neucha", 13.8F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.label3.Location = new System.Drawing.Point(309, 14);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(167, 29);
            this.label3.TabIndex = 18;
            this.label3.Text = "Поиск по жанру";
            // 
            // buttonSearchFilm
            // 
            this.buttonSearchFilm.BackColor = System.Drawing.Color.PaleVioletRed;
            this.buttonSearchFilm.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.buttonSearchFilm.Font = new System.Drawing.Font("Neucha", 16.2F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.buttonSearchFilm.Location = new System.Drawing.Point(21, 103);
            this.buttonSearchFilm.Name = "buttonSearchFilm";
            this.buttonSearchFilm.Size = new System.Drawing.Size(225, 49);
            this.buttonSearchFilm.TabIndex = 17;
            this.buttonSearchFilm.Text = "Поиск";
            this.buttonSearchFilm.UseVisualStyleBackColor = false;
            this.buttonSearchFilm.Click += new System.EventHandler(this.buttonSearchFilm_Click);
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
            // названиеDataGridViewTextBoxColumn
            // 
            this.названиеDataGridViewTextBoxColumn.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.DisplayedCells;
            this.названиеDataGridViewTextBoxColumn.DataPropertyName = "Название";
            dataGridViewCellStyle1.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleCenter;
            this.названиеDataGridViewTextBoxColumn.DefaultCellStyle = dataGridViewCellStyle1;
            this.названиеDataGridViewTextBoxColumn.HeaderText = "Название";
            this.названиеDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.названиеDataGridViewTextBoxColumn.Name = "названиеDataGridViewTextBoxColumn";
            this.названиеDataGridViewTextBoxColumn.ReadOnly = true;
            this.названиеDataGridViewTextBoxColumn.Width = 101;
            // 
            // жанрDataGridViewTextBoxColumn
            // 
            this.жанрDataGridViewTextBoxColumn.DataPropertyName = "Жанр";
            dataGridViewCellStyle2.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleCenter;
            this.жанрDataGridViewTextBoxColumn.DefaultCellStyle = dataGridViewCellStyle2;
            this.жанрDataGridViewTextBoxColumn.HeaderText = "Жанр";
            this.жанрDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.жанрDataGridViewTextBoxColumn.Name = "жанрDataGridViewTextBoxColumn";
            this.жанрDataGridViewTextBoxColumn.ReadOnly = true;
            this.жанрDataGridViewTextBoxColumn.Width = 74;
            // 
            // годDataGridViewTextBoxColumn
            // 
            this.годDataGridViewTextBoxColumn.DataPropertyName = "Год";
            dataGridViewCellStyle3.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleCenter;
            this.годDataGridViewTextBoxColumn.DefaultCellStyle = dataGridViewCellStyle3;
            this.годDataGridViewTextBoxColumn.HeaderText = "Год";
            this.годDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.годDataGridViewTextBoxColumn.Name = "годDataGridViewTextBoxColumn";
            this.годDataGridViewTextBoxColumn.ReadOnly = true;
            this.годDataGridViewTextBoxColumn.Width = 61;
            // 
            // странаDataGridViewTextBoxColumn
            // 
            this.странаDataGridViewTextBoxColumn.DataPropertyName = "Страна";
            dataGridViewCellStyle4.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleCenter;
            this.странаDataGridViewTextBoxColumn.DefaultCellStyle = dataGridViewCellStyle4;
            this.странаDataGridViewTextBoxColumn.HeaderText = "Страна";
            this.странаDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.странаDataGridViewTextBoxColumn.Name = "странаDataGridViewTextBoxColumn";
            this.странаDataGridViewTextBoxColumn.ReadOnly = true;
            this.странаDataGridViewTextBoxColumn.Width = 85;
            // 
            // режисерDataGridViewTextBoxColumn
            // 
            this.режисерDataGridViewTextBoxColumn.DataPropertyName = "Режисер";
            dataGridViewCellStyle5.Alignment = System.Windows.Forms.DataGridViewContentAlignment.MiddleCenter;
            this.режисерDataGridViewTextBoxColumn.DefaultCellStyle = dataGridViewCellStyle5;
            this.режисерDataGridViewTextBoxColumn.HeaderText = "Режисер";
            this.режисерDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.режисерDataGridViewTextBoxColumn.Name = "режисерDataGridViewTextBoxColumn";
            this.режисерDataGridViewTextBoxColumn.ReadOnly = true;
            this.режисерDataGridViewTextBoxColumn.Width = 94;
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
            // актерыDataGridViewTextBoxColumn
            // 
            this.актерыDataGridViewTextBoxColumn.DataPropertyName = "Актеры";
            this.актерыDataGridViewTextBoxColumn.HeaderText = "Актеры";
            this.актерыDataGridViewTextBoxColumn.MinimumWidth = 6;
            this.актерыDataGridViewTextBoxColumn.Name = "актерыDataGridViewTextBoxColumn";
            this.актерыDataGridViewTextBoxColumn.ReadOnly = true;
            this.актерыDataGridViewTextBoxColumn.Width = 86;
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
            // фильмыTableAdapter
            // 
            this.фильмыTableAdapter.ClearBeforeFill = true;
            // 
            // пользователиBindingSource
            // 
            this.пользователиBindingSource.DataMember = "Пользователи";
            this.пользователиBindingSource.DataSource = this.databaseDataSet;
            // 
            // пользователиTableAdapter
            // 
            this.пользователиTableAdapter.ClearBeforeFill = true;
            // 
            // историяBindingSource
            // 
            this.историяBindingSource.DataMember = "История";
            this.историяBindingSource.DataSource = this.databaseDataSet;
            // 
            // историяTableAdapter
            // 
            this.историяTableAdapter.ClearBeforeFill = true;
            // 
            // databaseDataSet1
            // 
            this.databaseDataSet1.DataSetName = "DatabaseDataSet";
            this.databaseDataSet1.SchemaSerializationMode = System.Data.SchemaSerializationMode.IncludeSchema;
            // 
            // panelFilm
            // 
            this.panelFilm.Controls.Add(this.dataGridViewFilm);
            this.panelFilm.Controls.Add(this.panelFilmSearch);
            this.panelFilm.Controls.Add(this.btnBackFilm);
            this.panelFilm.Controls.Add(this.panelFilmView);
            this.panelFilm.Location = new System.Drawing.Point(63, 8);
            this.panelFilm.Name = "panelFilm";
            this.panelFilm.Size = new System.Drawing.Size(1467, 750);
            this.panelFilm.TabIndex = 21;
            // 
            // FormView
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.PeachPuff;
            this.ClientSize = new System.Drawing.Size(1532, 758);
            this.Controls.Add(this.panelFilm);
            this.Controls.Add(this.toolStrip);
            this.MaximizeBox = false;
            this.MaximumSize = new System.Drawing.Size(1550, 800);
            this.MinimizeBox = false;
            this.MinimumSize = new System.Drawing.Size(1550, 800);
            this.Name = "FormView";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Просмотр баз";
            this.Load += new System.EventHandler(this.FormView_Load);
            this.toolStrip.ResumeLayout(false);
            this.toolStrip.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridViewFilm)).EndInit();
            this.panelFilmView.ResumeLayout(false);
            this.panelFilmView.PerformLayout();
            this.panelFilmSearch.ResumeLayout(false);
            this.panelFilmSearch.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.фильмыBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.databaseDataSet)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.пользователиBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.историяBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.databaseDataSet1)).EndInit();
            this.panelFilm.ResumeLayout(false);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Button btnBackFilm;
        private System.Windows.Forms.ToolStrip toolStrip;
        private System.Windows.Forms.ToolStripButton toolStripButton1;
        private System.Windows.Forms.ToolStripButton toolStripButton2;
        private System.Windows.Forms.ToolStripSeparator toolStripSeparator1;
        private System.Windows.Forms.ToolStripButton toolStripButton3;
        private System.Windows.Forms.DataGridView dataGridViewFilm;
        private DatabaseDataSet databaseDataSet;
        private System.Windows.Forms.BindingSource фильмыBindingSource;
        private DatabaseDataSetTableAdapters.ФильмыTableAdapter фильмыTableAdapter;
        private System.Windows.Forms.BindingSource пользователиBindingSource;
        private DatabaseDataSetTableAdapters.ПользователиTableAdapter пользователиTableAdapter;
        private System.Windows.Forms.BindingSource историяBindingSource;
        private DatabaseDataSetTableAdapters.ИсторияTableAdapter историяTableAdapter;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.RadioButton radioBtnFilmAll;
        private System.Windows.Forms.Panel panelFilmView;
        private System.Windows.Forms.RadioButton radioBtnFilmAbsent;
        private System.Windows.Forms.RadioButton radioBtnFilmPresent;
        private System.Windows.Forms.Panel panelFilmSearch;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.DataGridViewTextBoxColumn названиеDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn жанрDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn годDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn странаDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn режисерDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn краткаяАннотацияDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewTextBoxColumn актерыDataGridViewTextBoxColumn;
        private System.Windows.Forms.DataGridViewCheckBoxColumn отсутствуетDataGridViewCheckBoxColumn;
        private System.Windows.Forms.Button buttonSearchActor;
        private System.Windows.Forms.TextBox textBoxSearchActor;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Button buttonSearchGenre;
        private System.Windows.Forms.TextBox textBoxSearchGenre;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Button buttonSearchFilm;
        private System.Windows.Forms.TextBox textBoxSearchName;
        private DatabaseDataSet databaseDataSet1;
        private System.Windows.Forms.Panel panelFilm;
    }
}