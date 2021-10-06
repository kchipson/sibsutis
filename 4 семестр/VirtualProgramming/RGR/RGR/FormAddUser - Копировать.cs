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
    public partial class FormAddUser : Form
    {
        public FormAddUser()
        {
            InitializeComponent();
        }

        private void buttonAddUser_Click(object sender, EventArgs e)
        {
           
            if (textBoxName.Text != "" && textBoxGenre.Text != "" && textBoxYear.Text != "" && textBoxActors.Text != ""
                && textBoxAnnotation.Text != "" && textBoxCountry.Text != "" && textBoxProducer.Text != "")
            {
                if (textBoxYear.TextLength != 4)
                {
                    MessageBox.Show(
                        "Некорректный год выхода фильма",
                        "Ошибка",
                        MessageBoxButtons.OK,
                        MessageBoxIcon.Error);
                    return;
                }
                else
                {
                    try
                    {
                        int tmp = Convert.ToInt32(textBoxYear.Text);
                        try
                        {
                            this.фильмыTableAdapter.InsertQuery(textBoxName.Text, textBoxGenre.Text, textBoxProducer.Text, textBoxCountry.Text, textBoxYear.Text, textBoxActors.Text, textBoxAnnotation.Text, false);
                            MessageBox.Show(
                                "Запись успешно добавлена!",
                                "Уведомление",
                                MessageBoxButtons.OK,
                                MessageBoxIcon.Information);
                            Close();
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
                    }
                    catch (Exception)
                    {
                        MessageBox.Show(
                             "Некорректный год выхода фильма!",
                             "Ошибка",
                             MessageBoxButtons.OK,
                             MessageBoxIcon.Error);
                        return;
                    }
                }
                
            }
            else
            {
                MessageBox.Show(
                   "Некорректные данные, все поля должны быть заполнены!",
                   "Ошибка",
                   MessageBoxButtons.OK,
                   MessageBoxIcon.Error);
                return;
            }
        }

        private void FormAddUser_Load(object sender, EventArgs e)
        {
            // TODO: данная строка кода позволяет загрузить данные в таблицу "databaseDataSet.Фильмы". При необходимости она может быть перемещена или удалена.
            this.фильмыTableAdapter.Fill(this.databaseDataSet.Фильмы);

        }
    }
}
