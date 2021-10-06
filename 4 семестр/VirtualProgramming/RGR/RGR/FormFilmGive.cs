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
    public partial class FormFilmGive : Form
    {
        public FormFilmGive()
        {
            InitializeComponent();
        }

        private void FormFilmGive_Load(object sender, EventArgs e)
        {
            // TODO: данная строка кода позволяет загрузить данные в таблицу "databaseDataSet.Пользователи". При необходимости она может быть перемещена или удалена.
            this.пользователиTableAdapter.Fill(this.databaseDataSet.Пользователи);
            // TODO: данная строка кода позволяет загрузить данные в таблицу "databaseDataSet.Пользователи". При необходимости она может быть перемещена или удалена.
            this.пользователиTableAdapter.Fill(this.databaseDataSet.Пользователи);
            // TODO: данная строка кода позволяет загрузить данные в таблицу "databaseDataSet.Фильмы". При необходимости она может быть перемещена или удалена.
            this.фильмыTableAdapter.FillByAbsent(this.databaseDataSet.Фильмы, false);
            // TODO: данная строка кода позволяет загрузить данные в таблицу "databaseDataSet.История". При необходимости она может быть перемещена или удалена.
            this.историяTableAdapter.Fill(this.databaseDataSet.История);

            this.dataGridViewFilm.Sort(this.dataGridViewFilm.Columns[названиеDataGridViewTextBoxColumn.Index], ListSortDirection.Ascending);
            this.dataGridViewUser.Sort(this.dataGridViewUser.Columns[фамилияDataGridViewTextBoxColumn.Index], ListSortDirection.Ascending);

            this.panelFilm.Dock = System.Windows.Forms.DockStyle.Fill;

            this.panelUser.Dock = System.Windows.Forms.DockStyle.Fill;
            panelUser.Hide();
        }

        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        /*         Окно фильмов       */
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */

        // Поиск фильма
        private void ButtonSearchFilm_Click(object sender, EventArgs e)
        {
            string btnName = (sender as Button).Name.ToString();

            if (btnName == "buttonSearchName")
            {
                фильмыTableAdapter.FillByName2(this.databaseDataSet.Фильмы, this.textBoxSearchName.Text, (bool)false);
                this.textBoxSearchGenre.Text = null;
                this.textBoxSearchActor.Text = null;
            }
            else if (btnName == "buttonSearchGenre")
            {
                фильмыTableAdapter.FillByGenre2(this.databaseDataSet.Фильмы, this.textBoxSearchGenre.Text, (bool)false);
                this.textBoxSearchName.Text = null;
                this.textBoxSearchActor.Text = null;
            }
            else if (btnName == "buttonSearchActor")
            {
                фильмыTableAdapter.FillByActor2(this.databaseDataSet.Фильмы, this.textBoxSearchActor.Text, (bool)false);
                this.textBoxSearchName.Text = null;
                this.textBoxSearchGenre.Text = null;
            }
        }

        // Убирает выделение строк 
        private void DataGridViewFilm_SelectionChanged(object sender, EventArgs e)
        {
            this.dataGridViewFilm.ClearSelection();
        }

        private void BtnBack_Click(object sender, EventArgs e)
        {
            Close();
        }
        private void DataGridViewFilm_CellMouseDoubleClick(object sender, DataGridViewCellMouseEventArgs e)
        {
            panelFilm.Hide();
            panelUser.Show();
        }

        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        /*     Окно пользователей     */
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */

        // Выделение цветом
        private void DataGridViewUser_RowPrePaint(object sender, DataGridViewRowPrePaintEventArgs e)
        {
            //foreach (DataGridViewRow row in dataGridViewUser.Rows)
            //{
            //    if (row.Cells["наРукахDataGridViewTextBoxColumn"].Value.ToString() != "")
            //        dataGridViewUser.Rows[row.Index].DefaultCellStyle.BackColor = Color.LightPink;
            //    else
            //        dataGridViewUser.Rows[row.Index].DefaultCellStyle.BackColor = Color.LightGreen;
            //}
        }

        // Поиск пользователя
        private void ButtonSearchUser_Click(object sender, EventArgs e)
        {
            пользователиTableAdapter.FillByFIO(this.databaseDataSet.Пользователи, this.textBoxSearchUserF.Text, this.textBoxSearchUserI.Text, this.textBoxSearchUserO.Text);
        }

        // Сброс поиска
        private void ButtonResetSearchUser_Click(object sender, EventArgs e)
        {
            пользователиTableAdapter.Fill(this.databaseDataSet.Пользователи);
            this.textBoxSearchUserF.Text = null;
            this.textBoxSearchUserI.Text = null;
            this.textBoxSearchUserO.Text = null;
        }

        // Убирает выделение строк 
        private void DataGridViewUser_SelectionChanged(object sender, EventArgs e)
        {
            this.dataGridViewUser.ClearSelection();
        }

        private void BtnBackStep_Click(object sender, EventArgs e)
        {
            panelFilm.Show();
            panelUser.Hide();
        }

        private void DataGridViewUser_CellDoubleClick(object sender, DataGridViewCellEventArgs e)
        {
            int codeUser = Convert.ToInt32(dataGridViewUser.CurrentRow.Cells["кодПользователяDataGridViewTextBoxColumn"].Value.ToString());
            int codeFilm = Convert.ToInt32(dataGridViewFilm.CurrentRow.Cells["кодФильмаDataGridViewTextBoxColumn"].Value.ToString());

            string user = dataGridViewUser.CurrentRow.Cells["фамилияDataGridViewTextBoxColumn"].Value.ToString() + " " + dataGridViewUser.CurrentRow.Cells["имяDataGridViewTextBoxColumn"].Value.ToString().Substring(0, 1) + "." + dataGridViewUser.CurrentRow.Cells["отчествоDataGridViewTextBoxColumn"].Value.ToString().Substring(0, 1) + ".";
            string filmName = dataGridViewFilm.CurrentRow.Cells["названиеDataGridViewTextBoxColumn"].Value.ToString();
            string filmCountry = dataGridViewFilm.CurrentRow.Cells["странаDataGridViewTextBoxColumn"].Value.ToString();
            string filmProducer = dataGridViewFilm.CurrentRow.Cells["режиссерDataGridViewTextBoxColumn"].Value.ToString();
            string filmYear = dataGridViewFilm.CurrentRow.Cells["годDataGridViewTextBoxColumn"].Value.ToString();


            var condition = MessageBox.Show(
                "Отдать фильм: \n    Название: \"" + filmName + "\"\n    Режиссер(-ы): " + filmProducer + "\n    Год выхода: " + filmYear + "\n Пользователю: " + user,
                "Подтверждение действия",
                MessageBoxButtons.OKCancel,
                MessageBoxIcon.Warning);
            switch (condition)
            {
                case DialogResult.Cancel: return;
                case DialogResult.OK:
                    try
                    {
                        фильмыTableAdapter.UpdateAbsence(true, codeFilm);
                        пользователиTableAdapter.UpdateLastVisit(DateTime.Now.Date, codeUser);
                        историяTableAdapter.AddRecord(codeUser, codeFilm, user, filmName, filmProducer, filmCountry, filmYear, DateTime.Now.Date, null);
                        MessageBox.Show(
                                   "Действие успешно выполнено!",
                                   "Уведомление",
                                   MessageBoxButtons.OK,
                                   MessageBoxIcon.Information);

                        фильмыTableAdapter.FillByAbsent(this.databaseDataSet.Фильмы, false);
                        panelFilm.Show();
                        panelUser.Hide();
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
