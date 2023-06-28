using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Converter
{
    public partial class Form1 : Form
    {
        ADT_Control_ control_ = new ADT_Control_();
        public Form1()
        {
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            label1.Text = control_.editor.getNumber();
            trackBar1.Value = control_.Pin;
            trackBar2.Value = control_.Pout;
            label2.Text = "0";
            UpdateButtons();
        }

        private void UpdateButtons()
        {
            foreach (Control i in Controls)
            {
                if (i is Button)
                {
                    int j = Convert.ToInt16(i.Tag.ToString());
                    if (j < trackBar1.Value)
                        i.Enabled = true;
                    if ((j >= trackBar1.Value) && (j <= 15))
                        i.Enabled = false;
                }
            }
        }

        private void trackbar1_Scroll(object sender, EventArgs e)
        {
            numericUpDown1.Value = trackBar1.Value;
            UpdateP1();
        }

        private void numericUpDown1_ValueChanged(object sender, EventArgs e)
        {
            trackBar1.Value = Convert.ToByte(numericUpDown1.Value);
            UpdateP1();
        }

        private void UpdateP1()
        {
            control_.Pin = trackBar1.Value;
            UpdateButtons();
            label1.Text = control_.doCmnd(18);
            label2.Text = "0";
        }

        private void trackBar2_Scroll(object sender, EventArgs e)
        {
            numericUpDown2.Value = trackBar2.Value;
            this.updateP2();
        }
        private void numericUpDown2_ValueChanged(object sender, EventArgs e)
        {
            trackBar2.Value = Convert.ToByte(numericUpDown2.Value);
            this.updateP2();
        }
        private void updateP2()
        {
            control_.Pout = trackBar2.Value;
            //label2.Text = control_.doCmnd(19);
        }

        private void выходToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Close();
        }

        private void историяToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Form2 history = new Form2();
            history.Show();
            if (control_.history.count() == 0)
            {
                MessageBox.Show("История пуста", "Внимание", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                return;
            }
            for (int i = 0; i < control_.history.count(); i++)
            {
                List<string> currentRecord = control_.history[i].toList();
                history.dataGridView1.Rows.Add(currentRecord[0], currentRecord[1], currentRecord[2], currentRecord[3]);
            }
        }

        private void справкаToolStripMenuItem_Click(object sender, EventArgs e)
        {
            MessageBox.Show("Конвертор\nВерсия: 0.0.1 Alpha\n\nРазработчик: Мироненко Кирилл, ИП-911\n\n            © 2022-2023 уч.год, СибГУТИ", "О программе", MessageBoxButtons.OK, MessageBoxIcon.Information);

        }

        private void doCmnd(int j)
        {
            if (j == 19)
                label2.Text = control_.doCmnd(j);
            else
            {
                if (control_.St == ADT_Control_.State.Converted)
                    label1.Text = control_.doCmnd(18);
                label1.Text = control_.doCmnd(j);
                label2.Text = "0";
            }
        }


        private void button_Click(object sender, EventArgs e)
        {
            Button but = (Button)sender;
            int j = Convert.ToInt16(but.Tag.ToString());
            doCmnd(j);
        }
    }
}
