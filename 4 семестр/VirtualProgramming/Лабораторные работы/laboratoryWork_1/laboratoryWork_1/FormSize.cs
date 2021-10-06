using System;
using System.Windows.Forms;

namespace laboratoryWork_1
{
    public partial class FormSize : Form
    {
        public FormSize(Int16 n, Int16 m)
        {
            InitializeComponent();
            numericUpDownN.Value = n;
            numericUpDownM.Value = m;
        }

        private void buttonCancel_Click(object sender, EventArgs e)
        {
            Close();
        }

        private void buttonSave_Click(object sender, EventArgs e)
        {
            FormMain mainForm = this.Owner as FormMain;
            if (mainForm != null)
            {
                mainForm.setN(Convert.ToInt16(numericUpDownN.Value));
                mainForm.setM(Convert.ToInt16(numericUpDownM.Value));
            }
            Close();
        }
    }
}