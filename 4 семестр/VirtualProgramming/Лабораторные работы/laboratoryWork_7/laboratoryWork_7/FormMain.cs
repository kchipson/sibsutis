using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace laboratoryWork_7
{
    public partial class FormMain : Form
    {
        public FormMain()
        {
            InitializeComponent();
        }

        private void FormMain_Load(object sender, EventArgs e)
        {
            // TODO: данная строка кода позволяет загрузить данные в таблицу "dataBaseDataSet.Страны_Америки". При необходимости она может быть перемещена или удалена.
            this.страны_АмерикиTableAdapter.Fill(this.dataBaseDataSet.Страны_Америки);

        }

        private void All_button_Click(object sender, EventArgs e)
        {
            страны_АмерикиTableAdapter.Fill(this.dataBaseDataSet.Страны_Америки);
        }

        private void NorthAmerica_button_Click(object sender, EventArgs e)
        {
            страны_АмерикиTableAdapter.FillByCap(this.dataBaseDataSet.Страны_Америки, "Северная Америка");
        }

        private void SouthAmerica_button_Click(object sender, EventArgs e)
        {
            страны_АмерикиTableAdapter.FillByCap(this.dataBaseDataSet.Страны_Америки, "Южная Америка");
        }

        private void startK_button_Click(object sender, EventArgs e)
        {
            страны_АмерикиTableAdapter.FillByChar(dataBaseDataSet.Страны_Америки, "К%");
        }

        private void K_button_Click(object sender, EventArgs e)
        {
            страны_АмерикиTableAdapter.FillByChar(dataBaseDataSet.Страны_Америки, "%К%");
        }
        
        private void sort_button_Click(object sender, EventArgs e)
        {
            if (dataGridView.SortOrder == SortOrder.Ascending)
                dataGridView.Sort(dataGridView.Columns[4], ListSortDirection.Descending);
            else
                dataGridView.Sort(dataGridView.Columns[4], ListSortDirection.Ascending);
        }

        private void textBox_TextChanged(object sender, EventArgs e)
        {
            try
            {
                string str = textBox.Text + "%";
                страны_АмерикиTableAdapter.FillByChar(dataBaseDataSet.Страны_Америки, str);
            }
            catch
            {
                for (int i = 0; i < dataGridView.RowCount - 1; i++)
                {
                    dataGridView.Rows[i].Selected = false;
                }
            }
        }
    }
}