using Microsoft.VisualStudio.TestTools.UnitTesting;
using rgz;

namespace rgs_tests
{
    [TestClass]
    public class UnitTests
    {
        [TestMethod]
        public void InitString1()
        {
            string fracString = "1/2";
            TFrac fracClass = new TFrac(fracString);
            Assert.AreEqual(fracString, fracClass.ToString());
        }

        [TestMethod]
        public void InitString2()
        {
            string fracString = "111/2";
            TFrac fracClass = new TFrac(fracString);
            Assert.AreEqual(fracString, fracClass.ToString());
        }

        [TestMethod]
        public void InitString3()
        {
            string fracString = "-100/60";
            TFrac fracClass = new TFrac(fracString);
            string Expect = "-5/3";
            Assert.AreEqual(Expect, fracClass.ToString());
        }

        [TestMethod]
        public void InitString4()
        {
            string fracString = "00000003/000004";
            TFrac fracClass = new TFrac(fracString);
            string Expect = "3/4";
            Assert.AreEqual(Expect, fracClass.ToString());
        }

        [TestMethod]
        public void InitString5()
        {
            string fracString = "-00000003/000004";
            TFrac fracClass = new TFrac(fracString);
            string Expect = "-3/4";
            Assert.AreEqual(Expect, fracClass.ToString());
        }

        [TestMethod]
        public void InitNumber1()
        {
            TFrac fracClass = new TFrac(1, 2);
            string Expect = "1/2";
            Assert.AreEqual(Expect, fracClass.ToString());
        }

        [TestMethod]
        public void InitNumber2()
        {
            TFrac fracClass = new TFrac(100, 100);
            string Expect = "1/1";
            Assert.AreEqual(Expect, fracClass.ToString());
        }

        [TestMethod]
        public void InitNumber3()
        {
            TFrac fracClass = new TFrac(-100, -99);
            string Expect = "100/99";
            Assert.AreEqual(Expect, fracClass.ToString());
        }

        [TestMethod]
        public void InitNumber4()
        {
            TFrac fracClass = new TFrac(0, 0);
            string Expect = "0/1";
            Assert.AreEqual(Expect, fracClass.ToString());
        }

        [TestMethod]
        public void InitNumber5()
        {
            TFrac fracClass = new TFrac(50, -5);
            string fracCompar = "-10/1";
            Assert.AreEqual(fracCompar, fracClass.ToString());
        }

