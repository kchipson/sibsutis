using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace laboratoryWork_1
{
    public partial class FormMain : Form
    {
        public FormMain()
        {
            InitializeComponent();
        }

        
        public void setN(Int16 n)
        {
            numericUpDownN.Value = n;
        }
        
        public void setM(Int16 m)
        {
            numericUpDownM.Value = m;
        }
        
        private void startButton_Click(object sender, EventArgs e)
        {
            Int16 n = Convert.ToInt16(numericUpDownN.Value);
            Int16 m = Convert.ToInt16(numericUpDownM.Value);
            if (n == 0 || m == 0)
            {
                MessageBox.Show("Поля n и m не могут быть нулевыми", "Ошибка!", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            else
            {
                Random random = new Random();
                
                dataGridViewMatrix.RowCount = n;
                dataGridViewMatrix.ColumnCount = m + 1;

               
                for (int i = 0; i < n; ++i)
                {
                    dataGridViewMatrix.Rows[i].Cells[0].Value = i + 1;
                    dataGridViewMatrix.Rows[i].Cells[0].Style.BackColor = Color.MediumAquamarine;
                    for (int j = 1; j < m + 1; ++j)
                    {
                        dataGridViewMatrix.Rows[i].Cells[j].Value = random.Next(01000, 2000);
                    }
                }

                startToolStripMenuItem.Text = "Regenerate";
                startButton.Text = "Regenerate";
                maxToolStripMenuItem.Enabled = true;
                maxButton.Enabled = true;
                dataGridViewRes.Rows.Clear();

            }
        }

        private void maxButton_Click(object sender, EventArgs e)
        {
            Int16 n = Convert.ToInt16(dataGridViewMatrix.RowCount);
            Int16 m = Convert.ToInt16(dataGridViewMatrix.ColumnCount);
            dataGridViewRes.RowCount = n;
            dataGridViewRes.ColumnCount = 2;
            for (int i = 0; i < n; ++i)
            {
                int tmp = Convert.ToInt16(dataGridViewMatrix.Rows[i].Cells[1].Value);
                for (int j = 2; j < m; ++j)
                {
                    if (tmp < Convert.ToInt16(dataGridViewMatrix.Rows[i].Cells[j].Value))
                        tmp = Convert.ToInt16(dataGridViewMatrix.Rows[i].Cells[j].Value);
                }
                dataGridViewRes.Rows[i].Cells[0].Value = i + 1;
                dataGridViewRes.Rows[i].Cells[0].Style.BackColor = Color.MediumAquamarine;
                dataGridViewRes.Rows[i].Cells[1].Value = tmp;
            }
            maxToolStripMenuItem.Enabled = false;
            maxButton.Enabled = false;
        }

        private void dataGridViewMatrix_SelectionChanged(object sender, EventArgs e)
        {
            dataGridViewMatrix.ClearSelection();
        }

        private void dataGridViewRes_SelectionChanged(object sender, EventArgs e)
        {
            dataGridViewRes.ClearSelection();
        }

        private void startToolStripMenuItem_Click(object sender, EventArgs e)
        {
            startButton_Click(sender,e);
        }

        private void maxToolStripMenuItem_Click(object sender, EventArgs e)
        {
            maxButton_Click(sender,e);
        }

        private void aboutToolStripMenuItem_Click(object sender, EventArgs e)
        {
            MessageBox.Show("ФИО:\t\tМироненко К.А.\nГруппа:\t\tИП-811\n\nВизуальное программирование 2019-2020 уч. год", "About", MessageBoxButtons.OK, MessageBoxIcon.Information);
        }

        private void sizeToolStripMenuItem_Click(object sender, EventArgs e)
        {
            FormSize formSize = new FormSize(Convert.ToInt16(numericUpDownN.Value), Convert.ToInt16(numericUpDownM.Value));
            formSize.Owner = this;
            formSize.ShowDialog();

        }
    }
}