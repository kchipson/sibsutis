using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace rgz
{
    public partial class Form1 : Form
    {
        ADT_Control<TFrac, TEditor> fracController;

        const string operation_signs = "+-/*";
        bool fracMode = true;
        string memmory_buffer = string.Empty;

        public Form1()
        {
            fracController = new ADT_Control<TFrac, TEditor>();
            InitializeComponent();
        }

        private string NumberBeautifier(string v)
        {
            if (v == "ERROR")
                return v;
            string toReturn = v;
            if (fracMode == true)
                toReturn = v;
            else if (new TFrac(v).getDenominatorNum() == 1)
                toReturn = new TFrac(v).getNumeratorString();

            return toReturn;
        }

        private void CopyToolStripMenuItem_Click(object sender, EventArgs e)
        {
            memmory_buffer = textBox1.Text;

        }

        private void EnterToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (memmory_buffer == string.Empty)
            {
                MessageBox.Show("Буфер обмена пуст.\n" +
                    "Нечего вставить.",
                    "Ошибка",
                    MessageBoxButtons.OK,
                    MessageBoxIcon.Exclamation);
                return;
            }
            foreach (char i in memmory_buffer)
                textBox1.Text = fracController.ExecComandEditor(CharToEditorCommand(i));
        }

        private static int CharToEditorCommand(char ch)
        {
            int command = 66;
            switch (ch)
            {
                case '0':
                    command = 0;
                    break;
                case '1':
                    command = 1;
                    break;
                case '2':
                    command = 2;
                    break;
                case '3':
                    command = 3;
                    break;
                case '4':
                    command = 4;
                    break;
                case '5':
                    command = 5;
                    break;
                case '6':
                    command = 6;
                    break;
                case '7':
                    command = 7;
                    break;
                case '8':
                    command = 8;
                    break;
                case '9':
                    command = 9;
                    break;
                case '.':
                    command = 10;
                    break;
                case '-':
                    command = 11;
                    break;
            }

            return command;
        }
        private static int CharToOperationsCommand<T>(char ch) where T : TFrac, new()
        {
            int command = 0;
            switch (ch)
            {
                case '+':
                    command = 1;
                    break;
                case '-':
                    command = 2;
                    break;
                case '*':
                    command = 3;
                    break;
                case '/':
                    command = 4;
                    break;
            }

            return command;
        }

        private static int KeyCodeToEditorCommand(Keys ch)
        {
            int command = 14;
            switch (ch)
            {
                case Keys.Back:
                    command = 12;
                    break;
                case Keys.Delete:
                case Keys.Escape:
                    command = 13;
                    break;
            }

            return command;
        }


        private void AboutToolStripMenuItem1_Click(object sender, EventArgs e)
        {
            MessageBox.Show("Калькулятор простых дробей\nВерсия: 0.0.1 Alpha\n\nРазработчик: Мироненко Кирилл, ИП-911\n\n            © 2022-2023 уч.год, СибГУТИ", "О программе", MessageBoxButtons.OK, MessageBoxIcon.Information);

        }

        private void Button_Number_Edit(object sender, EventArgs e)
        {
            Button button = (Button)sender;
            int tag_command = Convert.ToInt32(button.Tag.ToString());
            textBox1.Text = fracController.ExecComandEditor(tag_command);
        }

        private void Button_Number_Operation(object sender, EventArgs e)
        {
            Button button = (Button)sender;
            int tag_command = Convert.ToInt32(button.Tag.ToString());
            textBox1.Text = NumberBeautifier(fracController.ExecOperation(tag_command));
        }

        private void Button_Number_Function(object sender, EventArgs e)
        {
            Button button = (Button)sender;
            int tag_command = Convert.ToInt32(button.Tag.ToString());
            textBox1.Text = NumberBeautifier(fracController.ExecFunction(tag_command));
        }

        private void Button_Memory(object sender, EventArgs e)
        {
            Button button = (Button)sender;
            int tag_command = Convert.ToInt32(button.Tag.ToString());
            dynamic exec = fracController.ExecCommandMemory(tag_command, textBox1.Text);
            if (tag_command == 3)
                textBox1.Text = exec.Item1.ToString();
            label1.Text = exec.Item2 == true ? "M" : string.Empty;
        }

        private void Button_Reset(object sender, EventArgs e)
        {
            textBox1.Text = fracController.Reset();
            label1.Text = string.Empty;
        }

        private void Button_Calculate(object sender, EventArgs e)
        {
            textBox1.Text = NumberBeautifier(fracController.Calculate());
        }

        private void Form1_KeyDown(object sender, KeyEventArgs e)
        {
     
            if (e.KeyCode == Keys.Enter)
                CalculateButton.PerformClick();
            else
            {
                int command = KeyCodeToEditorCommand(e.KeyCode);
                if (command != 14)
                    textBox1.Text = fracController.ExecComandEditor(command);
            }

        }

        private void Form1_KeyPress(object sender, KeyPressEventArgs e)
        {
            if (e.KeyChar == (char)Keys.Enter)
                e.Handled = true;
            if (e.KeyChar >= '0' && e.KeyChar <= '9' || e.KeyChar == '.')
                textBox1.Text = fracController.ExecComandEditor(CharToEditorCommand(e.KeyChar));
            else if (operation_signs.Contains(e.KeyChar))
                textBox1.Text = NumberBeautifier(fracController.ExecOperation(CharToOperationsCommand<TFrac>(e.KeyChar)));
        }

        private void FracToolStripMenuItem_Click(object sender, EventArgs e)
        {
            FracToolStripMenuItem.Checked = true;
            NumToolStripMenuItem.Checked = false;
            fracMode = true;
        }

        private void NumToolStripMenuItem_Click(object sender, EventArgs e)
        {
            FracToolStripMenuItem.Checked = false;
            NumToolStripMenuItem.Checked = true;
            fracMode = false;
        }

        private void Form1_KeyUp(object sender, KeyEventArgs e)
        {
            //MessageBox.Show($"KeyUp code: {e.KeyCode}, value: {e.KeyValue}, modifiers: {e.Modifiers}" + "\r\n");
            
        }

 
    }
}
