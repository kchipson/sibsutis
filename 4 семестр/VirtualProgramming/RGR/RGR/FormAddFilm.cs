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
    public partial class FormAddFilm : Form
    {
        public FormAddFilm()
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
                        if (tmp < 1888)
                        {
                            throw new Exception();
                        }
                        try
                        {
                            фильмыTableAdapter.AddFilm(textBoxName.Text, textBoxGenre.Text, textBoxProducer.Text, textBoxCountry.Text, textBoxYear.Text, textBoxActors.Text, textBoxAnnotation.Text, false);
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
    }
}