        [TestMethod]
        public void Add1()
        {
            TFrac fracClass1 = new TFrac(1, 4);
            TFrac fracClass2 = new TFrac(-3, 4);
            fracClass2 = fracClass1.Add(fracClass2);
            string answer = "-1/2";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Add2()
        {
            TFrac fracClass1 = new TFrac(-1, 2);
            TFrac fracClass2 = new TFrac(-1, 2);
            fracClass2 = fracClass1.Add(fracClass2);
            string answer = "-1/1";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Add3()
        {
            TFrac fracClass1 = new TFrac(-6, 2);
            TFrac fracClass2 = new TFrac(6, 2);
            fracClass2 = fracClass1.Add(fracClass2);
            string answer = "0/1";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Add4()
        {
            TFrac fracClass1 = new TFrac(50, 3);
            TFrac fracClass2 = new TFrac(0, 1);
            fracClass2 = fracClass1.Add(fracClass2);
            string answer = "50/3";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Add5()
        {
            TFrac fracClass1 = new TFrac(0, 1);
            TFrac fracClass2 = new TFrac(0, 1);
            fracClass2 = fracClass1.Add(fracClass2);
            string answer = "0/1";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Multiply1()
        {
            TFrac fracClass1 = new TFrac(-1, 2);
            TFrac fracClass2 = new TFrac(-1, 2);
            fracClass2 = fracClass1.Mul(fracClass2);
            string answer = "1/4";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Multiply2()
        {
            TFrac fracClass1 = new TFrac(1, 6);
            TFrac fracClass2 = new TFrac(0, 1);
            fracClass2 = fracClass1.Mul(fracClass2);
            string answer = "0/1";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Multiply3()
        {
            TFrac fracClass1 = new TFrac(1, 6);
            TFrac fracClass2 = new TFrac(1, 6);
            fracClass2 = fracClass1.Mul(fracClass2);
            string answer = "1/36";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Multiply4()
        {
            TFrac fracClass1 = new TFrac(-1, 6);
            TFrac fracClass2 = new TFrac(12, 1);
            fracClass2 = fracClass1.Mul(fracClass2);
            string answer = "-2/1";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Multiply5()
        {
            TFrac fracClass1 = new TFrac(-1, 6);
            TFrac fracClass2 = new TFrac(12, 1);
            fracClass2 = fracClass1.Mul(fracClass2);
            string answer = "-2/1";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Substract1()
        {
            TFrac fracClass1 = new TFrac(0, 1);
            TFrac fracClass2 = new TFrac(1, 1);
            fracClass2 = fracClass1.Sub(fracClass2);
            string answer = "-1/1";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Substract2()
        {
            TFrac fracClass1 = new TFrac(5, 1);
            TFrac fracClass2 = new TFrac(1, 1);
            fracClass2 = fracClass1.Sub(fracClass2);
            string answer = "4/1";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Substract3()
        {
            TFrac fracClass1 = new TFrac(1, 2);
            TFrac fracClass2 = new TFrac(1, 2);
            fracClass2 = fracClass1.Sub(fracClass2);
            string answer = "0/1";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Substract4()
        {
            TFrac fracClass1 = new TFrac(-1, 6);
            TFrac fracClass2 = new TFrac(-1, 6);
            fracClass2 = fracClass1.Sub(fracClass2);
            string answer = "0/1";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Substract5()
        {
            TFrac fracClass1 = new TFrac(-1, 6);
            TFrac fracClass2 = new TFrac(2, 6);
            fracClass2 = fracClass1.Sub(fracClass2);
            string answer = "-1/2";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Divide1()
        {
            TFrac fracClass1 = new TFrac(5, 6);
            TFrac fracClass2 = new TFrac(1, 1);
            fracClass2 = fracClass1.Div(fracClass2);
            string answer = "5/6";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Divide2()
        {
            TFrac fracClass1 = new TFrac(1, 1);
            TFrac fracClass2 = new TFrac(5, 6);
            fracClass2 = fracClass1.Div(fracClass2);
            string answer = "6/5";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Divide3()
        {
            TFrac fracClass1 = new TFrac(0, 1);
            TFrac fracClass2 = new TFrac(5, 6);
            fracClass2 = fracClass1.Div(fracClass2);
            string answer = "0/1";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Divide4()
        {
            TFrac fracClass1 = new TFrac(2, 3);
            TFrac fracClass2 = new TFrac(7, 4);
            fracClass2 = fracClass1.Div(fracClass2);
            string answer = "8/21";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Divide5()
        {
            TFrac fracClass1 = new TFrac(2, 3);
            TFrac fracClass2 = new TFrac(2, 3);
            fracClass2 = fracClass1.Div(fracClass2);
            string answer = "1/1";
            Assert.AreEqual(answer, fracClass2.ToString());
        }

        [TestMethod]
        public void Reverse1()
        {
            TFrac fracClass = new TFrac(-2, 3);
            fracClass = fracClass.Reverse() as TFrac;
            string answer = "-3/2";
            Assert.AreEqual(answer, fracClass.ToString());
        }

        [TestMethod]
        public void Reverse2()
        {
            TFrac fracClass = new TFrac(0, 1);
            fracClass = fracClass.Reverse() as TFrac;
            string answer = "0/1";
            Assert.AreEqual(answer, fracClass.ToString());
        }

        [TestMethod]
        public void Reverse3()
        {
            TFrac fracClass = new TFrac(5, 6);
            fracClass = fracClass.Reverse() as TFrac;
            string answer = "6/5";
            Assert.AreEqual(answer, fracClass.ToString());
        }

        [TestMethod]
        public void Square1()
        {
            TFrac fracClass = new TFrac(2, 3);
            fracClass = fracClass.Square() as TFrac;
            string answer = "4/9";
            Assert.AreEqual(answer, fracClass.ToString());
        }

        [TestMethod]
        public void Square2()
        {
            TFrac fracClass = new TFrac(0, 1);
            fracClass = fracClass.Square() as TFrac;
            string answer = "0/1";
            Assert.AreEqual(answer, fracClass.ToString());
        }

        [TestMethod]
        public void Square3()
        {
            TFrac fracClass = new TFrac(-2, 3);
            fracClass = fracClass.Square() as TFrac;
            string answer = "4/9";
            Assert.AreEqual(answer, fracClass.ToString());
        }

        [TestMethod]
        public void Equal1()
        {
            TFrac fracClass1 = new TFrac(1, 3);
            TFrac fracClass2 = new TFrac(1, 3);
            Assert.IsTrue(fracClass1.Equal(fracClass2));
        }

        [TestMethod]
        public void Equal2()
        {
            TFrac fracClass1 = new TFrac(0, 6);
            TFrac fracClass2 = new TFrac(1, 6);
            Assert.IsFalse(fracClass1.Equal(fracClass2));
        }

        [TestMethod]
        public void Equal3()
        {
            TFrac fracClass1 = new TFrac(-1, 6);
            TFrac fracClass2 = new TFrac(-1, 6);
            Assert.IsTrue(fracClass1.Equal(fracClass2));
        }

        [TestMethod]
        public void Equal4()
        {
            TFrac fracClass1 = new TFrac(-1, 7);
            TFrac fracClass2 = new TFrac(1, 7);
            Assert.IsFalse(fracClass1.Equal(fracClass2));
        }

        [TestMethod]
        public void Equal5()
        {
            TFrac fracClass1 = new TFrac(1, 6);
            TFrac fracClass2 = new TFrac(0, 1);
            Assert.IsFalse(fracClass1.Equal(fracClass2));
        }

        [TestMethod]
        public void Greater1()
        {
            TFrac fracClass1 = new TFrac(1, 6);
            TFrac fracClass2 = new TFrac(0, 1);
            Assert.IsTrue(fracClass1 > fracClass2);
        }

        [TestMethod]
        public void Greater2()
        {
            TFrac fracClass1 = new TFrac(0, 1);
            TFrac fracClass2 = new TFrac(0, 1);
            Assert.IsFalse(fracClass1 > fracClass2);
        }

        [TestMethod]
        public void Greater3()
        {
            TFrac fracClass1 = new TFrac(-1, 6);
            TFrac fracClass2 = new TFrac(0, 1);
            Assert.IsFalse(fracClass1 > fracClass2);
        }

        [TestMethod]
        public void Greater4()
        {
            TFrac fracClass1 = new TFrac(17, 3);
            TFrac fracClass2 = new TFrac(16, 3);
            Assert.IsTrue(fracClass1 > fracClass2);
        }

        [TestMethod]
        public void Greater5()
        {
            TFrac fracClass1 = new TFrac(-2, 3);
            TFrac fracClass2 = new TFrac(-1, 3);
            Assert.IsFalse(fracClass1 > fracClass2);
        }
    }

    [TestClass]
    public class FracEditorTest
    {
        [TestMethod]
        public void TestInit1()
        {
            TEditor testClass = new TEditor();
            string input = "3/4";
            testClass.Fraction = input;
            Assert.AreEqual(input, testClass.Fraction);
        }
        [TestMethod]
        public void TestInit2()
        {
            TEditor testClass = new TEditor();
            string input = "-16/3";
            testClass.Fraction = input;
            Assert.AreEqual(input, testClass.Fraction);
        }
        [TestMethod]
        public void TestInit3()
        {
            TEditor testClass = new TEditor();
            string input = "0/8";
            testClass.Fraction = input;
            string result = "0/1";
            Assert.AreEqual(result, testClass.Fraction);
        }
        [TestMethod]
        public void TestInit4()
        {
            TEditor testClass = new TEditor();
            string input = "-17/4";
            testClass.Fraction = input;
            Assert.AreEqual(input, testClass.Fraction);
        }

        [TestMethod]
        public void TestInit5()
        {
            TEditor testClass = new TEditor();
            string input = "0/1";
            testClass.Fraction = input;
            Assert.AreEqual(input, testClass.Fraction);
        }

        [TestMethod]
        public void TestInit6()
        {
            TEditor testClass = new TEditor();
            string input = "666/6666";
            testClass.Fraction = input;
            string result = "111/1111";
            Assert.AreEqual(result, testClass.Fraction);
        }

        [TestMethod]
        public void TestInit7()
        {
            TEditor testClass = new TEditor();
            string input = "aaaa";
            testClass.Fraction = input;
            string result = "0/1";
            Assert.AreEqual(result, testClass.Fraction);
        }

        [TestMethod]
        public void TestInit8()
        {
            TEditor testClass = new TEditor();
            string input = "0/1";
            testClass.Fraction = input;
            Assert.AreEqual(input, testClass.Fraction);
        }

        [TestMethod]
        public void TestInit10()
        {
            TEditor testClass = new TEditor();
            string input = "16/000000";
            testClass.Fraction = input;
            string result = "0/1";
            Assert.AreEqual(result, testClass.Fraction);
        }

        [TestMethod]
        public void hasZero1()
        {
            TEditor testClass = new TEditor("14/3");
            Assert.AreEqual(false, testClass.IsZero());
        }
        [TestMethod]
        public void hasZero2()
        {
            TEditor testClass = new TEditor("16/00000");
            Assert.AreEqual(true, testClass.IsZero());
        }

        [TestMethod]
        public void ToogleMinus1()
        {
            TEditor testClass = new TEditor("14/3");
            testClass.ToggleMinus();
            string result = "-14/3";
            Assert.AreEqual(result, testClass.ToString());
        }
        [TestMethod]
        public void ToogleMinus2()
        {
            TEditor testClass = new TEditor("-14/3");
            testClass.ToggleMinus();
            string result = "14/3";
            Assert.AreEqual(result, testClass.ToString());
        }

        [TestMethod]
        public void AddDeleteTest1()
        {
            TEditor testClass = new TEditor("123/123");
            testClass.AddNumber(0);
            testClass.AddNumber(1);
            testClass.AddNumber(3);
            testClass.AddSeparator();
            testClass.ToggleMinus();
            string result = "-1/1013";
            Assert.AreEqual(result, testClass.ToString());
        }
        [TestMethod]
        public void AddDeleteTest2()
        {
            TEditor testClass = new TEditor(123, 123);
            testClass.RemoveSymbol();
            testClass.RemoveSymbol();
            testClass.RemoveSymbol();
            testClass.RemoveSymbol();
            testClass.RemoveSymbol();
            testClass.RemoveSymbol();
            testClass.RemoveSymbol();
            testClass.AddNumber(1);
            testClass.AddNumber(2);
            testClass.AddNumber(3);
            testClass.AddNumber(4);
            testClass.AddNumber(5);
            testClass.AddSeparator();
            testClass.AddNumber(1);
            testClass.AddNumber(1);
            testClass.AddNumber(1);
            testClass.AddNumber(1);
            string result = "12345/1111";
            Assert.AreEqual(result, testClass.ToString());
        }

        [TestMethod]
        public void AddDeleteTest3()
        {
            TEditor testClass = new TEditor(1234567, 12345678);
            for (int i = 0; i < 100; ++i)
                testClass.RemoveSymbol();
            for (int i = 0; i < 100; ++i)
                testClass.AddSeparator();
            testClass.AddNumber(1);
            testClass.AddNumber(1);
            testClass.AddNumber(1);
            testClass.AddNumber(1);
            string result = "1111";
            Assert.AreEqual(result, testClass.ToString());
        }
        [TestMethod]
        public void AddDeleteTest4()
        {
            TEditor testClass = new TEditor("0/1");
            for (int i = 0; i < 100; ++i)
                testClass.AddNumber(i);
            string result = "123456789";
            Assert.AreEqual(result, testClass.ToString());
        }
        [TestMethod]
        public void Clear()
        {
            TEditor testClass = new TEditor("2345678/345678");
            testClass.Clear();
            string result = "0";
            Assert.AreEqual(result, testClass.ToString());
        }
    }

    [TestClass]
    public class TMemoryTest
    {
        [TestMethod]
        public void InitAndOutput1()
        {
            TFrac frac = new TFrac(22, 33);
            TMemory<TFrac> memory = new TMemory<TFrac>(frac);
            string answer = "2/3";
            Assert.AreEqual(answer, memory.FNumber.ToString());
        }
        [TestMethod]
        public void InitAndOutput2()
        {
            TFrac frac = new TFrac();
            TMemory<TFrac> memory = new TMemory<TFrac>(frac);
            string answer = "0/1";
            Assert.AreEqual(answer, memory.FNumber.ToString());
        }
        [TestMethod]
        public void InitAndOutput3()
        {
            TFrac frac = new TFrac(-1, 5);
            TMemory<TFrac> memory = new TMemory<TFrac>(frac);
            string answer = "-1/5";
            Assert.AreEqual(answer, memory.FNumber.ToString());
        }

        [TestMethod]
        public void Sum1()
        {
            TFrac frac = new TFrac(-1, 5);
            TMemory<TFrac> memory = new TMemory<TFrac>(frac);
            TFrac summator = new TFrac(1, 2);
            memory.Add(summator);
            string answer = "3/10";
            Assert.AreEqual(answer, memory.FNumber.ToString());
        }

        [TestMethod]
        public void Sum2()
        {
            TFrac frac = new TFrac(8, 9);
            TMemory<TFrac> memory = new TMemory<TFrac>(frac);
            TFrac summator = new TFrac(-16, 3);
            memory.Add(summator);
            string answer = "-40/9";
            Assert.AreEqual(answer, memory.FNumber.ToString());
        }

        [TestMethod]
        public void TestFState1()
        {
            TFrac frac = new TFrac(8, 9);
            TMemory<TFrac> memory = new TMemory<TFrac>(frac);
            memory.Clear();
            bool expected = false;
            Assert.AreEqual(expected, memory.FState);
        }

        [TestMethod]
        public void TestFState2()
        {
            TFrac frac = new TFrac(8, 9);
            TMemory<TFrac> memory = new TMemory<TFrac>(frac);
            bool expected = false;
            Assert.AreEqual(expected, memory.FState);
        }

        [TestMethod]
        public void TestFState3()
        {
            TFrac frac = new TFrac(8, 9);
            TMemory<TFrac> memory = new TMemory<TFrac>(frac);
            memory.Add(frac);
            bool expected = true;
            Assert.AreEqual(expected, memory.FState);
        }
    }

    [TestClass]
    public class TProcTest
    {
        [TestMethod]
        public void Init1()
        {
            TFrac leftFrac = new TFrac();
            TFrac rightFrac = new TFrac();
            ADT_Proc<TFrac> proc = new ADT_Proc<TFrac>(leftFrac, rightFrac);
            string answer = "0/1";
            Assert.AreEqual(answer, proc.Left_Result_operand.ToString());
            Assert.AreEqual(answer, proc.Right_operand.ToString());
        }

        [TestMethod]
        public void Init2()
        {
            TFrac leftFrac = new TFrac(11, 3);
            TFrac rightFrac = new TFrac();
            ADT_Proc<TFrac> proc = new ADT_Proc<TFrac>(leftFrac, rightFrac);
            string answer = "11/3";
            Assert.AreEqual(answer, proc.Left_Result_operand.ToString());
        }

        [TestMethod]
        public void Init3()
        {
            TFrac leftFrac = new TFrac(16, 4);
            TFrac rightFrac = new TFrac(17, 9);
            ADT_Proc<TFrac> proc = new ADT_Proc<TFrac>(leftFrac, rightFrac);
            string answer = "17/9";
            Assert.AreEqual(answer, proc.Right_operand.ToString());
        }

        [TestMethod]
        public void Operation1()
        {
            TFrac leftFrac = new TFrac(1, 2);
            TFrac rightFrac = new TFrac(1, 2);
            ADT_Proc<TFrac> proc = new ADT_Proc<TFrac>(leftFrac, rightFrac);
            proc.Operation = 1;
            proc.DoOperation();
            string answer = "1/1";
            Assert.AreEqual(answer, proc.Left_Result_operand.ToString());
        }

        [TestMethod]
        public void Operation2()
        {
            TFrac leftFrac = new TFrac(3, 4);
            TFrac rightFrac = new TFrac(5, 6);
            ADT_Proc<TFrac> proc = new ADT_Proc<TFrac>(leftFrac, rightFrac);
            proc.Operation = 2;
            proc.DoOperation();
            string answer = "-1/12";
            Assert.AreEqual(answer, proc.Left_Result_operand.ToString());
        }

        [TestMethod]
        public void Operation3()
        {
            TFrac leftFrac = new TFrac(12, 7);
            TFrac rightFrac = new TFrac(5, 9);
            ADT_Proc<TFrac> proc = new ADT_Proc<TFrac>(leftFrac, rightFrac);
            proc.Operation = 3;
            proc.DoOperation();
            string answer = "20/21";
            Assert.AreEqual(answer, proc.Left_Result_operand.ToString());
        }

        [TestMethod]
        public void Operation4()
        {
            TFrac leftFrac = new TFrac(56, 7);
            TFrac rightFrac = new TFrac(-22, 3);
            ADT_Proc<TFrac> proc = new ADT_Proc<TFrac>(leftFrac, rightFrac);
            proc.Operation = 4;
            proc.DoOperation();
            string answer = "-12/11";
            Assert.AreEqual(answer, proc.Left_Result_operand.ToString());
        }

        [TestMethod]
        public void TestFState1()
        {
            TFrac leftFrac = new TFrac(56, 7);
            TFrac rightFrac = new TFrac(-22, 3);
            ADT_Proc<TFrac> proc = new ADT_Proc<TFrac>(leftFrac, rightFrac);
            proc.DoFunction(0);
            string answer = "-3/22";
            Assert.AreEqual(answer, proc.Right_operand.ToString());
        }

        [TestMethod]
        public void TestFState2()
        {
            TFrac leftFrac = new TFrac(56, 7);
            TFrac rightFrac = new TFrac(-22, 3);
            ADT_Proc<TFrac> proc = new ADT_Proc<TFrac>(leftFrac, rightFrac);
            proc.DoFunction(1);
            string answer = "484/9";
            Assert.AreEqual(answer, proc.Right_operand.ToString());
        }
    }
}
