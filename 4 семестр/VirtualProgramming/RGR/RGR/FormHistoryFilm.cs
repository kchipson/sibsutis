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
    public partial class FormHistoryFilm : Form
    {
        public FormHistoryFilm()
        {
            InitializeComponent();
        }

        private void FormHistoryFilm_Load(object sender, EventArgs e)
        {
            this.фильмыTableAdapter.Fill(this.databaseDataSet.Фильмы);

            this.panelHistory.Dock = System.Windows.Forms.DockStyle.Fill;
            this.panelFilm.Dock = System.Windows.Forms.DockStyle.Fill;

            this.dataGridViewFilm.Sort(this.dataGridViewFilm.Columns[названиеDataGridViewTextBoxColumn.Index], ListSortDirection.Ascending);
            this.dataGridViewHistory.Sort(this.dataGridViewHistory.Columns[датаВзятияDataGridViewTextBoxColumn.Index], ListSortDirection.Ascending);

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

        // Убирает выделение строк 
        private void DataGridViewUser_SelectionChanged(object sender, EventArgs e)
        {
            this.dataGridViewFilm.ClearSelection();
        }

        private void DataGridViewUser_CellDoubleClick(object sender, DataGridViewCellEventArgs e)
        {
            
            int codeFilm = Convert.ToInt32(dataGridViewFilm.CurrentRow.Cells["кодЗаписиDataGridViewTextBoxColumn"].Value.ToString());
            string nameFilm = dataGridViewFilm.CurrentRow.Cells["названиеDataGridViewTextBoxColumn"].Value.ToString();
            историяTableAdapter.FillByFilmCode(this.databaseDataSet.История, codeFilm);
            /*
            if (dataGridViewHistory.Rows.Count == 0)
            {
                MessageBox.Show(
                      "Фильм \"" + nameFilm + "\" пока никто не брал!",
                      "Уведомление",
                      MessageBoxButtons.OK,
                      MessageBoxIcon.Information);
                return;
            }*/

            labelUser.Text = "Фильм: " + nameFilm;
            

            panelFilm.Hide();
            panelHistory.Show();
        }

        private void BtnBack_Click(object sender, EventArgs e)
        {
            Close();
        }

        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        /*        Окно истории        */
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        private void DataGridViewHistory_SelectionChanged(object sender, EventArgs e)
        {
            this.dataGridViewHistory.ClearSelection();
        }

        private void ButtonPrint_Click(object sender, EventArgs e)
        {
            this.dataGridViewHistory.Sort(this.dataGridViewHistory.Columns[датаВзятияDataGridViewTextBoxColumn.Index], ListSortDirection.Ascending);
            string filmName = dataGridViewFilm.CurrentRow.Cells["названиеDataGridViewTextBoxColumn"].Value.ToString();

            SaveFileDialog dlg = new SaveFileDialog();
            dlg.FileName = "История фильма " + filmName + " " + DateTime.Now.ToShortDateString();
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

                    Paragraph p = new Paragraph("История фильма \"" + filmName + "\"", new iTextSharp.text.Font(baseFont, 16, iTextSharp.text.Font.BOLD));
                    p.SpacingBefore = 20;
                    p.SpacingAfter = 20;
                    p.Alignment = 1;
                    doc.Add(p);
                    if (dataGridViewHistory.Rows.Count == 0)
                    {
                        string text = "История выдачи фильма пуста";
                        p = new Paragraph(text, new iTextSharp.text.Font(baseFont, 14, iTextSharp.text.Font.BOLD));
                        p.SpacingBefore = 20;
                        p.IndentationLeft = 20;
                        p.IndentationRight = 20;
                        p.Alignment = 0;
                        doc.Add(p);
                    }
                    else
                    {
                        string text = "История по состоянию на " + DateTime.Now.ToShortDateString() + ":";
                        p = new Paragraph(text, new iTextSharp.text.Font(baseFont, 14, iTextSharp.text.Font.BOLD));
                        p.SpacingBefore = 20;
                        p.SpacingAfter = 10;
                        p.IndentationLeft = 20;
                        p.Alignment = 0;
                        doc.Add(p);

                        iTextSharp.text.List listMain = new iTextSharp.text.List(List.UNORDERED);
                        listMain.IndentationLeft = 30;
                        listMain.SetListSymbol("\u2022");
                        DataGridView dgv = dataGridViewHistory;
                        for (int i = 0; i < dgv.Rows.Count; i++)
                        {
                            string user = dgv.Rows[i].Cells["пользовательDataGridViewTextBoxColumn"].Value.ToString();
                            string dateTake = dgv.Rows[i].Cells["датаВзятияDataGridViewTextBoxColumn"].Value.ToString().Split(' ')[0];
                            string dateReturn = dgv.Rows[i].Cells["датаВозвратаDataGridViewTextBoxColumn"].Value.ToString().Split(' ')[0];

                            listMain.Add(new iTextSharp.text.ListItem("  \"" + user + "\":", font));

                            iTextSharp.text.List list = new iTextSharp.text.List(List.UNORDERED);
                            list.IndentationLeft = 30;
                            list.SetListSymbol("\u2012");
                            list.Add(new iTextSharp.text.ListItem("  Дата взятия: " + dateTake, font));
                            list.Add(new iTextSharp.text.ListItem("  Дата возврата: " + dateReturn, font));
                            listMain.Add(list);
                        }
                        doc.Add(listMain);
                    }

                    doc.Close();
                    writer.Close();
                    MessageBox.Show(
                               "Документ успешно создан! \n\n Файл сохранен по следующей директории: " + outputFile,
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

        private void BtnBackStep_Click(object sender, EventArgs e)
        {
            panelHistory.Hide();
            panelFilm.Show();
        }
    }
}
