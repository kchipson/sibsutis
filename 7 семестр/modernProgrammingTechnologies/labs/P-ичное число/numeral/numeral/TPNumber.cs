using System;
using System.Collections.Generic;
using System.Text;

namespace numeral
{
    // Обработка исключения
    public class MyException : Exception
    {
        public MyException(string str) : base(str) { }
    }
    public abstract class TPNumber
    {
        protected double n;   // Number
        protected int b;      // Base
        protected int c;      // Correctness
        public TPNumber()
        {
            this.n = 0f;
            this.b = 10;
            this.c = 0;
        }
        public TPNumber(double a, int b, int c)
        {
            try
            {
                if (b < 10 && b > 1 && c >= 0 && check(a, b, c))
                {
                    this.b = b;
                    this.c = c;
                    n = ConvertToDouble(a);
                }
                else if (b == 10)
                {
                    this.b = b;
                    this.c = c;
                    n = a;
                }
                else
                {
                    this.n = 0f;
                    this.b = 10;
                    this.c = 0;
                }
            }
            catch
            {
                throw new MyException("Error");

            }

        }
        public TPNumber(string a, string b, string c)
        {
            this.b = Convert.ToInt32(b);
            this.c = Convert.ToInt32(c);
            try
            {
                if (this.b < 17 && this.b > 1 && this.b != 10 && this.c >= 0 && check(a, b, c))
                {
                    n = ConvertStringToDouble(a);
                }
                else if (this.b == 10)
                {
                    n = Convert.ToDouble(a);
                }
            }
            catch
            {
                throw new MyException("Error");
            }

        }
        public TPNumber(TPNumber d)
        {
            n = d.n;
            b = d.b;
            c = d.c;
        }
        public TPNumber Copy()
        {
            return (TPNumber)this.MemberwiseClone();
        }
        public TPNumber Add(TPNumber d)
        {
            TPNumber tmp = d.Copy();
            if (d.b != this.b || d.c != this.c)
            {
                tmp.n = 0.0;
                return tmp;
            }
            tmp.n = this.n + d.n;
            return tmp;
        }
        public TPNumber Mult(TPNumber d)
        {
            TPNumber tmp = d.Copy();
            if (d.b != this.b || d.c != this.c)
            {
                tmp.n = 0.0;
                return tmp;
            }
            tmp.n = this.n * d.n;
            return tmp;
        }
        public TPNumber Substract(TPNumber d)
        {
            TPNumber tmp = d.Copy();
            if (d.b != this.b || d.c != this.c)
            {
                tmp.n = 0.0;
                return tmp;
            }
            tmp.n = this.n - d.n;
            return tmp;
        }
        public TPNumber Del(TPNumber d)
        {
            TPNumber tmp = d.Copy();
            if (d.b != this.b || d.c != this.c)
            {
                tmp.n = 0.0;
                return tmp;
            }
            tmp.n = this.n / d.n;
            return tmp;
        }
        public TPNumber Revers()
        {
            TPNumber tmp = this.Copy();
            tmp.n = 1 / this.n;
            return tmp;
        }
        public TPNumber Sqr()
        {
            TPNumber tmp = this.Copy();
            tmp.n = this.n * this.n;
            return tmp;
        }
        public double GetPNumber()
        {
            return ConvertDoubleToBaseDouble(n);
        }
        public string GetPString()
        {
            return ConvertStringToBaseDouble(n);
        }
        public int GetBaseNumber()
        {
            return this.b;
        }
        public string GetBaseString()
        {
            return this.b.ToString();
        }
        public int GetСorrectnessNumber()
        {
            return this.c;
        }
        public string GetCorrectnessString()
        {
            return this.c.ToString();
        }
        public void SetBaseNumber(int b)
        {
            if (check(this.n, b, this.c))
            {
                this.b = b;
            }
            else
            {
                return;
            }
        }
        public void SetBaseString(string b)
        {
            if (check(this.n, Convert.ToInt32(b), this.c))
            {
                this.b = Convert.ToInt32(b);
            }
            else
            {
                return;
            }

        }
        public void SetCorrectnessNumber(int c)
        {
            if (check(this.n, this.b, c))
            {
                this.c = c;
            }
            else
            {
                return;
            }

        }
        public void SetCorrectnessString(string c)
        {
            if (check(this.n, this.b, Convert.ToInt32(c)))
            {
                this.c = Convert.ToInt32(c);
            }
            else
            {
                return;
            }

        }
        private double ConvertToDouble(double a)
        {
            double num_int = (a * Math.Pow(10, c));
            int left = (int)(num_int / Math.Pow(10, c));
            int right = (int)(num_int % (int)Math.Pow(10, c));
            double result = 0;

            int i = 0;
            while (left > 0)
            {
                int tmp = left % 10;
                result += tmp * Math.Pow(b, i);
                left /= 10;
                i++;
            }

            i = c - 1;
            int j = -1;
            while (i > -1)
            {
                int tmp = right / (int)Math.Pow(10, i);
                result += tmp * Math.Pow(b, j);
                right %= (int)Math.Pow(10, i);
                i--;
                j--;
            }

            return Math.Floor(result * Math.Pow(10, c)) / Math.Pow(10, c); ;
        }
        private double ConvertStringToDouble(string str)
        {
            string left, right;
            int tmp;
            double result = 0;

            if (c == 0)
            {
                for (int i = str.Length - 1; i >= 0; i--)
                {
                    if (str[i] >= 'A' && str[i] <= 'Z')
                    {
                        int move = Math.Abs('A' - str[i]);
                        tmp = 10 + move;
                    }
                    else
                    {
                        tmp = str[i] - '0';
                    }
                    result += tmp * Math.Pow(b, str.Length - i - 1);
                }
                return result;
            }
            else if (c > 0)
            {
                string[] substr = str.Split(",");
                left = substr[0];
                right = substr[1];

                for (int i = left.Length - 1; i >= 0; i--)
                {
                    if (left[i] >= 'A' && left[i] <= 'Z')
                    {
                        int move = Math.Abs('A' - left[i]);
                        tmp = 10 + move;
                    }
                    else
                    {
                        tmp = left[i] - '0';
                    }
                    result += tmp * Math.Pow(b, left.Length - i - 1);
                }

                for (int i = 0; i < right.Length; i++)
                {
                    if (right[i] >= 'A' && right[i] <= 'Z')
                    {
                        int move = Math.Abs('A' - right[i]);
                        tmp = 10 + move;
                    }
                    else
                    {
                        tmp = right[i] - '0';
                    }
                    result += tmp * Math.Pow(b, -(i + 1));
                }


                return Math.Floor(result * Math.Pow(10, c)) / Math.Pow(10, c);
            }
            else
            {
                return -1;
            }
        }
        private double ConvertDoubleToBaseDouble(double a)
        {
            if (b > 1 && b < 10 && a != 0)
            {
                string num_10_str = a.ToString();
                int j;
                for (j = 0; j < num_10_str.Length && num_10_str[j] != ','; j++) { }

                if (j < num_10_str.Length)
                {
                    string[] num_10_str_split = num_10_str.Split(",");
                    int left = Convert.ToInt32(num_10_str_split[0]);
                    double right;
                    if (num_10_str_split[1].Length < c)
                    {
                        right = Convert.ToDouble(num_10_str_split[1].Substring(0, this.c - 1));
                    }
                    else
                    {
                        right = Convert.ToDouble(num_10_str_split[1].Substring(0, this.c));
                    }
                    string result = "";

                    while (left > 0)
                    {
                        int tmp = left % b;
                        result += tmp;
                        left = left / b;
                    }

                    result = Revers(result);

                    result += ",";
                    string sub_res = "";
                    string right_str = "0," + right;
                    int i = 0;
                    while (i < c + 1)
                    {
                        right = Convert.ToDouble(right_str);
                        right *= (double)b;
                        right_str = right.ToString();
                        for (j = 0; j < right_str.Length && right_str[j] != ','; j++) { }
                        if (j < right_str.Length)
                        {
                            string[] sp = right_str.Split(",");
                            sub_res += sp[0];
                            right_str = "0," + right_str.Substring(2);
                        }
                        else
                        {
                            sub_res += right_str;
                            right_str = "0,0";
                        }

                        i++;
                    }
                    result += sub_res;
                    double res_double = Convert.ToDouble(result);
                    res_double = Math.Round(res_double, c, MidpointRounding.ToZero);

                    return res_double;
                }
                else
                {
                    int left = Convert.ToInt32(num_10_str);

                    string result = "";

                    while (left > 0)
                    {
                        int tmp = left % b;
                        result += tmp;
                        left = left / b;
                    }

                    result = Revers(result);

                    return Convert.ToDouble(result);
                }
            }
            else if (a == 0)
            {
                return 0.0;
            }
            else
            {
                return -1;
            }
        }
        private string ConvertStringToBaseDouble(double n)
        {
            try
            {
                if (b > 1 && b < 10)
                {
                    string result = ConvertDoubleToBaseDouble(n).ToString();
                    return result;
                }
                else if (b > 10 && b < 17)
                {
                    if (Math.Abs(n - 0.0) < 0.001)
                    {
                        return "0,0";
                    }
                    string number = n.ToString();
                    if (checkPoint(number))
                    {
                        string[] spliter = number.Split(',');
                        int left = Convert.ToInt32(spliter[0]);
                        double right = Convert.ToDouble(spliter[1]);
                        string result = "";

                        while (left > 0)
                        {
                            double tmp = left % this.b;
                            char tmp_char = tmp.ToString().ToCharArray()[0];
                            if (tmp > 9)
                            {
                                tmp_char = (char)('A' + tmp - 10);
                            }
                            result += tmp_char;
                            left /= b;
                        }
                        result = Revers(result) + ",";

                        int iter = 0;
                        double tmp_right = right, iter_right = 0;
                        for (; Math.Truncate(tmp_right) > 0; iter_right++)
                        {
                            tmp_right /= 10;
                        }
                        right = right / Math.Pow(10, iter_right);
                        while (iter < c)
                        {
                            right *= b;
                            int add = (int)Math.Truncate(right);
                            char add_char = add.ToString().ToCharArray()[0];
                            if (add > 9)
                            {
                                add_char = (char)('A' + add - 10);
                            }
                            result += add_char;
                            right = right - Math.Truncate(right);
                            iter++;
                        }

                        return result;
                    }
                    else
                    {
                        int left = Convert.ToInt32(number);
                        string result = "";
                        while (left > 0)
                        {
                            double tmp = left % this.b;
                            char tmp_char = tmp.ToString().ToCharArray()[0];
                            if (tmp > 9)
                            {
                                tmp_char = (char)('A' + tmp - 10);
                            }
                            result += tmp_char;
                            left /= b;
                        }
                        result = Revers(result);
                        return result;
                    }
                }
            }
            catch (Exception e)
            {
                Console.WriteLine(e.Message);
            }
            return null;
        }
        private bool checkPoint(string n)
        {
            int i;
            for (i = 0; i < n.Length && n[i] != ','; i++) { }
            if (i < n.Length)
            {
                return true;
            }
            return false;
        }
        private bool checkPoint(double n)
        {
            string n_str = n.ToString();
            int i;
            for (i = 0; i < n_str.Length && n_str[i] != ','; i++) { }
            if (i < n_str.Length)
            {
                return true;
            }
            return false;
        }
        private string Revers(string str)
        {
            char[] sub_char = str.ToCharArray();
            for (int j = 0; j < str.Length / 2; j++)
            {
                char tmp = sub_char[j];
                sub_char[j] = sub_char[sub_char.Length - j - 1];
                sub_char[sub_char.Length - j - 1] = tmp;
            }

            string result = "";
            for (int j = 0; j < sub_char.Length; j++)
            {
                result += sub_char[j];
            }
            return result;
        }
        private bool checkOnBase(string a, int b)
        {
            foreach (char iter in a)
            {
                int move = Math.Abs('A' - iter);
                int iter_int = iter - '0';
                if (iter >= 'A' && iter <= 'Z')
                {
                    iter_int = 10 + move;
                }
                if (iter == ',')
                {
                    continue;
                }
                if (iter_int >= b)
                {
                    return false;
                }
            }
            return true;
        }
        private bool checkOnC(string a, int c)
        {
            if (checkPoint(a) && c > 0)
            {
                string[] spliter = a.Split(',');
                if (spliter[1].Length == c)
                {
                    return true;
                }
            }
            return false;
        }
        private bool checkOnSymbol(string a)
        {
            foreach (char iter in a)
            {
                if (iter >= 'a' && iter <= 'z')
                {
                    return false;
                }
            }
            return true;
        }
        private bool check(double a, int b, int c)
        {
            string a_str = a.ToString();
            if (!checkOnBase(a_str, b))
            {
                return false;
            }
            if (!checkOnC(a_str, c))
            {
                return false;
            }
            if (!checkOnSymbol(a_str))
            {
                return false;
            }
            return true;
        }
        private bool check(string a, string b, string c)
        {
            int b_int = Convert.ToInt32(b);
            int c_int = Convert.ToInt32(c);
            if (!checkOnBase(a, b_int))
            {
                return false;
            }
            if (!checkOnC(a, c_int))
            {
                return false;
            }
            if (!checkOnSymbol(a))
            {
                return false;
            }
            return true;
        }
    }
}
