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
    public partial class FormHistoryUser : Form
    {
        public FormHistoryUser()
        {
            InitializeComponent();
        }
        private void FormHistoryUser_Load(object sender, EventArgs e)
        {
            пользователиTableAdapter.Fill(databaseDataSet.Пользователи);

            panelHistory.Dock = System.Windows.Forms.DockStyle.Fill;
            panelUser.Dock = System.Windows.Forms.DockStyle.Fill;

            dataGridViewUser.Sort(dataGridViewUser.Columns[фамилияDataGridViewTextBoxColumn.Index], ListSortDirection.Ascending);
            dataGridViewHistory.Sort(dataGridViewHistory.Columns[датаВзятияDataGridViewTextBoxColumn.Index], ListSortDirection.Ascending);
        }

        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */
        /*     Окно пользователей     */
        /* ~~~~~~~~~~~~~~~~~~~~~~~~~~ */

        // Поиск пользователя
        private void ButtonSearchUser_Click(object sender, EventArgs e)
        {
            пользователиTableAdapter.FillByFIO(databaseDataSet.Пользователи, textBoxSearchUserF.Text, textBoxSearchUserI.Text, textBoxSearchUserO.Text);
        }

        // Сброс поиска
        private void ButtonResetSearchUser_Click(object sender, EventArgs e)
        {
            пользователиTableAdapter.Fill(databaseDataSet.Пользователи);
            textBoxSearchUserF.Text = null;
            textBoxSearchUserI.Text = null;
            textBoxSearchUserO.Text = null;
        }

        // Убирает выделение строк 
        private void DataGridViewUser_SelectionChanged(object sender, EventArgs e)
        {
            dataGridViewUser.ClearSelection();
        }

        private void DataGridViewUser_CellDoubleClick(object sender, DataGridViewCellEventArgs e)
        {
            int codeUser = Convert.ToInt32(dataGridViewUser.CurrentRow.Cells["кодПользователяDataGridViewTextBoxColumn"].Value.ToString());
            string user = dataGridViewUser.CurrentRow.Cells["фамилияDataGridViewTextBoxColumn"].Value.ToString() + " " + dataGridViewUser.CurrentRow.Cells["имяDataGridViewTextBoxColumn"].Value.ToString().Substring(0, 1) + "." + dataGridViewUser.CurrentRow.Cells["отчествоDataGridViewTextBoxColumn"].Value.ToString().Substring(0, 1) + ".";
            историяTableAdapter.FillByUserCode(databaseDataSet.История, codeUser);
            if (dataGridViewHistory.Rows.Count == 0)
            {
                MessageBox.Show(
                      "Пользователь \"" + user + "\" пока не брал фильмов!",
                      "Уведомление",
                      MessageBoxButtons.OK,
                      MessageBoxIcon.Information);
                return;
            }

            labelUser.Text = "Пользователь: " + user;
            panelUser.Hide();
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
            dataGridViewHistory.ClearSelection();
        }

        private void ButtonPrint_Click(object sender, EventArgs e)
        {
            this.dataGridViewHistory.Sort(this.dataGridViewHistory.Columns[датаВзятияDataGridViewTextBoxColumn.Index], ListSortDirection.Ascending);
            string user = dataGridViewUser.CurrentRow.Cells["фамилияDataGridViewTextBoxColumn"].Value.ToString() + " " + dataGridViewUser.CurrentRow.Cells["имяDataGridViewTextBoxColumn"].Value.ToString().Substring(0, 1) + "." + dataGridViewUser.CurrentRow.Cells["отчествоDataGridViewTextBoxColumn"].Value.ToString().Substring(0, 1) + ".";

            SaveFileDialog dlg = new SaveFileDialog();
            dlg.FileName = "История пользователя " + user +" " + DateTime.Now.ToShortDateString();
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

                    Paragraph p = new Paragraph("История пользователя \"" +user + "\"", new iTextSharp.text.Font(baseFont, 16, iTextSharp.text.Font.BOLD));
                    p.SpacingBefore = 20;
                    p.SpacingAfter = 20;
                    p.Alignment = 1;
                    doc.Add(p);
                    if (dataGridViewHistory.Rows.Count == 0)
                    {
                        string text = "История пользователя пуста";
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
                        for(int i =0; i < dgv.Rows.Count; i++)
                        {
                            string filmName = dgv.Rows[i].Cells["фильмDataGridViewTextBoxColumn"].Value.ToString();
                            string filmCountry = dgv.Rows[i].Cells["странаDataGridViewTextBoxColumn"].Value.ToString();
                            string filmProducer = dgv.Rows[i].Cells["режиссерDataGridViewTextBoxColumn"].Value.ToString();
                            string filmYear = dgv.Rows[i].Cells["годВыходаDataGridViewTextBoxColumn"].Value.ToString();
                            string dateTake = dgv.Rows[i].Cells["датаВзятияDataGridViewTextBoxColumn"].Value.ToString().Split(' ')[0];
                            string dateReturn = dgv.Rows[i].Cells["датаВозвратаDataGridViewTextBoxColumn"].Value.ToString().Split(' ')[0];

                            listMain.Add(new iTextSharp.text.ListItem("  \"" + filmName + "\":", font));


                            iTextSharp.text.List list = new iTextSharp.text.List(List.UNORDERED);
                            list.IndentationLeft = 30;
                            list.SetListSymbol("\u2012"); 
                            list.Add(new iTextSharp.text.ListItem("  Дата взятия: " + dateTake, font));
                            list.Add(new iTextSharp.text.ListItem("  Дата возврата: " + dateReturn, font));
                            list.Add(new iTextSharp.text.ListItem("  Год выхода: " + filmYear, font));
                            list.Add(new iTextSharp.text.ListItem("  Страна: " + filmCountry, font));
                            list.Add(new iTextSharp.text.ListItem("  Режиссер: " + filmProducer, font));
                            

                            listMain.Add(list);
                        }
                        doc.Add(listMain);
                    }

                    doc.Close();
                    writer.Close();
                    историяTableAdapter.FillByAbsent(this.databaseDataSet.История);
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
            panelUser.Show();
        }
    }
}
