using RGR.DatabaseDataSetTableAdapters;
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
    public partial class FormDelUser : Form
    {
        public FormDelUser()
        {
            InitializeComponent();
        }
        private void FormDelUser_Load(object sender, EventArgs e)
        {
            // TODO: данная строка кода позволяет загрузить данные в таблицу "databaseDataSet.История". При необходимости она может быть перемещена или удалена.
            this.историяTableAdapter.Fill(this.databaseDataSet.История);
            // TODO: данная строка кода позволяет загрузить данные в таблицу "databaseDataSet.Пользователи". При необходимости она может быть перемещена или удалена.
            this.пользователиTableAdapter.Fill(this.databaseDataSet.Пользователи);
            this.dataGridViewUser.Sort(this.dataGridViewUser.Columns[фамилияDataGridViewTextBoxColumn.Index], ListSortDirection.Ascending);
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

        private void BtnBack_Click(object sender, EventArgs e)
        {
            Close();
        }

        private void DataGridViewUser_CellMouseDoubleClick(object sender, DataGridViewCellMouseEventArgs e)
        {
            Int32 userCode = (int)dataGridViewUser["кодПользователя", dataGridViewUser.CurrentRow.Index].Value;
            MessageBox.Show(userCode.ToString());
            string user = dataGridViewUser.CurrentRow.Cells["фамилияDataGridViewTextBoxColumn"].Value.ToString() + " " + dataGridViewUser.CurrentRow.Cells["имяDataGridViewTextBoxColumn"].Value.ToString().Substring(0, 1) + "." + dataGridViewUser.CurrentRow.Cells["отчествоDataGridViewTextBoxColumn"].Value.ToString().Substring(0, 1) + ".";

            DialogResult condition;
            историяTableAdapter.FillByAbsentUserCode(this.databaseDataSet.История, userCode);

            if (dataGridViewDel.RowCount == 0)
            {
                condition = MessageBox.Show(
                   "Удалить пользователя \"" + user + "\"? Также будет удалена история пользования фильмотекой",
                   "Подтверждение действия",
                   MessageBoxButtons.OKCancel,
                   MessageBoxIcon.Warning);
               
            }
            else
            {
                string films = "";
                foreach (DataGridViewRow row in dataGridViewDel.Rows)
                {
                    films += "\"" + row.Cells["Фильм"].Value.ToString() + "\"; ";
                }
                condition = MessageBox.Show(
                 "Удалить пользователя \"" + user + "\"? На руках у пользователя следующе фильмы: " + films + ", они будут  удалены. Также будет очищена история взятия данного фильма",
                 "Подтверждение действия",
                 MessageBoxButtons.OKCancel,
                 MessageBoxIcon.Warning);
            }

            switch (condition)
            {
                case DialogResult.Cancel: return;
                case DialogResult.OK:
                    пользователиTableAdapter.DelUser(userCode);
                    историяTableAdapter.DelRecordWhereUser(userCode);
                    foreach (DataGridViewRow row in dataGridViewDel.Rows)
                    {
                        
                        фильмыTableAdapter.DelFilm((int)row.Cells["КодФильма"].Value);
                    }

                        MessageBox.Show(
                        "Действие успешно выполнено!",
                        "Уведомление",
                        MessageBoxButtons.OK,
                        MessageBoxIcon.Information);
                    this.пользователиTableAdapter.Fill(this.databaseDataSet.Пользователи);
                    break;
            }
        }

        private void dataGridViewUser_SelectionChanged(object sender, EventArgs e)
        {
            this.dataGridViewUser.ClearSelection();
        }
    }
}
