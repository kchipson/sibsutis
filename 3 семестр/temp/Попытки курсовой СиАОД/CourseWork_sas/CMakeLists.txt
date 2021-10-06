cmake_minimum_required(VERSION 3.15)
project(CourseWork_sas)

set(CMAKE_CXX_STANDARD 17)

set(CMAKE_CXX_FLAGS "${CMAKE_CXX_FLAGS} -static-libgcc -fexec-charset=CP866")
add_executable(CourseWork_sas main.cpp struct.hpp func.cpp func.hpp func.cpp func.hpp funcOut.cpp funcOut.hpp rotationsAVL.cpp rotationsAVL.hpp)