using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Converter
{
    class ADT_Control_
    {
        //Основание системы сч. исходного числа.
        int pin = 10;
        //Основание системы сч. результата.
        int pout = 16;
        //Число разрядов в дробной части результата.
        const int accuracy = 10;
        public History history = new History();
        public enum State { Edit, Converted }
        private State state;
        //Свойство для чтения и записи состояние Конвертера.
        internal State St { get => state; set => state = value; }
        //Свойство для чтения и записи основание системы сч. р1.
        public int Pin { get => pin; set => pin = value; }
        //Свойство для чтения и записи основание системы сч. р2.
        public int Pout { get => pout; set => pout = value; }
        //Конструктор.
        public ADT_Control_()
        {
            St = State.Edit;
            Pin = pin;
            Pout = pout;
        }
        //объект редактор
        public Editor editor = new Editor();
        //Выполнить команду конвертера.
        public string doCmnd(int j)
        {
            if (j == 19)
            {
                double r = ADT_Convert_p_10.Dval(editor.getNumber(), (Int16)Pin);
                string res = ADT_Convert_10_p.Do(r, (Int32)Pout, Acc());
                St = State.Converted;
                history.addRecord(Pin, Pout, editor.getNumber(), res);
                return res;
            }
            else
            {
                St = State.Edit;
                return editor.doEdit(j);
            }
        }

        //Точность представления результата.
        private int Acc()
        {
            return (int)Math.Round(editor.acc() * Math.Log(Pin) / Math.Log(Pout) + 0.5);
        }
    }
}
