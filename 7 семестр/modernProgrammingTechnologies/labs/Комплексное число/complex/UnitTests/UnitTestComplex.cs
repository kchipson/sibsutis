using Microsoft.VisualStudio.TestTools.UnitTesting;
using System;
using complex;

namespace UnitTests
{
    [TestClass]
    public class UnitTestComplex
    {
        [TestMethod]
        public void TestTComplexDouble()
        {
            var testClass = new Complex(9.99, 0.44);

            Assert.AreEqual(testClass.Real, 9.99);
            Assert.AreEqual(testClass.Imaginary, 0.44);
        }
        [TestMethod]
        public void TestTComplexString()
        {
            string output = "9,99 + i * 0,44";
            var testClass = new Complex(output);

            Assert.AreEqual(testClass.Real, 9.99);
            Assert.AreEqual(testClass.Imaginary, 0.44);
        }
        [TestMethod]
        public void TestTComplexStringEx()
        {
            void Action()
            {
                string output = "9,5i +i3,1";
                new Complex(output);
            }
            Action action = new Action(Action);

            Assert.ThrowsException<MyException>(action);
        }


        [TestMethod]
        public void TestCopy()
        {
            var test1 = new Complex(9.89, 0.44);
            var test2 = test1.Copy();

            Assert.AreEqual(test1.Real, test2.Real);
            Assert.AreEqual(test1.Imaginary, test2.Imaginary);
        }

        [TestMethod]
        public void TestAdd()
        {
            var test1 = new Complex(3, 4);
            var test2 = new Complex(4, -1);
            var resulr = test1.Add(test2);

            Assert.AreEqual(resulr.Real, 7);
            Assert.AreEqual(resulr.Imaginary, 3);
        }

        [TestMethod]
        public void TestMultiply()
        {
            var test1 = new Complex(3, 4);
            var test2 = new Complex(4, -1);
            var resulr = test1.Multiplication(test2);

            Assert.AreEqual(resulr.Real, 16);
            Assert.AreEqual(resulr.Imaginary, 13);
        }

        [TestMethod]
        public void TestSubstract()
        {
            var test1 = new Complex(3, 4);
            var test2 = new Complex(4, -1);
            var resulr = test1.Subtract(test2);

            Assert.AreEqual(resulr.Real, -1);
            Assert.AreEqual(resulr.Imaginary, 5);
        }

        [TestMethod]
        public void TestDivide()
        {
            var test1 = new Complex(3, 4);
            var test2 = new Complex(4, -1);
            var resulr = test1.Divide(test2);

            Assert.AreEqual(resulr.Real, 0.470588, 5);
            Assert.AreEqual(resulr.Imaginary, 1.117647, 5);
        }

        [TestMethod]
        public void TestSquare()
        {
            var test1 = new Complex(3, 4);
            var resulr = test1.Square();

            Assert.AreEqual(resulr.Real, -7);
            Assert.AreEqual(resulr.Imaginary, 24);
        }

        [TestMethod]
        public void TestReverse()
        {
            var test1 = new Complex(0, -3);
            var resulr = test1.Reverse();

            Assert.AreEqual(resulr.Real, 0);
            Assert.AreEqual(resulr.Imaginary, 0.333333, 5);
        }

        [TestMethod]
        public void TestMinus()
        {
            var test1 = new Complex(0, 4);
            var resulr = test1.Minus();

            Assert.AreEqual(resulr.Real, 0);
            Assert.AreEqual(resulr.Imaginary, -4);
        }

        [TestMethod]
        public void TestAbs()
        {
            var test1 = new Complex(3, 4);
            var resulr = test1.Abs();

            Assert.AreEqual(resulr, 5);
        }

        [TestMethod]
        public void TestRad()
        {
            var test1 = new Complex(3, 4);
            var resulr = test1.Rad();

            Assert.AreEqual(0.927295, resulr, 5);
        }

        [TestMethod]
        public void TestDegree()
        {
            var test1 = new Complex(3, 4);
            var resulr = test1.Degree();

            Assert.AreEqual(53.1301, resulr, 4);
        }

        [TestMethod]
        public void TestPow()
        {
            var test1 = new Complex(3, 4);
            var resulr = test1.Pow(5);

            Assert.AreEqual(resulr.Real, -237, 4);
            Assert.AreEqual(resulr.Imaginary, -3116, 4);
        }

        [TestMethod]
        public void TestRoot()
        {
            var test1 = new Complex(3, 4);
            var resulr = test1.Sqrt(3, 4);

            Assert.AreEqual(resulr.Real, 2.567133, 5);
            Assert.AreEqual(resulr.Imaginary, 2.142468, 5);
        }

        [TestMethod]
        public void TestRavnFalse()
        {
            var test1 = new Complex(3, 4);
            var test2 = new Complex(4, -1);
            var resulr = test1.Equal(test2);

            Assert.IsFalse(resulr);
        }
        [TestMethod]
        public void TestRavnTrue()
        {
            var test1 = new Complex(3, 4);
            var resulr = test1.Equal(test1);

            Assert.IsTrue(resulr);
        }

        [TestMethod]
        public void TestNeRavnFalse()
        {
            var test1 = new Complex(3, 4);
            var test2 = new Complex(4, -1);
            var resulr = test1.NotEqual(test2);

            Assert.IsTrue(resulr);
        }
        [TestMethod]
        public void TestNeRavnTrue()
        {
            var test1 = new Complex(3, 4);
            var resulr = test1.NotEqual(test1);

            Assert.IsFalse(resulr);
        }

        [TestMethod]
        public void TestGetRealNumber()
        {
            var test1 = new Complex(3, 4);
            var resulr = test1.GetRealNumber();

            Assert.AreEqual(resulr, 3);
        }

        [TestMethod]
        public void TestGetImaginaryNumber()
        {
            var test1 = new Complex(3, 4);
            var resulr = test1.GetImaginaryNumber();

            Assert.AreEqual(resulr, 4);
        }

        [TestMethod]
        public void TestGetRealString()
        {
            var test1 = new Complex(3, 4);
            var resulr = test1.GetRealString();

            Assert.AreEqual(resulr, "3");
        }

        [TestMethod]
        public void TestGetImaginaryString()
        {
            var test1 = new Complex(3, 4);
            var resulr = test1.GetImaginaryString();

            Assert.AreEqual(resulr, "4");
        }

        [TestMethod]
        public void TestGetString()
        {
            var test1 = new Complex(3, 4);
            var resulr = test1.GetString();

            Assert.AreEqual(resulr, "3 + i * 4");
        }
    }
}
