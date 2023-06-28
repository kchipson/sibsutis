using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Converter
{
    public class ADT_Convert_p_10
    {
        //Преобразовать из с.сч. с основанием р 
        //в с.сч. с основанием 10
        public static double Dval(string p_num, int p)
        {
            if (p < 2 || p > 16)
                throw new IndexOutOfRangeException();

            double buf = 0d;
            if (p_num.Contains("."))
            {
                string[] lr = p_num.Split('.');
                if (lr[0].Length == 0)
                    throw new Exception();
                char[] chs = lr[0].ToCharArray();
                Array.Reverse(chs);
                for (int i = 0; i < chs.Length; i++)
                {
                    if(Char_to_num(chs[i]) > p)
                        throw new Exception();
                    buf += Char_to_num(chs[i]) * Math.Pow(p, i);
                }
                char[] chsr = lr[1].ToCharArray();
                for (int i = 0; i < chsr.Length; i++)
                {
                    if (Char_to_num(chsr[i]) > p)
                        throw new Exception();
                    buf += Char_to_num(chsr[i]) * Math.Pow(p, -(i + 1));
                }
            }
            else
            {
                char[] chs = p_num.ToCharArray();
                Array.Reverse(chs);
                for (int i = 0; i < chs.Length; i++)
                {
                    if (Char_to_num(chs[i]) > p)
                        throw new Exception();
                    buf += Char_to_num(chs[i]) * Math.Pow(p, i);
                }
            }
            return buf;
        }

        //Преобразовать цифру в число
        public static double Char_to_num(char ch)
        {
            string allNums = "0123456789ABCDEF";
            if (!allNums.Contains(ch))
                throw new IndexOutOfRangeException();
            return allNums.IndexOf(ch);

        }

        //Преобразовать строку в число
        public static double Convert(string p_num, int p, double weight)
        {
            return 0d;
        }
    }
}
