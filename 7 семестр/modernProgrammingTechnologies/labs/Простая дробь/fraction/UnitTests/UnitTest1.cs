using System;
using Microsoft.VisualStudio.TestTools.UnitTesting;
using fraction;

namespace UniyTestProject
{
    [TestClass]
    public class UnitTest1
    {
        [TestMethod]
        public void TestTFracInt()
        {
            TFrac frc = new Frac(10, 5);

            Assert.AreEqual(2, frc.Numerator);
            Assert.AreEqual(1, frc.Denominator);
        }

        [TestMethod]
        public void TestTFracInt2()
        {
            void Action()
            {
                new Frac(1, 0);
            }

            Action action = new Action(Action);

            Assert.ThrowsException<MyException>(action);
        }

        [TestMethod]
        public void TestTFracStr1()
        {
            var frc = new Frac("99/88");

            Assert.AreEqual(9, frc.Numerator);
            Assert.AreEqual(8, frc.Denominator);
        }
        [TestMethod]
        public void TestTFracStr2()
        {
            void Action()
            {
                new Frac("1/0");
            }
            Action action = new Action(Action);

            Assert.ThrowsException<MyException>(action);
        }
    

        [TestMethod]
        public void TestCopy()
        {
            var a = new Frac(10, 5);
            var fCopy = a.Copy();

            Assert.AreEqual(a.Numerator, fCopy.Numerator);
            Assert.AreEqual(a.Denominator, fCopy.Denominator);
        }

        [TestMethod]
        public void TestAdd()
        {
            var a = new Frac(1, 2);
            var b = new Frac(1, 3);
            var res = a + b;

            Assert.AreEqual(5, res.Numerator);
            Assert.AreEqual(6, res.Denominator);
        }

        [TestMethod]
        public void TestDifference()
        {
            var a = new Frac(1, 2);
            var b = new Frac(1, 3);
            var res = a - b;

            Assert.AreEqual(1, res.Numerator);
            Assert.AreEqual(6, res.Denominator);
        }

        [TestMethod]
        public void TestMultiplication()
        {
            var a = new Frac(11, 2);
            var b = new Frac(13, 7);
            var res = a * b;

            Assert.AreEqual(143, res.Numerator);
            Assert.AreEqual(14, res.Denominator);
        }

        [TestMethod]
        public void TestDivision()
        {
            var a = new Frac(1, 2);
            var b = new Frac(2, 4);
            var res = a / b;

            Assert.AreEqual(1, res.Numerator);
            Assert.AreEqual(1, res.Denominator);
        }

        [TestMethod]
        public void TestSquare()
        {
            var a = new Frac(3, 2);
            var res = a.Square();

            Assert.AreEqual(9, res.Numerator);
            Assert.AreEqual(4, res.Denominator);
        }

        [TestMethod]
        public void TestReverse()
        {
            var a = new Frac(3, 2);
            var res = a.Reverse();

            Assert.AreEqual(2, res.Numerator);
            Assert.AreEqual(3, res.Denominator);
        }

        [TestMethod]
        public void TestMinus()
        {
            var a = new Frac(3, 2);
            var res = a.Minus();

            Assert.AreEqual(-3, res.Numerator);
            Assert.AreEqual(2, res.Denominator);
        }

        [TestMethod]
        public void TestRavn()
        {
            var a = new Frac(1, 2);
            var b = new Frac(1, 2);
            var res = a == b;

            Assert.IsTrue(res);
        }

        [TestMethod]
        public void TestMore()
        {
            var a = new Frac(2, 3);
            var b = new Frac(1, 2);
            var res = a > b;

            Assert.IsTrue(res);
        }

        [TestMethod]
        public void TestGetNumeratorNumber()
        {
            var a = new Frac(2, 3);
            var res = a.GetNumeratorNumber();

            Assert.AreEqual(2, res);
        }

        [TestMethod]
        public void TestGetDenominatorNumber()
        {
            var a = new Frac(2, 3);
            var res = a.GetDenominatorNumber();

            Assert.AreEqual(3, res);
        }

        [TestMethod]
        public void TestGetNumeratorString()
        {
            var a = new Frac(2, 3);
            var res = a.GetNumeratorString();

            Assert.AreEqual("2", res);
        }

        [TestMethod]
        public void TestGetDenominatorString()
        {
            var a = new Frac(2, 3);
            var res = a.GetDenominatorString();

            Assert.AreEqual("3", res);
        }

        [TestMethod]
        public void TestGetString()
        {
            var a = new Frac(7, 10);
            var res = a.GetString();

            Assert.AreEqual("7/10", res);
        }
    }
}
