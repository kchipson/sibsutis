cmake_minimum_required(VERSION 3.15)
project(lab1_computerArchitecture)

set(CMAKE_CXX_STANDARD 20)

set(LIB_SOURCE lib/mySimpleComputer.cpp lib/mySimpleComputer.hpp)

add_library(mySimpleComputer STATIC ${LIB_SOURCE})

add_executable(lab1_computerArchitecture main.cpp)
target_link_libraries(lab1_computerArchitecture mySimpleComputer)
