using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Converter
{
    public class ADT_Convert_10_p
    {
        //Преобразовать десятичное 
        //действительное число в с.сч. с осн. р.
        public static string Do(double n, int p, int c)
        {
            if (p < 2 || p > 16)
                throw new IndexOutOfRangeException();
            if (c < 0 || c > 10)
                throw new IndexOutOfRangeException();

            long leftSide = (long)n;

            double rightSide = n - leftSide;
            if (rightSide < 0)
                rightSide *= -1;

            string leftSideString = Int_to_p(leftSide, p);
            string rightSideString = Flt_to_p(rightSide, p, c);

            return leftSideString + (rightSideString == String.Empty ? "" : ".") + rightSideString;
        }

        //Преобразовать целое в символ.
        public static char Int_to_char(int d)
        {
            if (d > 15 || d < 0)
            {
                throw new IndexOutOfRangeException();
            }
            string allSymbols = "0123456789ABCDEF";
            return allSymbols.ElementAt(d);
        }

        //Преобразовать десятичное целое в с.сч. с основанием р.
        public static string Int_to_p(long n, int p)
        {
            if (p < 2 || p > 16)
                throw new IndexOutOfRangeException();
            if (n == 0)
                return "0";
            if (p == 10)
                return n.ToString();

            bool isNegative = false;
            if (n < 0)
            {
                isNegative = true;
                n *= -1;
            }
            
            string buf = "";
            while (n > 0)
            {
                buf += Int_to_char((int)n % p);
                n /= p;
            }

            if (isNegative)
                buf += "-";

            char[] chs = buf.ToCharArray();
            Array.Reverse(chs);
            return new string(chs);
        }

        //Преобразовать десятичную дробь в с.сч. с основанием р.
        public static string Flt_to_p(double n, int p, int c)
        {
            if (p < 2 || p > 16)
                throw new IndexOutOfRangeException();
            if (c < 0 || c > 10)
                throw new IndexOutOfRangeException();

            string pNumber = String.Empty;
            for (int i = 0; i < c; i++)
            {
                pNumber += Int_to_char((int)(n * p));
                n = n * p - (int)(n * p);

            }
            return pNumber;
        }
    }
}
