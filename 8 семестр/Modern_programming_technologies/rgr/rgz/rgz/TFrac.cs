using System;
using System.Collections.Generic;
using System.Linq;
using System.Text.RegularExpressions;

namespace rgz
{
    public class TFrac
    {
        private long numerator;
        private long denominator;

        /// Числитель
        public long Numerator
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
        public long Denominator
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

        static void Swap<T>(ref T lhs, ref T rhs)
        {
            T temp;
            temp = lhs;
            lhs = rhs;
            rhs = temp;
        }

        public static long GCD(long a, long b)
        {
            a = Math.Abs(a);
            b = Math.Abs(b);
            while (b > 0)
            {
                a %= b;
                Swap(ref a, ref b);
            }
            return a;
        }

        public TFrac()
        {
            numerator = 0;
            denominator = 1;
        }

        public TFrac(long a, long b)
        {
            if (a < 0 && b < 0)
            {
                a *= -1;
                b *= -1;
            }
            else if (b < 0 && a > 0)
            {
                b *= -1;
                a *= -1;
            }
            else if (a == 0 && b == 0 || b == 0 || a == 0 && b == 1)
            {
                numerator = 0;
                denominator = 1;
                return;
            }
            numerator = a;
            denominator = b;
            long gcdRes = GCD(a, b);
            if (gcdRes > 1)
            {
                numerator /= gcdRes;
                denominator /= gcdRes;
            }
        }

        public TFrac(string frac)
        {
            Regex FracRegex = new Regex(@"^-?(\d+)/(\d+)$");
            Regex NumberRegex = new Regex(@"^-?\d+/?$");
            if (FracRegex.IsMatch(frac))
            {
                List<string> FracSplited = frac.Split('/').ToList();
                numerator = Convert.ToInt64(FracSplited[0]);
                denominator = Convert.ToInt64(FracSplited[1]);
                if (denominator == 0)
                {
                    numerator = 0;
                    denominator = 1;
                    return;
                }
                long gcd = GCD(numerator, denominator);
                if (gcd > 1)
                {
                    numerator /= gcd;
                    denominator /= gcd;
                }
                return;
            }
            else if (NumberRegex.IsMatch(frac))
            {
                if (long.TryParse(frac, out long NewNumber))
                    numerator = NewNumber;
                else
                    numerator = 0;
                denominator = 1;
                return;
            }
            else
            {
                numerator = 0;
                denominator = 1;
                return;
            }
        }

        public TFrac Copy()
        {
            return (TFrac)this.MemberwiseClone();
        }

        public void SetString(string str)
        {
            TFrac TempFrac = new TFrac(str);
            numerator = TempFrac.numerator;
            denominator = TempFrac.denominator;
        }

        public TFrac Add(TFrac a)
        {
            return new TFrac(numerator * a.denominator + denominator * a.numerator, denominator * a.denominator);
        }

        public TFrac Mul(TFrac b)
        {
            return new TFrac(numerator * b.numerator, denominator * b.denominator);
        }

        public TFrac Sub(TFrac b)
        {
            return new TFrac(numerator * b.denominator - denominator * b.numerator, denominator * b.denominator);
        }

        public TFrac Div(TFrac b)
        {
            return new TFrac(numerator * b.denominator, denominator * b.numerator);
        }

        public TFrac Square()
        {
            return new TFrac(numerator * numerator, denominator * denominator);
        }

        public TFrac Reverse()
        { 
            return new TFrac(denominator, numerator); 
        }

        public TFrac Minus()
        {
            return new TFrac(-numerator, denominator);
        }

        public bool Equal(TFrac b)
        {
            return numerator == b.numerator && denominator == b.denominator;
        }

        public static bool operator >(TFrac a, TFrac b)
        {
            return (Convert.ToDouble(a.numerator) / Convert.ToDouble(a.denominator)) > (Convert.ToDouble(b.numerator) / Convert.ToDouble(b.denominator));
        }

        public static bool operator <(TFrac a, TFrac b)
        {
            return (Convert.ToDouble(a.numerator) / Convert.ToDouble(a.denominator)) < (Convert.ToDouble(b.numerator) / Convert.ToDouble(b.denominator));
        }

        public static implicit operator string(TFrac v)
        {
            throw new NotImplementedException();
        }

        public long getNumeratorNum()
        {
            return numerator;
        }

        public long getDenominatorNum()
        {
            return denominator;
        }

        public string getNumeratorString()
        {
            return numerator.ToString();
        }

        public string getDenominatorString()
        {
            return denominator.ToString();
        }

        public override string ToString()
        {
            return getNumeratorString() + "/" + getDenominatorString();
        }
    }
}
