using System;
using System.Collections.Generic;
using System.Text;

namespace fraction
{
    public class Frac : TFrac
    {

        public Frac(int a, int b) : base(a, b)
        {

        }

        public Frac(string str) : base(str)
        {

        }

        public Frac() : base()
        {

        }

        public static Frac operator +(Frac a, Frac b)
        {
            return (Frac)a.Add(b);
        }

        public static Frac operator *(Frac a, Frac b)
        {
            return (Frac)a.Multiplication(b);
        }

        public static Frac operator -(Frac a, Frac b)
        {
            return (Frac)a.Difference(b);
        }

        public static Frac operator /(Frac a, Frac b)
        {
            return (Frac)a.Division(b);
        }
        
        public static Frac operator /(int a, Frac b)
        {
            return (Frac)(new Frac(a, 1)).Division(b);
        }

        public override bool Equals(object obj)
        {
            Frac frac = (Frac)obj;
            if ((frac.Numerator == this.Numerator) && (this.Denominator == frac.Denominator))
            {
                return true;
            }
            else return false;
        }
        
        public static bool operator ==(Frac a, Frac b)
        {
            return (a.Numerator == b.Numerator) && (a.Denominator == b.Denominator);
        }
        
        public static bool operator !=(Frac a, Frac b)
        {
            return (a.Numerator != b.Numerator) || (a.Denominator != b.Denominator);
        }

        public static bool operator >(Frac a, Frac b)
        {
            return ((double)a.Numerator / (double)a.Denominator) > ((double)b.Numerator / (double)b.Denominator);
        }
        public static bool operator <(Frac a, Frac b)
        {
            return ((double)a.Numerator / (double)a.Denominator) < ((double)b.Numerator / (double)b.Denominator);
        }

        public override int GetHashCode()
        {
            return this.Numerator.GetHashCode() + this.Denominator.GetHashCode();
        }

        public override string ToString()
        {
            return GetString();
        }
    }
}
