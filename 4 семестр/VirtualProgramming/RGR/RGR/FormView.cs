using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Drawing.Drawing2D;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace RGR
{
    public partial class FormView : Form
    {
        public FormView()
        {
            InitializeComponent();
        }

        private void FormView_Load(object sender, EventArgs e)
        {
            this.фильмыTableAdapter.Fill(this.databaseDataSet.Фильмы);
            this.пользователиTableAdapter.Fill(this.databaseDataSet.Пользователи);
            this.историяTableAdapter.Fill(this.databaseDataSet.История);


            this.panelUser.Dock = System.Windows.Forms.DockStyle.Fill;
            this.panelFilm.Dock = System.Windows.Forms.DockStyle.Fill;
            this.panelHistory.Dock = System.Windows.Forms.DockStyle.Fill;

            this.dataGridViewFilm.Sort(this.dataGridViewFilm.Columns[названиеDataGridViewTextBoxColumn.Index], ListSortDirection.Ascending);
            this.dataGridViewUser.Sort(this.dataGridViewUser.Columns[фамилияDataGridViewTextBoxColumn.Index], ListSortDirection.Ascending);
            this.dataGridViewHistory.Sort(this.dataGridViewHistory.Columns[датаВзятияDataGridViewTextBoxColumn.Index], ListSortDirection.Ascending);

        }
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        /*         Смена окон         */
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        private void ToolStripFilmBtn_Click(object sender, EventArgs e)
        {
            panelFilm.Show();
            panelUser.Hide();
            panelHistory.Hide();
        }

        private void ToolStripUserBtn_Click(object sender, EventArgs e)
        {
            panelFilm.Hide();
            panelUser.Show();
            panelHistory.Hide();

        }

        private void ToolStripHistoryBtn_Click(object sender, EventArgs e)
        {
            panelFilm.Hide();
            panelUser.Hide();
            panelHistory.Show();
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

        // Убирает выделение строк 
        private void DataGridViewFilm_SelectionChanged(object sender, EventArgs e)
        {
            this.dataGridViewFilm.ClearSelection();
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

        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        /*     Окно пользователей     */
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */

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

        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        /*         Окно истории       */
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */

        // Выделение цветом
        private void DataGridViewHistory_RowPrePaint(object sender, DataGridViewRowPrePaintEventArgs e)
        {
            foreach (DataGridViewRow row in dataGridViewHistory.Rows)
            {
                if (row.Cells["датаВозвратаDataGridViewTextBoxColumn"].Value.ToString() == "")
                    dataGridViewHistory.Rows[row.Index].DefaultCellStyle.BackColor = Color.LightPink;
                else
                    dataGridViewHistory.Rows[row.Index].DefaultCellStyle.BackColor = Color.LightGreen;
            }
        }

        // Убирает выделение строк 
        private void DataGridViewHistory_SelectionChanged(object sender, EventArgs e)
        {
            this.dataGridViewHistory.ClearSelection();
        }

        private void BtnBack_Click(object sender, EventArgs e)
        {
            Close();
        }

        private void ButtonHistoryUserSearch_Click(object sender, EventArgs e)
        {
            историяTableAdapter.FillByUser(this.databaseDataSet.История, this.textBoxSearchUser.Text);
            this.textBoxSearchUser.Text = null;
            this.textBoxSearchFilm.Text = null;
        }

        private void ButtonHistoryFilmSearch_Click(object sender, EventArgs e)
        {
            историяTableAdapter.FillByName(this.databaseDataSet.История, this.textBoxSearchFilm.Text);
            this.textBoxSearchUser.Text = null;
            this.textBoxSearchFilm.Text = null;

        }

        private void ButtonResetSearch_Click(object sender, EventArgs e)
        {
            историяTableAdapter.Fill(this.databaseDataSet.История);
            this.textBoxSearchUser.Text = null;
            this.textBoxSearchFilm.Text = null;
        }
    }
}
