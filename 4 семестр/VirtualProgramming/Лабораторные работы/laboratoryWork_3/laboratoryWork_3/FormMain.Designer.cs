namespace laboratoryWork_3
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
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(FormMain));
            this.menuStrip = new System.Windows.Forms.MenuStrip();
            this.fileToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.newToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.openToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.saveToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.toolStripMenuItem = new System.Windows.Forms.ToolStripSeparator();
            this.exitToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.editToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.undoToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.reToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.penToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.styleToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.solidToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.dotToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.dashDotDotToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.colorToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.ownColorToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.helpToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.aboutToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.toolStrip = new System.Windows.Forms.ToolStrip();
            this.newFile_toolStripButton = new System.Windows.Forms.ToolStripButton();
            this.openFile_toolStripButton = new System.Windows.Forms.ToolStripButton();
            this.saveFile_toolStripButton = new System.Windows.Forms.ToolStripButton();
            this.toolStripSeparator2 = new System.Windows.Forms.ToolStripSeparator();
            this.palette_toolStripButton = new System.Windows.Forms.ToolStripButton();
            this.ownColor_toolStripButton = new System.Windows.Forms.ToolStripButton();
            this.toolStripSeparator3 = new System.Windows.Forms.ToolStripSeparator();
            this.exit_toolStripButton = new System.Windows.Forms.ToolStripButton();
            this.panel = new System.Windows.Forms.Panel();
            this.MousePosition_textBox = new System.Windows.Forms.Label();
            this.PenWigth_trackBar = new System.Windows.Forms.TrackBar();
            this.flowLayoutPanel = new System.Windows.Forms.FlowLayoutPanel();
            this.paintBox = new System.Windows.Forms.PictureBox();
            this.menuStrip.SuspendLayout();
            this.toolStrip.SuspendLayout();
            this.panel.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize) (this.PenWigth_trackBar)).BeginInit();
            this.flowLayoutPanel.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize) (this.paintBox)).BeginInit();
            this.SuspendLayout();
            // 
            // menuStrip
            // 
            this.menuStrip.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.menuStrip.Items.AddRange(new System.Windows.Forms.ToolStripItem[] {this.fileToolStripMenuItem, this.editToolStripMenuItem, this.helpToolStripMenuItem});
            this.menuStrip.Location = new System.Drawing.Point(0, 0);
            this.menuStrip.Name = "menuStrip";
            this.menuStrip.Size = new System.Drawing.Size(1184, 29);
            this.menuStrip.TabIndex = 0;
            // 
            // fileToolStripMenuItem
            // 
            this.fileToolStripMenuItem.DropDownItems.AddRange(new System.Windows.Forms.ToolStripItem[] {this.newToolStripMenuItem, this.openToolStripMenuItem, this.saveToolStripMenuItem, this.toolStripMenuItem, this.exitToolStripMenuItem});
            this.fileToolStripMenuItem.Name = "fileToolStripMenuItem";
            this.fileToolStripMenuItem.Size = new System.Drawing.Size(46, 25);
            this.fileToolStripMenuItem.Text = "File";
            // 
            // newToolStripMenuItem
            // 
            this.newToolStripMenuItem.Name = "newToolStripMenuItem";
            this.newToolStripMenuItem.ShortcutKeys = ((System.Windows.Forms.Keys) ((System.Windows.Forms.Keys.Control | System.Windows.Forms.Keys.N)));
            this.newToolStripMenuItem.Size = new System.Drawing.Size(176, 26);
            this.newToolStripMenuItem.Text = "New";
            this.newToolStripMenuItem.Click += new System.EventHandler(this.newToolStripMenuItem_Click);
            // 
            // openToolStripMenuItem
            // 
            this.openToolStripMenuItem.Name = "openToolStripMenuItem";
            this.openToolStripMenuItem.ShortcutKeys = ((System.Windows.Forms.Keys) ((System.Windows.Forms.Keys.Control | System.Windows.Forms.Keys.O)));
            this.openToolStripMenuItem.Size = new System.Drawing.Size(176, 26);
            this.openToolStripMenuItem.Text = "Open";
            this.openToolStripMenuItem.Click += new System.EventHandler(this.openToolStripMenuItem_Click);
            // 
            // saveToolStripMenuItem
            // 
            this.saveToolStripMenuItem.Name = "saveToolStripMenuItem";
            this.saveToolStripMenuItem.ShortcutKeys = ((System.Windows.Forms.Keys) ((System.Windows.Forms.Keys.Control | System.Windows.Forms.Keys.S)));
            this.saveToolStripMenuItem.Size = new System.Drawing.Size(176, 26);
            this.saveToolStripMenuItem.Text = "Save";
            this.saveToolStripMenuItem.Click += new System.EventHandler(this.saveToolStripMenuItem_Click);
            // 
            // toolStripMenuItem
            // 
            this.toolStripMenuItem.Name = "toolStripMenuItem";
            this.toolStripMenuItem.Size = new System.Drawing.Size(173, 6);
            // 
            // exitToolStripMenuItem
            // 
            this.exitToolStripMenuItem.Name = "exitToolStripMenuItem";
            this.exitToolStripMenuItem.ShortcutKeys = ((System.Windows.Forms.Keys) ((System.Windows.Forms.Keys.Alt | System.Windows.Forms.Keys.X)));
            this.exitToolStripMenuItem.Size = new System.Drawing.Size(176, 26);
            this.exitToolStripMenuItem.Text = "Exit";
            this.exitToolStripMenuItem.Click += new System.EventHandler(this.exitToolStripMenuItem_Click);
            // 
            // editToolStripMenuItem
            // 
            this.editToolStripMenuItem.DropDownItems.AddRange(new System.Windows.Forms.ToolStripItem[] {this.undoToolStripMenuItem, this.reToolStripMenuItem, this.penToolStripMenuItem});
            this.editToolStripMenuItem.Name = "editToolStripMenuItem";
            this.editToolStripMenuItem.Size = new System.Drawing.Size(48, 25);
            this.editToolStripMenuItem.Text = "Edit";
            // 
            // undoToolStripMenuItem
            // 
            this.undoToolStripMenuItem.Image = ((System.Drawing.Image) (resources.GetObject("undoToolStripMenuItem.Image")));
            this.undoToolStripMenuItem.Name = "undoToolStripMenuItem";
            this.undoToolStripMenuItem.ShortcutKeys = ((System.Windows.Forms.Keys) ((System.Windows.Forms.Keys.Control | System.Windows.Forms.Keys.Z)));
            this.undoToolStripMenuItem.Size = new System.Drawing.Size(214, 26);
            this.undoToolStripMenuItem.Text = "Undo";
            this.undoToolStripMenuItem.Click += new System.EventHandler(this.undoToolStripMenuItem_Click);
            // 
            // reToolStripMenuItem
            // 
            this.reToolStripMenuItem.Image = ((System.Drawing.Image) (resources.GetObject("reToolStripMenuItem.Image")));
            this.reToolStripMenuItem.Name = "reToolStripMenuItem";
            this.reToolStripMenuItem.ShortcutKeys = ((System.Windows.Forms.Keys) (((System.Windows.Forms.Keys.Control | System.Windows.Forms.Keys.Shift) | System.Windows.Forms.Keys.Z)));
            this.reToolStripMenuItem.Size = new System.Drawing.Size(214, 26);
            this.reToolStripMenuItem.Text = "Reno";
            this.reToolStripMenuItem.Click += new System.EventHandler(this.reToolStripMenuItem_Click);
            // 
            // penToolStripMenuItem
            // 
            this.penToolStripMenuItem.DropDownItems.AddRange(new System.Windows.Forms.ToolStripItem[] {this.styleToolStripMenuItem, this.colorToolStripMenuItem, this.ownColorToolStripMenuItem});
            this.penToolStripMenuItem.Name = "penToolStripMenuItem";
            this.penToolStripMenuItem.Size = new System.Drawing.Size(214, 26);
            this.penToolStripMenuItem.Text = "Pen";
            // 
            // styleToolStripMenuItem
            // 
            this.styleToolStripMenuItem.DropDownItems.AddRange(new System.Windows.Forms.ToolStripItem[] {this.solidToolStripMenuItem, this.dotToolStripMenuItem, this.dashDotDotToolStripMenuItem});
            this.styleToolStripMenuItem.Name = "styleToolStripMenuItem";
            this.styleToolStripMenuItem.Size = new System.Drawing.Size(152, 26);
            this.styleToolStripMenuItem.Text = "Style";
            // 
            // solidToolStripMenuItem
            // 
            this.solidToolStripMenuItem.Checked = true;
            this.solidToolStripMenuItem.CheckState = System.Windows.Forms.CheckState.Checked;
            this.solidToolStripMenuItem.Name = "solidToolStripMenuItem";
            this.solidToolStripMenuItem.Size = new System.Drawing.Size(165, 26);
            this.solidToolStripMenuItem.Text = "Solid";
            this.solidToolStripMenuItem.Click += new System.EventHandler(this.solidToolStripMenuItem_Click);
            // 
            // dotToolStripMenuItem
            // 
            this.dotToolStripMenuItem.Name = "dotToolStripMenuItem";
            this.dotToolStripMenuItem.Size = new System.Drawing.Size(165, 26);
            this.dotToolStripMenuItem.Text = "Dot";
            this.dotToolStripMenuItem.Click += new System.EventHandler(this.dotToolStripMenuItem_Click);
            // 
            // dashDotDotToolStripMenuItem
            // 
            this.dashDotDotToolStripMenuItem.Name = "dashDotDotToolStripMenuItem";
            this.dashDotDotToolStripMenuItem.Size = new System.Drawing.Size(165, 26);
            this.dashDotDotToolStripMenuItem.Text = "DashDotDot";
            this.dashDotDotToolStripMenuItem.Click += new System.EventHandler(this.dashDotDotToolStripMenuItem_Click);
            // 
            // colorToolStripMenuItem
            // 
            this.colorToolStripMenuItem.Image = ((System.Drawing.Image) (resources.GetObject("colorToolStripMenuItem.Image")));
            this.colorToolStripMenuItem.Name = "colorToolStripMenuItem";
            this.colorToolStripMenuItem.Size = new System.Drawing.Size(152, 26);
            this.colorToolStripMenuItem.Text = "Color";
            this.colorToolStripMenuItem.Click += new System.EventHandler(this.colorToolStripMenuItem_Click);
            // 
            // ownColorToolStripMenuItem
            // 
            this.ownColorToolStripMenuItem.Image = ((System.Drawing.Image) (resources.GetObject("ownColorToolStripMenuItem.Image")));
            this.ownColorToolStripMenuItem.Name = "ownColorToolStripMenuItem";
            this.ownColorToolStripMenuItem.Size = new System.Drawing.Size(152, 26);
            this.ownColorToolStripMenuItem.Text = "Own color";
            this.ownColorToolStripMenuItem.Click += new System.EventHandler(this.ownColorToolStripMenuItem_Click);
            // 
            // helpToolStripMenuItem
            // 
            this.helpToolStripMenuItem.DropDownItems.AddRange(new System.Windows.Forms.ToolStripItem[] {this.aboutToolStripMenuItem});
            this.helpToolStripMenuItem.Name = "helpToolStripMenuItem";
            this.helpToolStripMenuItem.Size = new System.Drawing.Size(54, 25);
            this.helpToolStripMenuItem.Text = "Help";
            // 
            // aboutToolStripMenuItem
            // 
            this.aboutToolStripMenuItem.Image = ((System.Drawing.Image) (resources.GetObject("aboutToolStripMenuItem.Image")));
            this.aboutToolStripMenuItem.Name = "aboutToolStripMenuItem";
            this.aboutToolStripMenuItem.ShortcutKeys = System.Windows.Forms.Keys.F1;
            this.aboutToolStripMenuItem.Size = new System.Drawing.Size(149, 26);
            this.aboutToolStripMenuItem.Text = "About";
            this.aboutToolStripMenuItem.Click += new System.EventHandler(this.aboutToolStripMenuItem_Click);
            // 
            // toolStrip
            // 
            this.toolStrip.Dock = System.Windows.Forms.DockStyle.Left;
            this.toolStrip.GripStyle = System.Windows.Forms.ToolStripGripStyle.Hidden;
            this.toolStrip.ImageScalingSize = new System.Drawing.Size(64, 64);
            this.toolStrip.Items.AddRange(new System.Windows.Forms.ToolStripItem[] {this.newFile_toolStripButton, this.openFile_toolStripButton, this.saveFile_toolStripButton, this.toolStripSeparator2, this.palette_toolStripButton, this.ownColor_toolStripButton, this.toolStripSeparator3, this.exit_toolStripButton});
            this.toolStrip.LayoutStyle = System.Windows.Forms.ToolStripLayoutStyle.VerticalStackWithOverflow;
            this.toolStrip.Location = new System.Drawing.Point(0, 29);
            this.toolStrip.Name = "toolStrip";
            this.toolStrip.RenderMode = System.Windows.Forms.ToolStripRenderMode.System;
            this.toolStrip.Size = new System.Drawing.Size(69, 612);
            this.toolStrip.TabIndex = 1;
            // 
            // newFile_toolStripButton
            // 
            this.newFile_toolStripButton.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image;
            this.newFile_toolStripButton.Image = ((System.Drawing.Image) (resources.GetObject("newFile_toolStripButton.Image")));
            this.newFile_toolStripButton.ImageTransparentColor = System.Drawing.Color.Magenta;
            this.newFile_toolStripButton.Name = "newFile_toolStripButton";
            this.newFile_toolStripButton.Size = new System.Drawing.Size(66, 68);
            this.newFile_toolStripButton.Text = "Новое изображение";
            this.newFile_toolStripButton.TextImageRelation = System.Windows.Forms.TextImageRelation.ImageAboveText;
            this.newFile_toolStripButton.Click += new System.EventHandler(this.newToolStripMenuItem_Click);
            // 
            // openFile_toolStripButton
            // 
            this.openFile_toolStripButton.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image;
            this.openFile_toolStripButton.Font = new System.Drawing.Font("Segoe UI", 9F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte) (204)));
            this.openFile_toolStripButton.Image = ((System.Drawing.Image) (resources.GetObject("openFile_toolStripButton.Image")));
            this.openFile_toolStripButton.ImageTransparentColor = System.Drawing.Color.Magenta;
            this.openFile_toolStripButton.Name = "openFile_toolStripButton";
            this.openFile_toolStripButton.Size = new System.Drawing.Size(66, 68);
            this.openFile_toolStripButton.Text = "Открыть файл";
            this.openFile_toolStripButton.TextImageRelation = System.Windows.Forms.TextImageRelation.ImageAboveText;
            this.openFile_toolStripButton.Click += new System.EventHandler(this.openToolStripMenuItem_Click);
            // 
            // saveFile_toolStripButton
            // 
            this.saveFile_toolStripButton.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image;
            this.saveFile_toolStripButton.Image = ((System.Drawing.Image) (resources.GetObject("saveFile_toolStripButton.Image")));
            this.saveFile_toolStripButton.ImageTransparentColor = System.Drawing.Color.Magenta;
            this.saveFile_toolStripButton.Name = "saveFile_toolStripButton";
            this.saveFile_toolStripButton.Size = new System.Drawing.Size(66, 68);
            this.saveFile_toolStripButton.Text = "Сохранить файл";
            this.saveFile_toolStripButton.TextImageRelation = System.Windows.Forms.TextImageRelation.ImageAboveText;
            this.saveFile_toolStripButton.Click += new System.EventHandler(this.saveToolStripMenuItem_Click);
            // 
            // toolStripSeparator2
            // 
            this.toolStripSeparator2.Margin = new System.Windows.Forms.Padding(0, 20, 0, 20);
            this.toolStripSeparator2.Name = "toolStripSeparator2";
            this.toolStripSeparator2.Size = new System.Drawing.Size(66, 6);
            // 
            // palette_toolStripButton
            // 
            this.palette_toolStripButton.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image;
            this.palette_toolStripButton.Image = ((System.Drawing.Image) (resources.GetObject("palette_toolStripButton.Image")));
            this.palette_toolStripButton.ImageTransparentColor = System.Drawing.Color.Magenta;
            this.palette_toolStripButton.Name = "palette_toolStripButton";
            this.palette_toolStripButton.Size = new System.Drawing.Size(66, 68);
            this.palette_toolStripButton.Text = "Палитра";
            this.palette_toolStripButton.TextImageRelation = System.Windows.Forms.TextImageRelation.ImageAboveText;
            this.palette_toolStripButton.Click += new System.EventHandler(this.colorToolStripMenuItem_Click);
            // 
            // ownColor_toolStripButton
            // 
            this.ownColor_toolStripButton.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image;
            this.ownColor_toolStripButton.Image = ((System.Drawing.Image) (resources.GetObject("ownColor_toolStripButton.Image")));
            this.ownColor_toolStripButton.ImageTransparentColor = System.Drawing.Color.Magenta;
            this.ownColor_toolStripButton.Name = "ownColor_toolStripButton";
            this.ownColor_toolStripButton.Size = new System.Drawing.Size(66, 68);
            this.ownColor_toolStripButton.Text = "Свой цвет";
            this.ownColor_toolStripButton.TextImageRelation = System.Windows.Forms.TextImageRelation.ImageAboveText;
            this.ownColor_toolStripButton.Click += new System.EventHandler(this.ownColorToolStripMenuItem_Click);
            // 
            // toolStripSeparator3
            // 
            this.toolStripSeparator3.Margin = new System.Windows.Forms.Padding(0, 20, 0, 20);
            this.toolStripSeparator3.Name = "toolStripSeparator3";
            this.toolStripSeparator3.Size = new System.Drawing.Size(66, 6);
            // 
            // exit_toolStripButton
            // 
            this.exit_toolStripButton.Alignment = System.Windows.Forms.ToolStripItemAlignment.Right;
            this.exit_toolStripButton.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image;
            this.exit_toolStripButton.Image = ((System.Drawing.Image) (resources.GetObject("exit_toolStripButton.Image")));
            this.exit_toolStripButton.ImageTransparentColor = System.Drawing.Color.Magenta;
            this.exit_toolStripButton.Name = "exit_toolStripButton";
            this.exit_toolStripButton.Size = new System.Drawing.Size(66, 68);
            this.exit_toolStripButton.Text = "Выйти";
            this.exit_toolStripButton.TextImageRelation = System.Windows.Forms.TextImageRelation.ImageAboveText;
            this.exit_toolStripButton.Click += new System.EventHandler(this.exitToolStripMenuItem_Click);
            // 
            // panel
            // 
            this.panel.Anchor = ((System.Windows.Forms.AnchorStyles) (((System.Windows.Forms.AnchorStyles.Bottom | System.Windows.Forms.AnchorStyles.Left) | System.Windows.Forms.AnchorStyles.Right)));
            this.panel.BackColor = System.Drawing.Color.PapayaWhip;
            this.panel.Controls.Add(this.MousePosition_textBox);
            this.panel.Controls.Add(this.PenWigth_trackBar);
            this.panel.Location = new System.Drawing.Point(85, 574);
            this.panel.Name = "panel";
            this.panel.Size = new System.Drawing.Size(1099, 67);
            this.panel.TabIndex = 2;
            // 
            // MousePosition_textBox
            // 
            this.MousePosition_textBox.AutoSize = true;
            this.MousePosition_textBox.Font = new System.Drawing.Font("Microsoft Sans Serif", 12F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte) (204)));
            this.MousePosition_textBox.Location = new System.Drawing.Point(42, 18);
            this.MousePosition_textBox.Name = "MousePosition_textBox";
            this.MousePosition_textBox.Size = new System.Drawing.Size(0, 20);
            this.MousePosition_textBox.TabIndex = 3;
            // 
            // PenWigth_trackBar
            // 
            this.PenWigth_trackBar.Anchor = System.Windows.Forms.AnchorStyles.Right;
            this.PenWigth_trackBar.Cursor = System.Windows.Forms.Cursors.Hand;
            this.PenWigth_trackBar.LargeChange = 1;
            this.PenWigth_trackBar.Location = new System.Drawing.Point(586, 10);
            this.PenWigth_trackBar.Maximum = 20;
            this.PenWigth_trackBar.Minimum = 1;
            this.PenWigth_trackBar.Name = "PenWigth_trackBar";
            this.PenWigth_trackBar.Size = new System.Drawing.Size(501, 45);
            this.PenWigth_trackBar.TabIndex = 0;
            this.PenWigth_trackBar.TabStop = false;
            this.PenWigth_trackBar.Value = 1;
            this.PenWigth_trackBar.Scroll += new System.EventHandler(this.PenWigth_trackBar_Scroll);
            // 
            // flowLayoutPanel
            // 
            this.flowLayoutPanel.Anchor = ((System.Windows.Forms.AnchorStyles) ((((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) | System.Windows.Forms.AnchorStyles.Left) | System.Windows.Forms.AnchorStyles.Right)));
            this.flowLayoutPanel.AutoScroll = true;
            this.flowLayoutPanel.BackColor = System.Drawing.Color.PapayaWhip;
            this.flowLayoutPanel.BorderStyle = System.Windows.Forms.BorderStyle.Fixed3D;
            this.flowLayoutPanel.Controls.Add(this.paintBox);
            this.flowLayoutPanel.Location = new System.Drawing.Point(85, 32);
            this.flowLayoutPanel.Name = "flowLayoutPanel";
            this.flowLayoutPanel.Size = new System.Drawing.Size(1087, 524);
            this.flowLayoutPanel.TabIndex = 5;
            // 
            // paintBox
            // 
            this.paintBox.BackColor = System.Drawing.Color.PapayaWhip;
            this.paintBox.Cursor = System.Windows.Forms.Cursors.Cross;
            this.paintBox.Location = new System.Drawing.Point(0, 0);
            this.paintBox.Margin = new System.Windows.Forms.Padding(0);
            this.paintBox.Name = "paintBox";
            this.paintBox.Size = new System.Drawing.Size(5, 5);
            this.paintBox.SizeMode = System.Windows.Forms.PictureBoxSizeMode.AutoSize;
            this.paintBox.TabIndex = 4;
            this.paintBox.TabStop = false;
            this.paintBox.MouseDown += new System.Windows.Forms.MouseEventHandler(this.paintBox_MouseDown);
            this.paintBox.MouseMove += new System.Windows.Forms.MouseEventHandler(this.paintBox_MouseMove);
            this.paintBox.MouseUp += new System.Windows.Forms.MouseEventHandler(this.paintBox_MouseUp);
            // 
            // FormMain
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.PapayaWhip;
            this.ClientSize = new System.Drawing.Size(1184, 641);
            this.Controls.Add(this.flowLayoutPanel);
            this.Controls.Add(this.panel);
            this.Controls.Add(this.toolStrip);
            this.Controls.Add(this.menuStrip);
            this.Icon = ((System.Drawing.Icon) (resources.GetObject("$this.Icon")));
            this.MainMenuStrip = this.menuStrip;
            this.MinimumSize = new System.Drawing.Size(1200, 680);
            this.Name = "FormMain";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.menuStrip.ResumeLayout(false);
            this.menuStrip.PerformLayout();
            this.toolStrip.ResumeLayout(false);
            this.toolStrip.PerformLayout();
            this.panel.ResumeLayout(false);
            this.panel.PerformLayout();
            ((System.ComponentModel.ISupportInitialize) (this.PenWigth_trackBar)).EndInit();
            this.flowLayoutPanel.ResumeLayout(false);
            this.flowLayoutPanel.PerformLayout();
            ((System.ComponentModel.ISupportInitialize) (this.paintBox)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();
        }

        private System.Windows.Forms.ToolStripMenuItem aboutToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem colorToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem dashDotDotToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem dotToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem editToolStripMenuItem;
        private System.Windows.Forms.ToolStripButton exit_toolStripButton;
        private System.Windows.Forms.ToolStripMenuItem exitToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem fileToolStripMenuItem;
        private System.Windows.Forms.FlowLayoutPanel flowLayoutPanel;
        private System.Windows.Forms.ToolStripMenuItem helpToolStripMenuItem;
        private System.Windows.Forms.MenuStrip menuStrip;
        private System.Windows.Forms.Label MousePosition_textBox;
        private System.Windows.Forms.ToolStripButton newFile_toolStripButton;
        private System.Windows.Forms.ToolStripMenuItem newToolStripMenuItem;
        private System.Windows.Forms.ToolStripButton openFile_toolStripButton;
        private System.Windows.Forms.ToolStripMenuItem openToolStripMenuItem;
        private System.Windows.Forms.ToolStripButton ownColor_toolStripButton;
        private System.Windows.Forms.ToolStripMenuItem ownColorToolStripMenuItem;
        private System.Windows.Forms.PictureBox paintBox;
        private System.Windows.Forms.ToolStripButton palette_toolStripButton;
        private System.Windows.Forms.Panel panel;
        private System.Windows.Forms.ToolStripMenuItem penToolStripMenuItem;
        private System.Windows.Forms.TrackBar PenWigth_trackBar;
        private System.Windows.Forms.ToolStripMenuItem reToolStripMenuItem;
        private System.Windows.Forms.ToolStripButton saveFile_toolStripButton;
        private System.Windows.Forms.ToolStripMenuItem saveToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem solidToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem styleToolStripMenuItem;
        private System.Windows.Forms.ToolStrip toolStrip;
        private System.Windows.Forms.ToolStripSeparator toolStripMenuItem;
        private System.Windows.Forms.ToolStripSeparator toolStripSeparator2;
        private System.Windows.Forms.ToolStripSeparator toolStripSeparator3;
        private System.Windows.Forms.ToolStripMenuItem undoToolStripMenuItem;

        #endregion
    }
}