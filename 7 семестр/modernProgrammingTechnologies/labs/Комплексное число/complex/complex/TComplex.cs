using System;
using System.Collections.Generic;
using System.Text;

namespace complex
{
    // Обработка исключения
    public class MyException : Exception
    {
        public MyException(string str) : base(str) { }
    }
    public abstract class TComplex
    {
        private double real;
        private double imaginary;

        public double Real {

            get
            {
                return real;
            }
            set
            {
                real = value;
            }
        }
        public double Imaginary
        {

            get
            {
                return imaginary;
            }
            set
            {
                imaginary = value;
            }
        }
        public TComplex(double a, double b)
        {
            real = a;
            imaginary = b;
        }
        public TComplex(string str)
        {
            try
            {
                str = str.Replace(" ", "");
                var indexPlus = str.IndexOf("+");
                var astr = str.Substring(0, indexPlus);
                var bstr = str.Substring(indexPlus + 3);
                real = Double.Parse(astr);
                imaginary = Double.Parse(bstr);
            }
            catch
            {
                throw new MyException("Не получилось обработать строку");
            }
        }
        public TComplex Copy()
        {
            return (TComplex)this.MemberwiseClone();
        }

        public TComplex Add(TComplex b)
        {
            TComplex res = this.Copy();
            res.real += b.real;
            res.imaginary += b.imaginary;
            return res;
        }

        public TComplex Multiplication(TComplex b)
        {
            TComplex res = this.Copy();
            res.real = this.real * b.real - this.imaginary * b.imaginary;
            res.imaginary = this.real * b.imaginary + this.imaginary * b.real;
            return res;
        }

        public TComplex Square()
        {
            TComplex res = this.Copy();
            res.real = this.real * this.real - this.imaginary * this.imaginary;
            res.imaginary = this.real * this.imaginary + this.real * this.imaginary;
            return res;
        }

        public TComplex Reverse()
        {
            TComplex res = this.Copy();
            res.real = this.real / (this.real * this.real + this.imaginary * this.imaginary);
            res.imaginary = -this.imaginary / (this.real * this.real + this.imaginary * this.imaginary);
            return res;
        }

        public TComplex Subtract(TComplex b)
        {
            TComplex res = this.Copy();
            res.real -= b.real;
            res.imaginary -= b.imaginary;
            return res;
        }

        public TComplex Divide(TComplex b)
        {
            TComplex res = this.Copy();
            res.real = (this.real * b.real + this.imaginary * b.imaginary) / (b.real * b.real + b.imaginary * b.imaginary);
            res.imaginary = (b.real * this.imaginary - this.real * b.imaginary) / (b.real * b.real + b.imaginary * b.imaginary);
            return res;
        }

        public TComplex Minus()
        {
            TComplex res = this.Copy();
            res.real = 0 - res.real;
            res.imaginary = 0 - res.imaginary;
            return res;
        }

        public double Abs()
        {
            return Math.Sqrt(this.real * this.real + this.imaginary * this.imaginary);
        }

        public double Rad()
        {
            if (this.real > 0)
                return Math.Atan(this.imaginary / this.real);

            if (this.real == 0 && this.imaginary > 0)
                return (Math.PI / 2);

            if (this.real < 0)
                return (Math.Atan(this.imaginary / this.real) + Math.PI);

            if (this.real == 0 && this.imaginary < 0)
                return (-Math.PI / 2);

            return 0;
        }

        public double Degree()
        {
            return Rad() * 180 / Math.PI;
        }

        public TComplex Pow(int n)
        {
            TComplex res = this.Copy();
            res.real = Math.Pow(Abs(), n) * Math.Cos(n * Rad());
            res.imaginary = Math.Pow(Abs(), n) * Math.Sin(n * Rad());
            return res;
        }

        public TComplex Sqrt(int powN, int rootI)
        {
            if (powN == 0)
            {
                TComplex res0 = this.Copy();
                res0.real = 1;
                res0.imaginary = 0;
                return res0;

            }

            if (rootI == 0)
                new MyException("Деление на 0.");

            TComplex new1 = Pow(powN);

            TComplex res = this.Copy();
            res.real = Math.Pow(new1.Abs(), 1 / (double)rootI) * Math.Cos((new1.Rad() + 2 * Math.PI * rootI) / rootI);
            res.imaginary = Math.Pow(new1.Abs(), 1 / (double)rootI) * Math.Sin((new1.Rad() + 2 * Math.PI * rootI) / rootI);

            return res;
        }

        public bool Equal(TComplex anClass)
        {
            return (this.real == anClass.real && this.imaginary == anClass.imaginary);
        }

        public bool NotEqual(TComplex anClass)
        {
            return (this.real != anClass.real || this.imaginary != anClass.imaginary);
        }

        public double GetRealNumber()
        {
            return this.real;
        }

        public double GetImaginaryNumber()
        {
            return this.imaginary;
        }

        public string GetRealString()
        {
            return this.real.ToString();
        }

        public string GetImaginaryString()
        {
            return this.imaginary.ToString();
        }

        public string GetString()
        {
            return this.real.ToString("##,###") + ' ' + (this.imaginary >= 0 ? '+' : '-') + " i * " + this.imaginary.ToString("##,###");
        }

    }
}
