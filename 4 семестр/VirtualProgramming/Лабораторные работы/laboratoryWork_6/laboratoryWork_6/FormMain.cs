using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace laboratoryWork_6
{
    public partial class FormMain : Form
    {
        public FormMain()
        {
            InitializeComponent();
        }

        private void FormMain_Load(object sender, EventArgs e)
        {
            // TODO: данная строка кода позволяет загрузить данные в таблицу "dataBaseDataSet.Студенты". При необходимости она может быть перемещена или удалена.
            this.студентыTableAdapter.Fill(this.dataBaseDataSet.Студенты);
            // TODO: данная строка кода позволяет загрузить данные в таблицу "dataBaseDataSet.Группа". При необходимости она может быть перемещена или удалена.
            this.группаTableAdapter.Fill(this.dataBaseDataSet.Группа);
            // TODO: данная строка кода позволяет загрузить данные в таблицу "dataBaseDataSet.Факультет". При необходимости она может быть перемещена или удалена.
            this.факультетTableAdapter.Fill(this.dataBaseDataSet.Факультет);

        }

        private void button1_Click(object sender, EventArgs e)
        {
            if (students_dataGridView.SortOrder == SortOrder.Ascending) 
                students_dataGridView.Sort(students_dataGridView.Columns[1], ListSortDirection.Descending);
            else 
                students_dataGridView.Sort(students_dataGridView.Columns[1], ListSortDirection.Ascending);
        }

        private void textBox1_TextChanged(object sender, EventArgs e)
        {
            for (int i = 0; i < students_dataGridView.RowCount - 1; i++)
            {
                string str = students_dataGridView.Rows[i].Cells[1].Value.ToString();
                if (str.Contains(textBox1.Text) == true) 
                    students_dataGridView.Rows[i].Selected = true;
                else 
                    students_dataGridView.Rows[i].Selected = false;
                if (textBox1.Text == "") 
                    students_dataGridView.Rows[i].Selected = false;
            }
        }
        
        private void textBox2_TextChanged(object sender, EventArgs e)
        {
            for (int i = 0; i < students_dataGridView.RowCount - 1; i++)
            {
                string str = students_dataGridView.Rows[i].Cells[1].Value.ToString();
                if (str == textBox2.Text) 
                    students_dataGridView.Rows[i].Selected = true;
                else 
                    students_dataGridView.Rows[i].Selected = false;
            }
        }
    }
}