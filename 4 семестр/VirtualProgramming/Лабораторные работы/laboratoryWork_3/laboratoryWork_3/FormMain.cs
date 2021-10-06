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

namespace laboratoryWork_3
{
    public partial class FormMain : Form
    {
        private bool drawing;
        private GraphicsPath currentPath;
        private Point oldLocation;
        private Color currentColor;
        private Pen currentPen;

        private int historyCounter;
        private int currentRecordHistory;
        private List<Bitmap> history;
        public FormMain()
        {
            InitializeComponent();
            drawing = false;
            currentColor = Color.Black;
            currentPen = new Pen(currentColor, PenWigth_trackBar.Value);
            historyCounter = 10;
            history = new List<Bitmap>();
            currentRecordHistory = -1;
            
        }

        private void aboutToolStripMenuItem_Click(object sender, EventArgs e)
        {
             MessageBox.Show(
                 "ФИО:\t\tМироненко К.А.\nГруппа:\t\tИП-811\n\nВизуальное программирование 2019-2020 уч. год", 
                 "About",
                 MessageBoxButtons.OK, 
                 MessageBoxIcon.Information);
        }

        private void exitToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void saveToolStripMenuItem_Click(object sender, EventArgs e)
        {
            SaveFileDialog dlg = new SaveFileDialog();
            dlg.Filter = "Точечные рисунки (*.bmp; *.dib)|*.bmp; *.dib|JPEG (*.jpg; *.jpeg)|*.jpg; *.jpeg|PNG (*.png)|*.png|ICO (*.ico)|*.ico|Все файлы|*.*";
            dlg.FilterIndex = 2;
            dlg.RestoreDirectory = true;
            dlg.Title = "Сохранить изображение как...";

            if (dlg.ShowDialog() == DialogResult.OK)
            {
                try
                {
                    paintBox.Image.Save(dlg.FileName);
                }
                catch
                {
                    MessageBox.Show(
                        "Ошибка! \n Не удалось сохранить файл! \n Проверьте права на запись в дирректории для сохранения", 
                        "Упс! Что-то пошло не так...", 
                        MessageBoxButtons.OK, 
                        MessageBoxIcon.Error);
                }
            }
            dlg.Dispose();
        }

        private void openToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (paintBox.Image != null)
            {
                var result = MessageBox.Show(
                    "Сохранить текущее изображение перед открытием нового изображения?", 
                    "Предупреждение", 
                    MessageBoxButtons.YesNoCancel,
                    MessageBoxIcon.Warning);
                switch (result)
                {
                    case DialogResult.No: break;
                    case DialogResult.Yes:
                        saveToolStripMenuItem_Click(sender, e);
                        history.Clear();
                        currentRecordHistory = -1;
                        break;
                    case DialogResult.Cancel: return;
                } 
            }
            OpenFileDialog dlg = new OpenFileDialog();
            dlg.Filter = "Точечные рисунки (*.bmp; *.dib)|*.bmp; *.dib|JPEG (*.jpg; *.jpeg)|*.jpg; *.jpeg|PNG (*.png)|*.png|ICO (*.ico)|*.ico|Все файлы|*.*";
            dlg.FilterIndex = 2;
            dlg.RestoreDirectory = true;
            
            dlg.Title = "Открыть изображение...";
            
            if (dlg.ShowDialog() == DialogResult.OK)
            {
                try
                {
                    paintBox.Image = new Bitmap(dlg.FileName);
                }
                catch
                {
                    MessageBox.Show(
                        "Ошибка! \n Не удалось открыть файл! \n Возможно файл не является изображением!", 
                        "Упс! Что-то пошло не так...", 
                        MessageBoxButtons.OK, 
                        MessageBoxIcon.Error);
                }
            }
            dlg.Dispose();
            addRecordHistory();
        }


        private void newToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (paintBox.Image != null)
            {
                var result = MessageBox.Show(
                    "Сохранить текущее изображение перед созданием нового рисунка?", 
                    "Предупреждение", 
                    MessageBoxButtons.YesNoCancel,
                    MessageBoxIcon.Warning);
                switch (result)
                {
                    case DialogResult.No: break;
                    case DialogResult.Yes:
                        saveToolStripMenuItem_Click(sender, e);
                        history.Clear();
                        currentRecordHistory = -1;
                        break;
                    case DialogResult.Cancel: return;
                } 
            }
            
