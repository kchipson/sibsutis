cmake_minimum_required(VERSION 3.15)
project(lab2_computerArchitecture)

set(CMAKE_CXX_STANDARD 20)

set(LIB_SOURCE lib/mySimpleComputer.cpp lib/mySimpleComputer.hpp lib/myTerm.cpp lib/myTerm.h)

add_library(mySimpleComputer STATIC ${LIB_SOURCE})

add_executable(lab2_computerArchitecture main.cpp)
target_link_libraries(lab2_computerArchitecture mySimpleComputer)
