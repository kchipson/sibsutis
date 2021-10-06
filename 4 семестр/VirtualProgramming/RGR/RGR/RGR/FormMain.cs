using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace RGR
{
    public partial class FormMain : Form
    {
        public FormMain()
        {
            InitializeComponent();
            panelMain.Dock = System.Windows.Forms.DockStyle.Fill;
            panelControl.Dock = System.Windows.Forms.DockStyle.Fill;
        }

        private void btnAdd_Click(object sender, EventArgs e)
        {
            panelMain.Hide();
            panelControl.Show();
        }

        private void btnBack_Click(object sender, EventArgs e)
        {
            panelControl.Hide();
            panelMain.Show();
            
        }

        private void buttonView_Click(object sender, EventArgs e)
        {
            FormView form = new FormView
            {
                Owner = this
            };
            form.ShowDialog();
        }
    }
}