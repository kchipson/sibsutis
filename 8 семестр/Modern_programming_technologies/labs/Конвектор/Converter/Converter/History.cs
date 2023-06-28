using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Converter
{
   
    public class History
    {
        public struct Record
        {
            int p1, p2;
            string number1, number2;
            public Record(int p1, int p2, string number1, string number2)
            {
                this.p1 = p1;
                this.p2 = p2;
                this.number1 = number1;
                this.number2 = number2;
            }
            public List<string> toList()
            {
                return new List<string> { p1.ToString(), number1, p2.ToString(), number2 };
            }
        }

        List<Record> L;
        public History()
        {
            L = new List<Record>();
        }

        public void addRecord(int p1, int p2, string number1, string number2)
        {
            L.Add(new Record(p1, p2, number1, number2));
        }

        public void clear()
        {
            L.Clear();
        }

        public int count()
        {
            return L.Count;
        }

        public Record this[int i]
        {
            get {
                if (i < 0 || i >= L.Count)
                    throw new IndexOutOfRangeException(); 
                return L[i]; 
            }
            set {
                if (i < 0 || i >= L.Count)
                    throw new IndexOutOfRangeException();
                L[i] = value; 
            }
        }
    }
}
