using System;

namespace fraction

{
    class Program
    {
        static void Main(string[] args)
        {
            TFrac frac = new Frac(100, 5);
            Console.WriteLine($"{frac.Numerator} {frac.Denominator}");
        }
    }
}
