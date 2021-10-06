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

        private void btnBack_Click(object sender, EventArgs e)
        {
            Close();
        }

        private void FormView_Load(object sender, EventArgs e)
        {
            // TODO: данная строка кода позволяет загрузить данные в таблицу "databaseDataSet.История". При необходимости она может быть перемещена или удалена.
            this.историяTableAdapter.Fill(this.databaseDataSet.История);
            // TODO: данная строка кода позволяет загрузить данные в таблицу "databaseDataSet.Пользователи". При необходимости она может быть перемещена или удалена.
            this.пользователиTableAdapter.Fill(this.databaseDataSet.Пользователи);
            // TODO: данная строка кода позволяет загрузить данные в таблицу "databaseDataSet.Фильмы". При необходимости она может быть перемещена или удалена.
            this.фильмыTableAdapter.Fill(this.databaseDataSet.Фильмы);

            this.panelFilm.Dock = System.Windows.Forms.DockStyle.Fill;

        }

        private void radioBtnFilmAll_CheckedChanged(object sender, EventArgs e)
        {
            if (radioBtnFilmAll.Checked)
                фильмыTableAdapter.Fill(this.databaseDataSet.Фильмы);

        }

        private void radioBtnFilmPresent_CheckedChanged(object sender, EventArgs e)
        {
            if (radioBtnFilmPresent.Checked)
                фильмыTableAdapter.FillByAbsent(this.databaseDataSet.Фильмы, false);
        }

        private void radioBtnFilmAbsent_CheckedChanged(object sender, EventArgs e)
        {
            if (radioBtnFilmAbsent.Checked)
                фильмыTableAdapter.FillByAbsent(this.databaseDataSet.Фильмы, true);
        }

        private void dataGridViewFilm_RowPrePaint(object sender, DataGridViewRowPrePaintEventArgs e)
        {
            foreach (DataGridViewRow row in dataGridViewFilm.Rows)
            {
                if ((bool)row.Cells["отсутствуетDataGridViewCheckBoxColumn"].Value)
                    dataGridViewFilm.Rows[row.Index].DefaultCellStyle.BackColor = Color.LightPink;
                else
                    dataGridViewFilm.Rows[row.Index].DefaultCellStyle.BackColor = Color.LightGreen;
            }
        }

        private void dataGridViewFilm_SelectionChanged(object sender, EventArgs e)
        {
            this.dataGridViewFilm.ClearSelection();
        }

        private void buttonSearchFilm_Click(object sender, EventArgs e)
        {
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
                        фильмыTableAdapter.FillByName2(this.databaseDataSet.Фильмы, this.textBoxSearchName.Text, (bool)false);
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
                        фильмыTableAdapter.FillByName2(this.databaseDataSet.Фильмы, this.textBoxSearchName.Text, true);
                        break;
                }
            }
            else
                фильмыTableAdapter.FillByName(this.databaseDataSet.Фильмы, this.textBoxSearchName.Text);
            this.textBoxSearchName.Text = null;
            this.textBoxSearchGenre.Text = null;
            this.textBoxSearchActor.Text = null;
        }

        private void buttonSearchGenre_Click(object sender, EventArgs e)
        {
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
                        фильмыTableAdapter.FillByGenre2(this.databaseDataSet.Фильмы, this.textBoxSearchGenre.Text, (bool)false);
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
                        фильмыTableAdapter.FillByGenre2(this.databaseDataSet.Фильмы, this.textBoxSearchGenre.Text, true);
                        break;
                }
            }
            else
                фильмыTableAdapter.FillByGenre(this.databaseDataSet.Фильмы, this.textBoxSearchGenre.Text);
            this.textBoxSearchName.Text = null;
            this.textBoxSearchGenre.Text = null;
            this.textBoxSearchActor.Text = null;
        }

        private void buttonSearchActor_Click(object sender, EventArgs e)
        {
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
                        фильмыTableAdapter.FillByActor2(this.databaseDataSet.Фильмы, this.textBoxSearchActor.Text, (bool)false);
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
                        фильмыTableAdapter.FillByActor2(this.databaseDataSet.Фильмы, this.textBoxSearchActor.Text, true);
                        break;
                }
            }
            else
                фильмыTableAdapter.FillByActor(this.databaseDataSet.Фильмы, this.textBoxSearchActor.Text);
            this.textBoxSearchName.Text = null;
            this.textBoxSearchGenre.Text = null;
            this.textBoxSearchActor.Text = null;
        }
    }
}
