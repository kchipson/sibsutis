using System.ComponentModel;

namespace laboratoryWork_2
{
    partial class FormMain
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private IContainer components = null;

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
            this.menuStrip1 = new System.Windows.Forms.MenuStrip();
            this.fileToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.openToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.saveToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.exitToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.aboutStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.leftMainPanel = new System.Windows.Forms.Panel();
            this.label2 = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.groupSearch = new System.Windows.Forms.GroupBox();
            this.buttonSearch = new System.Windows.Forms.Button();
            this.checkSection2 = new System.Windows.Forms.CheckBox();
            this.checkSection1 = new System.Windows.Forms.CheckBox();
            this.listBoxSearch = new System.Windows.Forms.ListBox();
            this.textBoxWord = new System.Windows.Forms.TextBox();
            this.labelSearch = new System.Windows.Forms.Label();
            this.groupChoiceWorld = new System.Windows.Forms.GroupBox();
            this.radioChoiceAll = new System.Windows.Forms.RadioButton();
            this.buttonStart = new System.Windows.Forms.Button();
            this.radioChoiceEmail = new System.Windows.Forms.RadioButton();
            this.radioChoiceNumbers = new System.Windows.Forms.RadioButton();
            this.buttonClose = new System.Windows.Forms.Button();
            this.buttonReset = new System.Windows.Forms.Button();
            this.buttonClearSection2 = new System.Windows.Forms.Button();
            this.buttonSortSection2 = new System.Windows.Forms.Button();
            this.buttonClearSection1 = new System.Windows.Forms.Button();
            this.buttonSortSection1 = new System.Windows.Forms.Button();
            this.buttonsPanel = new System.Windows.Forms.Panel();
            this.buttonDel = new System.Windows.Forms.Button();
            this.buttonAdd = new System.Windows.Forms.Button();
            this.buttonLeftAllMove = new System.Windows.Forms.Button();
            this.buttonRightAllMove = new System.Windows.Forms.Button();
            this.buttonLeftMove = new System.Windows.Forms.Button();
            this.buttonRightMove = new System.Windows.Forms.Button();
            this.listBoxSection2 = new System.Windows.Forms.ListBox();
            this.listBoxSection1 = new System.Windows.Forms.ListBox();
            this.comboBoxSection2 = new System.Windows.Forms.ComboBox();
            this.comboBoxSection1 = new System.Windows.Forms.ComboBox();
            this.labelSection2 = new System.Windows.Forms.Label();
            this.labelSection1 = new System.Windows.Forms.Label();
            this.textWorkSpace = new System.Windows.Forms.TextBox();
            this.menuStrip1.SuspendLayout();
            this.leftMainPanel.SuspendLayout();
            this.groupSearch.SuspendLayout();
            this.groupChoiceWorld.SuspendLayout();
            this.buttonsPanel.SuspendLayout();
            this.SuspendLayout();
            // 
            // menuStrip1
            // 
            this.menuStrip1.BackColor = System.Drawing.Color.NavajoWhite;
            this.menuStrip1.Items.AddRange(new System.Windows.Forms.ToolStripItem[]
                {this.fileToolStripMenuItem, this.aboutStripMenuItem});
            this.menuStrip1.Location = new System.Drawing.Point(0, 0);
            this.menuStrip1.Name = "menuStrip1";
            this.menuStrip1.Size = new System.Drawing.Size(1184, 24);
            this.menuStrip1.TabIndex = 0;
            this.menuStrip1.Text = "menuStrip1";
            // 
            // fileToolStripMenuItem
            // 
            this.fileToolStripMenuItem.DropDownItems.AddRange(new System.Windows.Forms.ToolStripItem[]
                {this.openToolStripMenuItem, this.saveToolStripMenuItem, this.exitToolStripMenuItem});
            this.fileToolStripMenuItem.Name = "fileToolStripMenuItem";
            this.fileToolStripMenuItem.Size = new System.Drawing.Size(37, 20);
            this.fileToolStripMenuItem.Text = "File";
            // 
            // openToolStripMenuItem
            // 
            this.openToolStripMenuItem.Name = "openToolStripMenuItem";
            this.openToolStripMenuItem.ShortcutKeys =
                ((System.Windows.Forms.Keys) ((System.Windows.Forms.Keys.Control | System.Windows.Forms.Keys.O)));
            this.openToolStripMenuItem.Size = new System.Drawing.Size(172, 22);
            this.openToolStripMenuItem.Text = "Открыть";
            this.openToolStripMenuItem.Click += new System.EventHandler(this.openToolStripMenuItem_Click);
            // 
            // saveToolStripMenuItem
            // 
            this.saveToolStripMenuItem.Name = "saveToolStripMenuItem";
            this.saveToolStripMenuItem.ShortcutKeys =
                ((System.Windows.Forms.Keys) ((System.Windows.Forms.Keys.Control | System.Windows.Forms.Keys.S)));
            this.saveToolStripMenuItem.Size = new System.Drawing.Size(172, 22);
            this.saveToolStripMenuItem.Text = "Сохранить";
            this.saveToolStripMenuItem.Click += new System.EventHandler(this.saveToolStripMenuItem_Click);
            // 
            // exitToolStripMenuItem
            // 
            this.exitToolStripMenuItem.Name = "exitToolStripMenuItem";
            this.exitToolStripMenuItem.ShortcutKeys =
                ((System.Windows.Forms.Keys) ((System.Windows.Forms.Keys.Control | System.Windows.Forms.Keys.Q)));
            this.exitToolStripMenuItem.Size = new System.Drawing.Size(172, 22);
            this.exitToolStripMenuItem.Text = "Выйти";
            this.exitToolStripMenuItem.Click += new System.EventHandler(this.exitToolStripMenuItem_Click);
            // 
            // aboutStripMenuItem
            // 
            this.aboutStripMenuItem.Name = "aboutStripMenuItem";
            this.aboutStripMenuItem.Size = new System.Drawing.Size(24, 20);
            this.aboutStripMenuItem.Text = "?";
            this.aboutStripMenuItem.Click += new System.EventHandler(this.aboutStripMenuItem_Click);
            // 
            // leftMainPanel
            // 
            this.leftMainPanel.BackColor = System.Drawing.Color.Bisque;
            this.leftMainPanel.Controls.Add(this.label2);
            this.leftMainPanel.Controls.Add(this.label1);
            this.leftMainPanel.Controls.Add(this.groupSearch);
            this.leftMainPanel.Controls.Add(this.groupChoiceWorld);
            this.leftMainPanel.Controls.Add(this.buttonClose);
            this.leftMainPanel.Controls.Add(this.buttonReset);
            this.leftMainPanel.Controls.Add(this.buttonClearSection2);
            this.leftMainPanel.Controls.Add(this.buttonSortSection2);
            this.leftMainPanel.Controls.Add(this.buttonClearSection1);
            this.leftMainPanel.Controls.Add(this.buttonSortSection1);
            this.leftMainPanel.Controls.Add(this.buttonsPanel);
            this.leftMainPanel.Controls.Add(this.listBoxSection2);
            this.leftMainPanel.Controls.Add(this.listBoxSection1);
            this.leftMainPanel.Controls.Add(this.comboBoxSection2);
            this.leftMainPanel.Controls.Add(this.comboBoxSection1);
            this.leftMainPanel.Controls.Add(this.labelSection2);
            this.leftMainPanel.Controls.Add(this.labelSection1);
            this.leftMainPanel.Location = new System.Drawing.Point(12, 39);
            this.leftMainPanel.Name = "leftMainPanel";
            this.leftMainPanel.Size = new System.Drawing.Size(864, 590);
            this.leftMainPanel.TabIndex = 1;
            // 
            // label2
            // 
            this.label2.Font = new System.Drawing.Font("Segoe UI", 9F);
            this.label2.Location = new System.Drawing.Point(549, 25);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(148, 16);
            this.label2.TabIndex = 24;
            this.label2.Text = "Сортировать по...";
            // 
            // label1
            // 
            this.label1.Font = new System.Drawing.Font("Segoe UI", 9F);
            this.label1.Location = new System.Drawing.Point(19, 25);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(148, 16);
            this.label1.TabIndex = 23;
            this.label1.Text = "Сортировать по...";
            // 
            // groupSearch
            // 
            this.groupSearch.Controls.Add(this.buttonSearch);
            this.groupSearch.Controls.Add(this.checkSection2);
            this.groupSearch.Controls.Add(this.checkSection1);
            this.groupSearch.Controls.Add(this.listBoxSearch);
            this.groupSearch.Controls.Add(this.textBoxWord);
            this.groupSearch.Controls.Add(this.labelSearch);
            this.groupSearch.Location = new System.Drawing.Point(19, 407);
            this.groupSearch.Name = "groupSearch";
            this.groupSearch.Size = new System.Drawing.Size(361, 178);
            this.groupSearch.TabIndex = 13;
            this.groupSearch.TabStop = false;
            this.groupSearch.Text = "Поиск";
            // 
            // buttonSearch
            // 
            this.buttonSearch.Enabled = false;
            this.buttonSearch.Location = new System.Drawing.Point(211, 119);
            this.buttonSearch.Name = "buttonSearch";
            this.buttonSearch.Size = new System.Drawing.Size(124, 46);
            this.buttonSearch.TabIndex = 16;
            this.buttonSearch.Text = "Поиск";
            this.buttonSearch.UseVisualStyleBackColor = true;
            this.buttonSearch.Click += new System.EventHandler(this.buttonSearch_Click);
            // 
            // checkSection2
            // 
            this.checkSection2.Location = new System.Drawing.Point(211, 77);
            this.checkSection2.Name = "checkSection2";
            this.checkSection2.Size = new System.Drawing.Size(124, 27);
            this.checkSection2.TabIndex = 15;
            this.checkSection2.Text = "Раздел 2";
            this.checkSection2.UseVisualStyleBackColor = true;
            // 
            // checkSection1
            // 
            this.checkSection1.Checked = true;
            this.checkSection1.CheckState = System.Windows.Forms.CheckState.Checked;
            this.checkSection1.Location = new System.Drawing.Point(211, 51);
            this.checkSection1.Name = "checkSection1";
            this.checkSection1.Size = new System.Drawing.Size(124, 27);
            this.checkSection1.TabIndex = 14;
            this.checkSection1.Text = "Раздел 1";
            this.checkSection1.UseVisualStyleBackColor = true;
            // 
            // listBoxSearch
            // 
            this.listBoxSearch.FormattingEnabled = true;
            this.listBoxSearch.ItemHeight = 15;
            this.listBoxSearch.Location = new System.Drawing.Point(6, 77);
            this.listBoxSearch.Name = "listBoxSearch";
            this.listBoxSearch.SelectionMode = System.Windows.Forms.SelectionMode.MultiExtended;
            this.listBoxSearch.Size = new System.Drawing.Size(188, 94);
            this.listBoxSearch.TabIndex = 0;
            this.listBoxSearch.TabStop = false;
            // 
            // textBoxWord
            // 
            this.textBoxWord.Location = new System.Drawing.Point(6, 48);
            this.textBoxWord.Name = "textBoxWord";
            this.textBoxWord.Size = new System.Drawing.Size(188, 23);
            this.textBoxWord.TabIndex = 13;
            this.textBoxWord.TextChanged += new System.EventHandler(this.textBoxWord_TextChanged);
            // 
            // labelSearch
            // 
            this.labelSearch.Location = new System.Drawing.Point(6, 28);
            this.labelSearch.Name = "labelSearch";
            this.labelSearch.Size = new System.Drawing.Size(152, 15);
            this.labelSearch.TabIndex = 0;
            this.labelSearch.Text = "Введите искомое слово";
            // 
            // groupChoiceWorld
            // 
            this.groupChoiceWorld.Controls.Add(this.radioChoiceAll);
            this.groupChoiceWorld.Controls.Add(this.buttonStart);
            this.groupChoiceWorld.Controls.Add(this.radioChoiceEmail);
            this.groupChoiceWorld.Controls.Add(this.radioChoiceNumbers);
            this.groupChoiceWorld.Location = new System.Drawing.Point(480, 409);
            this.groupChoiceWorld.Name = "groupChoiceWorld";
            this.groupChoiceWorld.Size = new System.Drawing.Size(364, 108);
            this.groupChoiceWorld.TabIndex = 0;
            this.groupChoiceWorld.TabStop = false;
            this.groupChoiceWorld.Text = "Выбор слов";
            // 
            // radioChoiceAll
            // 
            this.radioChoiceAll.Checked = true;
            this.radioChoiceAll.Location = new System.Drawing.Point(16, 26);
            this.radioChoiceAll.Name = "radioChoiceAll";
            this.radioChoiceAll.Size = new System.Drawing.Size(165, 20);
            this.radioChoiceAll.TabIndex = 17;
            this.radioChoiceAll.TabStop = true;
            this.radioChoiceAll.Text = "Все";
            this.radioChoiceAll.UseVisualStyleBackColor = true;
            // 
            // buttonStart
            // 
            this.buttonStart.Enabled = false;
            this.buttonStart.Location = new System.Drawing.Point(234, 49);
            this.buttonStart.Name = "buttonStart";
            this.buttonStart.Size = new System.Drawing.Size(124, 46);
            this.buttonStart.TabIndex = 20;
            this.buttonStart.Text = "Начать";
            this.buttonStart.UseVisualStyleBackColor = true;
            this.buttonStart.Click += new System.EventHandler(this.buttonStart_Click);
            // 
            // radioChoiceEmail
            // 
            this.radioChoiceEmail.Location = new System.Drawing.Point(16, 75);
            this.radioChoiceEmail.Name = "radioChoiceEmail";
            this.radioChoiceEmail.Size = new System.Drawing.Size(165, 20);
            this.radioChoiceEmail.TabIndex = 19;
            this.radioChoiceEmail.Text = "Содержащие \"e-mail\"";
            this.radioChoiceEmail.UseVisualStyleBackColor = true;
            // 
            // radioChoiceNumbers
            // 
            this.radioChoiceNumbers.Location = new System.Drawing.Point(16, 49);
            this.radioChoiceNumbers.Name = "radioChoiceNumbers";
            this.radioChoiceNumbers.Size = new System.Drawing.Size(165, 20);
            this.radioChoiceNumbers.TabIndex = 18;
            this.radioChoiceNumbers.Text = "Содержащие цифры";
            this.radioChoiceNumbers.UseVisualStyleBackColor = true;
            // 
            // buttonClose
            // 
            this.buttonClose.Location = new System.Drawing.Point(714, 557);
            this.buttonClose.Name = "buttonClose";
            this.buttonClose.Size = new System.Drawing.Size(124, 28);
            this.buttonClose.TabIndex = 22;
            this.buttonClose.Text = "Выйти";
            this.buttonClose.UseVisualStyleBackColor = true;
            this.buttonClose.Click += new System.EventHandler(this.buttonClose_Click);
            // 
            // buttonReset
            // 
            this.buttonReset.Location = new System.Drawing.Point(714, 526);
            this.buttonReset.Name = "buttonReset";
            this.buttonReset.Size = new System.Drawing.Size(124, 28);
            this.buttonReset.TabIndex = 21;
            this.buttonReset.Text = "Сброс";
            this.buttonReset.UseVisualStyleBackColor = true;
            this.buttonReset.Click += new System.EventHandler(this.buttonReset_Click);
            // 
            // buttonClearSection2
            // 
            this.buttonClearSection2.Location = new System.Drawing.Point(698, 379);
            this.buttonClearSection2.Name = "buttonClearSection2";
            this.buttonClearSection2.Size = new System.Drawing.Size(146, 28);
            this.buttonClearSection2.TabIndex = 12;
            this.buttonClearSection2.Text = "Очистить";
            this.buttonClearSection2.UseVisualStyleBackColor = true;
            this.buttonClearSection2.Click += new System.EventHandler(this.buttonClearSection2_Click);
            // 
            // buttonSortSection2
            // 
            this.buttonSortSection2.Enabled = false;
            this.buttonSortSection2.Location = new System.Drawing.Point(549, 379);
            this.buttonSortSection2.Name = "buttonSortSection2";
            this.buttonSortSection2.Size = new System.Drawing.Size(146, 28);
            this.buttonSortSection2.TabIndex = 11;
            this.buttonSortSection2.Text = "Сортировать";
            this.buttonSortSection2.UseVisualStyleBackColor = true;
            this.buttonSortSection2.Click += new System.EventHandler(this.buttonSortSection2_Click);
            // 
            // buttonClearSection1
            // 
            this.buttonClearSection1.Location = new System.Drawing.Point(168, 379);
            this.buttonClearSection1.Name = "buttonClearSection1";
            this.buttonClearSection1.Size = new System.Drawing.Size(146, 28);
            this.buttonClearSection1.TabIndex = 10;
            this.buttonClearSection1.Text = "Очистить";
            this.buttonClearSection1.UseVisualStyleBackColor = true;
            this.buttonClearSection1.Click += new System.EventHandler(this.buttonClearSection1_Click);
            // 
            // buttonSortSection1
            // 
            this.buttonSortSection1.Enabled = false;
            this.buttonSortSection1.Location = new System.Drawing.Point(19, 379);
            this.buttonSortSection1.Name = "buttonSortSection1";
            this.buttonSortSection1.Size = new System.Drawing.Size(146, 28);
            this.buttonSortSection1.TabIndex = 9;
            this.buttonSortSection1.Text = "Сортировать";
            this.buttonSortSection1.UseVisualStyleBackColor = true;
            this.buttonSortSection1.Click += new System.EventHandler(this.buttonSortSection1_Click);
            // 
            // buttonsPanel
            // 
            this.buttonsPanel.BackColor = System.Drawing.Color.PeachPuff;
            this.buttonsPanel.Controls.Add(this.buttonDel);
            this.buttonsPanel.Controls.Add(this.buttonAdd);
            this.buttonsPanel.Controls.Add(this.buttonLeftAllMove);
            this.buttonsPanel.Controls.Add(this.buttonRightAllMove);
            this.buttonsPanel.Controls.Add(this.buttonLeftMove);
            this.buttonsPanel.Controls.Add(this.buttonRightMove);
            this.buttonsPanel.Location = new System.Drawing.Point(330, 69);
            this.buttonsPanel.Name = "buttonsPanel";
            this.buttonsPanel.Size = new System.Drawing.Size(200, 304);
            this.buttonsPanel.TabIndex = 6;
            // 
            // buttonDel
            // 
            this.buttonDel.Location = new System.Drawing.Point(24, 256);
            this.buttonDel.Name = "buttonDel";
            this.buttonDel.Size = new System.Drawing.Size(154, 28);
            this.buttonDel.TabIndex = 9;
            this.buttonDel.TabStop = false;
            this.buttonDel.Text = "Удалить";
            this.buttonDel.UseVisualStyleBackColor = true;
            this.buttonDel.Click += new System.EventHandler(this.buttonDel_Click);
            // 
            // buttonAdd
            // 
            this.buttonAdd.Location = new System.Drawing.Point(24, 222);
            this.buttonAdd.Name = "buttonAdd";
            this.buttonAdd.Size = new System.Drawing.Size(154, 28);
            this.buttonAdd.TabIndex = 8;
            this.buttonAdd.TabStop = false;
            this.buttonAdd.Text = "Добавить";
            this.buttonAdd.UseVisualStyleBackColor = true;
            this.buttonAdd.Click += new System.EventHandler(this.buttonAdd_Click);
            // 
            // buttonLeftAllMove
            // 
            this.buttonLeftAllMove.Location = new System.Drawing.Point(24, 116);
            this.buttonLeftAllMove.Name = "buttonLeftAllMove";
            this.buttonLeftAllMove.Size = new System.Drawing.Size(154, 28);
            this.buttonLeftAllMove.TabIndex = 7;
            this.buttonLeftAllMove.Text = "<<";
            this.buttonLeftAllMove.UseVisualStyleBackColor = true;
            this.buttonLeftAllMove.Click += new System.EventHandler(this.buttonLeftAllMove_Click);
            // 
            // buttonRightAllMove
            // 
            this.buttonRightAllMove.Location = new System.Drawing.Point(24, 82);
            this.buttonRightAllMove.Name = "buttonRightAllMove";
            this.buttonRightAllMove.Size = new System.Drawing.Size(154, 28);
            this.buttonRightAllMove.TabIndex = 6;
            this.buttonRightAllMove.Text = ">>";
            this.buttonRightAllMove.UseVisualStyleBackColor = true;
            this.buttonRightAllMove.Click += new System.EventHandler(this.buttonRightAllMove_Click);
            // 
            // buttonLeftMove
            // 
            this.buttonLeftMove.Location = new System.Drawing.Point(24, 48);
            this.buttonLeftMove.Name = "buttonLeftMove";
            this.buttonLeftMove.Size = new System.Drawing.Size(154, 28);
            this.buttonLeftMove.TabIndex = 5;
            this.buttonLeftMove.Text = "<";
            this.buttonLeftMove.UseVisualStyleBackColor = true;
            this.buttonLeftMove.Click += new System.EventHandler(this.buttonLeftMove_Click);
            // 
            // buttonRightMove
            // 
            this.buttonRightMove.Location = new System.Drawing.Point(24, 14);
            this.buttonRightMove.Name = "buttonRightMove";
            this.buttonRightMove.Size = new System.Drawing.Size(154, 28);
            this.buttonRightMove.TabIndex = 4;
            this.buttonRightMove.Text = ">";
            this.buttonRightMove.UseVisualStyleBackColor = true;
            this.buttonRightMove.Click += new System.EventHandler(this.buttonRightMove_Click);
            // 
            // listBoxSection2
            // 
            this.listBoxSection2.FormattingEnabled = true;
            this.listBoxSection2.ItemHeight = 15;
            this.listBoxSection2.Location = new System.Drawing.Point(549, 69);
            this.listBoxSection2.Name = "listBoxSection2";
            this.listBoxSection2.SelectionMode = System.Windows.Forms.SelectionMode.MultiExtended;
            this.listBoxSection2.Size = new System.Drawing.Size(295, 304);
            this.listBoxSection2.TabIndex = 8;
            // 
            // listBoxSection1
            // 
            this.listBoxSection1.FormattingEnabled = true;
            this.listBoxSection1.ItemHeight = 15;
            this.listBoxSection1.Location = new System.Drawing.Point(19, 69);
            this.listBoxSection1.Name = "listBoxSection1";
            this.listBoxSection1.SelectionMode = System.Windows.Forms.SelectionMode.MultiExtended;
            this.listBoxSection1.Size = new System.Drawing.Size(295, 304);
            this.listBoxSection1.TabIndex = 3;
            // 
            // comboBoxSection2
            // 
            this.comboBoxSection2.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            this.comboBoxSection2.FormattingEnabled = true;
            this.comboBoxSection2.Items.AddRange(new object[]
            {
                "Алфавиту (по возрастанию)", "Алфавиту (по убыванию)", "Длине слова (по возрастанию)",
                "Длине слова (по убыванию)"
            });
            this.comboBoxSection2.Location = new System.Drawing.Point(549, 44);
            this.comboBoxSection2.Name = "comboBoxSection2";
            this.comboBoxSection2.Size = new System.Drawing.Size(295, 23);
            this.comboBoxSection2.TabIndex = 2;
            this.comboBoxSection2.SelectedIndexChanged +=
                new System.EventHandler(this.comboBoxSection2_SelectedIndexChanged);
            // 
            // comboBoxSection1
            // 
            this.comboBoxSection1.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            this.comboBoxSection1.FormattingEnabled = true;
            this.comboBoxSection1.Items.AddRange(new object[]
            {
                "Алфавиту (по возрастанию)", "Алфавиту (по убыванию)", "Длине слова (по возрастанию)",
                "Длине слова (по убыванию)"
            });
            this.comboBoxSection1.Location = new System.Drawing.Point(19, 44);
            this.comboBoxSection1.Name = "comboBoxSection1";
            this.comboBoxSection1.Size = new System.Drawing.Size(295, 23);
            this.comboBoxSection1.TabIndex = 1;
            this.comboBoxSection1.SelectedIndexChanged +=
                new System.EventHandler(this.comboBoxSection1_SelectedIndexChanged);
            // 
            // labelSection2
            // 
            this.labelSection2.Font = new System.Drawing.Font("Segoe UI", 12F, System.Drawing.FontStyle.Regular,
                System.Drawing.GraphicsUnit.Point, ((byte) (204)));
            this.labelSection2.Location = new System.Drawing.Point(549, 3);
            this.labelSection2.Name = "labelSection2";
            this.labelSection2.Size = new System.Drawing.Size(148, 27);
            this.labelSection2.TabIndex = 1;
            this.labelSection2.Text = "Раздел 2";
            // 
            // labelSection1
            // 
            this.labelSection1.Font = new System.Drawing.Font("Segoe UI", 12F, System.Drawing.FontStyle.Regular,
                System.Drawing.GraphicsUnit.Point, ((byte) (204)));
            this.labelSection1.Location = new System.Drawing.Point(19, 3);
            this.labelSection1.Name = "labelSection1";
            this.labelSection1.Size = new System.Drawing.Size(148, 27);
            this.labelSection1.TabIndex = 0;
            this.labelSection1.Text = "Раздел 1";
            // 
            // textWorkSpace
            // 
            this.textWorkSpace.AcceptsReturn = true;
            this.textWorkSpace.AcceptsTab = true;
            this.textWorkSpace.Anchor =
                ((System.Windows.Forms.AnchorStyles) ((((System.Windows.Forms.AnchorStyles.Top |
                                                         System.Windows.Forms.AnchorStyles.Bottom) |
                                                        System.Windows.Forms.AnchorStyles.Left) |
                                                       System.Windows.Forms.AnchorStyles.Right)));
            this.textWorkSpace.BackColor = System.Drawing.Color.Bisque;
            this.textWorkSpace.BorderStyle = System.Windows.Forms.BorderStyle.None;
            this.textWorkSpace.Location = new System.Drawing.Point(894, 39);
            this.textWorkSpace.Multiline = true;
            this.textWorkSpace.Name = "textWorkSpace";
            this.textWorkSpace.ScrollBars = System.Windows.Forms.ScrollBars.Both;
            this.textWorkSpace.Size = new System.Drawing.Size(278, 590);
            this.textWorkSpace.TabIndex = 0;
            this.textWorkSpace.TabStop = false;
            this.textWorkSpace.TextChanged += new System.EventHandler(this.textWorkSpace_TextChanged);
            // 
            // FormMain
            // 
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.None;
            this.BackColor = System.Drawing.Color.PapayaWhip;
            this.BackgroundImageLayout = System.Windows.Forms.ImageLayout.None;
            this.ClientSize = new System.Drawing.Size(1184, 641);
            this.Controls.Add(this.textWorkSpace);
            this.Controls.Add(this.leftMainPanel);
            this.Controls.Add(this.menuStrip1);
            this.MainMenuStrip = this.menuStrip1;
            this.MaximizeBox = false;
            this.MaximumSize = new System.Drawing.Size(1200, 680);
            this.MinimumSize = new System.Drawing.Size(1200, 680);
            this.Name = "FormMain";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Лабораторная работа #2";
            this.menuStrip1.ResumeLayout(false);
            this.menuStrip1.PerformLayout();
            this.leftMainPanel.ResumeLayout(false);
            this.groupSearch.ResumeLayout(false);
            this.groupSearch.PerformLayout();
            this.groupChoiceWorld.ResumeLayout(false);
            this.buttonsPanel.ResumeLayout(false);
            this.ResumeLayout(false);
            this.PerformLayout();
        }

        #endregion

        private System.Windows.Forms.ToolStripMenuItem openToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem fileToolStripMenuItem;
        private System.Windows.Forms.MenuStrip menuStrip1;
        private System.Windows.Forms.ToolStripMenuItem exitToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem saveToolStripMenuItem;
        private System.Windows.Forms.Button buttonAdd;
        private System.Windows.Forms.Button buttonDel;
        private System.Windows.Forms.Button buttonReset;
        private System.Windows.Forms.Button buttonClose;
        private System.Windows.Forms.Button buttonStart;
        private System.Windows.Forms.TextBox textBoxWord;
        private System.Windows.Forms.Button buttonSearch;
        private System.Windows.Forms.ComboBox comboBoxSection2;
        private System.Windows.Forms.ComboBox comboBoxSection1;
        private System.Windows.Forms.Label labelSection2;
        private System.Windows.Forms.Label labelSection1;
        private System.Windows.Forms.TextBox textWorkSpace;
        private System.Windows.Forms.ListBox listBoxSearch;
        private System.Windows.Forms.ToolStripMenuItem aboutStripMenuItem;
        private System.Windows.Forms.ListBox listBoxSection1;
        private System.Windows.Forms.ListBox listBoxSection2;
        private System.Windows.Forms.Button buttonClearSection1;
        private System.Windows.Forms.Button buttonClearSection2;
        private System.Windows.Forms.Button buttonSortSection2;
        private System.Windows.Forms.Button buttonSortSection1;
        private System.Windows.Forms.Panel buttonsPanel;
        private System.Windows.Forms.Panel leftMainPanel;
        private System.Windows.Forms.Button buttonRightMove;
        private System.Windows.Forms.Button buttonLeftMove;
        private System.Windows.Forms.RadioButton radioChoiceAll;
        private System.Windows.Forms.CheckBox checkSection2;
        private System.Windows.Forms.CheckBox checkSection1;
        private System.Windows.Forms.Label labelSearch;
        private System.Windows.Forms.GroupBox groupChoiceWorld;
        private System.Windows.Forms.GroupBox groupSearch;
        private System.Windows.Forms.RadioButton radioChoiceEmail;
        private System.Windows.Forms.RadioButton radioChoiceNumbers;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Button buttonLeftAllMove;
        private System.Windows.Forms.Button buttonRightAllMove;
    }
}