using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Windows.Forms;

namespace laboratoryWork_2
{
    public partial class FormMain : Form
    {
        public FormMain()
        {
            InitializeComponent();
        }
        /* <MENU> */
        private void openToolStripMenuItem_Click(object sender, EventArgs e)
        {
            OpenFileDialog openDlg = new OpenFileDialog();
            if (openDlg.ShowDialog() == DialogResult.OK)
            {
                StreamReader reader = new StreamReader(openDlg.FileName, Encoding.Default); 
                textWorkSpace.Text = reader.ReadToEnd(); 
                reader.Close(); 
            }
            openDlg.Dispose(); 

        }
        
        private void saveToolStripMenuItem_Click(object sender, EventArgs e)
        {
            SaveFileDialog saveDlg = new SaveFileDialog();
            if (saveDlg.ShowDialog() == DialogResult.OK)
            {
                StreamWriter writer = new StreamWriter(saveDlg.FileName);
                foreach (var item in listBoxSection2.Items)
                    writer.WriteLine((string) item);
                writer.Close(); 
            }
            saveDlg.Dispose();
        }
        
        private void exitToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }
        
        private void aboutStripMenuItem_Click(object sender, EventArgs e)
        {
            MessageBox.Show(
                        "ФИО:\t\tМироненко К.А.\nГруппа:\t\tИП-811\n\nВизуальное программирование 2019-2020 уч. год", 
                     "About",
                             MessageBoxButtons.OK, 
                             MessageBoxIcon.Information);
        }
        /* < / MENU> */
        
        /* <SECTION 1> */
        private void buttonClearSection1_Click(object sender, EventArgs e)
        {
            listBoxSection1.Items.Clear();
        }
        
        private void comboBoxSection1_SelectedIndexChanged(object sender, EventArgs e)
        {
            buttonSortSection1.Enabled = comboBoxSection1.SelectedIndex != -1;
        }
        
        private void buttonSortSection1_Click(object sender, EventArgs e)
        {
            string[] arr = new string[listBoxSection1.Items.Count];
            for (int i = 0; i < listBoxSection1.Items.Count; i++)
                arr[i] = listBoxSection1.Items[i].ToString();

            IEnumerable<string> res = arr.OrderBy(x => x);
            switch (comboBoxSection1.SelectedIndex)
            {
                case 0 :
                    break;
                case 1 :
                    res = res.Reverse();
                    break;
                case 2 :
                    res = arr.OrderBy(x => (x.Length, x));
                    break;
                case 3 :
                    res = arr.OrderBy(x => (x.Length, x)).Reverse();
                    break;
            }
            listBoxSection1.Items.Clear();
            listBoxSection1.BeginUpdate();
            foreach (var text in res)
                listBoxSection1.Items.Add(text);
            listBoxSection1.EndUpdate();
        }
        /* < / SECTION 1> */
        
        /* <SECTION 2> */
        private void buttonClearSection2_Click(object sender, EventArgs e)
        {
            listBoxSection2.Items.Clear();
        }
        
        private void comboBoxSection2_SelectedIndexChanged(object sender, EventArgs e)
        {
            buttonSortSection2.Enabled = comboBoxSection2.SelectedIndex != -1;
        }
        
        private void buttonSortSection2_Click(object sender, EventArgs e)
        {
            string[] arr = new string[listBoxSection2.Items.Count];
            for (int i = 0; i < listBoxSection2.Items.Count; i++)
                arr[i] = listBoxSection2.Items[i].ToString();

            IEnumerable<string> res = arr.OrderBy(x => x);
            switch (comboBoxSection2.SelectedIndex)
            {
                case 0 :
                    break;
                case 1 :
                    res = res.Reverse();
                    break;
                case 2 :
                    res = arr.OrderBy(x => (x.Length, x));
                    break;
                case 3 :
                    res = arr.OrderBy(x => (x.Length, x)).Reverse();
                    break;
            }
            listBoxSection2.Items.Clear();
            listBoxSection2.BeginUpdate();
            foreach (var text in res)
                listBoxSection2.Items.Add(text);
            listBoxSection2.EndUpdate();
        }
        /* < / SECTION 2> */
        
        /* <BUTTONS SECTION> */
        private void buttonRightMove_Click(object sender, EventArgs e)
        {
            listBoxSection2.BeginUpdate();
            foreach (object item in listBoxSection1.SelectedItems)
                listBoxSection2.Items.Add(item);
            listBoxSection2.EndUpdate();
            delSelectedStrings(listBoxSection1);

        }

