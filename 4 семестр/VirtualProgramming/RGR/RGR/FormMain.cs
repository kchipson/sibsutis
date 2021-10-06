using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using iTextSharp.text;
using iTextSharp.text.pdf;

namespace RGR
{
    public partial class FormMain : Form
    {
        public FormMain()
        {
            InitializeComponent();
            panelMain.Dock = System.Windows.Forms.DockStyle.Fill;
            panelControl.Dock = System.Windows.Forms.DockStyle.Fill;
            panelPrint.Dock = System.Windows.Forms.DockStyle.Fill;
            panelLettersMissing.Dock = System.Windows.Forms.DockStyle.Fill;
            panelLettersDebtors.Dock = System.Windows.Forms.DockStyle.Fill;
        }

        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        /*        Главное окно        */
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        private void BtnControl_Click(object sender, EventArgs e)
        {
            panelMain.Hide();
            panelControl.Show();
        }

        private void BtnPrint_Click(object sender, EventArgs e)
        {
            panelMain.Hide();
            panelPrint.Show();
        }

        private void ButtonView_Click(object sender, EventArgs e)
        {
            FormView form = new FormView
            {
                Owner = this
            };
            form.ShowDialog();
        }

        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        /*       Окно управления      */
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        private void BtnFilmAdd_Click(object sender, EventArgs e)
        {
            FormAddFilm form = new FormAddFilm
            {
                Owner = this
            };
            form.ShowDialog();
        }

        private void BtnFilmDel_Click(object sender, EventArgs e)
        {
            FormDelFilm form = new FormDelFilm
            {
                Owner = this
            };
            form.ShowDialog();
        }

        private void BtnFilmGive_Click(object sender, EventArgs e)
        {
            FormFilmGive form = new FormFilmGive
            {
                Owner = this
            };
            form.ShowDialog();
        }

        private void BtnFilmReceive_Click(object sender, EventArgs e)
        {
            FormFilmReceive form = new FormFilmReceive
            {
                Owner = this
            };
            form.ShowDialog();
        }

        private void BtnUserAdd_Click(object sender, EventArgs e)
        {
            FormAddUser form = new FormAddUser
            {
                Owner = this
            };
            form.ShowDialog();
        }

        private void BtnUserDel_Click(object sender, EventArgs e)
        {
            FormDelUser form = new FormDelUser
            {
                Owner = this
            };
            form.ShowDialog();
        }



        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        /*         Окно печати        */
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        private void ButtonUserStory_Click(object sender, EventArgs e)
        {
            FormHistoryUser form = new FormHistoryUser
            {
                Owner = this
            };
            form.ShowDialog();

        }
        private void ButtonFilmStory_Click(object sender, EventArgs e)
        {
            FormHistoryFilm form = new FormHistoryFilm
            {
                Owner = this
            };
            form.ShowDialog();
        }

        private void ButtonDebtors_Click(object sender, EventArgs e)
        {
            FormDebtors form = new FormDebtors
            {
                Owner = this
            };
            form.ShowDialog();
        }

        private void ButtonMissingFilms_Click(object sender, EventArgs e)
        {
            FormMissingFilms form = new FormMissingFilms
            {
                Owner = this
            };
            form.ShowDialog();
        }

        private void ButtonLettersDebtors_Click(object sender, EventArgs e)
        {
            panelPrint.Hide();
            panelLettersDebtors.Show();
            dateTimePicker2.Format = DateTimePickerFormat.Short;
            dateTimePicker2.MaxDate = DateTime.Now;
            dateTimePicker2.Value = DateTime.Now;
            dateTimePicker3.Format = DateTimePickerFormat.Short;
            dateTimePicker3.MinDate = DateTime.Now;
            dateTimePicker3.Value = DateTime.Now;
        }

