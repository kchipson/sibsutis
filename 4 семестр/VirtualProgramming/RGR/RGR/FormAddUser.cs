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

        private void buttonAddFilm_Click(object sender, EventArgs e)
        {
            if (textBoxSurname.Text != "" && textBoxName.Text != "" && textBoxMiddleName.Text != "" && textBoxAddress.Text != "")
            {
                if (textBoxSurname.TextLength > 255 || textBoxName.TextLength > 255 || textBoxMiddleName.TextLength > 255 || textBoxAddress.TextLength > 255)
                {
                    MessageBox.Show(
                   "Некорректные данные, размер полей не должен превышать 255 символов!",
                   "Ошибка",
                   MessageBoxButtons.OK,
                   MessageBoxIcon.Error);
                    return;
                }
                try
                {
                    пользователиTableAdapter.AddUser(textBoxSurname.Text, textBoxName.Text, textBoxMiddleName.Text, textBoxAddress.Text, DateTime.Now.Date);
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
    }
}
