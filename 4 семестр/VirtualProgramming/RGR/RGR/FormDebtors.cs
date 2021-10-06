using System;
using System.Collections;
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
    public partial class FormDebtors : Form
    {
        public FormDebtors()
        {
            InitializeComponent();
        }

  
        private void FormDebtors_Load(object sender, EventArgs e)
        {
            историяTableAdapter.FillByAbsent(this.databaseDataSet.История);

            this.panelHistory.Dock = System.Windows.Forms.DockStyle.Fill;

            this.dataGridViewHistory.Sort(this.dataGridViewHistory.Columns[пользовательDataGridViewTextBoxColumn.Index], ListSortDirection.Ascending);
            //// TODO: Говнокод во всей красе
            //DataGridView dgv = dataGridViewHistory;
            //for (int intI = 0; intI < dgv.Rows.Count; intI++)
            //{
            //    dgv.Rows[intI].Cells[3].Value = dgv.Rows[intI].Cells[4].Value.ToString().Substring(0, 10);
            //    for (int intJ = intI + 1; intJ < dgv.RowCount; intJ++)
            //    {
            //        if (dgv.Rows[intJ].Cells[0].Value.ToString() == dgv.Rows[intI].Cells[0].Value.ToString())
            //        {
            //            dgv.Rows[intI].Cells["фильмDataGridViewTextBoxColumn"].Value += "\n\n" + dgv.Rows[intJ].Cells["фильмDataGridViewTextBoxColumn"].Value; // Объединяем названия
            //            dgv.Rows[intI].Cells[2].Value += "\n\n" + dgv.Rows[intJ].Cells[2].Value; // Объединяем года
            //            dgv.Rows[intI].Cells[3].Value += "\n\n" + dgv.Rows[intJ].Cells[4].Value.ToString().Substring(0, 10); // Объединяем дату в другом поле, тк типы
            //            dgv.Rows.RemoveAt(intJ);
            //            intJ--;
            //        }
            //    }
            //}
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
            this.dataGridViewHistory.Sort(this.dataGridViewHistory.Columns[пользовательDataGridViewTextBoxColumn.Index], ListSortDirection.Ascending);

            SaveFileDialog dlg = new SaveFileDialog();
            dlg.FileName = "Должники " + DateTime.Now.ToShortDateString();
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

                    Paragraph p = new Paragraph("Список должников | " + DateTime.Now.ToShortDateString(), new iTextSharp.text.Font(baseFont, 16, iTextSharp.text.Font.BOLD));
                    p.SpacingBefore = 20;
                    p.SpacingAfter = 20;
                    p.Alignment = 1;
                    doc.Add(p);
                    if (dataGridViewHistory.Rows.Count == 0)
                    {
                        string text = "Должники отсутствуют";
                        p = new Paragraph(text, new iTextSharp.text.Font(baseFont, 14, iTextSharp.text.Font.BOLD));
                        p.SpacingBefore = 20;
                        p.IndentationLeft = 20;
                        p.IndentationRight = 20;
                        p.Alignment = 0;
                        doc.Add(p);
                    }
                    else
                    {
                        string text = "Список должников по состоянию на " + DateTime.Now.ToShortDateString() + ":";
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
                        while (dgv.Rows.Count != 0)
                        {
                            Int32 userID = Int32.Parse(dgv.Rows[0].Cells["кодПользователяDataGridViewTextBoxColumn"].Value.ToString());
                            string userInitials = dgv.Rows[0].Cells["пользовательDataGridViewTextBoxColumn"].Value.ToString();

                            listMain.Add(new iTextSharp.text.ListItem("  " + userInitials+":", font));



                            string tempCode = dgv.Rows[0].Cells["кодПользователяDataGridViewTextBoxColumn"].Value.ToString();

                            iTextSharp.text.List list = new iTextSharp.text.List(List.UNORDERED);
                            list.IndentationLeft = 30;
                            list.SetListSymbol("\u2012");
                            

                            while ((dgv.Rows.Count != 0) && (tempCode == dgv.Rows[0].Cells["кодПользователяDataGridViewTextBoxColumn"].Value.ToString()))
                            {
                                DataGridViewRow row = dgv.Rows[0];
                                string filmName = row.Cells["фильмDataGridViewTextBoxColumn"].Value.ToString();
                                string filmYear = row.Cells["годВыходаDataGridViewTextBoxColumn"].Value.ToString();
                                string dateTake = row.Cells["датаВзятияDataGridViewTextBoxColumn"].Value.ToString().Split(' ')[0];

                                list.Add(new iTextSharp.text.ListItem("  \"" + filmName + "\" (" + filmYear + "); дата взятия: " + dateTake + ";", font));
                                dgv.Rows.RemoveAt(0);
                            }
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
        private void BtnBack_Click(object sender, EventArgs e)
        {
            Close();
        }
    }
}