        private void buttonLeftMove_Click(object sender, EventArgs e)
        {
            listBoxSection1.BeginUpdate();
            foreach (object item in listBoxSection2.SelectedItems)
                listBoxSection1.Items.Add(item);
            listBoxSection1.EndUpdate();
            delSelectedStrings(listBoxSection2);
        }

        private void buttonRightAllMove_Click(object sender, EventArgs e)
        {
            listBoxSection1.BeginUpdate();
            listBoxSection2.BeginUpdate();
            listBoxSection2.Items.AddRange(listBoxSection1.Items);
            listBoxSection1.Items.Clear();
            listBoxSection1.EndUpdate();
            listBoxSection2.EndUpdate();
        }

        private void buttonLeftAllMove_Click(object sender, EventArgs e)
        {
            listBoxSection1.BeginUpdate();
            listBoxSection2.BeginUpdate();
            listBoxSection1.Items.AddRange(listBoxSection2.Items);
            listBoxSection2.Items.Clear();
            listBoxSection1.EndUpdate();
            listBoxSection2.EndUpdate();
        }
        
        public void addWordInSection(int section, string str)
        {
            switch (section)
            {
               case 1:
                   listBoxSection1.Items.Add(str);
                   break;
               case 2:
                   listBoxSection2.Items.Add(str);
                   break;
            }
        }
        private void buttonAdd_Click(object sender, EventArgs e)
        {
            FormAdd addForm = new FormAdd();
            addForm.Owner = this;
            addForm.ShowDialog();

        }

        private void delSelectedStrings(ListBox list)
        {
            list.BeginUpdate();
            for (int i = list.Items.Count - 1; i > -1; i--)
                if (list.GetSelected(i)) 
                    list.Items.RemoveAt(i);
            list.EndUpdate();
        }
        private void buttonDel_Click(object sender, EventArgs e)
        {
            delSelectedStrings(listBoxSection1);
            delSelectedStrings(listBoxSection2);
           
        }
        /* < / BUTTONS SECTION> */
        
        /* <SEARCH SECTION> */
            private void buttonSearch_Click(object sender, EventArgs e)
        {
            listBoxSearch.Items.Clear();

            string find = textBoxWord.Text;

            if (checkSection1.Checked)
            {
                foreach (string s in listBoxSection1.Items)
                {
                    if (s.Contains(find)) listBoxSearch.Items.Add(s);      
                }
            }

            if (checkSection2.Checked)
            {
                foreach (string s in listBoxSection2.Items)
                {
                    if (s.Contains(find)) listBoxSearch.Items.Add(s);
                }
            }

        }
        /* < / SEARCH SECTION> */
        
        /* <WORD SELECTION SECTION> */
        private void textBoxWord_TextChanged(object sender, EventArgs e)
        {
            buttonSearch.Enabled = textBoxWord.Text != "";
        }
        
        private void buttonStart_Click(object sender, EventArgs e)
        {
            listBoxSection1.Items.Clear();
            listBoxSection2.Items.Clear();
            listBoxSearch.Items.Clear();
            labelSearch.Text = "";
            listBoxSection1.BeginUpdate();
            
            string[] strings = textWorkSpace.Text.Split(new char[] { '\n', '\t', ' ' }, StringSplitOptions.RemoveEmptyEntries);

            foreach (string s in strings)
            {
                string str = s.Trim(); // .Trim(new char[] { ',', ';', '.', '!', '?', ':', '"', '\'' })
                
                if (str == String.Empty) continue;
                if (radioChoiceAll.Checked) 
                    listBoxSection1.Items.Add(str);
                if (radioChoiceNumbers.Checked)
                    if (Regex.IsMatch(str, @"\d")) 
                        listBoxSection1.Items.Add(str);
                if (radioChoiceEmail.Checked)
                    if (Regex.IsMatch(str, @"\w+@\w+\.\w+"))
                        listBoxSection1.Items.Add(str);
            }
            listBoxSection1.EndUpdate();
        }
        /* < / WORD SELECTION SECTION> */
        
        private void buttonReset_Click(object sender, EventArgs e)
        {
            listBoxSection1.Items.Clear();
            comboBoxSection1.SelectedIndex = -1;
            listBoxSection2.Items.Clear();
            comboBoxSection2.SelectedIndex = -1;
            listBoxSearch.Items.Clear();
            textWorkSpace.Clear();
            textBoxWord.Clear();
            checkSection1.Checked = true;
            checkSection2.Checked = false;
            radioChoiceAll.Checked = true;
        }
        
        private void buttonClose_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }
        

        private void textWorkSpace_TextChanged(object sender, EventArgs e)
        {
            buttonStart.Enabled = textWorkSpace.Text != "";
        }

    }
}