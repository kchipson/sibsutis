using System;
using System.Collections.Generic;
using System.Text;

namespace fraction
{
    // Обработка исключения
    public class MyException : Exception
    {
        public MyException(string str) : base(str) { }
    }
    public abstract class TFrac
    {
        private int numerator;
        private int denominator;


        /// Числитель
        public int Numerator
        {
            get
            {
                return numerator;
            }
            set
            {
                numerator = value;
            }
        }

        /// Знаменатель
        public int Denominator
        {
            get
            {
                return denominator;
            }
            set
            {
                denominator = value;
            }
        }

        public TFrac()
        {
            Numerator = 0;
            Denominator = 1;
        }

        public TFrac(int a, int b)
        {
            if (b == 0)
            {
                throw new MyException("Деление на ноль невозможно!");
            }
            Numerator = a;
            Denominator = b;
            Norm(this);
        }

        public TFrac(string str)
        {
            var index = str.IndexOf("/");
            if (index < 0)
            {
                throw new MyException("Строка пуста!");
            }

            var num = str.Substring(0, index);
            var den = str.Substring(index + 1);
            var numInt = Convert.ToInt32(num);
            var denInt = Convert.ToInt32(den);
            if (denInt == 0)
            {
                throw new MyException("Деление на ноль невозможно!");
            }
            Numerator = numInt;
            Denominator = denInt;
            Norm(this);
        }

        public TFrac Copy()
        {
            return (TFrac)this.MemberwiseClone();
        }

        /// Сумма
        public TFrac Add(TFrac b)
        {
            TFrac res = b.Copy();
            if (this.Denominator == b.Denominator)
            {
                res.denominator = this.Denominator;
                res.numerator = this.Numerator + b.Numerator;
            }
            else
            {
                int nok = NOK(Convert.ToInt32(this.Denominator), Convert.ToInt32(b.Denominator));
                res.denominator = nok;
                res.numerator = this.Numerator * (nok / this.Denominator) + b.Numerator * (nok / b.Denominator);
            }
            return Norm(res);
        }

        /// Разность
        public TFrac Difference(TFrac B)
        {
            //if (A.Numerator == 0) return Multiplication(Norm(B), new TFrac(-1, 1));
            if (B.Numerator == 0) return Norm(this);
            TFrac res = this.Copy();
            TFrac a = Norm(this), b = Norm(B);
            if (a.Denominator == b.Denominator)
            {
                res.Denominator = a.Denominator;
                res.Numerator = a.Numerator - b.Numerator;
            }
            else
            {
                int nok = NOK(Convert.ToInt32(a.Denominator), Convert.ToInt32(b.Denominator));
                res.Denominator = nok;
                res.Numerator = a.Numerator * (nok / a.Denominator) - b.Numerator * (nok / b.Denominator);
            }
            return Norm(res);
        }

        /// Произведение
        public TFrac Multiplication(TFrac b)
        {
            TFrac res = this.Copy();
            res.Denominator = this.Denominator * b.Denominator;
            res.Numerator = this.Numerator * b.Numerator;
            return res;
        }


        /// Деление
        public TFrac Division(TFrac b)
        {
            TFrac res = this.Copy();
            res.Denominator = this.Denominator * b.Numerator;
            res.Numerator = this.Numerator * b.Denominator;
            return Norm(res);
        }


        /// Квадрат
        public TFrac Square()
        {
            return this.Multiplication(this);
        }


        /// Обратное
        public TFrac Reverse()
        {
            TFrac res = this.Copy();
            res.Denominator = this.Numerator;
            res.Numerator = this.Denominator;
            return res;
        }

        /// Минус
        public TFrac Minus()
        {
            TFrac res = this.Copy();
            res.Denominator = this.Denominator;
            res.Numerator = 0 - this.Numerator;
            return res;
        }

        /// Равно
        public bool Equal(TFrac b)
        {
            /*
            TFrac res = this.Difference(b);
            if (res.Numerator == 0)
            {
                return true;
            }

            return false;
            */
            if ((b.Numerator == this.Numerator) && (this.Denominator == b.Denominator))
            {
                return true;
            }
            else return false;
    }

        /// Больше
        public bool More(TFrac d)
        {
            TFrac otv = this.Difference(d);
            if ((otv.Numerator > 0 && otv.Denominator > 0)
                || (otv.Numerator < 0 && otv.Denominator < 0))
            {
                return true;
            }

            return false;
        }

        /// ВзятьЧислительЧисло
        public int GetNumeratorNumber()
        {
            return numerator;
        }

        /// ВзятьЗнаменательЧисло
        public int GetDenominatorNumber()
        {
            return denominator;
        }

        /// ВзятьЧислительСтрока
        public string GetNumeratorString()
        {
            return numerator.ToString();
        }


        /// ВзятьЗнаменательСтрока
        public string GetDenominatorString()
        {
            return denominator.ToString();
        }

        /// ВзятьДробьСтрока
        public string GetString()
        {
            return numerator + "/" + denominator;
        }

        private int NOK(int a, int b) { 
            return (a * b) / Gcd(a, b); 
        }
        private int Gcd(int a, int b) { 
            return a != 0 ? Gcd(b % a, a) : b; 
        }
        public int NOD(List<int> list)
        {
            if (list.Count == 0) return 0;
            int i;
            int gcd = list[0];
            for (i = 0; i < list.Count - 1; i++)
                gcd = NOD(gcd, list[i + 1]);
            return gcd;
        }
        static int NOD(int a, int b)
        {
            while (b != 0)
            {
                int temp = b;
                b = a % b;
                a = temp;
            }
            return a;
        }
        private TFrac Norm(TFrac SimpleFractions)
        {
            TFrac fractions = SimpleFractions;
            if (fractions.Numerator == 0) { fractions.Denominator = 1; return fractions; }
            fractions = Reduction(fractions);
            if (NOD(new List<int> { fractions.Numerator, fractions.Denominator }) != 0)
            {
                int nod = NOD(new List<int> { fractions.Numerator, fractions.Denominator });
                fractions.Numerator /= nod;
                fractions.Denominator /= nod;
            }
            if (fractions.Denominator < 0)
            {
                fractions.Numerator *= -1;
                fractions.Denominator *= -1;
            }
            return fractions;
        }
        public TFrac Reduction(TFrac SimpleFractions)
        {
            TFrac a = SimpleFractions;
            if ((SimpleFractions.Numerator >= 0 && SimpleFractions.Denominator < 0) || (SimpleFractions.Numerator < 0 && SimpleFractions.Denominator < 0))
            {
                SimpleFractions.Numerator *= -1;
                SimpleFractions.Denominator *= -1;
            }
            var nod = NOD(new List<int> { a.Numerator, a.Denominator });
            if (nod != 1)
            {
                a.Denominator /= nod;
                a.Numerator /= nod;
            }
            return a;
        }
    }
}