            paintBox.Size= new Size(flowLayoutPanel.Size.Width-6,flowLayoutPanel.Size.Height-6);
            var image = new Bitmap(flowLayoutPanel.Size.Width-6,flowLayoutPanel.Size.Height-6);
            paintBox.Image = image;
            var g = Graphics.FromImage(paintBox.Image);
            g.Clear(Color.White);
            g.Dispose();
            paintBox.Invalidate(); 
            addRecordHistory();
        }

        private void colorToolStripMenuItem_Click(object sender, EventArgs e)
        {
            ColorDialog dlg = new ColorDialog();
            if (dlg.ShowDialog() == DialogResult.OK)
            {
                currentColor = dlg.Color;
                currentPen.Color = currentColor;
            }
            dlg.Dispose();
        }
        
        private void ownColorToolStripMenuItem_Click(object sender, EventArgs e)
        {
            FormColorSelection dlg = new FormColorSelection();
            dlg.Owner = this;
            if (dlg.ShowDialog() == DialogResult.OK)
            {
                currentColor = dlg.Color;
                currentPen.Color = currentColor;
            }
        }
        private void paintBox_MouseDown(object sender, MouseEventArgs e)
        {
            if (e.Button == MouseButtons.Left)
            {
                drawing = true;
                oldLocation = e.Location;
                currentPath = new GraphicsPath();
            }
            if (e.Button == MouseButtons.Right)
            {
                drawing = true;
                currentPen.Color = Color.White;    
                oldLocation = e.Location;
                currentPath = new GraphicsPath();
            }
        }

        private void paintBox_MouseUp(object sender, MouseEventArgs e)
        {
            
            addRecordHistory();
            drawing = false;
            try
            {
                currentPath.Dispose();
            }
            catch { };
            currentPen.Color = currentColor;

        }

        private void paintBox_MouseMove(object sender, MouseEventArgs e)
        {
            if (drawing)
            {
                Graphics g = Graphics.FromImage(paintBox.Image);
                currentPath.AddLine(oldLocation, e.Location);
                g.DrawPath(currentPen, currentPath);
                oldLocation = e.Location;
                g.Dispose();
                paintBox.Invalidate();
            }
            MousePosition_textBox.Text = "X: " + e.X.ToString() + "  Y: " + e.Y.ToString();
        }

        private void PenWigth_trackBar_Scroll(object sender, EventArgs e)
        {
            currentPen.Width = PenWigth_trackBar.Value;
        }
        
        private void addRecordHistory()
        {
            try
            {
                history.RemoveRange(currentRecordHistory + 1, history.Count - currentRecordHistory - 1); 
            }
            catch{ }
                
            history.Add(new Bitmap(paintBox.Image));
            if (currentRecordHistory + 1 < historyCounter)
                currentRecordHistory += 1;
            
            if (history.Count() > historyCounter + 1)
            {
                history.RemoveAt(0);
            }

        }

        private void undoToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (currentRecordHistory > 0)
            {
                currentRecordHistory -= 1;
                paintBox.Image = new Bitmap(history[currentRecordHistory]);
            }
            else MessageBox.Show(
                "История пуста | Идти больше некуда",
                "Вселенная схлопнулась (×﹏×) ", 
                MessageBoxButtons.OK, 
                MessageBoxIcon.Asterisk);
        }

        private void reToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (currentRecordHistory < history.Count - 1)
            {
                paintBox.Image = new Bitmap(history[currentRecordHistory + 1]);
                currentRecordHistory += 1;
            }
            else MessageBox.Show(
               "Попытка заглянуть в будущее или давно забытое прошлое не удалась :с",
               "Временной партуль. Астанавитес (‡▼益▼)", 
               MessageBoxButtons.OK, 
               MessageBoxIcon.Asterisk);

        }

        private void solidToolStripMenuItem_Click(object sender, EventArgs e)
        {
            currentPen.DashStyle = DashStyle.Solid;
            solidToolStripMenuItem.Checked = true;
            dotToolStripMenuItem.Checked = false;
            dashDotDotToolStripMenuItem.Checked = false;
        }

        private void dotToolStripMenuItem_Click(object sender, EventArgs e)
        {
            currentPen.DashStyle = DashStyle.Dot;
            solidToolStripMenuItem.Checked = false;
            dotToolStripMenuItem.Checked = true;
            dashDotDotToolStripMenuItem.Checked = false;
        }

        private void dashDotDotToolStripMenuItem_Click(object sender, EventArgs e)
        {
            currentPen.DashStyle = DashStyle.DashDotDot;
            solidToolStripMenuItem.Checked = false;
            dotToolStripMenuItem.Checked = false;
            dashDotDotToolStripMenuItem.Checked = true;
        }
    
        public Color GetCurrentColor
        {
            get { return currentColor; }
        }

     
    }
}