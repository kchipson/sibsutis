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

namespace laboratoryWork_4
{
    public partial class FormMain : Form
    {
        public FormMain()
        {
            InitializeComponent();
        }
        
        private void FormMain_Load(object sender, EventArgs e)
        {
            type_comboBox.SelectedIndex = 0;
            type_comboBox_SelectionChangeCommitted(null, null);
            driveListBox.SelectedIndex = 0;
            driveListBox_SelectionChangeCommitted(null, null);
        }
        
        private void driveListBox_SelectionChangeCommitted(object sender, EventArgs e)
        {
            try
            {
                dirListBox.Path = driveListBox.Drive.Substring(0,1).ToUpper() +":\\";
                dirListBox.SelectedIndex = 0;
                dirListBox_MouseDoubleClick(null, null);
                
            }
            catch (System.Exception ex)
            {
                System.Windows.Forms.MessageBox.Show(ex.Message);
            }
        }

        private void dirListBox_MouseDoubleClick(object sender, MouseEventArgs e)
        {
            fileListBox.Path = dirListBox.Path;
            try
            {
                fileListBox.SelectedIndex = 0;
            }
            catch { }
            path_label.Text = dirListBox.Path;
        }


        private void type_comboBox_SelectionChangeCommitted(object sender, EventArgs e)
        {
            try
            {
                if (type_comboBox.Text == type_comboBox.Items[0].ToString())
                {
                    fileListBox.Pattern = "*.*";
                }
                else if (type_comboBox.Text == type_comboBox.Items[1].ToString())
                {
                    fileListBox.Pattern = "*.jpg";
                }
                else if (type_comboBox.Text == type_comboBox.Items[2].ToString())
                {
                    fileListBox.Pattern = "*.bmp";
                }
                else if (type_comboBox.Text == type_comboBox.Items[3].ToString())
                {
                    fileListBox.Pattern = "*.gif";
                }
                else if (type_comboBox.Text == type_comboBox.Items[4].ToString())
                {
                    fileListBox.Pattern = "*.png";
                }
            }
            catch (System.Exception ex)
            {
                System.Windows.Forms.MessageBox.Show(ex.Message);
            }
        }
        private void fileListBox_SelectedValueChanged(object sender, EventArgs e)
        {
            if (fileListBox.SelectedItem.ToString() != "")
            {
                double size;
                FileInfo file = new FileInfo((fileListBox.Path + "\\" + fileListBox.SelectedItem));
                size = file.Length / 1024;
                file_label.Text = fileListBox.SelectedItem + "  |  " + size + " Kbytes";
                pictureBox.SizeMode = PictureBoxSizeMode.StretchImage;
                Image img;
                try
                {
                    img = Image.FromFile(file.ToString());
                }
                catch
                {
                    img = Properties.Resources.no;
                }
                pictureBox.Image = img;
            }
            else
            {
                pictureBox.Image = null;
            }
                
        }

        private void timer_Tick(object sender, EventArgs e)
        {
            DateTime time = DateTime.Now;
            time_label.Text = "Время :  " + time.ToLongTimeString();
        }

        private void checkBox1_CheckedChanged(object sender, EventArgs e)
        {
            timer.Enabled = !timer.Enabled;
            if (!timer.Enabled)
            {
                time_label.Text = "Время :  none";
            }
        }
    }
}