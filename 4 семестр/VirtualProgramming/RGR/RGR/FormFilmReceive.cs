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
    public partial class FormFilmReceive : Form
    {
        public FormFilmReceive()
        {
            InitializeComponent();
        }
        private void FormFilmReceive_Load(object sender, EventArgs e)
        {
            историяTableAdapter.FillByAbsent(this.databaseDataSet.История);
        }

        private void BtnBack_Click(object sender, EventArgs e)
        {
            Close();
        }

        private void ButtonSearchUser_Click(object sender, EventArgs e)
        {
            историяTableAdapter.FillByAbsentUser(this.databaseDataSet.История, this.textBoxSearchUser.Text);
            this.textBoxSearchName.Text = null;
            this.textBoxSearchProducer.Text = null;
        }

        private void ButtonSearchName_Click(object sender, EventArgs e)
        {
            историяTableAdapter.FillByAbsentName(this.databaseDataSet.История, this.textBoxSearchName.Text);
            this.textBoxSearchUser.Text = null;
            this.textBoxSearchProducer.Text = null;
        }

        private void ButtonSearchProducer_Click(object sender, EventArgs e)
        {
            историяTableAdapter.FillByAbsentProducer(this.databaseDataSet.История, this.textBoxSearchProducer.Text);
            this.textBoxSearchUser.Text = null;
            this.textBoxSearchName.Text = null;
        }

        private void ButtonResetSearch_Click(object sender, EventArgs e)
        {
            историяTableAdapter.FillByAbsent(this.databaseDataSet.История);
            this.textBoxSearchUser.Text = null;
            this.textBoxSearchName.Text = null;
            this.textBoxSearchProducer.Text = null;
        }

        private void DataGridView_CellDoubleClick(object sender, DataGridViewCellEventArgs e)
        {
            int codeUser = Convert.ToInt32(dataGridView.CurrentRow.Cells["кодПользователяDataGridViewTextBoxColumn"].Value.ToString());
            int codeFilm = Convert.ToInt32(dataGridView.CurrentRow.Cells["кодФильмаDataGridViewTextBoxColumn"].Value.ToString());
            int codeRecord = Convert.ToInt32(dataGridView.CurrentRow.Cells["кодЗаписиDataGridViewTextBoxColumn"].Value.ToString());

            string user = dataGridView.CurrentRow.Cells["пользовательDataGridViewTextBoxColumn"].Value.ToString();
            string filmName = dataGridView.CurrentRow.Cells["фильмDataGridViewTextBoxColumn"].Value.ToString();
            string filmProducer = dataGridView.CurrentRow.Cells["режиссерDataGridViewTextBoxColumn"].Value.ToString();
            string filmYear = dataGridView.CurrentRow.Cells["годВыходаDataGridViewTextBoxColumn"].Value.ToString();


            var condition = MessageBox.Show(
                "Фильм: \n    Название: \"" + filmName + "\"\n    Режиссер(-ы): " + filmProducer + "\n    Год выхода: " + filmYear + "\n Пользователь: " + user,
                "Возвращение фильма в картотеку",
                MessageBoxButtons.OKCancel,
                MessageBoxIcon.Warning);
            switch (condition)
            {
                case DialogResult.Cancel: return;
                case DialogResult.OK:
                    try
                    {
                        фильмыTableAdapter.UpdateAbsence(false, codeFilm);
                        пользователиTableAdapter.UpdateLastVisit(DateTime.Now.Date, codeUser);
                        историяTableAdapter.UpdateReturnDate(DateTime.Now.Date, codeRecord);
                        MessageBox.Show(
                                   "Действие успешно выполнено!",
                                   "Уведомление",
                                   MessageBoxButtons.OK,
                                   MessageBoxIcon.Information);

                        историяTableAdapter.FillByAbsent(this.databaseDataSet.История);
                    }
                    catch (Exception)
                    {
                        MessageBox.Show(
                                "Произошла ошибка, попробуйте снова",
                                "Ошибка",
                                MessageBoxButtons.OK,
                                MessageBoxIcon.Error);
                        return;
                    }
                    break;
            }
        }
    }
}
