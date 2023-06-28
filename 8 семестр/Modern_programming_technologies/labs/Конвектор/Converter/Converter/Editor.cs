using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Converter
{
    public class Editor
    {
        string number = "0";
        const string zero = "0";
        const string delim = ".";

        public string getNumber() { return number; }

        public string addDigit(int n)
        {
            if (n < 0 || n > 16)
                throw new IndexOutOfRangeException();
            if (number == zero)
                number = ADT_Convert_10_p.Int_to_char(n).ToString();
            else
                number += ADT_Convert_10_p.Int_to_char(n);
            return number;
        }

        public int acc()
        {
            if (number.Contains(delim))
            {
                string[] chs = number.Split('.');
                return chs[1].Length;
            }
            return 0;
        }
        public string addZero()
        {
            number += zero;
            return number;
        }
        public string addDelim()
        {
            if (number.Length == 0)
            {
                addZero();
            }
            if (number.Length > 0 && !number.Contains(delim))
                number += delim;
            return number;
        }
        public string bs()
        {
            if (number.Length > 1)
                number = number.Remove(number.Length - 1);
            else
                number = zero;
            return number;
        }
        public string clear()
        {
            number = "0";
            return number;
        }
        public string doEdit(int j)
        {
            if (j < 16)
            {
                addDigit(j);
            }
            switch (j)
            {
                case 16:
                    addDelim();
                    break;
                case 17:
                    bs();
                    break;
                case 18:
                    clear();
                    break;
                case 19:
                    break;
            }
            return number;
        }
    }
}
