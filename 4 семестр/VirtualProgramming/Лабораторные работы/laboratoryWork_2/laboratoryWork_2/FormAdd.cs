using System;
using System.Windows.Forms;

namespace laboratoryWork_2
{
    public partial class FormAdd : Form
    {
        public FormAdd()
        {
            InitializeComponent();
        }

        private void buttonSave_Click(object sender, EventArgs e)
        {
            FormMain main = Owner as FormMain;
            if((main != null) && (textBox1.Text != ""))
                main.addWordInSection(radioButton1.Checked ? 1 : 2, textBox1.Text);
            Close();
        }

        private void buttonCancel_Click(object sender, EventArgs e)
        {
            Close();
        }
    }
}