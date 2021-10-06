using System;
using System.Drawing;
using System.Windows.Forms;

namespace laboratoryWork_3
{
    public partial class FormColorSelection : Form
    {
        public Color Color { get; set; }
        public FormColorSelection()
        {
            InitializeComponent();
            
            red_scrollBar.Tag = red_numericUpDown;
            green_scrollBar.Tag = green_numericUpDown;
            blue_scrollBar.Tag = blue_numericUpDown;
            
            red_numericUpDown.Tag = red_scrollBar;
            green_numericUpDown.Tag = green_scrollBar;
            blue_numericUpDown.Tag = blue_scrollBar;
            
        }
        
        private void scrollBar_ValueChanged(object sender, EventArgs e)
        {
            ScrollBar scrollBar = (ScrollBar)sender;
            NumericUpDown numericUpDown = (NumericUpDown)scrollBar.Tag;
            numericUpDown.Value = scrollBar.Value;
            UpdateColor();
        }

        private void numericUpDown_ValueChanged(object sender, EventArgs e)
        {
            NumericUpDown numericUpDown = (NumericUpDown)sender;
            ScrollBar scrollBar = (ScrollBar)numericUpDown.Tag;
            scrollBar.Value = (int)numericUpDown.Value;
        }
        
        private void UpdateColor()
        {
            Color color = Color.FromArgb(red_scrollBar.Value, green_scrollBar.Value, blue_scrollBar.Value);
            panel.BackColor = color;
            Color = color;
        }
        private void FormColorSelection_Load(object sender, EventArgs e)
        {
            FormMain main = (FormMain)this.Owner;
            if(main != null)
            {
                Color tmp = main.GetCurrentColor;
                red_scrollBar.Value = tmp.R;
                green_scrollBar.Value = tmp.G;
                blue_scrollBar.Value = tmp.B;
            }
        }
    }
}