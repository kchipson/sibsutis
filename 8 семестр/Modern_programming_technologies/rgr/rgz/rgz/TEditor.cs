using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace rgz
{
    public class TEditor
    {

        const string Separator = "/";
        const string ZeroFraction = "0/";
        const int max_numerator_length = 14;
        const int max_denominator_length = 22;
        private string fraction;

        public string Fraction
        {
            get
            {
                return fraction;
            }

            set
            {
                fraction = new TFrac(value).ToString();
            }
        }

        public TEditor()
        {
            fraction = "0";
        }

        public TEditor(long a, long b)
        {
            fraction = new TFrac(a, b).ToString();
        }

        public TEditor(string frac)
        {
            fraction = new TFrac(frac).ToString();
        }

        public void SetEditor(TFrac frac)
        {
            fraction = frac.ToString();
        }

        public bool IsZero()
        {
            return fraction.StartsWith(ZeroFraction) || fraction.StartsWith("-" + ZeroFraction) || fraction == "0" || fraction == "-0";
        }

        public string ToggleMinus()
        {
            if (fraction[0] == '-')
                fraction = fraction.Remove(0, 1);
            else
                fraction = '-' + fraction;

            return fraction;
        }

        public string AddNumber(long a)
        {
            if (!fraction.Contains(Separator) && fraction.Length > max_numerator_length)
                return fraction;
            else if (fraction.Length > max_denominator_length)
                return fraction;
            if (a < 0 || a > 9)
                return fraction;
            if (a == 0)
                AddZero();
            else if (IsZero())
                fraction = fraction.First() == '-' ? "-" + a.ToString() : a.ToString();
            else
                fraction += a.ToString();

            return fraction;
        }

        public string AddZero()
        {
            if (IsZero())
                return fraction;
            if (fraction.Last().ToString() == Separator)
                return fraction;
            fraction += "0";

            return fraction;
        }

        public string RemoveSymbol()
        {
            if (fraction.Length == 1)
                fraction = "0";
            else if (fraction.Length == 2 && fraction.First() == '-')
                fraction = "-0";
            else
                fraction = fraction.Remove(fraction.Length - 1);

            return fraction;
        }

        public string Clear()
        {
            fraction = "0";

            return fraction;
        }

        public string Edit(int command)
        {
            switch (command)
            {
                case 0:
                    AddZero();
                    break;
                case 1:
                    AddNumber(1);
                    break;
                case 2:
                    AddNumber(2);
                    break;
                case 3:
                    AddNumber(3);
                    break;
                case 4:
                    AddNumber(4);
                    break;
                case 5:
                    AddNumber(5);
                    break;
                case 6:
                    AddNumber(6);
                    break;
                case 7:
                    AddNumber(7);
                    break;
                case 8:
                    AddNumber(8);
                    break;
                case 9:
                    AddNumber(9);
                    break;
                case 10:
                    ToggleMinus();
                    break;
                case 11:
                    AddSeparator();
                    break;
                case 12:
                    RemoveSymbol();
                    break;
                case 13:
                    Clear();
                    break;
                default:
                    break;
            }

            return fraction;
        }

        public string AddSeparator()
        {
            if (!fraction.Contains(Separator))
                fraction += Separator;

            return fraction;
        }

        public override string ToString()
        {
            return Fraction;
        }
    }
}