        private void ButtonLettersMissing_Click(object sender, EventArgs e)
        {
            panelPrint.Hide();
            panelLettersMissing.Show();
            dateTimePicker1.Format = DateTimePickerFormat.Short;
            dateTimePicker1.MaxDate = DateTime.Now;
            dateTimePicker1.Value = DateTime.Now;
        }
        private void BtnBack_Click(object sender, EventArgs e)
        {
            panelPrint.Hide();
            panelControl.Hide();
            panelMain.Show();
        }

        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        /*  Окно давно не посещавших  */
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        private void ButtonComposeMissing_Click(object sender, EventArgs e)
        {
            пользователиTableAdapter.FillByLongVisited(this.databaseDataSet.Пользователи, dateTimePicker1.Value);
            if (dataGridViewUser.Rows.Count == 0)
            {
                MessageBox.Show(
                      "Пользователей, посещавщих фильмотеку в последний раз ранее чем " + dateTimePicker1.Value.ToString().Split(' ')[0] + " не найдено!",
                      "Уведомление",
                      MessageBoxButtons.OK,
                      MessageBoxIcon.Information);
                return;
            }

            SaveFileDialog dlg = new SaveFileDialog();
            dlg.FileName = "Письма пользователям посещавщим фильмотеку ранее " + dateTimePicker1.Text;
            dlg.Filter = "PDF files (*.pdf)|*.pdf";
            dlg.RestoreDirectory = true;
            dlg.Title = "Сохранение файла";

            if (dlg.ShowDialog() == DialogResult.OK)
            {
                try
                {
                    string outputFile = dlg.FileName;
                    FileStream fs = new FileStream(outputFile, FileMode.Create, FileAccess.Write, FileShare.None);
                    Document doc = new Document(PageSize.A4, 25, 25, 25, 15);
                    PdfWriter writer  = PdfWriter.GetInstance(doc, fs);

                    BaseFont baseFont = BaseFont.CreateFont(Path.Combine(Environment.GetFolderPath(Environment.SpecialFolder.Fonts), "ARIAL.TTF"), BaseFont.IDENTITY_H, BaseFont.NOT_EMBEDDED);
                    iTextSharp.text.Font font = new iTextSharp.text.Font(baseFont, 14, iTextSharp.text.Font.NORMAL);

                    doc.Open();
                    foreach (DataGridViewRow row in dataGridViewUser.Rows)
                    {
                        string userF = row.Cells["фамилияDataGridViewTextBoxColumn"].Value.ToString();
                        string userI = row.Cells["имяDataGridViewTextBoxColumn"].Value.ToString();
                        string userO = row.Cells["отчествоDataGridViewTextBoxColumn"].Value.ToString();
                        string userInitials = userF + " " + userI.Substring(0, 1) + "." + userO.Substring(0, 1) + ".";
                        string adress = row.Cells["адресDataGridViewTextBoxColumn"].Value.ToString();
                        string date = row.Cells["датаПоследнегоПосещенияDataGridViewTextBoxColumn"].Value.ToString().Split(' ')[0];

                        Paragraph p = new Paragraph(userInitials + "\n" + adress, font);
                        p.SpacingBefore = 20;
                        p.SpacingAfter = 40;
                        p.Alignment = 2;
                        doc.Add(p);

                        p = new Paragraph("Уважаемый(-ая), " + userI + " " + userO + "!", new iTextSharp.text.Font(baseFont, 16, iTextSharp.text.Font.BOLD));
                        p.SpacingBefore = 20;
                        p.SpacingAfter = 30;
                        p.Alignment = 1;
                        doc.Add(p);

                        string text = "Убедительно прошу Вас сообщить будете ли и впредь пользоваться услугами нашей видеотеки, поскольку в последний раз Вы посещали нас ";
                        p = new Paragraph(text + date, font);
                        p.SpacingBefore = 20;
                        p.SpacingAfter = 20;
                        p.IndentationLeft = 20;
                        p.IndentationRight = 20;
                        p.FirstLineIndent = 30;
                        p.Alignment = 0;
                        doc.Add(p);

                        p = new Paragraph("Заранее спасибо", font);
                        p.SpacingBefore = 20;
                        p.SpacingAfter = 20;
                        p.IndentationRight = 100;
                        p.Alignment = 2;
                        doc.Add(p);


                        p = new Paragraph("_______________\n", font);
                        p.Add(new Chunk("(Дата)               ", new iTextSharp.text.Font(baseFont, 10, iTextSharp.text.Font.NORMAL)));
                        p.SpacingBefore = 10;
                        p.IndentationRight = 60;
                        p.Alignment = 2;
                        doc.Add(p);

                        p = new Paragraph("_______________\n", font);
                        p.Add(new Chunk("(Подпись)            ", new iTextSharp.text.Font(baseFont, 10, iTextSharp.text.Font.NORMAL)));
                        p.SpacingBefore = 10;
                        p.IndentationRight = 60;
                        p.Alignment = 2;
                        doc.Add(p);

                        doc.NewPage();
                    }
                    doc.Close();
                    writer.Close();
                    MessageBox.Show(
                               "Письма успешно составлены! \n\n Файл сохранен по следующей директории: " + outputFile,
                               "Уведомление",
                               MessageBoxButtons.OK,
                               MessageBoxIcon.Information);
                }
                catch
                {
                    MessageBox.Show(
                        "Ошибка! \n Не удалось сохранить файл! \n Проверьте права на запись в дирректории для сохранения и попробуйте снова!",
                        "Упс! Что-то пошло не так...",
                        MessageBoxButtons.OK,
                        MessageBoxIcon.Error);
                }
            }
            dlg.Dispose();
        }
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        /*        Окно должников      */
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        private void ButtonComposeLettersDebtors_Click(object sender, EventArgs e)
        {
            историяTableAdapter.FillByDateTake(this.databaseDataSet.История, dateTimePicker2.Value);
            this.dataGridViewHistory.Sort(this.dataGridViewHistory.Columns[пользовательDataGridViewTextBoxColumn.Index], ListSortDirection.Ascending);

            if (dataGridViewHistory.Rows.Count == 0)
            {
                MessageBox.Show(
                      "Должников, взявших фильмы ранее чем " + dateTimePicker2.Value.ToString().Split(' ')[0] + " не найдено!",
                      "Уведомление",
                      MessageBoxButtons.OK,
                      MessageBoxIcon.Information);
                return;
            }

            SaveFileDialog dlg = new SaveFileDialog();
            dlg.FileName = "Письма должникам, которые брали фильмы ранее " + dateTimePicker2.Text;
            dlg.Filter = "PDF files (*.pdf)|*.pdf";
            dlg.RestoreDirectory = true;
            dlg.Title = "Сохранение файла";

            if (dlg.ShowDialog() == DialogResult.OK)
            {
                try
                {
                    string outputFile = dlg.FileName;
                    FileStream fs = new FileStream(outputFile, FileMode.Create, FileAccess.Write, FileShare.None);
                    Document doc = new Document(PageSize.A4, 25, 25, 25, 15);
                    PdfWriter writer = PdfWriter.GetInstance(doc, fs);

                    BaseFont baseFont = BaseFont.CreateFont(Path.Combine(Environment.GetFolderPath(Environment.SpecialFolder.Fonts), "ARIAL.TTF"), BaseFont.IDENTITY_H, BaseFont.NOT_EMBEDDED);
                    iTextSharp.text.Font font = new iTextSharp.text.Font(baseFont, 14, iTextSharp.text.Font.NORMAL);

                    doc.Open();

                    DataGridView dgv = dataGridViewHistory;
                    while(dgv.Rows.Count != 0)
                    {
                        Int32 userID = Int32.Parse(dgv.Rows[0].Cells["кодПользователяDataGridViewTextBoxColumn"].Value.ToString());
                        string userInitials = dgv.Rows[0].Cells["пользовательDataGridViewTextBoxColumn"].Value.ToString();
                        string date = dateTimePicker3.Text;

                        пользователиTableAdapter.FillByUserCode(this.databaseDataSet.Пользователи, userID);
                        // Говнокод во всей красе
                        string userI = dataGridViewUser.Rows[0].Cells["имяDataGridViewTextBoxColumn"].Value.ToString();
                        string userO = dataGridViewUser.Rows[0].Cells["отчествоDataGridViewTextBoxColumn"].Value.ToString();
                        string adress = dataGridViewUser.Rows[0].Cells["адресDataGridViewTextBoxColumn"].Value.ToString();


                        Paragraph p = new Paragraph(userInitials + "\n" + adress, font);
                        p.SpacingBefore = 20;
                        p.SpacingAfter = 40;
                        p.Alignment = 2;
                        doc.Add(p);

                        p = new Paragraph("Уважаемый(-ая), " + userI + " " + userO + "!", new iTextSharp.text.Font(baseFont, 16, iTextSharp.text.Font.BOLD));
                        p.SpacingBefore = 20;
                        p.SpacingAfter = 10;
                        p.Alignment = 1;
                        doc.Add(p);

                        string text = "Убедительно прошу Вас вернуть следующие фильмы до ";
                        p = new Paragraph(text + date + "г. :\n", font);
                        p.SpacingBefore = 20;
                        p.SpacingAfter = 10;
                        p.IndentationLeft = 20;
                        p.IndentationRight = 20;
                        p.FirstLineIndent = 30;
                        p.Alignment = 0;
                        doc.Add(p);

                        string tempCode = dgv.Rows[0].Cells["кодПользователяDataGridViewTextBoxColumn"].Value.ToString();

                        iTextSharp.text.List list = new iTextSharp.text.List(List.UNORDERED);
                        list.IndentationLeft = 80;
                        list.SetListSymbol("\u2022");

                        while ((dgv.Rows.Count != 0) && (tempCode == dgv.Rows[0].Cells["кодПользователяDataGridViewTextBoxColumn"].Value.ToString()))
                        {
                            DataGridViewRow row = dgv.Rows[0];
                            string filmName = row.Cells["фильмDataGridViewTextBoxColumn"].Value.ToString();
                            string filmYear = row.Cells["годВыходаDataGridViewTextBoxColumn"].Value.ToString();
                            string dateTake = row.Cells["датаВзятияDataGridViewTextBoxColumn"].Value.ToString().Split(' ')[0]; 

                            list.Add(new iTextSharp.text.ListItem("  \"" + filmName + "\" (" + filmYear + "), который Вы взяли " + dateTake + ";", font));
                            dgv.Rows.RemoveAt(0);
                        }
                        doc.Add(list);

                        p = new Paragraph("Заранее спасибо", font);
                        p.SpacingBefore = 40;
                        p.SpacingAfter = 40;
                        p.IndentationRight = 120;
                        p.Alignment = 2;
                        doc.Add(p);


                        p = new Paragraph("_______________\n", font);
                        p.Add(new Chunk("(Дата)               ", new iTextSharp.text.Font(baseFont, 10, iTextSharp.text.Font.NORMAL)));
                        p.SpacingBefore = 10;
                        p.IndentationRight = 60;
                        p.Alignment = 2;
                        doc.Add(p);

                        p = new Paragraph("_______________\n", font);
                        p.Add(new Chunk("(Подпись)            ", new iTextSharp.text.Font(baseFont, 10, iTextSharp.text.Font.NORMAL)));
                        p.SpacingBefore = 10;
                        p.IndentationRight = 60;
                        p.Alignment = 2;
                        doc.Add(p);

                        doc.NewPage();
                    }
                    
                    doc.Close();
                    writer.Close();
                    MessageBox.Show(
                               "Письма успешно составлены! \n\n Файл сохранен по следующей директории: " + outputFile,
                               "Уведомление",
                               MessageBoxButtons.OK,
                               MessageBoxIcon.Information);
                }
                catch
                {
                    MessageBox.Show(
                        "Ошибка! \n Не удалось сохранить файл! \n Проверьте права на запись в дирректории для сохранения и попробуйте снова!",
                        "Упс! Что-то пошло не так...",
                        MessageBoxButtons.OK,
                        MessageBoxIcon.Error);
                }
            }
            dlg.Dispose();
        }

        private void ButtonBackStep_Click(object sender, EventArgs e)
        {
            panelPrint.Show();
            panelLettersMissing.Hide();
            panelLettersDebtors.Hide();
        }

        private void FormMain_Load(object sender, EventArgs e)
        {
            // TODO: данная строка кода позволяет загрузить данные в таблицу "databaseDataSet.История". При необходимости она может быть перемещена или удалена.
            this.историяTableAdapter.Fill(this.databaseDataSet.История);

        }
    }
}