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
    public partial class FormDelFilm : Form
    {
        public FormDelFilm()
        {
            InitializeComponent();
        }
        private void FormDelFilm_Load(object sender, EventArgs e)
        {
            // TODO: данная строка кода позволяет загрузить данные в таблицу "databaseDataSet.Фильмы". При необходимости она может быть перемещена или удалена.
            this.фильмыTableAdapter.Fill(this.databaseDataSet.Фильмы);
            this.dataGridViewFilm.Sort(this.dataGridViewFilm.Columns[названиеDataGridViewTextBoxColumn.Index], ListSortDirection.Ascending);
        }

        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        /*         Окно фильмов       */
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        private void RadioBtnFilm_CheckedChanged(object sender, EventArgs e)
        {
            if (radioBtnFilmAll.Checked)
                фильмыTableAdapter.Fill(this.databaseDataSet.Фильмы);
            else if (radioBtnFilmPresent.Checked)
                фильмыTableAdapter.FillByAbsent(this.databaseDataSet.Фильмы, false);
            else if (radioBtnFilmAbsent.Checked)
                фильмыTableAdapter.FillByAbsent(this.databaseDataSet.Фильмы, true);

            this.textBoxSearchName.Text = null;
            this.textBoxSearchGenre.Text = null;
            this.textBoxSearchActor.Text = null;

        }

        // Выделение цветом
        private void DataGridViewFilm_RowPrePaint(object sender, DataGridViewRowPrePaintEventArgs e)
        {
            foreach (DataGridViewRow row in dataGridViewFilm.Rows)
            {
                if ((bool)row.Cells["отсутствуетDataGridViewCheckBoxColumn"].Value)
                    dataGridViewFilm.Rows[row.Index].DefaultCellStyle.BackColor = Color.LightPink;
                else
                    dataGridViewFilm.Rows[row.Index].DefaultCellStyle.BackColor = Color.LightGreen;
            }
        }

        // Поиск фильма
        private void ButtonSearchFilm_Click(object sender, EventArgs e)
        {
            string btnName = (sender as Button).Name.ToString();
            if (radioBtnFilmPresent.Checked)
            {
                var condition = MessageBox.Show(
                "Поиск будет выполнен только по присутствующим фильмам",
                "Предупреждение",
                MessageBoxButtons.OKCancel,
                MessageBoxIcon.Warning);
                switch (condition)
                {
                    case DialogResult.Cancel: return;
                    case DialogResult.OK:
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
                        break;
                }
            }
            else if (radioBtnFilmAbsent.Checked)
            {
                var condition = MessageBox.Show(
                "Поиск будет выполнен только по отсутствующим фильмам",
                "Предупреждение",
                MessageBoxButtons.OKCancel,
                MessageBoxIcon.Warning);
                switch (condition)
                {
                    case DialogResult.Cancel: return;
                    case DialogResult.OK:
                        if (btnName == "buttonSearchName")
                        {
                            фильмыTableAdapter.FillByName2(this.databaseDataSet.Фильмы, this.textBoxSearchName.Text, (bool)true);
                            this.textBoxSearchGenre.Text = null;
                            this.textBoxSearchActor.Text = null;
                        }
                        else if (btnName == "buttonSearchGenre")
                        {
                            фильмыTableAdapter.FillByGenre2(this.databaseDataSet.Фильмы, this.textBoxSearchGenre.Text, (bool)true);
                            this.textBoxSearchName.Text = null;
                            this.textBoxSearchActor.Text = null;
                        }
                        else if (btnName == "buttonSearchActor")
                        {
                            фильмыTableAdapter.FillByActor2(this.databaseDataSet.Фильмы, this.textBoxSearchActor.Text, (bool)true);
                            this.textBoxSearchName.Text = null;
                            this.textBoxSearchGenre.Text = null;
                        }
                        break;
                }
            }
            else
            {
                if (btnName == "buttonSearchName")
                {
                    фильмыTableAdapter.FillByName(this.databaseDataSet.Фильмы, this.textBoxSearchName.Text);
                    this.textBoxSearchGenre.Text = null;
                    this.textBoxSearchActor.Text = null;
                }
                else if (btnName == "buttonSearchGenre")
                {
                    фильмыTableAdapter.FillByGenre(this.databaseDataSet.Фильмы, this.textBoxSearchGenre.Text);
                    this.textBoxSearchName.Text = null;
                    this.textBoxSearchActor.Text = null;
                }
                else if (btnName == "buttonSearchActor")
                {
                    фильмыTableAdapter.FillByActor(this.databaseDataSet.Фильмы, this.textBoxSearchActor.Text);
                    this.textBoxSearchName.Text = null;
                    this.textBoxSearchGenre.Text = null;
                }
            }
        }
        private void BtnBack_Click(object sender, EventArgs e)
        {
            Close();
        }

        private void DataGridViewFilm_CellMouseDoubleClick(object sender, DataGridViewCellMouseEventArgs e)
        {
            Int32 codeFilm = (int)dataGridViewFilm["кодФильма", dataGridViewFilm.CurrentRow.Index].Value;
            string nameFilm = dataGridViewFilm["названиеDataGridViewTextBoxColumn", dataGridViewFilm.CurrentRow.Index].Value.ToString();

            DialogResult condition;
            if ((bool)dataGridViewFilm["отсутствуетDataGridViewCheckBoxColumn", dataGridViewFilm.CurrentRow.Index].Value)
            {
                историяTableAdapter.FillByAbsentFilmCode(this.databaseDataSet.История, codeFilm);
                string userName = dataGridViewDel["Пользователь", 0].Value.ToString();
                condition = MessageBox.Show(
                  "Удалить отсутствующий фильм \"" + nameFilm + "\"? Фильм будет удален с рук пользователя \""+userName+"\", а также будет удалена история взятия данного фильма",
                  "Подтверждение действия",
                  MessageBoxButtons.OKCancel,
                  MessageBoxIcon.Warning);
            }
            else
            {
                condition = MessageBox.Show(
                   "Удалить фильм \""+ nameFilm + "\"? Также будет удалена история взятия данного фильма",
                   "Подтверждение действия",
                   MessageBoxButtons.OKCancel,
                   MessageBoxIcon.Warning);
            }
           
            switch (condition)
            {
                case DialogResult.Cancel: return;
                case DialogResult.OK:
                    фильмыTableAdapter.DelFilm(codeFilm);
                    историяTableAdapter.DelRecordWhereFilm(codeFilm);
                    MessageBox.Show(
                        "Действие успешно выполнено!",
                        "Уведомление",
                        MessageBoxButtons.OK,
                        MessageBoxIcon.Information);
                    this.фильмыTableAdapter.Fill(this.databaseDataSet.Фильмы);
                    break;
            }
        }

        private void dataGridViewFilm_SelectionChanged(object sender, EventArgs e)
        {
            this.dataGridViewFilm.ClearSelection();
        }
    }
}
