using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace rgz
{
    public class ADT_Proc<T> where T : TFrac, new()
    {
        T left_result_operand;
        T right_operand;
        int operation;

        public T Left_Result_operand
        {
            get 
            { 
                return left_result_operand; 
            }

            set 
            {
                left_result_operand = value;
            }
        }
        public T Right_operand
        {
            get
            {
                return right_operand;
            }

            set
            {
                right_operand = value;
            }
        }

        public int Operation
        {
            get 
            { 
                return operation; 
            }

            set
            {
                operation = value;
            }
        }

        public ADT_Proc()
        {
            operation = 0;
            left_result_operand = new T();
            right_operand = new T();
        }

        public ADT_Proc(T leftObj, T rightObj)
        {
            operation = 0;
            left_result_operand = leftObj;
            right_operand = rightObj;
        }

        public void ResetProc()
        {
            operation = 0;
            T newObj = new T();
            left_result_operand = right_operand = newObj;
        }

        public void DoOperation()
        {
            try
            {
                dynamic a = left_result_operand;
                dynamic b = right_operand;
                switch (operation)
                {
                    case 1:
                        left_result_operand = a.Add(b);
                        
                        break;
                    case 2:
                        left_result_operand = a.Sub(b);
                        break;
                    case 3:
                        left_result_operand = a.Mul(b);
                        break;
                    case 4:
                        left_result_operand = a.Div(b);
                        break;
                    default:
                        left_result_operand = right_operand;
                        break;
                }
            }
            catch
            {
                throw new System.OverflowException();
            }
        }

        public void DoFunction(int function)
        {
            dynamic a = right_operand;
            switch (function)
            {
                case 0:
                    a = a.Reverse();
                    right_operand = (T)a;
                    break;
                case 1:
                    a = a.Square();
                    right_operand = (T)a;
                    break;
                default:
                    break;
            }
        }
    }
}
