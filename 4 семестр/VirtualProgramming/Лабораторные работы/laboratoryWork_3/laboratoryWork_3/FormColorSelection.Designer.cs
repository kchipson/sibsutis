using System.ComponentModel;

namespace laboratoryWork_3
{
    partial class FormColorSelection
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
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(FormColorSelection));
            this.red_scrollBar = new System.Windows.Forms.HScrollBar();
            this.green_scrollBar = new System.Windows.Forms.HScrollBar();
            this.blue_scrollBar = new System.Windows.Forms.HScrollBar();
            this.red_label = new System.Windows.Forms.Label();
            this.green_label = new System.Windows.Forms.Label();
            this.blue_label = new System.Windows.Forms.Label();
            this.red_numericUpDown = new System.Windows.Forms.NumericUpDown();
            this.green_numericUpDown = new System.Windows.Forms.NumericUpDown();
            this.blue_numericUpDown = new System.Windows.Forms.NumericUpDown();
            this.panel = new System.Windows.Forms.Panel();
            this.save_button = new System.Windows.Forms.Button();
            this.cancel_button = new System.Windows.Forms.Button();
            ((System.ComponentModel.ISupportInitialize) (this.red_numericUpDown)).BeginInit();
            ((System.ComponentModel.ISupportInitialize) (this.green_numericUpDown)).BeginInit();
            ((System.ComponentModel.ISupportInitialize) (this.blue_numericUpDown)).BeginInit();
            this.SuspendLayout();
            // 
            // red_scrollBar
            // 
            this.red_scrollBar.LargeChange = 1;
            this.red_scrollBar.Location = new System.Drawing.Point(75, 25);
            this.red_scrollBar.Maximum = 255;
            this.red_scrollBar.Name = "red_scrollBar";
            this.red_scrollBar.Size = new System.Drawing.Size(200, 15);
            this.red_scrollBar.TabIndex = 0;
            this.red_scrollBar.TabStop = true;
            this.red_scrollBar.ValueChanged += new System.EventHandler(this.scrollBar_ValueChanged);
            // 
            // green_scrollBar
            // 
            this.green_scrollBar.LargeChange = 1;
            this.green_scrollBar.Location = new System.Drawing.Point(75, 55);
            this.green_scrollBar.Maximum = 255;
            this.green_scrollBar.Name = "green_scrollBar";
            this.green_scrollBar.Size = new System.Drawing.Size(200, 15);
            this.green_scrollBar.TabIndex = 1;
            this.green_scrollBar.TabStop = true;
            this.green_scrollBar.ValueChanged += new System.EventHandler(this.scrollBar_ValueChanged);
            // 
            // blue_scrollBar
            // 
            this.blue_scrollBar.LargeChange = 1;
            this.blue_scrollBar.Location = new System.Drawing.Point(75, 85);
            this.blue_scrollBar.Maximum = 255;
            this.blue_scrollBar.Name = "blue_scrollBar";
            this.blue_scrollBar.Size = new System.Drawing.Size(200, 15);
            this.blue_scrollBar.TabIndex = 2;
            this.blue_scrollBar.TabStop = true;
            this.blue_scrollBar.ValueChanged += new System.EventHandler(this.scrollBar_ValueChanged);
            // 
            // red_label
            // 
            this.red_label.AutoSize = true;
            this.red_label.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte) (204)));
            this.red_label.Location = new System.Drawing.Point(20, 25);
            this.red_label.Name = "red_label";
            this.red_label.Size = new System.Drawing.Size(37, 16);
            this.red_label.TabIndex = 3;
            this.red_label.Text = "Red:";
            // 
            // green_label
            // 
            this.green_label.AutoSize = true;
            this.green_label.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte) (204)));
            this.green_label.Location = new System.Drawing.Point(20, 55);
            this.green_label.Name = "green_label";
            this.green_label.Size = new System.Drawing.Size(48, 16);
            this.green_label.TabIndex = 3;
            this.green_label.Text = "Green:";
            // 
            // blue_label
            // 
            this.blue_label.AutoSize = true;
            this.blue_label.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte) (204)));
            this.blue_label.Location = new System.Drawing.Point(20, 85);
            this.blue_label.Name = "blue_label";
            this.blue_label.Size = new System.Drawing.Size(38, 16);
            this.blue_label.TabIndex = 3;
            this.blue_label.Text = "Blue:";
            // 
            // red_numericUpDown
            // 
            this.red_numericUpDown.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte) (204)));
            this.red_numericUpDown.Location = new System.Drawing.Point(290, 23);
            this.red_numericUpDown.Maximum = new decimal(new int[] {255, 0, 0, 0});
            this.red_numericUpDown.Name = "red_numericUpDown";
            this.red_numericUpDown.Size = new System.Drawing.Size(52, 22);
            this.red_numericUpDown.TabIndex = 4;
            this.red_numericUpDown.TabStop = false;
            this.red_numericUpDown.ValueChanged += new System.EventHandler(this.numericUpDown_ValueChanged);
            // 
            // green_numericUpDown
            // 
            this.green_numericUpDown.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte) (204)));
            this.green_numericUpDown.Location = new System.Drawing.Point(290, 53);
            this.green_numericUpDown.Maximum = new decimal(new int[] {255, 0, 0, 0});
            this.green_numericUpDown.Name = "green_numericUpDown";
            this.green_numericUpDown.Size = new System.Drawing.Size(52, 22);
            this.green_numericUpDown.TabIndex = 5;
            this.green_numericUpDown.TabStop = false;
            this.green_numericUpDown.ValueChanged += new System.EventHandler(this.numericUpDown_ValueChanged);
            // 
            // blue_numericUpDown
            // 
            this.blue_numericUpDown.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte) (204)));
            this.blue_numericUpDown.Location = new System.Drawing.Point(290, 83);
            this.blue_numericUpDown.Maximum = new decimal(new int[] {255, 0, 0, 0});
            this.blue_numericUpDown.Name = "blue_numericUpDown";
            this.blue_numericUpDown.Size = new System.Drawing.Size(52, 22);
            this.blue_numericUpDown.TabIndex = 5;
            this.blue_numericUpDown.TabStop = false;
            this.blue_numericUpDown.ValueChanged += new System.EventHandler(this.numericUpDown_ValueChanged);
            // 
            // panel
            // 
            this.panel.BackColor = System.Drawing.Color.Black;
            this.panel.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.panel.Location = new System.Drawing.Point(362, 23);
            this.panel.Name = "panel";
            this.panel.Size = new System.Drawing.Size(82, 82);
            this.panel.TabIndex = 6;
            this.panel.TabStop = true;
            // 
            // save_button
            // 
            this.save_button.DialogResult = System.Windows.Forms.DialogResult.OK;
            this.save_button.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte) (204)));
            this.save_button.Location = new System.Drawing.Point(133, 133);
            this.save_button.Name = "save_button";
            this.save_button.Size = new System.Drawing.Size(75, 25);
            this.save_button.TabIndex = 7;
            this.save_button.TabStop = false;
            this.save_button.Text = "ОК";
            this.save_button.UseVisualStyleBackColor = true;
            // 
            // cancel_button
            // 
            this.cancel_button.DialogResult = System.Windows.Forms.DialogResult.Cancel;
            this.cancel_button.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte) (204)));
            this.cancel_button.Location = new System.Drawing.Point(248, 133);
            this.cancel_button.Name = "cancel_button";
            this.cancel_button.Size = new System.Drawing.Size(75, 25);
            this.cancel_button.TabIndex = 7;
            this.cancel_button.TabStop = false;
            this.cancel_button.Text = "Отмена";
            this.cancel_button.UseVisualStyleBackColor = true;
            // 
            // FormColorSelection
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(469, 168);
            this.Controls.Add(this.cancel_button);
            this.Controls.Add(this.save_button);
            this.Controls.Add(this.panel);
            this.Controls.Add(this.blue_numericUpDown);
            this.Controls.Add(this.green_numericUpDown);
            this.Controls.Add(this.red_numericUpDown);
            this.Controls.Add(this.blue_label);
            this.Controls.Add(this.green_label);
            this.Controls.Add(this.red_label);
            this.Controls.Add(this.blue_scrollBar);
            this.Controls.Add(this.green_scrollBar);
            this.Controls.Add(this.red_scrollBar);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.Icon = ((System.Drawing.Icon) (resources.GetObject("$this.Icon")));
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "FormColorSelection";
            this.ShowIcon = false;
            this.ShowInTaskbar = false;
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Own Color";
            this.Load += new System.EventHandler(this.FormColorSelection_Load);
            ((System.ComponentModel.ISupportInitialize) (this.red_numericUpDown)).EndInit();
            ((System.ComponentModel.ISupportInitialize) (this.green_numericUpDown)).EndInit();
            ((System.ComponentModel.ISupportInitialize) (this.blue_numericUpDown)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();
        }

        private System.Windows.Forms.Label blue_label;
        private System.Windows.Forms.NumericUpDown blue_numericUpDown;
        private System.Windows.Forms.HScrollBar blue_scrollBar;
        private System.Windows.Forms.Button cancel_button;
        private System.Windows.Forms.Label green_label;
        private System.Windows.Forms.NumericUpDown green_numericUpDown;
        private System.Windows.Forms.HScrollBar green_scrollBar;
        private System.Windows.Forms.Panel panel;
        private System.Windows.Forms.Label red_label;
        private System.Windows.Forms.NumericUpDown red_numericUpDown;
        private System.Windows.Forms.HScrollBar red_scrollBar;
        private System.Windows.Forms.Button save_button;

        #endregion
    }
}