using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace laboratoryWork_5
{
    public partial class FormMain : Form
    {
        private Rectangle rectangle, circle, square;
        private bool bool_rectangle, bool_circle, bool_square;
        private bool bool_rounded_rectangle, bool_rounded_circle, bool_rounded_square;
        
        private int rectangleZ, circleZ, squareZ;

        private bool dragging;
        
        private int oldX, oldY;
        public FormMain()
        {
            InitializeComponent();
            rectangle = new Rectangle(10, 10, 300, 150);
            rectangleZ = 1;
            bool_rounded_rectangle = false;
            circle = new Rectangle(420, 10, 150, 150);
            circleZ = 2;
            bool_rounded_circle = true;
            square = new Rectangle(630, 10, 150, 150);
            squareZ = 3;
            bool_rounded_square = false;

            dragging = false;
            

        }

        private void pictureBox_Paint(object sender, PaintEventArgs e)
        {
            if (rectangleZ < circleZ && rectangleZ < squareZ)
            {
                if (bool_rounded_rectangle) e.Graphics.FillEllipse(Brushes.Yellow, rectangle);
                else e.Graphics.FillRectangle(Brushes.Yellow, rectangle);
                if (circleZ < squareZ)
                {
                    if (bool_rounded_circle) e.Graphics.FillEllipse(Brushes.Red, circle);
                    else e.Graphics.FillRectangle(Brushes.Red, circle);
                    if (bool_rounded_square) e.Graphics.FillEllipse(Brushes.Blue, square);
                    else e.Graphics.FillRectangle(Brushes.Blue, square);
                }
                else
                {
                    if (bool_rounded_square) e.Graphics.FillEllipse(Brushes.Blue, square);
                    else e.Graphics.FillRectangle(Brushes.Blue, square);
                    if (bool_rounded_circle) e.Graphics.FillEllipse(Brushes.Red, circle);
                    else e.Graphics.FillRectangle(Brushes.Red, circle);
                }
            }
            else if (circleZ < rectangleZ && circleZ < squareZ)
            {
                if (bool_rounded_circle) e.Graphics.FillEllipse(Brushes.Red, circle);
                else e.Graphics.FillRectangle(Brushes.Red, circle);
                if (rectangleZ < squareZ)
                {
                    if (bool_rounded_rectangle) e.Graphics.FillEllipse(Brushes.Yellow, rectangle);
                    else e.Graphics.FillRectangle(Brushes.Yellow, rectangle);
                    if (bool_rounded_square) e.Graphics.FillEllipse(Brushes.Blue, square);
                    else e.Graphics.FillRectangle(Brushes.Blue, square);
                }
                else
                {
                    if (bool_rounded_square) e.Graphics.FillEllipse(Brushes.Blue, square);
                    else e.Graphics.FillRectangle(Brushes.Blue, square);
                    if (bool_rounded_rectangle) e.Graphics.FillEllipse(Brushes.Yellow, rectangle);
                    else e.Graphics.FillRectangle(Brushes.Yellow, rectangle);
                }
            }
            else
            {
                if (bool_rounded_square) e.Graphics.FillEllipse(Brushes.Blue, square);
                else e.Graphics.FillRectangle(Brushes.Blue, square);
                if (circleZ < rectangleZ)
                {
                    if (bool_rounded_circle) e.Graphics.FillEllipse(Brushes.Red, circle);
                    else e.Graphics.FillRectangle(Brushes.Red, circle);
                    if (bool_rounded_rectangle) e.Graphics.FillEllipse(Brushes.Yellow, rectangle);
                    else e.Graphics.FillRectangle(Brushes.Yellow, rectangle);
                }
                else
                {
                    if (bool_rounded_rectangle) e.Graphics.FillEllipse(Brushes.Yellow, rectangle);
                    else e.Graphics.FillRectangle(Brushes.Yellow, rectangle);
                    if (bool_rounded_circle) e.Graphics.FillEllipse(Brushes.Red, circle);
                    else e.Graphics.FillRectangle(Brushes.Red, circle);
                }
            }
        }

        private void pictureBox_MouseDown(object sender, MouseEventArgs e)
        {
            oldX = e.X;
            oldY = e.Y;
            int tmp = 0;
            
            if (oldX >= rectangle.X &&
                oldX <= rectangle.X + rectangle.Width &&
                oldY >= rectangle.Y &&
                oldY <= rectangle.Y + rectangle.Height)
            {
                tmp = rectangleZ;
            }
            if (oldX >= circle.X &&
                oldX <= circle.X + circle.Width &&
                oldY >= circle.Y &&
                oldY <= circle.Y + circle.Height)
            {
                if (tmp < circleZ)
                {
                    tmp = circleZ;
                }
            }
            if (oldX >= square.X &&
                oldX <= square.X + square.Width &&
                oldY >= square.Y &&
                oldY <= square.Y + square.Height)
            {
                if (tmp < squareZ)
                {
                    tmp = squareZ;
                }
            }

            if (tmp != 0)
            {
                dragging = true;
                if (tmp == rectangleZ)
                {
                    bool_rectangle = true;
                    rectangleZ = 3;
                    if (circleZ > squareZ)
                    {
                        circleZ = 2;
                        squareZ = 1;
                    }
                    else
                    {
                        squareZ = 2;
                        circleZ = 1;
                    }
                }
                else if (tmp == circleZ)
                {
                    bool_circle = true;
                    circleZ = 3;
                    if (rectangleZ > squareZ)
                    {
                        rectangleZ = 2;
                        squareZ = 1;
                    }
                    else
                    {
                        squareZ = 2;
                        rectangleZ = 1;
                    }
                }
                else
                {
                    bool_square = true;
                    squareZ = 3;
                    if (circleZ > rectangleZ)
                    {
                        circleZ = 2;
                        rectangleZ = 1;
                    }
                    else
                    {
                        rectangleZ = 2;
                        circleZ = 1;
                    }
                }
            }
        }

        private void pictureBox_MouseMove(object sender, MouseEventArgs e)
        {
            if (dragging)
            {
                if (bool_rectangle)
                {
                    rectangle.X = e.X - (oldX - rectangle.X);
                    rectangle.Y = e.Y - (oldY - rectangle.Y);
                    if (
                        ((labelView.Location.X < rectangle.X + rectangle.Width) &&
                         (labelView.Location.X > rectangle.X) &&
                         (labelView.Location.Y < rectangle.Y + rectangle.Height) &&
                         (labelView.Location.Y > rectangle.Y)
                         ) || 
                        ((labelView.Location.X + labelView.Width  < rectangle.X + rectangle.Width) &&
                         (labelView.Location.X + labelView.Width > rectangle.X) &&
                         (labelView.Location.Y < rectangle.Y + rectangle.Height) && 
                         (labelView.Location.Y > rectangle.Y)
                         )
                        )
                    {
                        labelInfo.Text = "Жёлтый ";
                        if (bool_rounded_rectangle)
                            labelInfo.Text += "овал";
                        else
                            labelInfo.Text += "прямоугольник";
                    }
                    
                }
                else if (bool_circle)
                {
                    circle.X = e.X - (oldX - circle.X);
                    circle.Y = e.Y - (oldY - circle.Y);
                    if (
                        ((labelView.Location.X < circle.X + circle.Width) &&
                         (labelView.Location.X > circle.X) &&
                         (labelView.Location.Y < circle.Y + circle.Height) &&
                         (labelView.Location.Y > circle.Y)
                        ) || 
                        ((labelView.Location.X + labelView.Width  < circle.X + circle.Width) &&
                         (labelView.Location.X + labelView.Width > circle.X) &&
                         (labelView.Location.Y < circle.Y + circle.Height) && 
                         (labelView.Location.Y > circle.Y)
                        )
                        )
                    {
                        labelInfo.Text = "Красный ";
                        if (bool_rounded_circle)
                            labelInfo.Text += "круг";
                        else
                            labelInfo.Text += "квадрат";
                    }
                }
                else
                {
                    square.X = e.X - (oldX - square.X);
                    square.Y = e.Y - (oldY - square.Y);
                    if (
                        ((labelView.Location.X < square.X + square.Width) &&
                         (labelView.Location.X > square.X) &&
                         (labelView.Location.Y < square.Y + square.Height) &&
                         (labelView.Location.Y > square.Y)
                        ) || 
                        ((labelView.Location.X + labelView.Width  < square.X + square.Width) &&
                         (labelView.Location.X + labelView.Width > square.X) &&
                         (labelView.Location.Y < square.Y + square.Height) && 
                         (labelView.Location.Y > square.Y)
                        )
                    )
                    {
                        labelInfo.Text = "Синий ";
                        if (bool_rounded_square)
                            labelInfo.Text += "круг";
                        else
                            labelInfo.Text += "квадрат";
                    }
                }

                oldX = e.X;
                oldY = e.Y;
            }
            pictureBox.Invalidate();
        }

        private void pictureBox_MouseUp(object sender, MouseEventArgs e)
        {
            if (dragging)
            {
                if (bool_rectangle)
                {
                    if (
                        ((labelForm.Location.X < rectangle.X + rectangle.Width) &&
                         (labelForm.Location.X > rectangle.X) &&
                         (labelForm.Location.Y < rectangle.Y + rectangle.Height) &&
                         (labelForm.Location.Y > rectangle.Y)
                        ) || 
                        ((labelForm.Location.X + labelForm.Width  < rectangle.X + rectangle.Width) &&
                         (labelForm.Location.X + labelForm.Width > rectangle.X) &&
                         (labelForm.Location.Y < rectangle.Y + rectangle.Height) && 
                         (labelForm.Location.Y > rectangle.Y)
                        )
                        )
                        bool_rounded_rectangle = !bool_rounded_rectangle;
                    bool_rectangle = false;
                }
                else if (bool_circle)
                {
                    if (
                        ((labelForm.Location.X < circle.X + circle.Width) &&
                         (labelForm.Location.X > circle.X) &&
                         (labelForm.Location.Y < circle.Y + circle.Height) &&
                         (labelForm.Location.Y > circle.Y)
                        ) || 
                        ((labelForm.Location.X + labelForm.Width  < circle.X + circle.Width) &&
                         (labelForm.Location.X + labelForm.Width > circle.X) &&
                         (labelForm.Location.Y < circle.Y + circle.Height) && 
                         (labelForm.Location.Y > circle.Y)
                        )
                    )
                        bool_rounded_circle = !bool_rounded_circle;
                    bool_circle = false;
                }
                else
                {
                    if (
                        ((labelForm.Location.X < square.X + square.Width) &&
                         (labelForm.Location.X > square.X) &&
                         (labelForm.Location.Y < square.Y + square.Height) &&
                         (labelForm.Location.Y > square.Y)
                        ) || 
                        ((labelForm.Location.X + labelForm.Width  < square.X + square.Width) &&
                         (labelForm.Location.X + labelForm.Width > square.X) &&
                         (labelForm.Location.Y < square.Y + square.Height) && 
                         (labelForm.Location.Y > square.Y)
                        )
                    )
                        bool_rounded_square = !bool_rounded_square;
                    bool_square = false;
                }
            }
            pictureBox.Invalidate();
            dragging = false;

        }
    }
}